<?php

/**
 * This is the model class for table "assignmentschedule".
 *
 * The followings are the available columns in table 'assignmentschedule':
 * @property string $id
 * @property string $assignmentId
 * @property string $dictScheduleId
 *
 * The followings are the available model relations:
 * @property Assignment $assignment
 * @property Dictschedule $dictSchedule
 */
class AssignmentSchedule extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'assignmentschedule';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('assignmentId, dictScheduleId', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, assignmentId, dictScheduleId', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'assignment' => array(self::BELONGS_TO, 'Assignment', 'assignmentId'),
            'dictSchedule' => array(self::BELONGS_TO, 'DictSchedule', 'dictScheduleId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'assignmentId' => 'Assignment',
            'dictScheduleId' => 'Dict Schedule',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('assignmentId', $this->assignmentId, true);
        $criteria->compare('dictScheduleId', $this->dictScheduleId, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AssignmentSchedule the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function __toString() {
        return $this->assignmentId.'-'.$this->dictScheduleId;
    }
}
