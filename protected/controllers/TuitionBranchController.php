<?php

class TuitionBranchController extends Controller
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
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', 
                'actions' => array('create', 'update','admin', 'delete'),
                'users' => array('@'),
                'expression' => '$user->isVerified && ($user->isCenter || $user->isAdmin)'
            ),
            array('deny', 
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id)
    {
        $model = $this->loadModel($id);
//        $tuitionCenter = $model->tuitionCenter;
//        if (!$tuitionCenter->hasRights()) {
//            throw new CHttpException(401,'The function is restricted');
//        }
        $classProvider = new CActiveDataProvider('TuitionClass', array(
            'criteria' => array(
                'condition' => 'tuitionBranchId = :tuitionBranchId',
                'params' => array(
                    ':tuitionBranchId' => $id
                )
            )
        ));
        $this->render('view', array(
            'model' => $model,
            'classProvider' => $classProvider,
        ));
    }

    public function actionCreate($centerId = null)
    {
        if ($centerId == null) {
            $centerId = Helper::getCurrentCenterId();
            if (!$centerId)
                throw new CHttpException(401,'Invalid request');
        }
        $tuitionCenter = TuitionCenter::model()->findByPk($centerId);
        if (!$tuitionCenter->hasRights()) {
            throw new CHttpException(401,'The function is restricted');
        }
        
        $model = new TuitionBranch;
        $mrtStation = null;
        if (isset($_POST['TuitionBranch'])) {
            $model->attributes = $_POST['TuitionBranch'];
            $model->tuitionCenterId = $centerId;
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
            $mrtStation = DictMrtStation::model()->findByPk($model->dictMrtStationId);
        }

        $this->render('create', array(
            'model' => $model,
            'mrtStation' => $mrtStation,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $tuitionCenter = $model->center;
        if (!$tuitionCenter->hasRights()) {
            throw new CHttpException(401,'The function is restricted');
        }
        $mrtStation = null;
        if (isset($_POST['TuitionBranch'])) {
            $model->attributes = $_POST['TuitionBranch'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
            $mrtStation = DictMrtStation::model()->findByPk($model->dictMrtStationId);
        }

        $this->render('update', array(
            'model' => $model,
            'mrtStation' => $mrtStation,
        ));
    }

    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            $model = $this->loadModel($id);
            $tuitionCenter = $model->center;
            if (!$tuitionCenter->hasRights()) {
                throw new CHttpException(401,'The function is restricted');
            }
            $model->delete();

            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionIndex($centerId = null)
    {
        if ($centerId == null) {
            $centerId = Helper::getCurrentCenterId();
        }
        $tuitionCenter = TuitionCenter::model()->findByPk($centerId);
        if (!$tuitionCenter)
            throw new CHttpException(404);
        if (!$tuitionCenter->hasRights()) {
            throw new CHttpException(401, 'The function is restricted.');
        }
        $dataProvider = new CActiveDataProvider('TuitionBranch', array(
            'criteria' => array(
                'condition' => 'tuitionCenterId = :tuitionCenterId',
                'params' => array(
                    ':tuitionCenterId' => $centerId,
                )
            )
        ));
        $this->render('index', array(
            'tuitionCenter' => $tuitionCenter,
            'dataProvider' => $dataProvider,
        ));
    }

    public function loadModel($id)
    {
        $model = TuitionBranch::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tuition-branch-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}