<?php

/**
 * This is the model class for table "tuitionclass".
 *
 * The followings are the available columns in table 'tuitionclass':
 * @property string $id
 * @property string $tuitionBranchId
 * @property string $dictClassLevelId
 * @property string $dictSubjectId
 * @property string $weekday
 * @property string $startTime
 * @property string $endTime
 * @property string $startDate
 * @property string $endDate
 * @property string $lessonCount
 * @property string $classSize
 * @property string $status
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property TuitionBranch $tuitionBranch
 * @property DictClassLevel $dictClassLevel
 * @property DictSubject $dictSubject
 */
class TuitionClass extends ActiveRecord {

    public function tableName() {
        return 'tuitionclass';
    }

    public function rules() {
        return array(
            array('dictClassLevelId, dictSubjectId, weekday, startTime, endTime', 'required'),
            array('dictClassLevelId, dictSubjectId, lessonCount, classSize, status', 'length', 'max' => 10),
            array('lessonCount, classSize', 'numerical', 'integerOnly' => true, 'min' => 1),
            array('dictClassLevelId, dictSubjectId, weekday', 'numerical', 'integerOnly' => true, 'min' => 1, 'tooSmall' => 'Please choose {attribute}'),
            array('weekday', 'length', 'max' => 3),
            array('startTime, endTime','type','timeFormat'=>'hh:mm:ss'),
            array('startDate, endDate', 'type', 'dateFormat' => 'dd-MM-yyyy'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, tuitionBranchId, dictClassLevelId, dictSubjectId, weekday, startTime, endTime, startDate, endDate, lessonCount, classSize, status, created, modified', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'tuitionBranch' => array(self::BELONGS_TO, 'TuitionBranch', 'tuitionBranchId'),
            'dictClassLevel' => array(self::BELONGS_TO, 'DictClassLevel', 'dictClassLevelId'),
            'dictSubject' => array(self::BELONGS_TO, 'DictSubject', 'dictSubjectId'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'tuitionBranchId' => 'Tuition Branch',
            'dictClassLevelId' => 'Class Level',
            'dictSubjectId' => 'Subject',
            'weekday' => 'Weekday',
            'startTime' => 'Start Time',
            'endTime' => 'End Time',
            'startDate' => 'Start Date',
            'endDate' => 'End Date',
            'lessonCount' => 'Lesson Count',
            'classSize' => 'Class Size',
            'status' => 'Status',
            'created' => 'Created',
            'modified' => 'Modified',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('tuitionBranchId', $this->tuitionBranchId, true);
        $criteria->compare('dictClassLevelId', $this->dictClassLevelId, true);
        $criteria->compare('dictSubjectId', $this->dictSubjectId, true);
        $criteria->compare('weekday', $this->weekday, true);
        $criteria->compare('startTime', $this->startTime, true);
        $criteria->compare('endTime', $this->endTime, true);
        $criteria->compare('startDate', $this->startDate, true);
        $criteria->compare('endDate', $this->endDate, true);
        $criteria->compare('lessonCount', $this->lessonCount, true);
        $criteria->compare('classSize', $this->classSize, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function beforeSave() {
        $this->startDate = Helper::convertDateForSave($this->startDate);
        $this->endDate = Helper::convertDateForSave($this->endDate);
        return parent::beforeSave();
    }
    
    public function getIdStr()
    {
        return str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }
    
    public function getTimeStr() {
        $startTime = DateTime::createFromFormat('H:i:s', $this->startTime);
        $endTime   = DateTime::createFromFormat('H:i:s', $this->endTime);
        if (isset($startTime) && isset($endTime)) {
            return $startTime->format('H:i') . ' - ' . $endTime->format('H:i');
        }
    }
    
}