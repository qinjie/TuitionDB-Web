<?php

class AssignmentController extends BlockController {

    /**
     * @return array action filters
     */
    public function filters() {
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
    public function accessRules() {
        return array(
            array('allow', 
                'actions' => array('list','view'),
                'users' => array('*'),
            ),
            array('allow', 
                'actions' => array('reject'),
                'users' => array('@'),
            ),
            array('allow', 
                'actions' => array('create', 'update'),
                'users' => array('@'),
                'expression'=>'$user->isRequestor && $user->isVerified',
            ),
            array('allow', 
                'actions' => array('shortlist','accept','cancel','review'),
                'users' => array('@'),
                'expression'=>'$user->isRequestor',
//                'expression'=>'$user->isRequestor && $user->isVerified',
            ),
            array('allow', 
                'actions' => array('apply','review','accept'),
                'users' => array('@'),
                'expression'=>'$user->isTutor && $user->isVerified',
//                'expression'=>'$user->isTutor && $user->isVerified',
            ),
            array('allow', 
                'actions' => array('admin','confirm','updatePayment'),
                'users' => array('@'),
                'expression'=>'$user->isAdmin',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $assignment = $this->loadModel($id);
        /* @var $user User */
        $user = Yii::app()->user->user;
        if ($assignment->isOpen) {
            if (isset($user) && $user->isRequestor && $user->requestor->id == $assignment->requestorId) {
                $this->render('view/open/ownerView/view', array(
                    'assignment' => $assignment,
                ));
            } else {
                if (!Yii::app()->user->isAdmin) $assignment->updatePageview();
//                FacebookHelper::postNewAssignment($id);
                $this->render('view/open/nonOwnerView/view', array(
                    'assignment' => $assignment,
                ));
            }
        } else {
            if (isset($user) && $user->isRequestor && $user->requestor->id == $assignment->requestorId) {
                $ownerView = true;
            } else {
                $ownerView = false;
                if (!Yii::app()->user->isAdmin) $assignment->updatePageview();
            }
            $this->render('view/closed/view',array(
                'assignment'=>$assignment,
                'ownerView'=>$ownerView,
            ));
        }
    }
    
    public function actionApply($id) {
        $assignment = $this->loadModel($id);
        $tutor = Tutor::model()->findByAttributes(array('userId'=>Yii::app()->user->id));
        $assignmentApplication = AssignmentApplication::model()->findByAttributes(array(
            'assignmentId' => $assignment->id,
            'tutorId' => $tutor->id,
        ));
        if (is_null($assignmentApplication)) {
            $assignmentApplication = new AssignmentApplication;
            $assignmentApplication->assignmentId = $assignment->id;
            $assignmentApplication->tutorId = $tutor->id;
            $assignmentApplication->statusCode = AssignmentApplication::STATUS_SELFREC_BY_TUTOR;
            $assignmentApplication->save();
            $assignment->sendTutorAppNoti($tutor);
            MatchingTutor::model()->deleteAllByAttributes(array('tutorId'=>$tutor->id,'assignmentId'=>$id));
        }
        // Remove tutor from Qualified Tutors list
        MatchingTutor::model()->deleteAllByAttributes(array(
            'assignmentId' => $assignment->id,
            'tutorId' => $tutor->id,
        ));
        $this->redirect(array('assignment/view','id'=>$id));
    }

    public function actionCreate($step = 1, $skippable = false) {
        switch ($step) {
            case 1:
                $assignment = new Assignment;
                $subjects = array();
                $schedules = array();

                if (isset($_POST['Assignment'])) {
                    $validate = true;
                    $assignment->attributes = $_POST['Assignment'];
                    $validate = $assignment->validate(array('dictCategoryId', 'yearOfBirth', 'currentSchool')) && $validate;
                    
                    $validSubjects = DictSubject::getSubjectsByCategory($_POST['Assignment']['dictCategoryId']);
                    if (isset($_POST['Subject'])) {
                        foreach ($_POST['Subject'] as $subjectId) {
                            if (isset($validSubjects[$subjectId])) {
                                $assignmentSubject = new AssignmentSubject;
                                $assignmentSubject->dictSubjectId = $subjectId;
                                array_push($subjects, $assignmentSubject);
                                $validate = $assignmentSubject->validate(array('dictSubjectId')) && $validate;
                            }
                        }
                    } else {
                        $validate = false;
                        $assignment->addError('subject', 'Please add at least one subject');
                    }

                    if (isset($_POST['TimeSlot'])) {
                        foreach ($_POST['TimeSlot'] as $scheduleId) {
                            $assignmentSchedule = new AssignmentSchedule;
                            $assignmentSchedule->dictScheduleId = $scheduleId;
                            array_push($schedules, $assignmentSchedule);
                            $validate = $assignmentSchedule->validate(array('dictScheduleId')) && $validate;
                        }
                    } else {
                        $validate = false;
                        $assignment->addError('schedule', 'Please add at least one time slot');
                    }

                    if ($validate) {
                        $_SESSION['Assignment'] = $_POST['Assignment'];
                        $_SESSION['Subject'] = $subjects;
                        $_SESSION['Schedule'] = $schedules;
                        $this->redirect(array('create', 'step' => 2));
                    }
                }

                $this->render('create/step1', array(
                    'assignment' => $assignment,
                    'subjects' => $subjects,
                    'schedules' => $schedules,
                    'skippable' => $skippable,
                ));
                break;
            case 2:
                if (!isset($_SESSION['Assignment'])) { // If user hasn't completed step 1, navigate to step 1
                    $this->redirect(array('create', 'step' => 1));
                }
                $assignment = new Assignment;

                if (isset($_POST['Assignment'])) {
                    $assignment->attributes = $_SESSION['Assignment'] + $_POST['Assignment'];
                    if ($assignment->validate(array('budgetRate', 'remark'))) {
                        $requestor = Requestor::model()->findByAttributes(array('userId' => Yii::app()->user->id));
                        $subjects = $_SESSION['Subject'];
                        $schedules = $_SESSION['Schedule'];

                        $assignment->requestorId = $requestor->id;
                        $assignment->save(false);
                        foreach ($subjects as $assignmentSubject) {
                            $assignmentSubject->assignmentId = $assignment->id;
                            $assignmentSubject->save(false);
                        }
                        foreach ($schedules as $assignmentSchedule) {
                            $assignmentSchedule->assignmentId = $assignment->id;
                            $assignmentSchedule->save(false);
                        }
                        $assignment->findMatchingTutors();

                        //Publish to Facebook page
                        FacebookHelper::postNewAssignment($assignment);

                        $this->redirect(array('requestor/myassignment'));
                    }
                }

                $this->render('create/step2', array('assignment' => $assignment));
                break;
        }
    }

    public function actionUpdate($id) {
        $assignment = $this->loadModel($id);
        $subjects = array();
        $schedules = array();
        $user = Yii::app()->user->user;
        if ($user->accountType != User::TYPE_REQUESTOR || $user->requestor->id != $assignment->requestorId) {
            throw new CHttpException(403,'You are not authorized to access this page');
        }
        // $this->performAjaxValidation($model);

        if (Yii::app()->request->getRequestType() == 'POST') {
            if (isset($_POST['Assignment'])) {
                $assignment->attributes = $_POST['Assignment'];
                $assignment->save();
            }
            
            if (isset($_POST['Subject'])) {
                foreach ($_POST['Subject'] as $subjectId) {
                    $assignmentSubject = AssignmentSubject::model()->findByAttributes(array(
                        'assignmentId' =>$assignment->id,
                        'dictSubjectId'=>$subjectId,
                    ));
                    if (is_null($assignmentSubject)) {
                        $assignmentSubject = new AssignmentSubject;
                        $assignmentSubject->assignmentId = $assignment->id;
                        $assignmentSubject->dictSubjectId = $subjectId;
                        $assignmentSubject->save(false);
                    }
                    array_push($subjects, $assignmentSubject);
                }
                $subjects = array_unique($subjects);
                foreach (array_diff($assignment->assignmentSubjects, $subjects) as $discardedSubject) {
                    $discardedSubject->delete();
                }
                $assignment->assignmentSubjects = $subjects;
            } else {
                $assignment->addError('subject','Please add at least one subject');
            }
            
            if (isset($_POST['TimeSlot'])) {
                foreach ($_POST['TimeSlot'] as $scheduleId) {
                    $assignmentSchedule = AssignmentSchedule::model()->findByAttributes(array(
                        'assignmentId'=>$assignment->id,
                        'dictScheduleId'=>$scheduleId,
                    ));
                    if (is_null($assignmentSchedule)) {
                        $assignmentSchedule = new AssignmentSchedule;
                        $assignmentSchedule->assignmentId = $assignment->id;
                        $assignmentSchedule->dictScheduleId = $scheduleId;
                        $assignmentSchedule->save(false);
                    }
                    array_push($schedules, $assignmentSchedule);
                }
                $schedules = array_unique($schedules);
                foreach (array_diff($assignment->assignmentSchedules, $schedules) as $discardedSchedule) {
                    $discardedSchedule->delete();
                }
                $assignment->assignmentSchedules = $assignmentSchedule;
            } else {
                $assignment->addError('schedule', 'Please add at least one time slot');
            }
            if (!$assignment->hasErrors()) {
                $assignment->findMatchingTutors();
                $this->redirect(array('assignment/view','id'=>$assignment->id));
            }
        } else {
            $subjects = $assignment->assignmentSubjects;
            $schedules = $assignment->assignmentSchedules;
        }

        $this->render('update', array(
            'assignment' => $assignment,
            'subjects'   => $subjects,
            'schedules'  => $schedules,
        ));
    }
    
    public function actionCancel($id) {
        $assignment = Assignment::model()->findByPk($id);
        if ($assignment->requestorId == Yii::app()->user->user->requestor->id) {
            $assignment->statusCode = Assignment::STATUS_CANCELLED;
            $assignment->save(false,array('statusCode'));
            $this->redirect(array('assignment/view','id'=>$id));
        } else {
            throw new CHttpException(403);
        }
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionAdmin() {
        $matchedProvider = new CActiveDataProvider('Assignment',array(
            'criteria'=>array(
                'condition'=>'statusCode = '.Assignment::STATUS_MATCHED,
            )
        ));
        $confirmedProvider = new CActiveDataProvider('Assignment',array(
            'criteria'=>array(
                'condition'=>'statusCode = '.Assignment::STATUS_CONFIRMED,
            )
        ));
        $unpaidProvider = new CActiveDataProvider('Assignment');
        $unpaidAssignments = array();
        foreach ($confirmedProvider->getData() as $confirmedAssignment) {
            if (!$confirmedAssignment->paid)
                array_push ($unpaidAssignments, $confirmedAssignment);
        }
        $unpaidProvider->setData($unpaidAssignments);
        $this->render('admin', array(
            'matchedProvider' => $matchedProvider,
            'unpaidProvider' => $unpaidProvider,
            'confirmedProvider' => $confirmedProvider,
        ));
    }
    
    public function actionShortlist($tutorId = null,$assignmentId = null) {
        if (is_null($assignmentId)) {
            $dataProvider = new CActiveDataProvider('Assignment');
            $dataProvider->setCriteria(new CDbCriteria(array(
                'scopes'=>'available',
                'condition'=>'requestorId=:requestorId AND :tutorId NOT IN (SELECT tutorId FROM assignmentapplication WHERE assignmentId=t.id)',
                'params'=>array(
                    ':requestorId'=>Yii::app()->user->user->requestor->id,
                    ':tutorId'=>$tutorId,
                ),
            )));
            $this->render('shortlist/chooseAssignment',array(
                'tutorId'=>$tutorId,
                'dataProvider'=>$dataProvider,
            ));
        } else if (isset($tutorId)) {
            $assignment = Assignment::model()->findByPk($assignmentId);
            if ($assignment->requestorId != Yii::app()->user->user->requestor->id) {
                throw new CHttpException(403);
            }
            $assignmentApplication = AssignmentApplication::model()->findByAttributes(array(
                'assignmentId'=>$assignmentId,
                'tutorId' => $tutorId,
            ));
            if (is_null($assignmentApplication)) {
                $assignmentApplication = new AssignmentApplication;
                $assignmentApplication->assignmentId = $assignmentId;
                $assignmentApplication->tutorId = $tutorId;
                $assignmentApplication->statusCode = AssignmentApplication::STATUS_SHORTLISTED_BY_PARENT;
                $assignmentApplication->save();
                $assignment->sendShortlistNoti(Tutor::model()->findByPk($tutorId));
            }
            // Remove tutor from Qualified Tutors list
            MatchingTutor::model()->deleteAllByAttributes(array(
                'assignmentId' => $assignmentId,
                'tutorId' => $tutorId,
            ));
            $this->redirect(array('assignment/view','id'=>$assignmentId));
        } else throw new CHttpException(404);
    }
    
    /**
     * Reject an application
     * @param int $id ID of the AssignmentApplication record
     */
    public function actionReject($id) {
        header('Content-type: application/json');
        $user = Yii::app()->user->user;
        $application = AssignmentApplication::model()->findByPk($id);
        if (!is_null($application)) {
            if ($user->isRequestor) {
                $assignment = $application->assignment;
                if ($assignment->requestorId != $user->requestor->id) {
                    echo CJSON::encode(array(
                        'status'=>0,
                        'message'=>'You are not authorized to perform this action',
                    ));
                    return;
                }
                $application->statusCode = AssignmentApplication::STATUS_REJECT_BY_PARENT;
                $application->save();
                echo CJSON::encode(array(
                    'status'=>1,
                    'newState'=>Lookup::item(Lookup::TYPE_APPLICATION_STATUS, AssignmentApplication::STATUS_REJECT_BY_PARENT),
                ));
                return;
            }
            if ($user->isTutor) {
                if ($application->tutorId != $user->tutor->id) {
                    echo CJSON::encode(array(
                        'status'=>0,
                        'message'=>'You are not authorized to perform this action',
                    ));
                    return;
                }
                $application->statusCode = AssignmentApplication::STATUS_REJECT_BY_TUTOR;
                $application->save();
                echo CJSON::encode(array(
                    'status'=>1,
                    'newState'=>Lookup::item(Lookup::TYPE_APPLICATION_STATUS, AssignmentApplication::STATUS_REJECT_BY_TUTOR),
                ));
                return;
            }
        }
        echo CJSON::encode(array('status'=>0)); return;
    }
    
    public function actionAccept($id){
        header('Content-type: application/json');
        $user = Yii::app()->user->user;
        $application = AssignmentApplication::model()->findByPk($id);
        if (!is_null($application)) {
            $assignment = $application->assignment;
            $unauthorized = false;
            if ($user->isRequestor) {
                if ($assignment->requestorId != $user->requestor->id || $application->statusCode != AssignmentApplication::STATUS_SELFREC_BY_TUTOR) {
                    $unauthorized = true;
                }
                $application->statusCode = AssignmentApplication::STATUS_ACCEPT_BY_PARENT;
            }
            if ($user->isTutor) {
                if ($application->tutorId != $user->tutor->id || $application->statusCode != AssignmentApplication::STATUS_SHORTLISTED_BY_PARENT) {
                    $unauthorized = true;
                }
                $application->statusCode = AssignmentApplication::STATUS_ACCEPT_BY_TUTOR;
            }
            if ($unauthorized) {
                echo CJSON::encode(array(
                    'status'=>0,
                    'message'=>'You are not authorized to perform this action',
                ));
                return; // Terminate. Application status will not be saved.
            }
            $application->save();
            $assignment->statusCode = Assignment::STATUS_MATCHED;
            $assignment->save(false);
            echo CJSON::encode(array(
                'status'=>1,
                'redirect'=>Yii::app()->createUrl('assignment/view',array('id'=>$assignment->id)),
            )); 
            return;
        }
        echo CJSON::encode(array('status'=>0));
    }
    
    public function actionList() {
        $dataProvider = new CActiveDataProvider('Assignment');
        $showFilter = true;
        $selectedSubjects = array();
        $selectedMrtStations = array();
        $selectedSchedules = array();
        $selectedGender = 99;
        $selectedRace = 99;

//        if (Yii::app()->user->isTutor) {
//            $tutorQualification = $_SESSION['User']->tutor->tutorQualification;
//            $selectedQualification = $tutorQualification->dictTutorQualificationId;
//            $selectedCredential = is_null($tutorQualification->dictTutorCredentialId) ? null : 1;
//        } else {
            $selectedQualification = null;
            $selectedCredential = null;
//        }
        
//        $criteria = new CDbCriteria(array(
//            'condition'=>'t.statusCode = '.Assignment::STATUS_POSTED.' OR t.statusCode = '.Assignment::STATUS_MATCHED,
//        ));
        $criteria = new CDbCriteria();
        $criteria->with = array();
        $criteria->scopes = array('available');
        
        if (isset($_POST['Filter'])) {
            $showFilter = false;
            
            $selectedGender = $_POST['Filter']['gender'];
            if ($selectedGender != 99) {
//                $criteria->compare('tutorGenderCode',$selectedGender);
                $criteria->addCondition("t.tutorGenderCode IS NULL OR t.tutorGenderCode = $selectedGender");
            }
            
            $selectedRace = $_POST['Filter']['race'];
            if ($selectedRace != 99) {
//                $criteria->compare('tutorRaceCode',$selectedRace);
                $criteria->addCondition("t.tutorRaceCode IS NULL OR t.tutorRaceCode = $selectedRace");
            }
            
            $selectedQualification = $_POST['Filter']['qualification'];
            if ($selectedQualification != 0) {
                $criteria->addCondition("t.minQualificationId IS NULL OR t.minQualificationId <= $selectedQualification");
            }
            
            $selectedCredential = $_POST['Filter']['credential'];
            if ($selectedCredential == 99) {
//                $criteria->compare('teachingCredential', $_POST['Filter']['credential']);
                $criteria->addCondition("t.teachingCredential IS NULL");
            }
            
//            $assignments = Assignment::model()->findAll($criteria);
            
            // Filter by location
            if (isset($_POST['MrtStation'])) {
                $selectedMrtStations = $_POST['MrtStation'];
                $ids = join(',',$selectedMrtStations);
//                $assignments = array_filter($assignments, function($assignment){
//                    return $assignment->filterByLocation($_POST['MrtStation']);
//                });
                if(!in_array('requestor', $criteria->with))
                    $criteria->with[] = 'requestor';
                $criteria->addCondition("requestor.dictMrtStationId in ($ids)");
            }

//            if (isset($_POST['Filter']['mrtStation']) && $_POST['Filter']['mrtStation'] > 0) {
//                $selectedMrtStation = DictMrtStation::model()->findByPk($_POST['Filter']['mrtStation']);
//                $criteria->with = array('requestor');
//                $criteria->compare('requestor.dictMrtStationId', $_POST['Filter']['mrtStation']);
//            }
            
            // Filter by subject
            if (isset($_POST['Subject'])) {
                $selectedSubjectIds = $_POST['Subject'];
                $selectedSubjects = DictSubject::model()->findAllByPk($selectedSubjectIds);
                $ids = join(',', $selectedSubjectIds);
//                $assignments = array_filter($assignments,function($assignment) {
//                    return $assignment->filterBySubject($_POST['Subject']);
//                });
                if(!in_array('assignmentSubjects', $criteria->with))
                    $criteria->with[] = 'assignmentSubjects';
                $criteria->addCondition("assignmentSubjects.dictSubjectId in ($ids)");
//                $assignmentsFilteredBySubject = array();
//                foreach ($assignments as $assignment) {
//                    if ($assignment->filterBySubject($_POST['Subject'])) {
//                        array_push($assignmentsFilteredBySubject, $assignment);
//                    }
//                }
//                $assignments = $assignmentsFilteredBySubject;
            }
            
            // FIlter by schedule
            if (isset($_POST['Schedule'])) {
                $selectedSchedules = $_POST['Schedule'];
                $ids = join(',', $selectedSchedules);
//                $assignments = array_filter($assignments, function($assignment){
//                    return $assignment->filterBySchedule($_POST['Schedule']);
//                });
                if(!in_array('assignmentSchedules', $criteria->with))
                    $criteria->with[] = 'assignmentSchedules';
                $criteria->addCondition("assignmentSchedules.dictScheduleId in ($ids)");
            }

            $criteria->distinct = true;
            $criteria->select = "t.*";
            $assignments = Assignment::model()->findAll($criteria);
            $dataProvider->setData($assignments);
            $dataProvider->setTotalItemCount(count($assignments));
        } else {
            $dataProvider->setCriteria($criteria);
        }
        
        $filterParams = array(
            'showFilter' => $showFilter,
            'selectedGender' => $selectedGender,
            'selectedRace' => $selectedRace,
            'selectedMrtStations' => $selectedMrtStations,
            'selectedSubjects' => $selectedSubjects,
            'selectedSchedules' => $selectedSchedules,
            'selectedQualification' => $selectedQualification,
            'selectedCredential' => $selectedCredential,
        );
        $this->render('list',array(
            'dataProvider'=>$dataProvider,
            'filterParams' => $filterParams,
        ));
    }
    
    /**
     * Create SuccessfulAssignment record
     * @param int $appId ID of the AssignmentApplication
     */
    public function actionConfirm($appId) {
        $application = AssignmentApplication::model()->findByPk($appId);
        $assignment = $application->assignment;
        $successfulAssign = SuccessfulAssignment::model()->findByAttributes(array(
            'assignmentId'=>$application->assignmentId,
            'tutorId'=>$application->tutorId,
        ));
        if (is_null($successfulAssign))
            $successfulAssign = new SuccessfulAssignment;
        if (isset($_POST['SuccessfulAssignment'])) {
            $successfulAssign->attributes = $_POST['SuccessfulAssignment'];
            $successfulAssign->assignmentId = $assignment->id;
            $successfulAssign->tutorId = $application->tutorId;
            if ($successfulAssign->save())
                $assignment->statusCode = Assignment::STATUS_CONFIRMED;
                $result = $assignment->save(false,array('statusCode'));
                if($result) {
                    MatchingTutor::model()->deleteAllByAttributes(array('assignmentId'=>$application->assignmentId));
                    $this->redirect(array('assignment/view','id'=>$assignment->id));
                }else{
                    Yii::app()->user->setFlash('error', "Sorry! Failed to update the status of the Assignment. Administrator has beeen notified.");
                }
        }
        $this->render('successful_assignment/form',array(
            'assignment' => $assignment,
            'tutor' => $application->tutor,
            'successfulAssign' => $successfulAssign,
        ));
    }
    
    /**
     * Update SuccessfulAssignment record
     * @param int $id ID of the SuccessfulAssignment
     */
    public function actionUpdatePayment($id) {
        $successfulAssignment = SuccessfulAssignment::model()->findByPk($id);
        if ($successfulAssignment) {
            if (isset($_POST['SuccessfulAssignment'])) {
                $successfulAssignment->attributes = $_POST['SuccessfulAssignment'];
                if ($successfulAssignment->save()) {
                    $this->redirect(array('assignment/view','id'=>$successfulAssignment->assignmentId));
                }
            }
            $this->render('successful_assignment/form',array(
                'assignment' => $successfulAssignment->assignment,
                'tutor' => $successfulAssignment->tutor,
                'successfulAssign' => $successfulAssignment,
            ));
        } else {
            throw new CHttpException(404);
        }
    }
    
    public function actionReview($assId, $tutorId) {
        if ($assId && $tutorId) {
            if (SuccessfulAssignment::model()->exists(array('condition'=>'assignmentId = '.$assId.' AND tutorId = '.$tutorId))) {
                $assignment = $this->loadModel($assId);
                if (Yii::app()->user->user->requestor->id == $assignment->requestorId) {
                    $tutor = Tutor::model()->findByPk($tutorId);
                    $assignmentReview = new AssignmentReview;
                    if (isset($_POST['AssignmentReview'])) {
                        $assignmentReview->attributes = $_POST['AssignmentReview'];
                        $assignmentReview->tutorId = $tutorId;
                        $assignmentReview->assignmentId = $assId;
                        if ($assignmentReview->save())
                            $this->redirect(array('assignment/view','id'=>$assId));
                    }
                    $this->render('review',array(
                        'tutor'=>$tutor,
                        'assignment'=>$assignment,
                        'assignmentReview' => $assignmentReview
                    ));
                } else 
                    throw new CHttpException(403);
            } else
                $this->redirect(array('assignment/view','id'=>$assId));
        } else 
            throw new CHttpException(404);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Assignment the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Assignment::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Assignment $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'assignment-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
