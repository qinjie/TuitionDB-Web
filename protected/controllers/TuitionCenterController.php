<?php

class TuitionCenterController extends BlockController
{
    public $layout = '//layouts/column1_centered';

    public function filters()
    {
        return array(
            'accessControl', 
            'postOnly + delete',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow', 
                'actions' => array('view', 'profile', 'list', 'logo', 'photo', 'gallery', 'registerAccount', 'sendVerificationEmail', 'registrationOk', 'registrationFailed', 'public'),
                'users' => array('*'),
            ),
            array('allow', 
                'actions' => array('uploadFile'),
                'users' => array('@'),
            ),
            array('allow', 
                'actions' => array('update', 'uploadLogo', 'managePhotos', 'deletePhoto'),
                'users' => array('@'),
                'expression' => '$user->isCenter && $user->isVerified'
            ),
            array('allow',
                'actions' => array('createCenter'),
                'users' => array('@'),
                'expression' => '$user->isAdmin'
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id = null)
    {
        if ($id == null) {
            $id = Helper::getCurrentCenterId();
            if (!$id)
                throw new CHttpException(401, 'Invalid request. This function is for tuition center only.');
        }

        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionUpdate($id = null)
    {
        if ($id == null) {
            $id = Helper::getCurrentCenterId();
        }
        $model = $this->loadModel($id);
        if (!$model->hasRights()) {
            throw new CHttpException(401, 'The function is restricted.');
        }
        
        if (isset($_GET['returnUrl'])) {
            $returnUrl = $_GET['returnUrl'];
        } else {
            $returnUrl = null;
        }
        if (isset($_POST['TuitionCenter'])) {
            $model->attributes = $_POST['TuitionCenter'];
            if ($model->save()) {
                if ($returnUrl)
                    $this->redirect(Yii::app()->createUrl($returnUrl));
                else
                    $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }
    
    public function actionList() {
        $this->layout = '//layouts/column1';
        $dataProvider = new CActiveDataProvider('TuitionCenter', array(
            'pagination' => array(
                'pageSize' => 10
            ),
            'criteria' => array(
                'scopes' => 'available'
            )
        ));
        $showFilter = true;
        $centerName = null;
        $selectedClassLevels = array();
        $selectedSubjects = array();
        $selectedWeekdays = array();
        $selectedMrtStations = array();
        
        if (isset($_POST['Filter'])) {
            $showFilter = false;
            $criteria = new CDbCriteria;
            $criteria->with = array('branches','branches.classes');

            // Filter by name
            if (isset($_POST['Filter']['CenterName'])) {
                $centerName = trim($_POST['Filter']['CenterName']);
                if (strlen($centerName) > 0){
                    $keywords = explode(' ', $centerName);
                    foreach ($keywords as $keyword)
                        $criteria->addSearchCondition('t.name', $keyword);   
                }
//                $criteria->addCondition('t.name LIKE "%'.$centerName.'%"');
            }
            
            // Filter by class level
            if (isset($_POST['ClassLevel'])) {
                $selectedClassLevels = $_POST['ClassLevel'];
                $ids = join(',',$selectedClassLevels);
                $criteria->addCondition("classes.dictClassLevelId in ($ids)");
            }
            
            
            // Filter by location
            if (isset($_POST['MrtStation'])) {
                $selectedMrtStations = $_POST['MrtStation'];
                $ids = join(',',$selectedMrtStations);
                $criteria->addCondition("branches.dictMrtStationId in ($ids)");
            }
            
            // Filter by weekday
            if (isset($_POST['Weekday'])) {
                $selectedWeekdays = $_POST['Weekday'];
                $ids = join(',',$selectedWeekdays);
                $criteria->addCondition("classes.weekday in ($ids)");
            }

            // Filter by subject
            if (isset($_POST['Subject'])) {
                $selectedSubjects = $_POST['Subject'];
                $ids = join(',', $selectedSubjects);
                $criteria->addCondition("classes.dictSubjectId in ($ids)");
            }
            $criteria->distinct = true;
            $criteria->select = "t.*";
            $criteria->scopes = 'available';
            $centers = TuitionCenter::model()->findAll($criteria);
            $dataProvider->setData($centers);
            $dataProvider->setTotalItemCount(count($centers));
        }
        $this->render('list',array(
            'dataProvider' => $dataProvider,
            'showFilter' => $showFilter,
            'centerName' => $centerName,
            'selectedClassLevels' => $selectedClassLevels,
            'selectedSubjects' => $selectedSubjects,
            'selectedWeekdays' => $selectedWeekdays,
            'selectedMrtStations' => $selectedMrtStations,
        ));
    }

    public function actionRegisterAccount()
    {
        $this->layout = '//layouts/column1';
        $model = new User;
        $model->accountType = User::TYPE_CENTER;
        $center = new TuitionCenter;
        $centerStaff = new TuitionCenterStaff;

        if (isset($_POST['User']) && isset($_POST['TuitionCenter'])) {
            $model->attributes = $_POST['User'];
            $center->attributes = $_POST['TuitionCenter'];
            $centerStaff->attributes = $_POST['TuitionCenterStaff'];
            $pass = $model->password;
            
            $transaction = Yii::app()->db->beginTransaction();
            try {
                if ($model->validate() * $center->validate(array('name')) * $centerStaff->validate(array('fullName'))) {
                    $model->save(false);
                    $center->ownerId = $model->id;
                    $center->verified = 0;
                    $center->save(false);
                    $centerStaff->tuitionCenterId = $center->id;
                    $centerStaff->userId = $model->id;
                    $centerStaff->email = $model->username;
                    $centerStaff->save(false);
                    $transaction->commit();

                    //-- Publish it to Facebook page
                    // Moved it to UserController. We should publish it after center's account has been verified
                    // FacebookHelper::postNewCenter($center);

                    if (Yii::app()->params['sendActivationMail']) {
                        $model->sendVerificationMail();
                    }
                    
                    if (UserController::login($model->username, $pass)) {
                        $this->redirect(array('tuitionCenterStaff/view'));
                    } else {
                        $this->redirect(array('site/index'));
                    }
                }
            } catch (Exception $e) {
                if ($transaction->getActive())
                    $transaction->rollback();
                throw new CHttpException(500, $e->getMessage());
            }
        }

        $model->password = null;
        $model->repeat_password = null;
        $this->render('registerAccount', array(
            'model' => $model,
            'center' => $center,
            'centerStaff' => $centerStaff,
        ));
    }

    public function actionSendVerificationEmail($userId)
    {
        $user = User::model()->findByPk($userId);

        $message = new YiiMailMessage;
        $message->setFrom(Yii::app()->params['adminEmail']);
        $message->setSubject('Welcome to TuitionDB');
        $message->addTo($user->username);
        if (isset(Yii::app()->controller))
            $controller = Yii::app()->controller;
        else
            $controller = new CController('YiiMail');
        // Render the verification email view
        $viewPath = Yii::getPathOfAlias(Yii::app()->mail->viewPath . '.verify') . '.php';
        $body = $controller->renderInternal($viewPath, array('user' => $user), true);
        $message->setBody($body, 'text/html', null);

        $result = 0;
        try {
            $result = Yii::app()->mail->send($message);
        } catch (Exception $e) {
            Yii::log($e->getMessage(), 'error', 'emailing');
            $result = 0;
        }

        return $result;
    }

    public function actionRegistrationOk($id)
    {
        $model = User::model()->findByPk($id);
        $this->render('registrationOk', array('model' => $model));
    }

    public function actionCreateCenter()
    {
        $model = new TuitionCenter;

        if (isset($_POST['TuitionCenter'])) {
            $model->attributes = $_POST['TuitionCenter'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('createCenter', array(
            'model' => $model,
        ));
    }

    public function actionProfile($id = null)
    {
        if ($id == null) {
            $id = Helper::getCurrentCenterId();
        }
        $model = TuitionCenter::model()->findByPk($id);
        if (!$model)
            throw new CHttpException(404);
        $classesProvider = new CActiveDataProvider('TuitionClass', array(
            'criteria' => array(
                'condition' => 'tuitionbranch.tuitionCenterId = :centerId',
                'join' => 'JOIN tuitionbranch on t.tuitionBranchId = tuitionbranch.id',
                'params' => array(
                    ':centerId' => $id
                )
            )
        ));
        $this->render('profile', array(
            'model' => $model,
            'classesProvider' => $classesProvider,
        ));

    }

    // File upload action for EFineUploader
    public function actionUploadFile() {
        $tempFolder = Yii::getPathOfAlias('webroot') . '/upload/temp/';

        if (!file_exists($tempFolder) && !is_dir($tempFolder))
            mkdir($tempFolder, 0777, TRUE);
        if (!file_exists($tempFolder . '/chunks') && !is_dir($tempFolder . '/chunks'))
            mkdir($tempFolder . 'chunks', 0777, TRUE);

        Yii::log("Before upload files... ", "info", "actionUploadFile");

        Yii::import("ext.EFineUploader.qqFileUploader");

        $uploader = new qqFileUploader();
        $uploader->allowedExtensions = array('jpg', 'jpeg', 'png');
        $uploader->sizeLimit = 10 * 1024 * 1024; //maximum file size in bytes
        $uploader->chunksFolder = $tempFolder . 'chunks';

        $result = $uploader->handleUpload($tempFolder);
        $result['filename'] = $uploader->getUploadName();
        $result['folder'] = $tempFolder;

        if (array_key_exists('error', $result))
            Yii::log("After upload files... " . print_r($result,1), "error", "actionUploadFile");
        else
            Yii::log("After upload files... " . print_r($result,1), "info", "actionUploadFile");

        ob_clean();
        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    }
    
    public function actionUploadLogo() {
        $tuitionCenterId = Yii::app()->user->profile->tuitionCenterId;
        $center = TuitionCenter::model()->findByPk($tuitionCenterId);
        if (!$center->hasRights()) {
            throw new CHttpException(401, 'The function is restricted.');
        }
        if ($center->logo) {
            $model = $center->logo;
        } else {
            $model = new TuitionCenterLogo;
            $model->tuitionCenterId = $center->id;
            $model->caption = $center->name;
        }

        if (isset($_POST['TuitionCenterLogo']) && isset($_POST['uploadfile']) && isset($_POST['uploadfolder'])) {
            $model->attributes = $_POST['TuitionCenterLogo'];
            $filepath = $_POST['uploadfolder'] . $_POST['uploadfile'];
            if (file_exists($filepath)) {
                //http://kohanaframework.org/3.0/guide/api/Image
                $image = Yii::app()->image->load($filepath);
                $image->resize(200, 200)->quality(75)->sharpen(20)->save();

                // copy the logo to photo/center folder
                $temp = explode(".",$_POST['uploadfile']);
                $newfilename = $center->id . '.' .end($temp);
                $tempFolder = Yii::getPathOfAlias('webroot') . '/photo/center/';
                if (!file_exists($tempFolder) && !is_dir($tempFolder))
                    mkdir($tempFolder, 0777, TRUE);
                if (file_exists($filepath) && is_writable($tempFolder)) {
                    $ok = copy($filepath, $tempFolder . $newfilename);
                }

                ob_start();
                $image->render(); 
                $processedImage = ob_get_contents();
                ob_end_clean();
                header('Content-type: text/html');
                $model->fileName = $_POST['uploadfile'];
                $model->fileType = $image->ext;
                $model->fileBinary = $processedImage;
                $model->save(false);
                Helper::cleanTempFolder();
            }
        }

        $this->render('upload_logo', array(
            'model' => $model,
        ));
    }
    
    // Download the center's logo
    public function actionLogo($id) {
        $centerLogo = TuitionCenterLogo::model()->findByAttributes(array('tuitionCenterId' => $id));
        if ($centerLogo) {
            header('Content-type: image/' . $centerLogo->fileType);
            echo $centerLogo->fileBinary;
//        } else {
//            header('Content-type: image/png');
//            echo file_get_contents(Yii::getPathOfAlias('webroot').'/images/default-center-logo.png');
        }
    }
    
    // Download the center's photos
    public function actionPhoto($id, $photoId) {
        $centerPhoto = TuitionCenterPhoto::model()->findByAttributes(array('tuitionCenterId' => $id, 'id' => $photoId));
        if ($centerPhoto) {
            header('Content-type: image/' . $centerPhoto->fileType);
            echo $centerPhoto->fileBinary;
        }
    }
    
    public function actionManagePhotos() {
        $this->layout = '//layouts/column1_centered';
        $tuitionCenterId = Yii::app()->user->profile->tuitionCenterId;
        $center = TuitionCenter::model()->findByPk($tuitionCenterId);
        if (!$center->hasRights()) {
            throw new CHttpException(401, 'The function is restricted.');
        }
        $model = new TuitionCenterPhoto;
        $model->tuitionCenterId = $center->id;
        $photoProvider = $model->search();
        $photoProvider->pagination = false;
        $model->caption = $center->name;

        if (isset($_POST['TuitionCenterPhoto']) && isset($_POST['uploadfile']) && isset($_POST['uploadfolder'])) {
            $model->attributes = $_POST['TuitionCenterPhoto'];
            $filepath = $_POST['uploadfolder'] . $_POST['uploadfile'];
            if (file_exists($filepath)) {
                //http://kohanaframework.org/3.0/guide/api/Image
                $image = Yii::app()->image->load($filepath);
                $image->resize(900,900,Image::AUTO)->quality(75)->save();
                ob_start();
                $image->render(); 
                $processedImage = ob_get_contents();
                ob_end_clean();
                header('Content-type: text/html');
                $model->fileName = $_POST['uploadfile'];
                $model->fileType = $image->ext;
                $model->fileBinary = $processedImage;
                $model->save(false);
                Helper::cleanTempFolder();
            }
        }
        $this->render('manage_photos', array(
            'model' => $model,
            'photoProvider' => $photoProvider,
        ));
    }
    
    /**
     * 
     * @param int $id The photo's ID
     */
    public function actionDeletePhoto($id) {
        if (!Yii::app()->request->isPostRequest) 
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        $photo = TuitionCenterPhoto::model()->findByPk($id);
        if (!$photo) 
            throw new CHttpException(401, 'Invalid request');
        if (!$photo->tuitionCenter->hasRights())
            throw new CHttpException(401, 'The function is restricted');
        $photo->delete();
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('tuitionCenter/managePhotos'));    
        }
    }
    
    public function actionGallery($id) {
        $center = $this->loadModel($id);
        if ($center) {
            $photos = $center->photos;
            $this->renderPartial('gallery',array(
                'center' => $center,
                'photos' => $photos,
            ),false, true);
        } else {
            throw new CHttpException(404);
        }
    }

    public function loadModel($id)
    {
        $model = TuitionCenter::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tuition-center-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionPublic($nick) {
        $model = TuitionCenter::model()->findByAttributes(array('nick'=>$nick));
        if (!$model)
            throw new CHttpException(404);
        $classesProvider = new CActiveDataProvider('TuitionClass', array(
            'criteria' => array(
                'condition' => 'tuitionbranch.tuitionCenterId = :centerId',
                'join' => 'JOIN tuitionbranch on t.tuitionBranchId = tuitionbranch.id',
                'params' => array(
                    ':centerId' => $model->id
                )
            )
        ));
        $this->render('profile', array(
            'model' => $model,
            'classesProvider' => $classesProvider,
        ));
    }
}