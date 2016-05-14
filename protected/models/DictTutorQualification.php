<?php

/**
 * This is the model class for table "dicttutorqualification".
 *
 * The followings are the available columns in table 'dicttutorqualification':
 * @property string $id
 * @property string $qualification
 * @property string $position
 *
 * The followings are the available model relations:
 * @property Tutorqualification[] $tutorqualifications
 */
class DictTutorQualification extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'dicttutorqualification';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('position', 'required'),
            array('qualification', 'length', 'max' => 50),
            array('position', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, qualification, position', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'tutorqualifications' => array(self::HAS_MANY, 'TutorQualification', 'dictTutorQualificationId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'qualification' => 'Qualification',
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
        $criteria->compare('qualification', $this->qualification, true);
        $criteria->compare('position', $this->position, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DictTutorQualification the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    private static $qualificationList = array();

    public static function getAllTutorQualifications() {
        if (empty(self::$qualificationList)) {
            $qualifications = self::model()->findAll(array('order' => 'position'));
            foreach ($qualifications as $qualification) {
                self::$qualificationList[$qualification->id] = $qualification->qualification;
            }
        }
        return self::$qualificationList;
    }
    
    public static function getQualificationLabel($id) {
        if (empty(self::$qualificationList)) {
            self::getAllTutorQualifications();
        }
        if (isset(self::$qualificationList[$id])) {
            return self::$qualificationList[$id];
        }
        return null;
    }

}
