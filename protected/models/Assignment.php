<?php

/**
 * This is the model class for table "assignment".
 *
 * The followings are the available columns in table 'assignment':
 * @property string $id
 * @property string $requestorId
 * @property string $genderCode
 * @property string $raceCode
 * @property string $yearOfBirth
 * @property string $currentSchool
 * @property string $dictCategoryId
 * @property string $lessonPerMonth
 * @property double $hourPerLesson
 * @property string $tutorGenderCode
 * @property string $tutorRaceCode
 * @property string $budgetRate
 * @property string $minQualificationId
 * @property string $teachingCredential
 * @property string $remark
 * @property string $statusCode
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property Requestor $requestor
 * @property Dictcategory $dictCategory
 * @property AssignmentApplication[] $assignmentApplications
 * @property AssignmentReview[] $assignmentReviews
 * @property AssignmentSchedule[] $assignmentSchedules
 * @property AssignmentSubject[] $assignmentSubjects
 * @property Tutor[] $matchingTutors
 * @property Tutor[] $appliedtutors
 * @property SuccessfulAssignment[] $successfulAssignments
 */
class Assignment extends ActiveRecord
{

    private $title;

    const STATUS_POSTED = 0; // after parents created the assignment
    const STATUS_CANCELLED = 1; // if parents cancel the assignment
    const STATUS_MATCHED = 2; // there is a match between parent and tutor, waiting for admin to process
    const STATUS_CONFIRMED = 3; // admin has process it. the deal is successful

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'assignment';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('dictCategoryId, lessonPerMonth', 'required'),
            array('yearOfBirth, currentSchool, hourPerLesson, budgetRate, remark', 'filter', 'filter' => 'trim'),
            array('hourPerLesson', 'numerical'),
            array('requestorId, yearOfBirth, dictCategoryId, lessonPerMonth, budgetRate, minQualificationId', 'length', 'max' => 10),
            array('genderCode, raceCode, tutorGenderCode, tutorRaceCode, teachingCredential, statusCode', 'length', 'max' => 5),
            array('currentSchool', 'length', 'max' => 100),
            array('remark', 'length', 'max' => 500),
            array('dictCategoryId', 'ext.validators.DropdownListSelected'),
            array('yearOfBirth', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, requestorId, genderCode, raceCode, yearOfBirth, currentSchool, dictCategoryId, lessonPerMonth, hourPerLesson, tutorGenderCode, tutorRaceCode, budgetRate, minQualificationId, teachingCredential, remark, statusCode, created, modified', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'requestor' => array(self::BELONGS_TO, 'Requestor', 'requestorId'),
            'dictCategory' => array(self::BELONGS_TO, 'DictCategory', 'dictCategoryId'),
            'assignmentApplications' => array(self::HAS_MANY, 'AssignmentApplication', 'assignmentId'),
            'assignmentReviews' => array(self::HAS_MANY, 'AssignmentReview', 'assignmentId'),
            'assignmentSchedules' => array(self::HAS_MANY, 'AssignmentSchedule', 'assignmentId'),
            'assignmentSubjects' => array(self::HAS_MANY, 'AssignmentSubject', 'assignmentId'),
            'matchingTutorsRaw' => array(self::HAS_MANY, 'MatchingTutor', 'assignmentId'),
            'successfulAssignments' => array(self::HAS_MANY, 'SuccessfulAssignment', 'assignmentId'),
            // MANY-MANY related models
            'schedules' => array(self::MANY_MANY, 'DictSchedule', 'assignmentschedule(assignmentId,dictScheduleId)'),
            'subjects' => array(self::MANY_MANY, 'DictSubject', 'assignmentsubject(assignmentId,dictSubjectId)'),
            'matchingTutors' => array(self::MANY_MANY, 'Tutor', 'matchingtutor(assignmentId, tutorId)'),
            // tutors who have self-recommended or are shortlisted for the assignment
            'appliedtutors' => array(self::MANY_MANY, 'Tutor', 'assignmentapplication(assignmentId, tutorId)'),
            // tutor who has been assigned with the assignment
            'assignedtutor' => array(self::HAS_ONE, 'Tutor', 'successfulassignment(assignmentId, tutorId)'),
            'assignmentPageView' => array(self::HAS_ONE, 'AssignmentPageView', 'assignmentId'),
        );
    }

    public function scopes()
    {
        $t = $this->getTableAlias(false);
        return array(
            'available' => array(
                'condition' => "$t.statusCode = " . Assignment::STATUS_POSTED . " OR $t.statusCode = " . Assignment::STATUS_MATCHED,
                'order' => "$t.created DESC, $t.modified DESC",
            ),
            'recently' => array(
                'order' => "$t.created DESC",
                'limit' => 10,
            ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'requestorId' => 'Requestor',
            'genderCode' => 'Student Gender',
            'raceCode' => 'Student Race',
            'yearOfBirth' => 'Year of Birth',
            'currentSchool' => 'Current School',
            'dictCategoryId' => 'Level to be Tutored',
            'subjects' => 'Subjects',
            'schedule' => 'Schedule',
            'lessonPerMonth' => 'Lessons Per Month',
            'hourPerLesson' => 'Hour Per Lesson',
            'tutorGenderCode' => 'Tutor Gender',
            'tutorRaceCode' => 'Tutor Race',
            'budgetRate' => 'Budget per Hour',
            'minQualificationId' => 'Min Qualification',
            'teachingCredential' => 'Teaching Credential',
            'remark' => 'Remark',
            'statusCode' => 'Status',
            'created' => 'Posted On',
            'modified' => 'Modified',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('requestorId', $this->requestorId, true);
        $criteria->compare('genderCode', $this->genderCode, true);
        $criteria->compare('raceCode', $this->raceCode, true);
        $criteria->compare('yearOfBirth', $this->yearOfBirth, true);
        $criteria->compare('currentSchool', $this->currentSchool, true);
        $criteria->compare('dictCategoryId', $this->dictCategoryId, true);
        $criteria->compare('lessonPerMonth', $this->lessonPerMonth, true);
        $criteria->compare('hourPerLesson', $this->hourPerLesson);
        $criteria->compare('tutorGenderCode', $this->tutorGenderCode, true);
        $criteria->compare('tutorRaceCode', $this->tutorRaceCode, true);
        $criteria->compare('budgetRate', $this->budgetRate, true);
        $criteria->compare('minQualificationId', $this->minQualificationId, true);
        $criteria->compare('teachingCredential', $this->teachingCredential, true);
        $criteria->compare('remark', $this->remark, true);
        $criteria->compare('statusCode', $this->statusCode, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Assignment the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function afterConstruct()
    {
        $this->tutorGenderCode = 99;
        $this->tutorRaceCode = 99;
        $this->minQualificationId = 99;
        $this->teachingCredential = 99;
        $this->budgetRate = 10; // Recommended rate
        parent::afterFind();
    }

    public function beforeSave()
    {
        foreach (['tutorGenderCode', 'tutorRaceCode', 'minQualificationId', 'teachingCredential'] as $property) {
            if ($this->$property == 99) {
                $this->$property = null;
            }
        }
        return parent::beforeSave();
    }

    public function getSubjectStr()
    {
        $subjects = $this->subjects;
        $subjectStr = '';
        foreach ($subjects as $subject) {
            $subjectStr .= $subject->subject . ', ';
        }
        $subjectStr = substr($subjectStr, 0, strlen($subjectStr) - 2);
        return $subjectStr;
    }

    public function getScheduleStrOLD()
    {
        $schedules = $this->schedules;
        $scheduleStr = '';
        foreach ($schedules as $schedule) {
            $scheduleStr .= $schedule->weekday . ' ' . $schedule->slot . ', ';
        }
        $scheduleStr = substr($scheduleStr, 0, strlen($scheduleStr) - 2);
        return $scheduleStr;
    }

    public function getLessionPerMonthStr()
    {
        $str = $this->lessonPerMonth . ' ';
        if ($this->lessonPerMonth > 1) {
            $str .= 'lessions / month';
        } else {
            $str .= 'lession / month';
        }
        return $str;
    }

    public function getHourPerLessionStr()
    {
        $str = $this->hourPerLesson . ' ';
        if ($this->hourPerLesson > 1) {
            $str .= ' hours / lession';
        } else {
            $str .= ' hour / lession';
        }
        return $str;
    }

    public function getScheduleStr()
    {
        $schedules = $this->schedules;
        $strings = array();
        foreach ($schedules as $schedule) {
            if (!isset($strings[$schedule->slot])) {
                $strings[$schedule->slot] = '';
            }
            $strings[$schedule->slot] .= $schedule->weekday . ', ';
        }
        foreach ($strings as $i => $string) {
            $strings[$i] = substr($string, 0, strlen($string) - 2);
        }

        $scheduleStr = (isset($strings['AM']) ? $strings['AM'] . ' morning' . '<br>' : '') .
            (isset($strings['PM']) ? $strings['PM'] . ' afternoon' . '<br>' : '') .
            (isset($strings['Evening']) ? $strings['Evening'] . ' evening' . '<br>' : '');
        return substr($scheduleStr, 0, strlen($scheduleStr) - 4);
    }

    public function getPriceStr()
    {
        $price = (int)$this->budgetRate;
        $lowerBound = floor($price / 10) * 10;
        if ($lowerBound == 0) {
            $str = 'Under $10';
        } else {
            $str = '$' . $lowerBound . ' - $' . ($lowerBound + 10);
        }
        return $str;
    }

    public function getTutorGenderStr()
    {
        if (is_null($this->tutorGenderCode)) {
            $str = 'No Reference';
        } else {
            $str = Lookup::item(Lookup::TYPE_GENDER, $this->tutorGenderCode);
        }
        return $str;
    }

    public function getTutorRaceStr()
    {
        if (is_null($this->tutorRaceCode)) {
            $str = 'No Reference';
        } else {
            $str = Lookup::item(Lookup::TYPE_RACE, $this->tutorRaceCode);
        }
        return $str;
    }

    public function getTutorRaceGenderStr()
    {
        if (is_null($this->tutorGenderCode) AND is_null($this->tutorRaceCode)) {
            $str = 'No Reference';
        } else {
            $str = (is_null($this->tutorRaceCode) ? '' : (Lookup::item(Lookup::TYPE_RACE, $this->tutorRaceCode)));
            $str = $str . ($str == '' ? '' : ' ') . (is_null($this->tutorGenderCode) ? '' : (Lookup::item(Lookup::TYPE_GENDER, $this->tutorGenderCode)));
        }
        return $str;
    }

    public function getTutorProfileStr()
    {
        $strQualification = null;
        if (!is_null($this->minQualificationId)) {
            $strQualification = 'At least ' . DictTutorQualification::getQualificationLabel($this->minQualificationId);
        }
        $strCredential = null;
        if (!is_null($this->teachingCredential) && $this->teachingCredential == 1) {
            $strCredential = 'Prefer either trainee, current or ex school teacher';
        }
        if ($strQualification || $strCredential) {
            return $strQualification . (is_null($strCredential) ? '' : (is_null($strQualification) ? 'P' : ', p') . $strCredential);
        } else {
            return 'No preference';
        }
    }

    public function getPreferredTutorInfo(){
        $str = '';
        if (!is_null($this->tutorGenderCode)) {
            $str = Lookup::item(Lookup::TYPE_GENDER, $this->tutorGenderCode);
        }
        if (!is_null($this->tutorRaceCode)) {
            $str = (($str=='')? '' : ($str . ', ')) . Lookup::item(Lookup::TYPE_RACE, $this->tutorRaceCode);
        }

        if (!is_null($this->minQualificationId)) {
            $str = (($str=='')? '' : ($str . ', ')) . 'at least ' . DictTutorQualification::getQualificationLabel($this->minQualificationId);
        }
        if (!is_null($this->teachingCredential) && $this->teachingCredential == 1) {
            $str = (($str=='')? '' : ($str . ', ')) . 'ex/current MOE teacher or trainee';
        }
        return $str;
    }

    public function getPostedTime()
    {
        return date('d M Y', strtotime($this->created));
    }

    public function getTeachingCredentialStr()
    {
        if ($this->teachingCredential) {
            return 'Ex/Current MOE Teacher or Trainee';
        }
        return 'No preference';
    }

    public function isComplete()
    {
        if (count($this->assignmentSubjects) == 0 || count($this->assignmentSchedules) == 0) {
            return false;
        }
        if ($this->statusCode != Assignment::STATUS_POSTED) {
            return false;
        }
        return true;
    }


    public function findMatchingTutors()
    {
        MatchingTutor::model()->deleteAllByAttributes(array('assignmentId' => $this->id));
        if ($this->isComplete()) {
            $tutors = Tutor::model()->with('tutorQualification', 'subjects', 'schedules', 'locations')->findAll();
            $tutors = $this->findMatched();
            foreach ($tutors as $tutor) {
                $matchingTutor = new MatchingTutor;
                $matchingTutor->tutorId = $tutor->id;
                $matchingTutor->assignmentId = $this->id;
                $matchingTutor->save();
                $this->sendMatchedNotification($tutor);
            }
        }
    }

    private function findMatched()
    {
        // criteria to search for Tutor
        $criteria = new CDbCriteria;
        $criteria->with = array();
        $criteria->scopes = array('available');

        if ($this->tutorGenderCode !== NULL) {
            $criteria->addCondition("t.genderCode = " . $this->tutorGenderCode);
        }

        if ($this->tutorRaceCode !== NULL) {
            $criteria->addCondition("t.raceCode = " . $this->tutorRaceCode);
        }

        if ($this->minQualificationId !== NULL) {
            if (!in_array('tutorQualification', $criteria->with))
                $criteria->with[] = 'tutorQualification';
            $criteria->addCondition('tutorQualification.dictTutorQualificationId >= ' . $this->minQualificationId);
        }

        if ($this->teachingCredential !== NULL) {
            if (!in_array('tutorQualification', $criteria->with))
                $criteria->with[] = 'tutorQualification';
            $criteria->addCondition('tutorQualification.dictTutorCredentialId IS NOT NULL');
        }

        // match location
        if (!in_array('tutorLocations', $criteria->with))
            $criteria->with[] = 'tutorLocations';
        $criteria->addCondition('tutorLocations.dictMrtStationId = ' . $this->requestor->dictMrtStationId);

        // match subjects
        if (!in_array('tutorSubjects', $criteria->with))
            $criteria->with[] = 'tutorSubjects';
        $criteria->addCondition("tutorSubjects.dictSubjectId IN (SELECT dictSubjectId
                                FROM  `assignmentsubject`
                                WHERE `assignmentsubject`.assignmentId = $this->id)"
        );

        // match schedules
        if (!in_array('tutorSchedules', $criteria->with))
            $criteria->with[] = 'tutorSchedules';
        $criteria->addCondition("tutorSchedules.dictScheduleId IN (SELECT dictScheduleId
                                FROM `assignmentschedule`
                                WHERE `assignmentschedule`.assignmentId = $this->id)"
        );

        $criteria->distinct = true;
        $criteria->select = "t.id, t.email";
        $tutors = Tutor::model()->findAll($criteria);

        return $tutors;
    }

    /**
     * Send an email nofication to tutor telling of a matched assignment
     * @param Tutor $tutor
     */
    public function sendMatchedNotification($tutor)
    {
        $message = new YiiMailMessage;
        $message->setFrom(Yii::app()->params['adminEmail']);
        $message->setSubject('A new assignment matches you profile');
        $message->addTo($tutor->email);
        $controller = isset(Yii::app()->controller) ? Yii::app()->controller : new CController('YiiMail');
        $viewPath = Yii::getPathOfAlias(Yii::app()->mail->viewPath . '.matched_notification') . '.php';
        $body = $controller->renderInternal($viewPath, array('tutor' => $tutor, 'assignment' => $this), true);
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

    /**
     * Send notification to requestor when a tutor applies to assignment
     * @param Tutor $tutor
     */
    public function sendTutorAppNoti($tutor)
    {
        $message = new YiiMailMessage;
        $message->setFrom(Yii::app()->params['adminEmail']);
        $message->setSubject('A tutor has applied to your assignment');
        $message->addTo($this->requestor->email);
        $controller = isset(Yii::app()->controller) ? Yii::app()->controller : new CController('YiiMail');
        $viewPath = Yii::getPathOfAlias(Yii::app()->mail->viewPath . '.tutor_app_noti') . '.php';
        $body = $controller->renderInternal($viewPath, array('tutor' => $tutor, 'assignment' => $this), true);
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

    /**
     * Send notification email to tutor when he is shortlisted by parent
     * @param Tutor $tutor
     */
    public function sendShortlistNoti($tutor)
    {
        $message = new YiiMailMessage;
        $message->setFrom(Yii::app()->params['adminEmail']);
        $message->setSubject('You have been shortlisted to an assignment');
        $message->addTo($tutor->email);
        $controller = isset(Yii::app()->controller) ? Yii::app()->controller : new CController('YiiMail');
        $viewPath = Yii::getPathOfAlias(Yii::app()->mail->viewPath . '.shortlist_noti') . '.php';
        $body = $controller->renderInternal($viewPath, array('tutor' => $tutor, 'assignment' => $this), true);
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

    /**
     *
     * @param array $subjectIds
     */
    public function filterBySubject($subjectIds)
    {
        $mySubjectIds = array();
        foreach ($this->subjects as $dictSubject) {
            array_push($mySubjectIds, $dictSubject->id);
        }
        if (count(array_diff($subjectIds, $mySubjectIds)) > 0) {
            return false;
        }
        return true;
    }

    public function filterByLocation($locationIds)
    {
        if (in_array($this->requestor->dictMrtStationId, $locationIds)) {
            return true;
        }
        return false;
    }

    public function filterBySchedule($scheduleIds)
    {
        $myScheduleIds = array();
        foreach ($this->schedules as $dictSchedule) {
            array_push($myScheduleIds, $dictSchedule->id);
        }
        if (count(array_diff($scheduleIds, $myScheduleIds)) > 0) {
            return false;
        }
        return true;
    }

    public function getNoOfApplicant()
    {
        return count($this->assignmentApplications);
    }

    public function getPageview()
    {
        if (isset($this->assignmentPageView)) {
            return $this->assignmentPageView->count;
        }
        return 1;
    }

    /**
     * This function should be called before any call for getPageview, because it creates an AssignmentPageView record
     * @return int
     */
    public function updatePageview()
    {
        if (is_null($this->assignmentPageView)) {
            $pageView = new AssignmentPageView;
            $pageView->assignmentId = $this->id;
            $pageView->count = 1;
        } else {
            $pageView = $this->assignmentPageView;
            $pageView->count = $pageView->count + 1;
        }
        $pageView->save();
        return $pageView->count;
    }

    public function getIdStr()
    {
        return str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }

    public function getTitle()
    {
        return DictCategory::getCategoryLabel($this->dictCategoryId) . ' - ' . $this->subjectStr;
    }

    public function getCategoryLabel()
    {
        if ($this->dictCategory) {
            return $this->dictCategory->label;
        } else {
            return null;
        }
    }

    public function getLocation()
    {
        if ($this->requestor AND $this->requestor->dictMrtStation) {
            return $this->requestor->dictMrtStation->label;
        } else {
            return null;
        }
    }

    public function getStatusStr()
    {
        return LookUp::item(LookUp::TYPE_ASSSIGNMENT_STATUS, $this->statusCode);
    }

    public function getDate()
    {
        if (strtotime($this->created)) {
            $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $this->created);
            if ($myDateTime) {
                return $myDateTime->format('d/m/Y');
            }
        }
        return null;
    }

    public function getIsOpen()
    {
        return $this->statusCode == Assignment::STATUS_MATCHED || $this->statusCode == Assignment::STATUS_POSTED;
    }

    /**
     * Return true when all successful assignments has been paid
     */
    public function getPaid()
    {
        foreach ($this->successfulAssignments as $successfulAssigment) {
            if (!$successfulAssigment->paid)
                return false;
        }
        return true;
    }

    public function __toString()
    {
        return $this->id;
    }

    public function getUrl()
    {
        $controller = get_class($this);
//        $controller[0] = strtolower($controller[0]);

        $params = array("id" => $this->id);
        // add the title parameter to the URL
        $params['location'] = $this->getLocation();
        $params['category'] = $this->getCategoryLabel();
        $params['subjects'] = $this->getSubjectStr();
        return Yii::app()->urlManager->createUrl($controller . '/view', $params);
    }

}
