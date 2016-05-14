<?php

/**
 * This is the model class for table "tutor".
 *
 * @property boolean $profileComplete Indicate whether tutor profile is complete or not
 *
 * The followings are the available columns in table 'tutor':
 * @property string $id
 * @property string $userId
 * @property string $fullName
 * @property string $genderCode
 * @property string $yearOfBirth
 * @property string $raceCode
 * @property string $nationality
 * @property string $passport
 * @property string $email
 * @property string $mobilePhone
 * @property string $homeTel
 * @property string $homeAddress
 * @property string $homePostal
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property AssignmentQpplication[] $assignmentApplications
 * @property AssignmentReview[] $assignmentReviews
 * @property FavoriteTutor[] $favoriteTutors
 * @property MatchingTutor[] $matchingTutors
 * @property SuccessfulAssignment[] $successfulAssignments
 * @property User $user
 * @property TutorExamResult[] $tutorExamResults
 * @property TutorHourlyRate[] $tutorHourlyRates
 * @property TutorSchool[] $tutorSchools
 * @property TutorStatus[] $tutorStatus
 * @property TutorLocation[] $tutorLocations
 * @property TutorPhoto[] $tutorPhoto
 * @property TutorQualification[] $tutorQualification
 * @property TutorResume[] $tutorResume
 * @property TutorSchedule[] $tutorSchedules
 * @property TutorSubject[] $tutorSubjects
 */
Yii::import('ext.validators.DropdownListSelected');
class Tutor extends ActiveRecord
{

    private $profileComplete;
    private $profileErrors = array();
    protected $ageRange;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tutor';
    }

    /**
     * @return string the age range, e.g. 32 -> 30+, 36 -> 35+
     */
    public function getAgeRange()
    {
        return strval(floor((date("Y") - $this->yearOfBirth) / 5) * 5) . '+';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('fullName, yearOfBirth, , mobilePhone, email, homePostal', 'required'),
            array('genderCode, raceCode', 'ext.validators.DropdownListSelected'),
            array('userId, yearOfBirth, homePostal', 'length', 'max' => 10),
            array('fullName, email, homeAddress', 'length', 'max' => 255),
            array('genderCode, raceCode', 'length', 'max' => 5),
            array('yearOfBirth', 'numerical', 'integerOnly' => true, 'min' => 1900, 'max' => 2010),
            array('nationality', 'length', 'max' => 100),
            array('passport', 'length', 'max' => 20),
            array('mobilePhone, homeTel', 'length', 'min' => 5, 'max' => 20),
            array('homePostal, mobilePhone, homeTel', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('userId, fullName, genderCode, yearOfBirth, raceCode, nationality, passport, email, mobilePhone, homeTel, homeAddress, homePostal', 'safe', 'on' => 'search'),
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
            'assignmentApplications' => array(self::HAS_MANY, 'AssignmentApplication', 'tutorId'),
            'assignmentReviews' => array(self::HAS_MANY, 'AssignmentReview', 'tutorId'),
            'favoriteTutors' => array(self::HAS_MANY, 'FavoriteTutor', 'tutorId'),
            'matchingTutorsRaw' => array(self::HAS_MANY, 'MatchingTutor', 'tutorId'),
            'successfulAssignments' => array(self::HAS_MANY, 'SuccessfulAssignment', 'tutorId'),
            'user' => array(self::BELONGS_TO, 'User', 'userId'),
            'tutorExamResults' => array(self::HAS_MANY, 'TutorExamResult', 'tutorId'),
            'tutorHourlyRates' => array(self::HAS_MANY, 'TutorHourlyRate', 'tutorId'),
            'tutorSchools' => array(self::HAS_MANY, 'TutorSchool', 'tutorId'),
            'tutorStatus' => array(self::HAS_ONE, 'TutorStatus', 'tutorId'),
            'tutorLocations' => array(self::HAS_MANY, 'TutorLocation', 'tutorId'),
            'tutorPhoto' => array(self::HAS_ONE, 'TutorPhoto', 'tutorId'),
            'tutorQualification' => array(self::HAS_ONE, 'TutorQualification', 'tutorId'),
            'tutorResume' => array(self::HAS_ONE, 'TutorResume', 'tutorId'),
            'tutorSchedules' => array(self::HAS_MANY, 'TutorSchedule', 'tutorId'),
            'tutorSubjects' => array(self::HAS_MANY, 'TutorSubject', 'tutorId'),
            'tutorOtherSkills' => array(self::HAS_MANY, 'TutorOtherSkill', 'tutorId'),
            // MANY-MANY related models
            'subjects' => array(self::MANY_MANY, 'DictSubject', 'tutorsubject(tutorId, dictSubjectId)'),
            'schedules' => array(self::MANY_MANY, 'DictSchedule', 'tutorschedule(tutorId, dictScheduleId)'),
            'locations' => array(self::MANY_MANY, 'DictMrtStation', 'tutorlocation(tutorId, dictMrtStationId)'),
            'matchingAssignments' => array(self::MANY_MANY, 'Assignment', 'matchingtutor(tutorId, assignmentId)'),
            'pastAssignments' => array(self::MANY_MANY, 'Assignment', 'successfulassignment(tutorId, assignmentId)'),
            // models
            'status' => array(self::HAS_ONE, 'TutorStatus', 'tutorId'),
            'tutorPageView' => array(self::HAS_ONE, 'TutorPageView', 'tutorId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'userId' => 'User',
            'fullName' => 'Full Name',
            'genderCode' => 'Gender',
            'yearOfBirth' => 'Year Of Birth',
            'raceCode' => 'Race',
            'nationality' => 'Nationality',
            'passport' => 'NRIC/FIN/Passport',
            'email' => 'Email',
            'mobilePhone' => 'Mobile Phone',
            'homeTel' => 'Home Tel',
            'homeAddress' => 'Home Address',
            'homePostal' => 'Postal Code',
            'created' => 'Created',
            'modified' => 'Modified',
            'tutorSubjects' => 'Subject',
            'tutorHourlyRates' => 'Houryly Rate',
            'tutorLocations' => 'Location',
            'tutorSchedules' => 'Time Slot',
        );
    }

    public function scopes()
    {
        $t = $this->getTableAlias(false);
        return array(
            'available' => array(
                'with' => array('tutorStatus','user'),
                'condition' => "tutorStatus.tutorStatusCode = " . TutorStatus::STATUS_AVAILABLE,
//                                . " AND user.isVerified = 1",
                'order' => "$t.created DESC, $t.modified DESC",
            ),
            'recently' => array(
                'order' => "$t.created DESC",
                'limit' => 10,
            ),
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

        $criteria->compare('userId', $this->userId, true);
        $criteria->compare('fullName', $this->fullName, true);
        $criteria->compare('genderCode', $this->genderCode, true);
        $criteria->compare('yearOfBirth', $this->yearOfBirth, true);
        $criteria->compare('raceCode', $this->raceCode, true);
        $criteria->compare('nationality', $this->nationality, true);
        $criteria->compare('passport', $this->passport, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('mobilePhone', $this->mobilePhone, true);
        $criteria->compare('homeTel', $this->homeTel, true);
        $criteria->compare('homeAddress', $this->homeAddress, true);
        $criteria->compare('homePostal', $this->homePostal, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Tutor the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function validateProfile()
    {
        $this->clearErrors();
        $this->profileErrors = array();
        foreach (['tutorSubjects', 'tutorHourlyRates', 'tutorLocations', 'tutorSchedules'] as $relation) {
            if (empty($this->$relation)) {
                array_push($this->profileErrors, $relation);
                $this->addError($relation, 'You need to add at least one ' . $this->getAttributeLabel($relation));
            }
        }
        if (count($this->profileErrors) > 0) {
            $this->profileComplete = false;
        } else {
            $this->profileComplete = true;
        }
    }

    public function afterFind()
    {
//        $this->validateProfile();
        parent::afterFind();
    }

    public function deleteRelated($relation)
    {
        if ($this->$relation instanceof CModel) {
            $this->$relation->delete();
            $this->$relation = null;
            return;
        }
        if (is_array($this->$relation)) {
            foreach ($this->$relation as $model) {
                $model->delete();
            }
            $this->$relation = array();
            return;
        }
    }

    public function getAgeStr()
    {
        $age = date_diff(new DateTime, DateTime::createFromFormat('Y', $this->yearOfBirth), true)->y;
        $lowerBound = floor($age / 10) * 10;
        if ($age - $lowerBound > 4) {
            $lowerBound += 5;
        }
        return $lowerBound . '-' . ($lowerBound + 4);
    }

    public function getBackgroundStr()
    {
        $qualification = TutorQualification::model()->findByAttributes(array('tutorId' => $this->id));
        if (!is_null($qualification)) {
            return Lookup::item(Lookup::TYPE_TUTORING_MODE, $qualification->tutoringMode)
            . (strlen($str = DictTutorQualification::getQualificationLabel($qualification->dictTutorQualificationId)) > 0 ? ', ' . $str : '')
            . (strlen($str = DictTutorCredential::getCredentialLabel($qualification->dictTutorCredentialId)) > 0 ? ', ' . $str : '');
        }
        return;
    }

    public function getSubjectsStr()
    {
        $subjects = $this->subjects;
        $str = '';
        foreach ($subjects as $subject) {
            $str .= $subject->subject . ', ';
        }
        return substr($str, 0, strlen($str) - 2);
    }

    public function getSubjectLevelsStr()
    {
        $subjects = $this->subjects;
        $str = '';
        foreach ($subjects as $subject) {
            $str .= $subject->subject . ' (' . $subject->category->shortLabel . '), ';
        }
        return substr($str, 0, strlen($str) - 2);
    }

    public function getScheduleStr()
    {
        $schedules = $this->schedules;
        $strings = array();

        foreach ($schedules as $schedule) {
            if (!isset($strings[$schedule->slot])) {
                $strings[$schedule->slot] = '';
            }
            $strings[$schedule->slot] .= $schedule->wkday . ', ';
        }
        foreach ($strings as $i => $string) {
            $strings[$i] = substr($string, 0, strlen($string) - 2);
        }

//        $scheduleStr = '<table cellpadding="2">';
//        $scheduleStr .= (isset($strings['AM']) ? '<tr><td>AM:</td><td>' . $strings['AM'] . "</td></tr>" : '') .
//                        (isset($strings['PM']) ? '<tr><td>PM:</td><td>' . $strings['PM'] . "</td></tr>" : '') .
//                        (isset($strings['Evening']) ? '<tr><td>Evening:</td><td>' . $strings['Evening'] . "</td></tr>" : '');
//        $scheduleStr .= '</table>';
        return $strings;
    }

    public function isProfileComplete()
    {
        if (!$this->validate()
            || count($this->tutorLocations) == 0
            || count($this->tutorSubjects) == 0
            || count($this->tutorSchedules) == 0
            || is_null($this->tutorQualification)
            || !$this->tutorQualification->validate()
        ) {
            return false;
        }
        return true;
    }

    /**
     * Create MatchingTutor records
     */
    public function findMatchingAssignments()
    {
        MatchingTutor::model()->deleteAllByAttributes(array('tutorId' => $this->id));
        if ($this->isProfileComplete()) {
            $assignments = $this->findMatched();
            foreach ($assignments as $assignment) {
                $matchingTutor = new MatchingTutor;
                $matchingTutor->tutorId = $this->id;
                $matchingTutor->assignmentId = $assignment->id;
                $matchingTutor->save();
                $assignment->sendMatchedNotification($this);
            }
        }
    }

    /**
     * Find matched assignments
     * $return array
     */
    public function findMatched()
    {
        $criteria = new CDbCriteria;
        $criteria->with = array('requestor', 'assignmentSchedules', 'assignmentSubjects');
        $criteria->scopes = array('available');
        $criteria->addCondition("t.tutorGenderCode IS NULL OR t.tutorGenderCode = " . $this->genderCode);
        $criteria->addCondition("t.tutorRaceCode IS NULL OR t.tutorRaceCode = " . $this->raceCode);
        $criteria->addCondition("t.minQualificationId IS NULL OR t.minQualificationId <= " . $this->tutorQualification->dictTutorQualificationId);
        $criteria->addCondition("t.teachingCredential IS NULL " . (is_null($this->tutorQualification->dictTutorCredentialId) ? "" : "OR 0 < " . $this->tutorQualification->dictTutorCredentialId));
        $criteria->addCondition("requestor.dictMrtStationId IN (SELECT dictMrtStationId "
            . "FROM `tutorlocation` "
            . "WHERE `tutorlocation`.tutorId = $this->id)"
        );
        $criteria->addCondition("assignmentSchedules.dictScheduleId IN (SELECT dictScheduleId "
            . "FROM `tutorschedule` "
            . "WHERE `tutorschedule`.tutorId = $this->id)"
        );
        $criteria->addCondition("assignmentSubjects.dictSubjectId IN (SELECT dictSubjectId "
            . "FROM `tutorsubject` "
            . "WHERE `tutorsubject`.tutorId = $this->id)"
        );
        $criteria->distinct = true;
        $criteria->select = "*";
//        $criteria->select = "t.id, t.dictCategoryId";
        $assignments = Assignment::model()->findAll($criteria);
        return $assignments;
    }

    /**
     * Check if tutor has applied to the specified assignment
     * @param int $assignmentId
     * @return boolean | AssignmentApplicatioin
     */
    public function appliedTo($assignmentId)
    {
        $assignmentApplication = AssignmentApplication::model()->findByAttributes(array(
            'tutorId' => $this->id,
            'assignmentId' => $assignmentId,
        ));
        if (is_null($assignmentApplication)) {
            return false;
        }
        return $assignmentApplication;
    }

    /**
     * Return true if Tutor's subjects is superset of given set of subjects
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

    public function filterByLocation($mrtStationIds)
    {
        $myMrtStationIds = array();
        foreach ($this->locations as $dictMrtStation) {
            array_push($myMrtStationIds, $dictMrtStation->id);
        }
        if (count(array_diff($mrtStationIds, $myMrtStationIds)) > 0) {
            return false;
        }
        return true;
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

    public function changeStatus($newStatus)
    {
        $this->tutorStatus->tutorStatusCode = $newStatus;
    }

    public function getPageview()
    {
        if (isset($this->tutorPageView)) {
            return $this->tutorPageView->count;
        }
        return 0;
    }

    public function updatePageview()
    {
        if (is_null($this->tutorPageView)) {
            $pageView = new TutorPageView;
            $pageView->tutorid = $this->id;
            $pageView->count = 0;
        } else {
            $pageView = $this->tutorPageView;
        }
        // If the tutor is not viewing his own public profile
        if (Yii::app()->user->isGuest || Yii::app()->user->user->id != $this->userId) { 
            $pageView->count = $pageView->count + 1;
        }
        $pageView->save();
        return $pageView->count;
    }

    public function getIdStr()
    {
        return str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }

    private $_examResultTree = null;

    public function getExamResultTree()
    {
        if (!$this->_examResultTree) {
            $examResultTree = array();
            foreach ($this->tutorExamResults as $examResult) {
                if (!isset($examResultTree[$examResult->examCode])) {
                    $examResultTree[$examResult->examCode] = array();
                }
                array_push($examResultTree[$examResult->examCode], $examResult);
            }
            $this->_examResultTree = $examResultTree;
        }
        return $this->_examResultTree;
    }

    private $_examResultStr = null;

    public function getExamResultStr()
    {
        if (is_null($this->_examResultStr)) {
            $str = '';
            foreach ($this->getExamResultTree() as $examCode => $results) {
                $str = $str . '<b>' . Lookup::item(Lookup::TYPE_EXAM_TYPE, $examCode) . '</b><br>';
                $gradeStr = '';
                foreach ($results as $result) {
                    $gradeStr .= DictSubject::getSubjectStr($result->dictSubjectId) . ' (' . $result->grade . '), ';
                }
                $str = $str . substr($gradeStr, 0, strlen($gradeStr) - 2);
            }
            $this->_examResultStr = $str;
        }
        return $this->_examResultStr;
    }

    public function getOtherSkillStr()
    {
        $result = '';
        $otherSkills = $this->tutorOtherSkills;
        if (is_array($otherSkills) && count($otherSkills) > 0) {
            $result = $result . '<b>Others</b><br>';
            foreach ($otherSkills as $otherSkill) {
                $result = $result . $otherSkill->str . '<br>';
            }
        }
        return $result;
    }

    private $_schoolsStr = null;

    public function getSchoolsStr()
    {
        if (!$this->_schoolsStr) {
            $result = '';
            foreach ($this->tutorSchools as $school) {
                $result = $result . $school->str . '<br><br>';
            }
            $this->_schoolsStr = substr($result, 0, strlen($result) - 8);
        }
        return $this->_schoolsStr;
    }

    private $_qualificationTreeStr = null;

    public function getQualificationTreeStr()
    {
        if (!$this->_qualificationTreeStr) {
            $result = $this->schoolsStr
                . ((strlen($this->schoolsStr) > 0 && strlen($this->examResultStr) > 0) ? '<br><br>' : '')
                . $this->examResultStr
                . ((strlen($this->examResultStr) > 0 && strlen($this->otherSkillStr) > 0) ? '<br><br>' : '')
                . $this->otherSkillStr;
            $this->_qualificationTreeStr = $result;
        }
        return $this->_qualificationTreeStr;
    }

    private $_levelSubjectTree = array();

    public function getLevelSubjectTree()
    {
        if (empty($this->_levelSubjectTree)) {
            $levelSubjectTree = array();
            foreach ($this->subjects as $dictSubject) {
                $categoryId = $dictSubject->dictCategoryId;
                if (!isset($levelSubjectTree[$categoryId])) {
                    $levelSubjectTree[$categoryId] = array();
                }
                array_push($levelSubjectTree[$categoryId], $dictSubject);
            }
            $this->_levelSubjectTree = $levelSubjectTree;
        }
        return $this->_levelSubjectTree;
    }

    private $_levelSubjectTreeStr = null;

    public function getLevelSubjectTreeStr()
    {
        if (!$this->_levelSubjectTreeStr) {
            $result = '';
            foreach ($this->getLevelSubjectTree() as $categoryId => $subjects) {
                $result = $result . '<b>' . DictCategory::getCategoryLabel($categoryId) . '</b><br>';
                $str = '';
                foreach ($subjects as $subject) {
                    $str .= $subject->subject . ', ';
                }
                $result = $result . substr($str, 0, strlen($str) - 2) . '<br><br>';
            }
            $this->_levelSubjectTreeStr = substr($result, 0, strlen($result) - 8);
        }
        return $this->_levelSubjectTreeStr;
    }

    /**
     * Generate a list of levels that the tutor teaches
     */
    public function getLevelsStr()
    {
        $str = '';
        foreach ($this->getLevelSubjectTree() as $categoryId => $subjects) {
            $str .= DictCategory::getCategoryLabel($categoryId) . ', ';
        }
        return substr($str, 0, strlen($str) - 2);
    }

    public function getLocationsStr()
    {
        $str = '';
        foreach ($this->locations as $mrtStations) {
            $str .= $mrtStations->fullLabel . ', ';
        }
        $str = substr($str, 0, strlen($str) - 2);
        return $str;
    }

    public function getHourlyRatesStr()
    {
        $str = '';
//        foreach ($this->with('dictCategory')->tutorHourlyRates as $hourlyRates) {
//            $str .= '<b>' . $hourlyRates->dictCategory->label . ':</b> ' . ($hourlyRates->hourlyRate > 0 ? $hourlyRates->hourlyRate : 'Negotiable') . '<br>';
//        }
        $str .= '<table cellpadding="2">';
        foreach ($this->with('dictCategory')->tutorHourlyRates as $hourlyRates) {
            $str .= '<tr><td>' . $hourlyRates->dictCategory->label . ':</td><td>'
                . ($hourlyRates->hourlyRate > 0 ? '$' . $hourlyRates->hourlyRate : 'Negotiable') . '</td></tr>';
        }
        $str .= '</table>';
        return $str;
    }

    public function getAverageRating()
    {
        $reviews = $this->assignmentReviews;
        if (count($reviews) > 0) {
            $averageRating = 0;
            foreach ($reviews as $review) {
                $averageRating += $review->tutorRating;
            }
            return (float)$averageRating / count($reviews);
        }
        return 0;
    }

    public function __toString()
    {
        return $this->id;
    }

    public function getPublicUrl(){
        $base = Yii::app()->getBaseUrl(true);
        if(isset($this->tutorStatus) && strlen($this->tutorStatus->nick) > 0)
            $base = $base . '/tutor/public/' . $this->tutorStatus->nick;
        else
            $base = $base . $this->url;
        return $base;
    }

    public function getUrl()
    {
            $controller = get_class($this);
//        $controller[0] = strtolower($controller[0]);
            $params = array("id" => $this->id);
            // add the title parameter to the URL
            $params['name'] = $this->fullName;
            return Yii::app()->urlManager->createUrl($controller . '/view', $params);
    }

    public function getPhotoData()
    {
        $photo = null;
        if ($this->tutorPhoto && $this->tutorPhoto->fileBinary) {
            $photo = 'data:'. $this->tutorPhoto->fileType . ';base64,' . base64_encode($this->tutorPhoto->fileBinary);
        } else {
            $photo = $this->getDefaultPhotoUrl();
        }
        return $photo;
    }
    
    public function getPhotoUrl() {
        return Yii::app()->getBaseUrl().'/tutor/photo?tutorId='.$this->id.'.jpg';
    }

    public function getPhotoFileUrl() {
        $url = null;
        if($this->tutorPhoto && $this->tutorPhoto->fileName) {
            $filename = $this->tutorPhoto->fileName;
            $url = "/photo/tutor/$filename";
            if (!file_exists('.' . $url)){
                $url = null;
            }
        }
        if($url)
            return Yii::app()->getBaseUrl(). $url;
        else
            return '';
    }

    public function getDefaultPhotoUrl()
    {
//        $file = Yii::getPathOfAlias('webroot').'/images/default_profile_pic.png';
//        $photo = Yii::app()->assetManager->publish($file);
        $photo = Yii::app()->getBaseUrl() . '/images/default_profile_pic.png';
        return $photo;
    }

    public function getBriefInfo(){
        $info =  Lookup::item(Lookup::TYPE_GENDER, $this->genderCode) . ', ';
        $info = $info . Lookup::item(Lookup::TYPE_RACE, $this->raceCode) . ', ';
        $info = $info . 'Age ' . $this->ageStr;
        return $info;
    }
}
