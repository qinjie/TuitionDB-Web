<?php

class AdminController extends Controller {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }
    
    public function accessRules() {
        return array(
            array('allow', 
                'actions' => array('list','view'),
                'users' => array('*'),
            ),
            array('allow', 
                'actions' => array('create', 'update'),
                'users' => array('@'),
                'expression'=>'$user->isAdmin',
            )
        );
    }
    
    public function actionIndex() {
        $this->render('index');
    }

}
