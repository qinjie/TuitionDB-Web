<?php

class TuitionClassController extends Controller {
    public $layout = '//layouts/column1_centered';

    public function filters() {
        return array(
            'accessControl', 
            'postOnly + delete', 
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('create', 'update', 'delete'),
                'users' => array('@'),
                'expression' => '$user->isVerified && ($user->isCenter || $user->isAdmin)'
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionCreate($branchId) {
        $branch = TuitionBranch::model()->findByPk($branchId);
        if (!$branch)
            throw new CHttpException(401, 'Invalid Request');
        $center = $branch->center;
        if (!$center->hasRights())
            throw new CHttpException(401, 'The function is restricted');
        $model = new TuitionClass;
        $model->tuitionBranchId = $branchId;

        if (isset($_POST['TuitionClass'])) {
            $model->attributes = $_POST['TuitionClass'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'branch' => $branch,
            'model' => $model,
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $center = $model->tuitionBranch->center;
        if (!$center->hasRights()) 
            throw new CHttpException(401, 'The function is restricted');
        
        if (isset($_POST['TuitionClass'])) {
            $model->attributes = $_POST['TuitionClass'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($id);;
            $center = $model->tuitionBranch->tuitionCenter;
            if (!$center->hasRights()) 
                throw new CHttpException(401, 'The function is restricted');
            $model->delete();
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    public function loadModel($id) {
        $model = TuitionClass::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tuition-class-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function getIdStr()
    {
        return str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }

}
