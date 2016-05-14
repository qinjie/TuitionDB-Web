<?php

/**
 * This is the model class for table "lookup".
 *
 * The followings are the available columns in table 'lookup':
 * @property string $id
 * @property string $name
 * @property string $code
 * @property string $type
 * @property string $position
 */
class Lookup extends CActiveRecord {

    private static $_items = array();

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Lookup the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'lookup';
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
            'type' => 'Type',
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('code', $this->code, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('position', $this->position, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the items for the specified type.
     * @param string item type (e.g. 'PostStatus').
     * @return array item names indexed by item code. The items are order by their position values.
     * An empty array is returned if the item type does not exist.
     */
    public static function items($type) {
        if (!isset(self::$_items[$type]))
            self::loadItems($type);
        return self::$_items[$type];
    }

    /**
     * Returns the item name for the specified type and code.
     * @param string the item type (e.g. 'PostStatus').
     * @param integer the item code (corresponding to the 'code' column value)
     * @return string the item name for the specified code. False is returned if the item type or code does not exist.
     */
    public static function item($type, $code) {
        if (!isset(self::$_items[$type]))
            self::loadItems($type);
        return isset(self::$_items[$type][$code]) ? self::$_items[$type][$code] : false;
    }

    /**
     * Loads the lookup items for the specified type from the database.
     * @param string the item type
     */
    private static function loadItems($type) {
        self::$_items[$type] = array();
        $models = self::model()->findAll(array(
            'condition' => 'type=:type',
            'params' => array(':type' => $type),
            'order' => 'position',
        ));
        foreach ($models as $model)
            self::$_items[$type][$model->code] = $model->name;
    }

    const TYPE_RACE = 'race';
    const TYPE_GENDER = 'gender';
    const TYPE_QUALIFICATION = 'qualification';
    const TYPE_ACCOUNT_TYPE = 'accountType';
    const TYPE_TUTOR_STATUS = 'tutorStatus';
    const TYPE_TUTORING_MODE = 'tutoringMode';
    const TYPE_TUTOR_JOB = 'tutorJob';
    const TYPE_TUITION_VENUE = 'tuitionVenue';
    const TYPE_ASSSIGNMENT_STATUS = 'assignmentStatus';
    const TYPE_PAYMENT_MODE = 'paymentMode';
    const TYPE_TUTOR_SELFMATCH_STATUS = 'tutorSelfMatchStatus';
    const TYPE_ACCOUNT_VERIFIED = 'accountVerified';
    const TYPE_APPLICATION_STATUS = 'assignmentApplicationstatus';
    const TYPE_EXAM_TYPE = 'examType';
    const TYPE_QUESTION_TYPE = 'questionType';
    const TYPE_CLASS_STATUS = 'tuitionClassStatus';
}
