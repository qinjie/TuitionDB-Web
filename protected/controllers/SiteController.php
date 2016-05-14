<?php

class SiteController extends Controller
{

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('index', 'contact', 'test', 'test2', 'center', 'tutor', 'aboutUs', 'captcha'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('login'),
                'users' => array('?'),
            ),
            array('allow',
                'actions' => array('reset', 'resetOk', 'logout', 'download'),
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
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }
    
    public function actionAboutUs() {
        $this->render('about-us');
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $assignProvider = new CActiveDataProvider('Assignment', array(
            'criteria' => array(
                'condition' => 'statusCode=' . Assignment::STATUS_POSTED . ' OR statusCode=' . Assignment::STATUS_MATCHED,
                'with' => array('dictCategory' => array('alias' => 'level')),
                'order' => 'created DESC',
                'limit' => 10,
            ),
            'pagination' => array(
                'pageSize' => 5,
            ),
        ));

        $tutorProvider = new CActiveDataProvider('Tutor', array(
            'criteria' => array(
                'with' => array('tutorQualification', 'locations'),
                'order' => 't.created DESC',
//                'condition' => 'DATEDIFF(DATE(NOW()),DATE(t.created)) <= 7',
                'limit' => 4,
            ),
            'pagination' => array(
                'pageSize' => 4,
            ),
        ));

        $classProvider = new CActiveDataProvider('TuitionClass', array(
            'criteria' => array(
                'with' => array('dictClassLevel', 'dictSubject'),
                'order' => 't.created DESC',
                'limit' => 5,
            ),
            'pagination' => array(
                'pageSize' => 5,
            ),
        ));

        $this->render('index', array(
            'assignProvider' => $assignProvider,
            'tutorProvider' => $tutorProvider,
            'classProvider' => $classProvider,
        ));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $this->layout = '//layouts/column1_centered';
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                    "Reply-To: {$model->email}\r\n" .
                    "MIME-Version: 1.0\r\n" .
                    "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $model = new LoginForm;
        if (isset($_GET['username'])) {
            $model->username = $_GET['username'];
        }

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        $model->password = null;
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout(true);
        $this->redirect(Yii::app()->homeUrl);
    }

    // reset password
    public function actionReset()
    {
        $model = new PasswordResetForm;
        if (isset($_POST['PasswordResetForm'])) {
            $model->attributes = $_POST['PasswordResetForm'];
            if ($model->validate()) {
                // send email
//                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
//                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
//                $headers = "From: $name <{$model->email}>\r\n" .
//                        "Reply-To: {$model->email}\r\n" .
//                        "MIME-Version: 1.0\r\n" .
//                        "Content-Type: text/plain; charset=UTF-8";
//                mail($model->email, $subject, $model->body, $headers);

                $this->render('passwordResetOk', array('model' => $model));
                return;
            }
        }

        if (isset($_GET['email'])) {
            $model->email = $_GET['email'];
        }
        $this->render('passwordReset', array('model' => $model));
    }

    public function actionResetOk()
    {

//        $this->render('reset', array('model' => $model));
    }

    public function actionTest()
    {
//        header('WWW-Authenticate: Basic realm="Top Secret Files"');
        $this->actionTest2(array('one','two','three'));
    }

    public function actionTest2($array)
    {
        var_dump($array);
    }

    // showing the profile page of a center with $nick
    public function actionCenter($nick)
    {
        $model = TuitionCenter::model()->findByAttributes(array('nick'=>$nick));
        if($model){
            $this->redirect($model->url);
        }
    }

    // showing the profile page of a tutor
    public function actionTutor($nick)
    {
        $model = TutorStatus::model()->findByAttributes(array('nick'=>$nick));
        if($model){
            $this->redirect($model->tutor->url);
        }
    }
}

