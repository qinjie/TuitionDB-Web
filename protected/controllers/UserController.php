<?php

class UserController extends Controller
{

    public $layout = '//layouts/column1_centered';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('signUp', 'verifyEmail', 'passwordReset', 'enterNewPass', 'captcha'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('register', 'registerAsRequestor', 'registerAsTutor'),
                'users' => array('?'),
            ),
            array('allow',
                'actions' => array('passwordChange', 'sendVerificationMail', 'profile'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
        );
    }

    public function actionProfile()
    {
        if (Yii::app()->user->isGuest) {
            $this->redirect("site/login");
        }
        if (Yii::app()->user->isTutor) {
            $this->redirect("tutor/profile");
        } else if (Yii::app()->user->isRequestor) {
            $this->redirect("requestor/profile");
        } else if (Yii::app()->user->isCenter) {
            $this->redirect("tuitionCenterStaff/view");
        } else {
            $this->redirect("site/index");
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new User;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $model->password = $model->hashPassword($model->password);
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $model->repeat_password = $model->password;
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('User');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new User('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['User'])) {
            $model->attributes = $_GET['User'];
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionSignUp($id)
    {
        $model = new User;

        if ($id == User::TYPE_TUTOR || $id == User::TYPE_REQUESTOR || $id == User::TYPE_CENTER || $id == User::TYPE_ADMIN) {
            $model->accountType = $id;
        } else {
            // redirect user to homepage if request is invalid
            Yii::app()->getController()->redirect(array('/site/index'));
        }

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save()) {
                $model->password = $model->hashPassword($model->password);
                $model->save(false);
                $this->render('signupok', array('model' => $model));
                return;
            }
        }

        $this->render('signup', array('model' => $model));
    }

    public function actionRegister()
    {
        $this->render('register');
    }

    public function actionRegisterAsTutor($step = 1)
    {
        $this->layout = '//layouts/column1';
        Yii::app()->getSession()->open();
        // retrieve $tutor from session
        if (Yii::app()->session['Tutor']) {
            $tutor = Yii::app()->session['Tutor'];
        }
        switch ($step) {
            case 1:
                $user = new User;
                $user->accountType = User::TYPE_TUTOR;
                $tutor = new Tutor;
                $validated = true;

                // collect user data
                if (isset($_POST['User'])) {
                    $user->attributes = $_POST['User'];
                    $validated = $user->validate() && $validated;
                } else {
                    $validated = false;
                }
                // save user to session if it's valid
                if ($validated) {
                    Yii::app()->session['NewUser'] = $user;
                }
                // collect tutor data
                if (isset($_POST['Tutor'])) {
                    $tutor->attributes = $_POST['Tutor'];
                    $tutor->email = $user->username;
                    $validated = $tutor->validate() && $validated;
                } else {
                    $validated = false;
                }
                if ($validated) {
                    $_SESSION['Tutor'] = $tutor;
                    $this->redirect(array('user/registerAsTutor', 'step' => 2));
                }
                $user->password = null;
                $user->repeat_password = null;
                $this->render('registerAsTutor/step1', array('user' => $user, 'tutor' => $tutor));
                break;
            case 2:
                // If user hasn't completed step 1, navigate to step 1
                if (!isset($tutor)) {
                    $this->redirect(array('user/registerAsTutor'));
                }
                $subjects = array();
                $hrates = array();
                $error = null;
                // collect subject & hourly rate data
                if (Yii::app()->request->getRequestType() == 'POST') {
                    if (isset($_POST['Subject']) && isset($_POST['HRate'])) {
                        foreach ($_POST['Subject'] as $subjectId) {
                            $tutorSubject = new TutorSubject;
                            $tutorSubject->dictSubjectId = $subjectId;
                            array_push($subjects, $tutorSubject);
                        }
                        $validate = true;
                        foreach ($_POST['HRate'] as $catId => $hourlyRate) {
                            $tutorHourlyRate = new TutorHourlyRate;
                            $tutorHourlyRate->dictCategoryId = $catId;
                            $tutorHourlyRate->hourlyRate = $hourlyRate;
                            $validate = $tutorHourlyRate->validate(array('hourlyRate')) && $validate;
                            array_push($hrates, $tutorHourlyRate);
                        }
                        if ($validate) {
                            $_SESSION['Subject'] = $subjects;
                            $_SESSION['HRate'] = $hrates;
                            $this->redirect(array('user/registerAsTutor', 'step' => 3));
                        }
                    } else {
                        $error = 'Please add at least one subject';
                    }
                }
                $this->render('registerAsTutor/step2', array(
                    'subjects' => $subjects,
                    'hourlyRates' => $hrates,
                    'error' => $error
                ));
                break;
            case 3:
                // If user hasn't completed step 2, navigate to step 2
                if (!isset($_SESSION['Subject'])) {
                    $this->redirect(array('user/registerAsTutor', 'step' => 2));
                }
                $mrtMessage = null;
                $scheduleMessage = null;
                // The following arrays are for displaying the station and time slot rows in case of error
                $mrtStations = array();
                $schedules = array();
                if (Yii::app()->request->getRequestType() == 'POST') {
                    $validate = true;
                    // Collect mrt station data. $tutorLocations is for storing in session
                    $tutorLocations = array();
                    if (isset($_POST['Station'])) {
                        foreach ($_POST['Station'] as $stationId) {
                            $tutorLocation = new TutorLocation;
                            $tutorLocation->dictMrtStationId = $stationId;
                            array_push($tutorLocations, $tutorLocation);
                        }
                        $_SESSION['Station'] = $tutorLocations;
                        $validate = $validate && true;
                    } else {
                        $mrtMessage = 'You need to add at least one MRT station';
                        $validate = false;
                    }

                    // Collect time slot data. $tutorSchedules is for storing in session
                    $tutorSchedules = array();
                    if (isset($_POST['TimeSlot'])) {
                        foreach ($_POST['TimeSlot'] as $scheduleId) {
                            $tutorSchedule = new TutorSchedule;
                            $tutorSchedule->dictScheduleId = $scheduleId;
                            array_push($tutorSchedules, $tutorSchedule);
                        }
                        $_SESSION['TimeSlot'] = $tutorSchedules;
                        $validate = $validate && true;
                    } else {
                        $scheduleMessage = 'You need to add at least one time slot';
                        $validate = false;
                    }

                    if ($validate) {
                        $this->redirect(array('user/registerAsTutor', 'step' => 4));
                    } else {
                        if (isset($_POST['Station'])) {
                            $mrtStations = DictMrtStation::model()->with('mrtLine')->findAllByPk($_POST['Station']);
                        }
                        if (isset($_POST['TimeSlot'])) {
                            $schedules = DictSchedule::model()->findAllByPk($_POST['TimeSlot']);
                        }
                    }
                }

                $this->render('registerAsTutor/step3', array(
                    'mrtMessage' => $mrtMessage,
                    'scheduleMessage' => $scheduleMessage,
                    'mrtStations' => $mrtStations,
                    'schedules' => $schedules,
                ));
                break;
            case 4:
                // If user hasn't completed step 3, navigate to step 3
                if (!isset($_SESSION['Station'])) {
                    $this->redirect(array('user/registerAsTutor', 'step' => 3));
                }
                $schools = array();
                $tutorExamResults = array(); // $tutorExamResults[$examCode][TutorExamResult]
                $tutorOtherSkills = array();

                $validate = Yii::app()->request->getRequestType() == 'POST';
                if (isset($_POST['School'])) {
                    foreach ($_POST['School'] as $id => $school) {
                        $tutorSchool = new TutorSchool;
                        $tutorSchool->attributes = $school;
                        array_push($schools, $tutorSchool);
                        $validate = $tutorSchool->validate(array('school', 'course')) && $validate;
                    }
                }

                if (isset($_POST['ExamResult'])) {
                    foreach ($_POST['ExamResult'] as $examCode => $examResults) {
                        if (!isset($tutorExamResults[$examCode])) {
                            $tutorExamResults[$examCode] = array();
                        }
                        foreach ($examResults as $examResult) {
                            $tutorExamResult = new TutorExamResult;
                            $tutorExamResult->examCode = $examCode;
                            $tutorExamResult->dictSubjectId = $examResult['dictSubjectId'];
                            $tutorExamResult->grade = $examResult['grade'];
                            $validate = $tutorExamResult->validate(array('dictSubjectId', 'grade')) && $validate;
                            array_push($tutorExamResults[$examCode], $tutorExamResult);
                        }
                    }
                }

                if (isset($_POST['OtherSkill'])) {
                    foreach ($_POST['OtherSkill'] as $otherSkill) {
                        $tutorOtherSkill = new TutorOtherSkill;
                        $tutorOtherSkill->attributes = $otherSkill;
                        $validate = $tutorOtherSkill->validate(array('skill', 'achievement')) && $validate;
                        array_push($tutorOtherSkills, $tutorOtherSkill);
                    }
                }

                if ($validate) {
                    $_SESSION['TutorSchool'] = $schools;
                    $_SESSION['ExamResult'] = $tutorExamResults;
                    $_SESSION['TutorOtherSkill'] = $tutorOtherSkills;

                    $this->redirect(array('user/registerAsTutor', 'step' => 5));
                }

                for ($i = 0; $i <= 2; $i++) {
                    if (!isset($tutorExamResults[$i]))
                        $tutorExamResults[$i] = array();
                }

                $this->render('registerAsTutor/step4', array(
                    'schools' => $schools,
                    'tutorExamResults' => $tutorExamResults,
                    'otherSkills' => $tutorOtherSkills,
                    'validate' => $validate || Yii::app()->request->getRequestType() == 'GET',
                ));
                break;
            case 5:
                // If user hasn't completed step 3, navigate to step 3
                // User can enter nothing at step 4
                if (!isset($_SESSION['Station'])) {
                    $this->redirect(array('user/registerAsTutor', 'step' => 3));
                }
                $tutorQualification = new TutorQualification;

                if (isset($_POST['TutorQualification'])) {
                    $tutorQualification->attributes = $_POST['TutorQualification'];

                    if ($tutorQualification->validate(array('dictTutorQualificationId', 'experienceStyle'))) {
                        $_SESSION['TutorQualification'] = $tutorQualification;
                        $this->redirect(array('user/registerAsTutor', 'step' => 6));
                    }
                }

                $this->render('registerAsTutor/step5', array('tutorQualification' => $tutorQualification));
                break;
            case 6:
                // If user hasn't completed step 5, navigate to step 5
                if (!isset($_SESSION['TutorQualification'])) {
                    $this->redirect(array('user/registerAsTutor', 'step' => 5));
                }

                $tutorStatus = new TutorStatus;
                $confirmForm = new ConfirmationForm;
                if (isset($_POST['TutorStatus']) && isset($_POST['ConfirmationForm'])) {
                    $tutorPhoto = new TutorPhoto;
                    $uploadedFile = CUploadedFile::getInstanceByName('TutorPhoto');
                    if (!is_null($uploadedFile) && isset($_POST['Crop'])) {
                        $tutorPhoto->processPhoto($uploadedFile, $_POST['Crop']);
                    }
                    $tutorStatus->tutorStatusCode = TutorStatus::STATUS_AVAILABLE;
                    $tutorStatus->nick = $_POST['TutorStatus']['nick'];
                    $confirmForm->attributes = $_POST['ConfirmationForm'];

                    if ($tutorStatus->validate(array('nick')) * $confirmForm->validate()) {
                        // Save everything to database
                        $user = $_SESSION['NewUser'];
                        $subjects = $_SESSION['Subject'];
                        $hourlyRates = $_SESSION['HRate'];
                        $tutorLocations = $_SESSION['Station'];
                        $tutorSchedules = $_SESSION['TimeSlot'];
                        $schools = $_SESSION['TutorSchool'];
                        $tutorExamResults = $_SESSION['ExamResult'];
                        $tutorOtherSkills = $_SESSION['TutorOtherSkill'];
                        $tutorQualification = $_SESSION['TutorQualification'];

                        $user->accountType = User::TYPE_TUTOR;
                        $pass = $user->password;

                        $transaction = Yii::app()->db->beginTransaction();
                        try {
                            $user->save(false);
                            $tutor->userId = $user->id;
                            $tutor->save(false);
                            foreach ($subjects as $subject) {
                                $subject->tutorId = $tutor->id;
                                $subject->save(false);
                            }
                            foreach ($hourlyRates as $hourlyRate) {
                                $hourlyRate->tutorId = $tutor->id;
                                $hourlyRate->save(false);
                            }
                            foreach ($tutorLocations as $tutorLocation) {
                                $tutorLocation->tutorId = $tutor->id;
                                $tutorLocation->save(false);
                            }
                            foreach ($tutorSchedules as $tutorSchedule) {
                                $tutorSchedule->tutorId = $tutor->id;
                                $tutorSchedule->save(false);
                            }
                            foreach ($schools as $tutorSchool) {
                                $tutorSchool->tutorId = $tutor->id;
                                $tutorSchool->save(false);
                            }
                            foreach ($tutorExamResults as $examCode => $results) {
                                foreach ($results as $tutorExamResult) {
                                    $tutorExamResult->tutorId = $tutor->id;
                                    $tutorExamResult->save(false);
                                }
                            }
                            foreach ($tutorOtherSkills as $tutorOtherSkill) {
                                $tutorOtherSkill->tutorId = $tutor->id;
                                $tutorOtherSkill->save(false);
                            }
                            $tutorQualification->tutorId = $tutor->id;
                            $tutorQualification->save(false);
                            if (!empty($tutorPhoto->fileBinary)) {
                                $tutorPhoto->tutorId = $tutor->id;
                                $tutorPhoto->save(false);
                            }
                            $tutorStatus->tutorId = $tutor->id;
                            $tutorStatus->save(false);

                            $transaction->commit();

                            // TODO pending ... no in use now
//                            $tutor->findMatchingAssignments();

                            //-- Post it to Facebook page
                            FacebookHelper::postNewTutor($tutor->id);

                            Yii::app()->getSession()->clear(); // Remove all variables
                            UserController::login($user->username, $pass);
                            if (Yii::app()->params['sendActivationMail'])
                                $user->sendVerificationMail();
                            $this->redirect(array('tutor/profile'));
                        } catch (Exception $e) {
                            if ($transaction->getActive())
                                $transaction->rollback();
                            Yii::log('RegisterAsTutor(): ' . $e->getMessage(), 'error', 'emailing');
                            Yii::app()->user->setFlash('error', "So sorry! There is an error occured in your registration. We will investigate and rectify the problem as soon as possible.");
                        }
                    }
                }
                $this->render('registerAsTutor/step6',array(
                    'tutorStatus' => $tutorStatus,
                    'confirmForm' => $confirmForm,
                ));
                break;
        }
    }

    public function actionRegisterAsRequestor()
    {
        $this->layout = '//layouts/column1';
        Yii::app()->getSession()->open();
        $user = new User;
        $user->accountType = User::TYPE_REQUESTOR;
        $requestor = new Requestor;
        $confirmForm = new ConfirmationForm;
        $mrtStation = null;

        $validate = true;
        if (isset($_POST['User']) && isset($_POST['Requestor'])) {
            $user->attributes = $_POST['User'];
            $validate = $user->validate() && $validate;
            $requestor->attributes = $_POST['Requestor'];
            $requestor->email = $user->username;
            $mrtStationId = isset($_POST['Requestor']['dictMrtStationId']) ? $_POST['Requestor']['dictMrtStationId'] : null;
            $mrtStation = DictMrtStation::model()->findByPk($mrtStationId);
            $validate = $requestor->validate() && $validate;
        } else {
            $validate = false;
        }

        // collect confirmForm data
        if (isset($_POST['ConfirmationForm'])) {
            $confirmForm->attributes = $_POST['ConfirmationForm'];
            $validate = $confirmForm->validate() && $validate;
        }
        
        if ($validate) {
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $user->save(false);
                $requestor->userId = $user->id;
                $requestor->save(false);
                $transaction->commit();
                UserController::login($_POST['User']['username'], $_POST['User']['password']);
                if (Yii::app()->params['sendActivationMail']) {
                    $result = $user->sendVerificationMail();
                    if ($result > 0)
                        Yii::app()->user->setFlash('success', "Thank you for joining TuitionDB. A verification email has been sent to your email.");
                }
                $this->redirect(array('requestor/profile'));
//                $this->redirect(array('assignment/create', 'skippable' => 1));
            } catch (CException $e) {
                if ($transaction->getActive())
                    $transaction->rollback();
                Yii::log('RegisterAsRequestor(): ' . '\n ' . $e->getMessage(), 'error', 'emailing');
                //Database Error: Cannot create user account
                Yii::app()->user->setFlash('error', "So sorry! There is an error occured in your registration. We will investigate and rectify the problem as soon as possible.");
            }
        }
        $user->password = null;
        $user->repeat_password = null;
        $this->render('registerAsRequestor/step1', array(
            'user' => $user,
            'requestor' => $requestor,
            'confirmForm' => $confirmForm,
            'mrtStation' => $mrtStation,
        ));
    }

    public function actionPasswordChange()
    {
//        switch ( Yii::app()->user->user->accountType) {
//            case User::TYPE_REQUESTOR:
//                $this->layout = 'requestorProfile';
//                break;
//            case User::TYPE_TUTOR:
//                $this->layout = 'tutorProfile';
//                break;
//        }
        $model = new PasswordChangeForm;
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['PasswordChangeForm'])) {
            $model->attributes = $_POST['PasswordChangeForm'];
            if ($model->validate() && $model->changePassword()) {
                Yii::app()->user->setFlash('success', '<strong>Success!</strong> Your password has been changed.');
                $this->redirect($this->action->id);
            }
        }
        $model->currentPassword = null;
        $model->newPassword = null;
        $model->newPassword_repeat = null;
        $this->render('passwordChange', array('model' => $model));
    }

    public function actionVerifyEmail($userId, $token)
    {
        $user = User::model()->findByAttributes(array('id' => $userId, 'sessionToken' => $token));
        if ($user !== null) {
            if ($user->isVerified) {
                $this->render('verifyEmail/verified', array('model'=>$user));
            } else {
                $user->isVerified = 1;
                $user->save(false);
                if ($user->isCenter) {
                    $center = $user->tuitioncenterstaff->tuitionCenter;
                    $center->verified = 1;
                    $center->save(false);
                    
                    FacebookHelper::postNewCenter($center);
                }
                Yii::app()->user->logout();
                $this->render('verifyEmail/ok', array('model'=>$user));
            }
        } else {
            throw new CHttpException(404);
        }
    }

    public function actionSendVerificationMail($redirect)
    {
        $this->layout = '//layouts/column1_centered';
        $result = Yii::app()->user->user->sendVerificationMail();
        if ($result > 0) {
            Yii::app()->user->setFlash('success', 'An email have been sent to your email address. Please check your inbox');
            $this->render('verifyEmail/emailSent');
        } else {
            $this->render('verifyEmail/emailNotSent');
        }
//        if ($redirect) {
//            $this->redirect(array($redirect));
//        }
//        $this->redirect('site/index');
    }

    public function actionPasswordReset()
    {
        $resetForm = new PasswordResetForm;
        if (isset($_POST['PasswordResetForm'])) {
            $resetForm->attributes = $_POST['PasswordResetForm'];
            if ($resetForm->validate()) {
                User::sendPasswordResetMail($resetForm->email);
                Yii::app()->user->setFlash('success', 'An email has been sent to ' . $resetForm->email);
                $this->redirect(array('site/index'));
            }
        }
        $this->render('passwordReset/password_reset', array(
            'model' => $resetForm,
        ));
    }

    /**
     * This action confirms the  email address entered to actionPasswordReset,
     * and let user enter a new password
     * @param string $token
     */
    public function actionEnterNewPass($userId, $token)
    {
        $user = User::model()->findByAttributes(array('id' => $userId, 'sessionToken' => $token));
        if ($user !== null) {
            $model = new NewPasswordEnterForm;
            if (isset($_POST['NewPasswordEnterForm'])) {
                $model->attributes = $_POST['NewPasswordEnterForm'];
                if ($model->validate()) {
                    $user->password = $user->hashPassword($model->newPassword);
                    $user->save();
                    Yii::app()->user->setFlash('success', 'Your password has been successfully changed');
                    $this->redirect(array('site/login'));
                }
            } else {
                $this->render('passwordReset/enter_new_pass', array(
                    'model' => $model
                ));
            }
        } else {
            throw new CHttpException(404);
        }
    }

    public static function login($username, $password)
    {
        $identity = new UserIdentity($username, $password);
        $identity->authenticate();
        if ($identity->errorCode === UserIdentity::ERROR_NONE) {
            Yii::app()->user->login($identity, Yii::app()->params['cookiesTimeout']);
            return true;
        }
        return false;
    }

    /*
     * Login with a User object
     * @param User $user
     */
    public static function loginUser($user)
    {
        if (!$user instanceof User || $user->isNewRecord) {
            return false;
        }
        $identity = new UserIdentity($user->username, null);
        $identity->user = $user;
        Yii::app()->user->login($identity, Yii::app()->params['cookiesTimeout']);
        return true;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = User::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
