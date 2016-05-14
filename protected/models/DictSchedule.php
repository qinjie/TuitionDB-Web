<?php

/**
 * This is the model class for table "dictschedule".
 *
 * The followings are the available columns in table 'dictschedule':
 * @property string $id
 * @property string $weekday
 * @property string $slot
 * @property string $position
 *
 * The followings are the available model relations:
 * @property Assignmentschedule[] $assignmentschedules
 * @property Tutorschedule[] $tutorschedules
 */
class DictSchedule extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'dictschedule';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('weekday', 'length', 'max' => 20),
            array('slot', 'length', 'max' => 10),
            array('position', 'length', 'max' => 5),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, weekday, slot, position', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'assignmentschedules' => array(self::HAS_MANY, 'AssignmentSchedule', 'dictScheduleId'),
            'tutorschedules' => array(self::HAS_MANY, 'TutorSchedule', 'dictScheduleId'),
            // tutors who can work in this schedule
            'tutors' => array(self::MANY_MANY, 'Tutor', 'tutorschedule(dictScheduleId, tutorId)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'weekday' => 'Weekday',
            'slot' => 'Slot',
            'position' => 'Position',
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
        $criteria->compare('weekday', $this->weekday, true);
        $criteria->compare('slot', $this->slot, true);
        $criteria->compare('position', $this->position, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DictSchedule the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    private static $scheduleTree = array();

    public static function getScheduleTree() {
        if (count(self::$scheduleTree) == 0) {
            $schedules = DictSchedule::model()->findAll(array('order' => 'position'));
            foreach ($schedules as $schedule) {
                if (!isset(self::$scheduleTree[$schedule->weekday])) {
                    self::$scheduleTree[$schedule->weekday] = array();
                }
                self::$scheduleTree[$schedule->weekday][$schedule->id] = $schedule->wkdayslot;
            }
        }
        return self::$scheduleTree;
    }
    
    public static function getScheduleTreeNew() {
        $scheduleTree = array();
        $schedules = DictSchedule::model()->findAll(array('order' => 'position'));
        foreach ($schedules as $schedule) {
            if (!isset($scheduleTree[$schedule->weekday])) {
                $scheduleTree[$schedule->weekday] = array();
            }
            $scheduleTree[$schedule->weekday][$schedule->slot] = $schedule->id;
        }
        return $scheduleTree;
    }
    
    public static function getWeekdayList() {
//        $connection = Yii::app()->db;
//        $command = $connection->createCommand('SELECT DISTINCT weekday FROM dictschedule');
//        $dataReader = $command->query();
//        var_dump($dataReader->readAll());
        return array(
            'Monday'=>'Monday',
            'Tuesday'=>'Tuesday',
            'Wednesday'=>'Wednesday',
            'Thursday'=>'Thursday',
            'Friday'=>'Friday',
            'Saturday'=>'Saturday',
            'Sunday'=>'Sunday'
        );
    }
    
    public static function getTimeSlotList() {
        return array(
            'AM'=>'AM',
            'PM'=>'PM',
            'Evening'=>'Evening',
        );
    }
    
    public function __toString() {
        return $this->id;
    }

}
