<?php

class TuitionCenterStaffController extends Controller
{
    public $layout = '//layouts/column1';

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
        return array(
            array('allow', 
                'actions' => array('update', 'view'),
                'users' => array('@'),
                'expression' => '$user->isCenter || $user->isAdmin'
            ),
            array('allow', 
                'actions' => array('invite', 'myStaffs'),
                'users' => array('@'),
                'expression' => '$user->isVerified && ($user->isCenter || $user->isAdmin)'
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id = null)
    {
        if ($id == null) {
            $id = Helper::getCurrentCenterStaffId();
            if (!$id)
                throw new CHttpException(401, 'Invalid request.');
        }
        $model = $this->loadModel($id);
        if (!$model->tuitionCenter->hasRights()) {
            throw new CHttpException(401, 'The function is restricted.');
        }

        $this->render('view', array(
            'model' => $model,
        ));
    }

    public function actionInvite($id = null)
    {
        if ($id == null) {
            $id = Yii::app()->user->profile->tuitionCenterId;
        } elseif (!Yii::app()->user->isAdmin)
            throw new CHttpException(401, 'The function is only for admin.');

        $model = new TuitionCenterStaff;
        $model->tuitionCenterId = $id;
        $user = new User();
        $user->password = '12345'; //ModelHelper::getRandomPassword();
        $user->accountType = User::TYPE_CENTER;

        if (!$model->tuitionCenter->hasRights()) {
            throw new CHttpException(401, 'The function is restricted.');
        }

        if (isset($_POST['TuitionCenterStaff'])) {
            $model->attributes = $_POST['TuitionCenterStaff'];
//            if (TuitionCenterStaff::model()->exists('tuitionCenterId = :tuitionCenterId AND email = :email', array(':tuitionCenterId' => $model->tuitionCenterId, ':email' => $model->email))) {
//                $model = TuitionCenterStaff::model()->find('tuitionCenterId = :tuitionCenterId AND email = :email', array(':tuitionCenterId' => $model->tuitionCenterId, ':email' => $model->email));
//            }
//            if (User::model()->exists('username=:username', array(':username' => $model->email))) {
//                $user = User::model()->findBySql('username=:username', array(':username' => $model->email));
//                $model->userId = $user->id;
//            } else {
            $user->attributes = $_POST['User'];
            $model->email = $user->username;
            if ($user->save(true, array('username'))) {
                $model->userId = $user->id;
                if ($model->save()) {
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }

        $this->render('invite', array(
            'model' => $model,
            'user' => $user,
        ));
    }

    public function actionUpdate($id = null)
    {
        if ($id == null) {
            $id = Helper::getCurrentCenterStaffId();
            if (!$id)
                throw new CHttpException(401, 'Invalid request.');
        }
        $model = $this->loadModel($id);
        if (!$model->tuitionCenter->hasRights()) {
            throw new CHttpException(401, 'The function is restricted.');
        }
        if (isset($_GET['returnUrl']))
            $returnUrl = $_GET['returnUrl'];
        else
            $returnUrl = null;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['TuitionCenterStaff'])) {
            $model->attributes = $_POST['TuitionCenterStaff'];
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

//    public function actionDelete($id)
//    {
//        if (Yii::app()->request->isPostRequest) {
//            // we only allow deletion via POST request
//            $this->loadModel($id)->delete();
//
//            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//            if (!isset($_GET['ajax'])) {
//                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
//            }
//        } else {
//            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
//        }
//    }

    public function actionMyStaffs($id = null)
    {
        if ($id == null) {
            $id = Yii::app()->user->profile->tuitionCenterId;
        }
        $center = TuitionCenter::model()->findByPk($id);
        if (!$center->hasRights()) {
            throw new CHttpException(401, 'The function is restricted.');
        }

        $this->layout = '//layouts/column1';
        $criteria = new CDbCriteria();
        if ($id)
            $criteria->addCondition('tuitionCenterId = ' . $id);
        $dataProvider = new CActiveDataProvider('TuitionCenterStaff', array(
            'criteria' => $criteria,
        ));

        $this->render('myStaffs', array(
            'center' => $center,
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return TuitionCenterStaff the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = TuitionCenterStaff::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param TuitionCenterStaff $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tuition-center-staff-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}