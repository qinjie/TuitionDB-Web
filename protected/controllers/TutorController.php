<?php

class TutorController extends BlockController {

    public $layout = '//layouts/column1_centered';
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('photo','view','list', 'public'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('profile', 'updatePersonal','updateTutoring','updateEducation','updateQualification','recommendedAssignment'),
                'users' => array('@'),
                'expression'=>'$user->isTutor',
            ),
            array('allow',
                'actions' => array('myassignment'),
                'users' => array('@'),
                'expression'=>'$user->isTutor',
//                'expression'=>'$user->isTutor && $user->isVerified',
            ),
            array('allow',
                'actions' => array(),
                'users' => array('@'),
                'expression'=>'$user->isRequestor',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    public function actionList() {
        $this->layout = '//layouts/column1';
        $dataProvider = new CActiveDataProvider('Tutor', array(
            'pagination' => array(
                'pageSize' => 5,
            ),
            'criteria' => array(
                'scopes' => 'available',
            )
        ));
        $showFilter = true;
        $selectedGender = null;
        $selectedRace = null;
        $selectedMrtStations = array();
        $selectedSubjects = array();
        $selectedSchedules = array();
        $selectedQualification = 0;
        $selectedCredential = 0;
        
        if (isset($_POST['Filter'])) {
            $showFilter = false;
            $criteria = new CDbCriteria;
            $criteria->with = array();
            $criteria->scopes= array('available');

            $selectedGender = $_POST['Filter']['gender'];
            if ($_POST['Filter']['gender'] != 99) {
//                $criteria->compare('genderCode', $_POST['Filter']['gender']);
                $criteria->addCondition("genderCode = $selectedGender");
            }
            
            $selectedRace = $_POST['Filter']['race'];
            if ($_POST['Filter']['race'] != 99) {
//                $criteria->compare('raceCode', $_POST['Filter']['race']);
                $criteria->addCondition("raceCode = $selectedRace");
            }
            
            // Filter by Qualification
            if (isset($_POST['Filter']['qualification']) && $_POST['Filter']['qualification'] > 0) {
                $selectedQualificationId = $_POST['Filter']['qualification'];
                $selectedQualification = DictTutorQualification::model()->findByPk($selectedQualificationId);
                if(!in_array('tutorQualification', $criteria->with))
                    $criteria->with[] = 'tutorQualification';
//                $criteria->compare('tutorQualification.dictTutorQualificationId', '>=' . $_POST['Filter']['qualification']);
                $criteria->addCondition("tutorQualification.dictTutorQualificationId >= $selectedQualificationId");
            }
            
            // Filter by Credential
            if (isset($_POST['Filter']['credential']) && $_POST['Filter']['credential'] == 1) {
                $selectedCredential = 1;
//                array_push($criteria->with,'tutorQualification');
                if(!in_array('tutorQualification', $criteria->with))
                    $criteria->with[] = 'tutorQualification';
                $criteria->addCondition('tutorQualification.dictTutorCredentialId IS NOT NULL');
            }

//            $tutors = Tutor::model()->findAll($criteria);

            // Filter by location
            if (isset($_POST['MrtStation'])) {
                $selectedMrtStations = $_POST['MrtStation'];
//                $tutors = array_filter($tutors, function($tutor){
//                    return $tutor->filterByLocation($_POST['MrtStation']);
//                });
//                array_push($criteria->with,'tutorLocations');
                if(!in_array('tutorLocations', $criteria->with))
                    $criteria->with[] = 'tutorLocations';
                $ids = join(',',$selectedMrtStations);
                $criteria->addCondition("tutorLocations.dictMrtStationId in ($ids)");
            }

//            if (isset($_POST['Filter']['mrtStation']) && $_POST['Filter']['mrtStation'] > 0) {
//                $selectedMrtStation = DictMrtStation::model()->findByPk($_POST['Filter']['mrtStation']);
//                $criteria->with = array_merge($criteria->with = array(
//                    'locations'=>array(
//                        'select'=>false,
//                    ),
//                ));
//                $criteria->compare('locations.id', $_POST['Filter']['mrtStation']);
//            }
            
            // Filter by subject
            if (isset($_POST['Subject'])) {
                $selectedSubjects = $_POST['Subject'];
//                $tutors = array_filter($tutors,function($tutor){
//                    return $tutor->filterBySubject($_POST['Subject']);
//                });
//                array_push($criteria->with, 'tutorSubjects');
                if(!in_array('tutorSubjects', $criteria->with))
                    $criteria->with[] = 'tutorSubjects';
                $ids = join(',', $selectedSubjects);
                $criteria->addCondition("tutorSubjects.dictSubjectId in ($ids)");
            }
            
            // Filter by Schedule
            if (isset($_POST['Schedule'])) {
                $selectedSchedules = $_POST['Schedule'];
//                $tutors = array_filter($tutors, function($tutor){
//                    return $tutor->filterBySchedule($_POST['Schedule']);
//                });
//                array_push($criteria->with, 'tutorSchedules');
                if(!in_array('tutorSchedules', $criteria->with))
                    $criteria->with[] = 'tutorSchedules';
                $ids = join(',', $selectedSchedules);
                $criteria->addCondition("tutorSchedules.dictScheduleId in ($ids)");
            }
            
//            if (isset($_POST['Filter']['mrtStation']) && $_POST['Filter']['mrtStation'] != 0) {
//                $selectedMrtStation = DictMrtStation::model()->findByPk($_POST['Filter']['mrtStation']);
//                $tutorsFilteredByLocation = array();
//                foreach ($tutors as $tutor) {
//                    if ($tutor->filterByLocation(array($_POST['Filter']['mrtStation']))) {
//                        array_push($tutorsFilteredByLocation, $tutor);
//                    }
//                }
//                $tutors = $tutorsFilteredByLocation;
//            }

            $criteria->distinct = true;
            $criteria->select = "t.*";
            $criteria->scopes = array('available');
            $tutors = Tutor::model()->findAll($criteria);
            $dataProvider->setData($tutors);
            $dataProvider->setTotalItemCount(count($tutors));
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
        $this->render('list', array(
            'dataProvider' => $dataProvider,
            'filterParams' => $filterParams,
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->layout = 'column1';
        $tutor = $this->loadModel($id);
//        if (!$tutor->user->isVerified) {
//            throw new CHttpException(404);
//        }
        $tutor->updatePageview();
        $assignProvider = new CActiveDataProvider('SuccessfulAssignment',array(
            'criteria' => array(
                'condition' => 'tutorId = :tutorId',
                'with' => array('assignment'),
                'order' => 'startDate DESC',
                'params' => array(
                    ':tutorId' => $id,
                ),
            ),
        ));
        $this->render('view', array(
            'tutor' => $tutor,
            'assignProvider' => $assignProvider,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Tutor;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Tutor'])) {
            $model->attributes = $_POST['Tutor'];
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
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Tutor'])) {
            $model->attributes = $_POST['Tutor'];
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
    public function actionDelete($id) {
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
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Tutor');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Tutor('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Tutor'])) {
            $model->attributes = $_GET['Tutor'];
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionPublic($nick) {
        $model = TutorStatus::model()->findByAttributes(array('nick'=>$nick));
        if($model){
            $tutor = $model->tutor;
            $tutor->updatePageview();
            $assignProvider = new CActiveDataProvider('SuccessfulAssignment', array(
                'criteria' => array(
                    'condition' => 'tutorId = :tutorId',
                    'with' => array('assignment'),
                    'order' => 'startDate DESC',
                    'params' => array(
                        ':tutorId' => $tutor->id,
                    ),
                ),
            ));
            $this->render('view', array(
                'tutor' => $tutor,
                'assignProvider' => $assignProvider,
            ));
        }
    }

    public function actionProfile() {
//        $this->layout = '//layouts/tutorProfile';
        $tutor = self::loadTutor();
        $this->render('myprofile/view',array(
            'tutor'=>$tutor,
        ));
    }
    
    public function actionUpdatePersonal() {
//        $this->layout = '//layouts/tutorProfile';
        /* @var $user User */
        $user = Yii::app()->user->user;
        /* @var $tutor Tutor */
        $tutor = self::loadTutor();
        
        if (isset($_POST['User']) && isset($_POST['Tutor'])) {
            $valid = true;
            
            // collect user data
            $newEmail = $_POST['User']['username'];
            if ($newEmail != $user->username) {
                $user->username = $newEmail;
                $user->isVerified = 0;
                if ($valid = $user->save(true, array('username')) && $valid) {
                    $tutor->email = $newEmail;
                    $user->sendVerificationMail();
                    Yii::app()->user->setFlash('success','You have changed you email address. A verification mail has been sent to you.');
                }
            }
            
            // collect tutor data
            $tutor->attributes = $_POST['Tutor'];
            $tutor->email      = $user->username;
            $valid = $tutor->save() && $valid;
            $tutor->findMatchingAssignments();
            
            // collect uploaded photo
            $uploadedFile = CUploadedFile::getInstanceByName('TutorPhoto');
            if (!is_null($uploadedFile) && isset($_POST['Crop'])) {
                $tutorPhoto = TutorPhoto::model()->findByAttributes(array('tutorId'=>$tutor->id));
                if (is_null($tutorPhoto)) {
                    $tutorPhoto = new TutorPhoto;
                    $tutorPhoto->tutorId  = $tutor->id; 
                }
                if (!$tutorPhoto->processPhoto($uploadedFile, $_POST['Crop'])) {
                    $tutor->addError('photo','Photo couldn\'t be saved');
                }
                $tutorPhoto->save(false);
            }
            
            if ($valid) {
                $this->redirect(array('/tutor/profile'));
            }
        } 
        
        $this->render('myprofile/personal', array(
            'user' => $user,
            'tutor'=> $tutor,
        ));
    }
    
    public function actionUpdateTutoring() {
//        $this->layout = '//layouts/tutorProfile';
        /* @var $tutor Tutor */
        $tutor = self::loadTutor();
        
        $subjects   = array();
        $hrates     = array();
        $tutorLocations = array();
        $tutorSchedules = array();
            
        if (Yii::app()->request->getRequestType() == 'POST') {
            
            /* Collect subjects and hourly rates input */
            if (isset($_POST['Subject']) && isset($_POST['HRate'])) {
                foreach ($_POST['Subject'] as $id=>$subjectId) {
                    $tutorSubject = TutorSubject::model()->findByAttributes(array('tutorId'=>$tutor->id,'dictSubjectId'=>$subjectId));
                    if (is_null($tutorSubject)) {
                        $tutorSubject = new TutorSubject;
                        $tutorSubject->tutorId = $tutor->id;
                        $tutorSubject->dictSubjectId = $subjectId;
                    }
                    array_push($subjects, $tutorSubject);
                }
                
                $validate = true;
                foreach ($_POST['HRate'] as $catId=>$hourlyRate) {
                    $tutorHourlyRate = new TutorHourlyRate;
                    $tutorHourlyRate->tutorId = $tutor->id;
                    $tutorHourlyRate->dictCategoryId = $catId;
                    $tutorHourlyRate->hourlyRate = $hourlyRate;
                    $validate = $tutorHourlyRate->validate(array('hourlyRate')) && $validate;
                    array_push($hrates, $tutorHourlyRate);
                }
                
                if ($validate) {
                    $subjects = array_unique($subjects);
                    $hrates = array_unique($hrates);
                    
                    // Get a set of subject category IDs
                    $dictSubjects = DictSubject::model()->findAllByPk($_POST['Subject']);
                    $subjectCategories = array();
                    foreach ($dictSubjects as $dictSubject) {
                        array_push($subjectCategories, $dictSubject->dictCategoryId);
                    }
                    // Delete the removed subjects from database
                    foreach (array_diff($tutor->tutorSubjects, $subjects) as $discardedSubject) {
                        $discardedSubject->delete();
                    }
                    $tutor->deleteRelated('tutorHourlyRates');
                    
                    foreach ($subjects as $subject) {
                        $subject->save(false);
                    }
                    $hratesInDB = array();
                    foreach ($hrates as $hrate) {
                        if (in_array($hrate->dictCategoryId, $subjectCategories)) {
                            $hrate->save(false);
                            array_push($hratesInDB, $hrate);
                        }
                    }
                    $hrates = $hratesInDB;
                }
            } else {
                // If user post nothing, delete all data
                $tutor->deleteRelated('tutorSubjects');
                $tutor->deleteRelated('tutorHourlyRates');
            }
            
            if (isset($_POST['Station'])) {
                foreach ($_POST['Station'] as $stationId) {
                    $tutorLocation = TutorLocation::model()->findByAttributes(array(
                        'tutorId'=>$tutor->id,
                        'dictMrtStationId'=>$stationId,
                    ));
                    if (is_null($tutorLocation)) {
                        $tutorLocation = new TutorLocation;
                        $tutorLocation->tutorId = $tutor->id;
                        $tutorLocation->dictMrtStationId = $stationId;
                    }
                    array_push($tutorLocations, $tutorLocation);
                }
                $tutorLocations = array_unique($tutorLocations);
                foreach ($tutorLocations as $tutorLocation) {
                    $tutorLocation->save(false);
                }
                foreach (array_diff($tutor->tutorLocations, $tutorLocations) as $discardedLocation) {
                    $discardedLocation->delete();
                }
            } else {
                // If user post nothing, delete all data
                $tutor->deleteRelated('tutorLocations');
            }
            
            if (isset($_POST['TimeSlot'])) {
                foreach ($_POST['TimeSlot'] as $scheduleId) {
                    $tutorSchedule = TutorSchedule::model()->findByAttributes(array(
                        'tutorId'=>$tutor->id,
                        'dictScheduleId'=>$scheduleId,
                    ));
                    if (is_null($tutorSchedule)) {
                        $tutorSchedule = new TutorSchedule;
                        $tutorSchedule->tutorId = $tutor->id;
                        $tutorSchedule->dictScheduleId = $scheduleId;
                    }
                    array_push($tutorSchedules, $tutorSchedule);
                }
                $tutorSchedules = array_unique($tutorSchedules);
                foreach ($tutorSchedules as $tutorSchedule) {
                    $tutorSchedule->save(false);
                }
                foreach (array_diff($tutor->tutorSchedules, $tutorSchedules) as $discardedSchedule) {
                    $discardedSchedule->delete();
                }
            } else {
                // If user post nothing, delete all data
                $tutor->deleteRelated('tutorSchedules');
            }
            $tutor->tutorSubjects    = $subjects;
            $tutor->tutorHourlyRates = $hrates;
            $tutor->tutorLocations   = $tutorLocations;
            $tutor->tutorSchedules   = $tutorSchedules;
            $tutor->findMatchingAssignments();
            if ($validate)
                $this->redirect(array('/tutor/profile'));
        } else {
            $subjects   = $tutor->tutorSubjects;
            $hrates     = $tutor->tutorHourlyRates;
            $tutorLocations = $tutor->tutorLocations;
            $tutorSchedules = $tutor->tutorSchedules;
        }
        // Get DictSchedule objects for displaying
        $scheduleIds = array();
        foreach ($tutorSchedules as $tutorSchedule) {
            array_push($scheduleIds, $tutorSchedule->dictScheduleId);
        }
        $schedules = DictSchedule::model()->findAllByAttributes(array('id'=>$scheduleIds));
        
        $this->render('myprofile/tutoring',array(
            'tutor' => $tutor,
            'subjects'=>$subjects, 
            'hourlyRates'=>$hrates, 
            'tutorLocations'=>$tutorLocations,
            'schedules'=>$schedules,
        ));
    }
    
    public function actionUpdateTutoringOLD() {
        $user = $_SESSION['User'];
        /* @var $tutor Tutor */
        $tutor = self::loadTutor();
        
        // $subjects, $hrates, $tutorLocations, $schedules are for display back
        // $tutor->tutorSubjects, $tutor->tutorHourlyRates... are the records in database
        $subjects = $tutor->tutorSubjects;
        $hrates = $tutor->tutorHourlyRates;
        $tutorLocations = $tutor->tutorLocations;
        $schedules = $tutor->tutorSchedules;

        if (Yii::app()->request->getRequestType() == 'POST') {
            /* Collect subjects and hourly rates input */
            if (isset($_POST['Subject']) && isset($_POST['HRate'])) {

                // Retrieve the subjects that already exist in database
                $savedSubjects = TutorSubject::model()
                    ->findAllByAttributes(array('tutorId'=>$tutor->id,'dictSubjectId'=>$_POST['Subject']));
                $savedSubjectIds = array();
                foreach ($savedSubjects as $savedSubject) {
                    array_push($savedSubjectIds, $savedSubject->id);
                }
                $newSubjectIds = array_diff($_POST['Subject'], $savedSubjectIds);
                // $postedSubjects stores all the subjects user posted
                $postedSubjects = $savedSubjects;
                // create new objects for the new subjects that don't exist in database
                foreach ($newSubjectIds as $newSubjectId) {
                    $tutorSubject = new TutorSubject;
                    $tutorSubject->tutorId = $tutor->id;
                    $tutorSubject->dictSubjectId = $newSubjectId;
                    array_push($postedSubjects, $tutorSubject);
                }
                // remove duplicated objects, in case user post duplicated subjectIDs
                $postedSubjects = array_unique($postedSubjects);

                // Delete from database the subjects that user has removed 
                $discardedSubjects = array_diff($subjects, $postedSubjects);
                foreach ($discardedSubjects as $discardedSubject) {
                    if (!$discardedSubject->isNewRecord) $discardedSubject->delete();
                }

                // Get a set of subject category IDs
                $dictSubjects = DictSubject::model()->findAllByPk($_POST['Subject']);
                $subjectCategories = array();
                foreach ($dictSubjects as $dictSubject) {
                    array_push($subjectCategories, $dictSubject->dictCategoryId);
                }

                $postedCategoryIds = array();
                foreach ($_POST['HRate'] as $id=>$values) {
                    array_push($postedCategoryIds, $values['dictCategoryId']);
                }
                // Retrieve the hourly rate records that already exist in database
                $savedHrates = TutorHourlyRate::model()
                    ->findAllByAttributes(array('tutorId'=>$tutor->id,'dictCategoryId'=>$postedCategoryIds));
                $savedCategoryIds = array();
                foreach ($savedHrates as $savedHrate) {
                    $savedHrate->hourlyRate = $_POST['HRate'][$savedHrate->dictCategoryId];
                    array_push($savedCategoryIds, $savedHrate->dictCategoryId);
                }
                $newCategoryIds = array_diff($postedCategoryIds, $savedCategoryIds);
                // $postedHrates stores all the hourly rates user posted
                $postedHrates = $savedHrates;
                // create new objects for the new hourly rates that don't exist in database
                foreach ($newCategoryIds as $newCategoryId) {
                    $tutorHourlyRate = new TutorHourlyRate;
                    $tutorHourlyRate->tutorId = $tutor->id;
                    $tutorHourlyRate->dictCategoryId = $newCategoryId;
                    $tutorHourlyRate->hourlyRate = $_POST['HRate'][$newCategoryId];
                    array_push($postedHrates, $tutorHourlyRate);
                }
                // Remove the dupliated hourly rate categories
                $postedHrates = array_unique($postedHrates);
                $validate = true;
                // validates the posted hourly rates
                foreach ($postedHrates as $postedHrate) {
                    $validate = $postedHrate->validate(array('hourlyRate')) && $validate;
                }
                // Delete from database the hourly rates that user has removed
                $discardedHrates = array_diff($hrates, $postedHrates);
                foreach ($discardedHrates as $discardedHrate) {
                    if (!$discardedHrate->isNewRecord) $discardedHrate->delete();
                }

                if ($validate) {
                    // Insert new TutorSubject records to database
                    // We don't need to update the records like we do with hourly rates, since there's nothing to update
                    $newSubjects = array_diff($postedSubjects, $subjects);
                    foreach ($newSubjects as $newSubject) {
                        $newSubject->save();
                    }
                    $tutor->tutorSubjects = $subjects = $postedSubjects;

                    // Insert new TutorHourlyRate records to database, and update existing ones
                    $hratesInDB = array();
                    foreach ($postedHrates as $hrate) {
                        // This is to prevent user from post hourly rates for cateogories that he doesn't teach
                        if (in_array($hrate->dictCategoryId, $subjectCategories)) { 
                            $hrate->save(false);
                            array_push($hratesInDB, $hrate);
                        } else {
                            if (!$hrate->isNewRecord) {
                                $hrate->delete();
                            }
                        }
                    }
                    $tutor->tutorHourlyRates = $hrates = $hratesInDB;
                } else {
                    $subjects = $postedSubjects;
                    $hrates = $postedHrates;
                }
            } else {
                // If user post nothing, delete all current subjects and hourly rates
                foreach ($subjects as $discardedSubject) {
                    if (!$discardedSubject->isNewRecord) $discardedSubject->delete();
                }
                foreach ($hrates as $discardedHrate) {
                    if (!$discardedHrate->isNewRecord) $discardedHrate->delete();
                }
                $subjects = array();
                $hrates = array();
            }
            
            /* Collect MRT stations input */
            if (isset($_POST['Station'])) {
                // Retrieve the MRT station records from database
                $savedStations = TutorLocation::model()
                    ->findAllByAttributes(array('tutorId'=>$tutor->id,'dictMrtStationId'=>$_POST['Station']));
                $savedStationIds = array();
                foreach ($savedStations as $savedStation) {
                    array_push($savedStationIds, $savedStation->dictMrtStationId);
                }
                $newStationIds = array_diff($_POST['Station'], $savedStationIds);
                // $postedStations stores all the stations user posted
                $postedStations = $savedStations;
                // create new objects for the new stations that don't exist in database
                foreach ($newStationIds as $newStationId) {
                    $tutorLocation = new TutorLocation;
                    $tutorLocation->tutorId = $tutor->id;
                    $tutorLocation->dictMrtStationId = $newStationId;
                    array_push($postedStations, $tutorLocation);
                }
                // Remove the duplicated stations
                $postedStations = array_unique($postedStations);
                // Delete from database the stations that user has removed
                $discardedStations = array_diff($tutorLocations, $postedStations);
                foreach ($discardedStations as $discardedStation) {
                    if (!$discardedStation->isNewRecord) $discardedStation->delete();
                }
                // Save the new stations to database
                $newStations = array_diff($postedStations, $savedStations);
                foreach ($newStations as $newStation) {
                    $newStation->save();
                }
                // Now $postedStations contains all the records currently in database
                $tutor->tutorLocations = $tutorLocations = $postedStations;
            } else {
                // If user post nothing, delete all current MRT stations
                foreach ($tutorLocations as $discardedStation) {
                    if (!$discardedStation->isNewRecord) $discardedStation->delete();
                }
                $tutorLocations = array();
            }
            
            if (isset($_POST['TimeSlot'])) {
                // Retrieve the schedule records from database
                $saveSchedules = TutorSchedule::model()->findAllByAttributes(array('tutorId'=>$tutor->id,'dictScheduleId'=>$_POST['TimeSlot']));
            }
            
            
            $tutor->validateProfile();
        }

        $this->render('myprofile/tutoring',array(
            'tutor' => $tutor,
            'subjects'=>$subjects, 
            'hourlyRates'=>$hrates, 
            'tutorLocations'=>$tutorLocations,
            'schedules'=>$schedules,
        ));
    }
    
    public function actionUpdateEducation() {
//        $this->layout = '//layouts/tutorProfile';
        /* @var $tutor Tutor */
        $tutor = self::loadTutor();
        
        $schools = array();         
        $allExamResults = array(); // $tutorExamResults[$examCode][TutorExamResult]
        $tutorOtherSkills = array();

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'education-info-form') {
            echo CActiveForm::validate(new TutorSchool, array('school','course'));
            Yii::app()->end();
        }

        if (Yii::app()->request->getRequestType() == 'POST') {
            $validate = true;
            
            // Collect TutorSchool
            if (isset($_POST['School'])) {
                foreach ($_POST['School'] as $id=>$schoolData) {
                    $tutorSchool = null;
                    if (is_numeric($id)) {
                        $tutorSchool = TutorSchool::model()->findByAttributes(array('id'=>$id,'tutorId'=>$tutor->id));
                    }
                    if (is_null($tutorSchool)) {
                        $tutorSchool = new TutorSchool;
                        $tutorSchool->tutorId = $tutor->id;
                    }
                    $tutorSchool->attributes = $schoolData;
                    $validate = $tutorSchool->validate(array('school', 'course')) && $validate;
                    array_push($schools, $tutorSchool);
                }
            }
            
            // Collect ExamResult data
            if (isset($_POST['ExamResult'])) {
                foreach ($_POST['ExamResult'] as $examCode => $examResults) {
                    foreach ($examResults as $id=>$examResult) {
                        $tutorExamResult = TutorExamResult::model()
                            ->findByAttributes(array('tutorId'=>$tutor->id,'dictSubjectId'=>$examResult['dictSubjectId']));
                        if (is_null($tutorExamResult)) {
                            $tutorExamResult = new TutorExamResult;
                            $tutorExamResult->tutorId = $tutor->id;
                            $tutorExamResult->examCode = $examCode;
                            $tutorExamResult->dictSubjectId = $examResult['dictSubjectId'];
                        }
                        $tutorExamResult->grade = $examResult['grade'];
                        $validate = $tutorExamResult->validate(array('dictSubjectId', 'grade')) && $validate;
                        array_push($allExamResults, $tutorExamResult);
                    }
                }
            }

            // Collect OtherSkill data
            if (isset($_POST['OtherSkill'])) {
                foreach ($_POST['OtherSkill'] as $id=>$otherSkill) {
                    $tutorOtherSkill = null;
                    if (is_numeric($id)) {
                        $tutorOtherSkill = TutorOtherSkill::model()
                            ->findByAttributes(array('id'=>$id,'tutorId'=>$tutor->id));
                    }
                    if (is_null($tutorOtherSkill)) {
                        $tutorOtherSkill = new TutorOtherSkill;
                        $tutorOtherSkill->tutorId = $tutor->id;
                    }
                    $tutorOtherSkill->attributes = $otherSkill;
                    $validate = $tutorOtherSkill->validate(array('skill', 'achievement')) && $validate;
                    array_push($tutorOtherSkills, $tutorOtherSkill);
                }
            }
            
            if ($validate) {
//                $allExamResults = array_unique($allExamResults);
                // Delete the removed records from database
                foreach (array_diff($tutor->tutorSchools, $schools) as $discardedSchool) {
                    $discardedSchool->delete();
                }
                foreach (array_diff($tutor->tutorExamResults, $allExamResults) as $discardedExamResult) {
                    $discardedExamResult->delete();
                }
                foreach (array_diff($tutor->tutorOtherSkills, $tutorOtherSkills) as $discardedOtherSkill) {
                    $discardedOtherSkill->delete();
                }
                // Save posted data to database
                foreach ($schools as $school) {
                    $school->save(false);
                }
                foreach ($allExamResults as $tutorExamResult) {
                    $tutorExamResult->save(false);
                }
                foreach ($tutorOtherSkills as $tutorOtherSkill) {
                    $tutorOtherSkill->save(false);
                }
//                $tutor->tutorSchools = $schools;;
//                $tutor->tutorOtherSkills = $tutorOtherSkills;
//                $tutor->tutorExamResults = $allExamResults;
//                $tutor->tutorOtherSkills = $tutorOtherSkills;
                $tutor->findMatchingAssignments();
                $this->redirect(array('/tutor/profile'));
            }
        } else {
            $schools          = $tutor->tutorSchools;
            $tutorOtherSkills = $tutor->tutorOtherSkills;
            $allExamResults   = $tutor->tutorExamResults;
        }
        // Convert exam result array for display
        $tutorExamResults = array();
        foreach ($allExamResults as $examResult) {
            $examCode = $examResult->examCode;
            if (!isset($tutorExamResults[$examCode])) {
                $tutorExamResults[$examCode] = array();
            }
            array_push($tutorExamResults[$examCode], $examResult);
        }
        
        for ($i = 0; $i <= 2; $i++) {
            if (!isset($tutorExamResults[$i])) {
                $tutorExamResults[$i] = array();
            }   
        }
        
        $this->render('myprofile/education', array(
            'schools' => $schools,
            'tutorExamResults' => $tutorExamResults,
            'otherSkills' => $tutorOtherSkills,
        ));
    }
    
    public function actionUpdateQualification() {
//        $this->layout = '//layouts/tutorProfile';
        /* @var $tutor Tutor */
        $tutor = self::loadTutor();
        
        $tutorQualification = $tutor->tutorQualification;
        if (is_null($tutorQualification)) {
            $tutorQualification = new TutorQualification;
            $tutorQualification->tutorId = $tutor->id;
        }
        
        if (isset($_POST['TutorQualification'])) {
            $tutorQualification->attributes = $_POST['TutorQualification'];
            if ($tutorQualification->validate(array('dictTutorQualificationId', 'experienceStyle'))) {
                $tutorQualification->save(false);
                $tutor->findMatchingAssignments();
                $this->redirect(array('/tutor/profile'));
            }
            $tutor->tutorQualification = $tutorQualification;
        }
        
        $this->render('myprofile/qualification',array('tutorQualification'=>$tutorQualification));
    }
    
    /*
     * Download profile photo
     */
    public function actionPhoto($tutorId = null) {
        $tutorPhoto = TutorPhoto::model()->findByAttributes(array('tutorId'=>$tutorId));
        if (!is_null($tutorPhoto) && strlen($tutorPhoto->fileType) > 0) {
            header('Content-type: ' . $tutorPhoto->fileType);
            echo $tutorPhoto->fileBinary;
        } else {
            header('Content-type: image/png');
            echo file_get_contents(Yii::getPathOfAlias('webroot').'/images/default_profile_pic.png');
        }
    }

    public function actionMyassignment() {
        $tutor = Tutor::model()->findByAttributes(array('userId'=>Yii::app()->user->id));
//        $successfulAssignments = $tutor->successfulAssignments;
//        $applications = $tutor->assignmentApplications;
        $appProvider = new CActiveDataProvider('AssignmentApplication',array(
            'criteria' => array(
                'condition' => 't.tutorId = '.$tutor->id.' AND assignment.statusCode IN (0,2) AND t.statusCode IN (0,1,2,5,6)',
                'with' => array(
                    'assignment',
                    'assignment.requestor'
                ),
                'order' => 't.created DESC'
            ),
            'pagination' => array(
                'pageSize' => 10,
            )
        ));
        $successfulAssProvider = new CActiveDataProvider('SuccessfulAssignment',array(
            'criteria' => array(
                'condition' => 't.tutorId = '.$tutor->id,
            ),
            'pagination' => array(
                'pageSize' => 10,
            )
        ));
        $reviewProvider = new CActiveDataProvider('AssignmentReview',array(
            'criteria'=>array(
                'condition' => 't.tutorId = '.$tutor->id,
            ),
            'pagination' => array(
                'pageSize' => 10,
            )
        ));
        $recommendedAssProvider = new CActiveDataProvider('Assignment');
        $recommendedAssProvider->data = $tutor->matchingAssignments;
        
        $this->render('myassignment', array(
            'tutor'=>$tutor,
//            'successfulAssignments'=>$successfulAssignments,
//            'applications'=>$applications,
            'appProvider' => $appProvider,
            'successfulAssProvider' => $successfulAssProvider,
            'reviewProvider' => $reviewProvider,
            'recommendedAssProvider' => $recommendedAssProvider,
        ));
    }
    public function actionRecommendedAssignment() {
        $tutor = Tutor::model()->findByAttributes(array('userId'=>Yii::app()->user->id));
        $recommendedAssProvider = new CActiveDataProvider('Assignment');
        $recommendedAssProvider->data = $tutor->matchingAssignments;
        
        $this->render('recommendedAssignment',array(
            'recommendedAssProvider' => $recommendedAssProvider,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Tutor the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Tutor::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }
    
    /**
     * Load the Tutor object of the current user
     */
    public static function loadTutor() {
        $tutor = Tutor::model()->findByAttributes(array('userId'=>Yii::app()->user->id));
        if ($tutor === NULL) {
            $tutor = new Tutor;
            $tutor->userId = Yii::app()->user->id;
//            throw new CHttpException(404,'Tutor does not exist.');
        }
        return $tutor;
    }

    /**
     * Performs the AJAX validation.
     * @param Tutor $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tutor-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
}
