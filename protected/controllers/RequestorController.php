<?php

class RequestorController extends CController {

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('profile','updateProfile','myassignment'),
                'users' => array('@'),
                'expression' => '$user->isRequestor',
            ),
            array('allow',
                'actions' => array('favoriteTutors','addFavorite','ajaxAddFavorite','ajaxRemoveFavorite'),
                'users' => array('@'),
                'expression' => '$user->isRequestor',
//                'expression' => '$user->isRequestor && $user->isVerified',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }
    
    public function actionProfile() {
//        $this->layout = '//layouts/requestorProfile';
        $requestor = $this->loadRequestor();
        $this->render('myprofile/view',array(
            'requestor' => $requestor,
        ));
    }
    
    public function actionUpdateProfile() {
//        $this->layout = '//layouts/requestorProfile';
        $user = Yii::app()->user->user;
//        $requestor = $user->requestor;
        $requestor = Requestor::model()->findByAttributes(array('userId'=>$user->id));
        $mrtStation = DictMrtStation::model()->findByPk($requestor->dictMrtStationId);
        
        if (isset($_POST['User']) && isset($_POST['Requestor'])) {
            $user->username = $_POST['User']['username'];
            $user->save(true, array('username'));
            $requestor->attributes = $_POST['Requestor'];
            $requestor->email = $user->username;
            $requestor->save();
            // Get $mrtStation for display back
            $mrtStationId = $_POST['Requestor']['dictMrtStationId'];
            if ($mrtStationId != $mrtStation->id) {
                $mrtStation = DictMrtStation::model()->findByPk($mrtStationId);
            }
        } 
        
        $this->render('myprofile/update', array(
            'user' => $user, 
            'requestor' => $requestor,
            'mrtStation' => $mrtStation,
        ));
    }
    
    public function actionMyAssignment() {
        $requestor = $this->loadRequestor();
        $newAssProvider = new CActiveDataProvider('Assignment',array(
//            'criteria'=>array(
//                'condition'=>'t.requestorId = '.$requestor->id.' AND t.statusCode IN ()',
//            ),
        ));
        $assignments = $requestor->assignments;
        usort($assignments,function($a,$b) {
            return $a->isOpen < $b->isOpen;
        });
        $newAssProvider->setData($assignments);
        $this->render('myassignment',array(
            'newAssProvider'=>$newAssProvider,
        ));
    }
    
    public function actionFavoriteTutors() {
        $requestor = $this->loadRequestor();
        $criteria = new CDbCriteria(array(
                'select' => 't.*',
                'distinct' => true,
                'with' => array('assignmentApplications'=>array('alias'=>'app', 'select'=>'', 'joinType'=>'JOIN'),
                            'assignmentApplications.assignment'=>array('alias'=>'ass', 'select'=>'', 'joinType'=>'JOIN'),
                            'assignmentApplications.assignment.requestor'=>array('alias'=>'req', 'select'=>'', 'joinType'=>'JOIN') ),
                'together' => true,
            ));
        $criteria->addInCondition('app.statusCode', array(5,6));
        $criteria->compare('req.id', $requestor->id);

        $myTutorProvider = new CActiveDataProvider('Tutor',array(
            'criteria'=> $criteria,
        ));

//        $myTutorProvider = new CActiveDataProvider('Tutor',array(
//            'criteria'=>array(
//                'select'=>'t.*',
//                'join'=>'JOIN successfulassignment ON t.id = successfulassignment.tutorId JOIN assignment ON successfulassignment.assignmentId = assignment.id',
//                'condition'=>'assignment.requestorId = '.$requestor->id,
//                'distinct'=>true,
//            ),
//        ));
        $favoriteTutors = $requestor->goodTutors;
        $favoriteProvider = new CActiveDataProvider('Tutor');
        $favoriteProvider->setData($favoriteTutors);
        
//        $favoriteProvider = new CActiveDataProvider('Tutor',array(
//            'criteria'=>array(
//                'select' => 't.*',
//                'join' => 'JOIN favoritetutor ON t.id = favoritetutor.tutorId',
//                'condition' => 'favoritetutor.requestorId = ' . $this->loadRequestor()->id,
//            ),
//            'pagination' => array(
//                'pageSize' => 5
//            )
//        ));
        $this->render('favoriteTutors', array(
            'favoriteProvider' => $favoriteProvider,
            'myTutorProvider' => $myTutorProvider
        ));
    }
    
    public function actionAddFavorite($tutorId) {
        $tutor = Tutor::model()->findByPk($tutorId);
        if (is_null($tutor)) {
            throw new CHttpException(404,'Tutor does not exist');
        }
        $requestor = $this->loadRequestor();
        $favoriteTutor = new FavoriteTutor;
        $favoriteTutor->tutorId = $tutorId;
        $favoriteTutor->requestorId = $requestor->id;
        $favoriteTutor->save();
        $this->redirect('favoriteTutors');
    }
    
    public function actionAjaxAddFavorite() {
        header('Content-type: application/json');
        if (isset($_POST['tutorId'])) {
            $tutorId = $_POST['tutorId'];
            if (!Tutor::model()->exists('id = '.$tutorId)) {
                echo CJSON::encode(array(
                    'status' => 0,
                    'message' => 'Tutor doesn\'t exist',
                ));
                return;
            }
            $requestor = $this->loadRequestor();
            $favoriteTutor = new FavoriteTutor;
            $favoriteTutor->tutorId = $_POST['tutorId'];
            $favoriteTutor->requestorId = $requestor->id;
            $favoriteTutor->save();
            echo CJSON::encode(array(
                'status' => 1,
            ));
            return;
        }
        echo CJSON::encode(array(
            'status' => 0,
            'message' => 'Invalid request',
        ));
    }
    
    public function actionAjaxRemoveFavorite() {
        header('Content-type: application/json');
        if (isset($_POST['tutorId'])) {
            $tutorId = $_POST['tutorId'];
            if (!Tutor::model()->exists('id = '.$tutorId)) {
                echo CJSON::encode(array(
                    'status' => 0,
                    'message' => 'Tutor doesn\'t exist',
                ));
                return;
            }
            $requestor = $this->loadRequestor();
            $favoriteTutor = FavoriteTutor::model()->findByAttributes(array(
                'tutorId' => $tutorId,
                'requestorId' => $requestor->id,
            ));
            if ($favoriteTutor) {
                if ($favoriteTutor->delete()) {
                echo CJSON::encode(array(
                        'status' => 1,
                    ));
                }
            } else {
                echo CJSON::encode(array(
                    'status' => 0,
                    'message' => 'FavoriteTutor record not found',
                ));
            }
        } else {
            echo CJSON::encode(array(
                'status' => 0,
                'message' => 'Invalid request',
            ));
        }
    }
    
    private $requestor;
    public function loadRequestor() {
        if (empty($this->requestor)) {
            $this->requestor = Requestor::model()->findByAttributes(array('userId'=>Yii::app()->user->id));
            if ($this->requestor === NULL) {
                throw new CHttpException(404, 'Requestor does not exist.');
            }
        }
        return $this->requestor;
    }
    
    public function filterRequestorContext($filterChain) {
        $this->loadRequestor();
        $filterChain->run();
    }
}
