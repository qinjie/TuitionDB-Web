<?php

/**
 * This is the model class for table "tutorlocation".
 *
 * The followings are the available columns in table 'tutorlocation':
 * @property string $id
 * @property string $tutorId
 * @property string $dictMrtStationId
 *
 * The followings are the available model relations:
 * @property Tutor $tutor
 * @property Dictmrtstation $dictMrtStation
 */
class TutorLocation extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tutorlocation';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tutorId, dictMrtStationId', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, tutorId, dictMrtStationId', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'tutor' => array(self::BELONGS_TO, 'Tutor', 'tutorId'),
            'dictMrtStation' => array(self::BELONGS_TO, 'DictMrtStation', 'dictMrtStationId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'tutorId' => 'Tutor',
            'dictMrtStationId' => 'Dict Mrt Station',
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
        $criteria->compare('tutorId', $this->tutorId, true);
        $criteria->compare('dictMrtStationId', $this->dictMrtStationId, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TutorLocation the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
        
    public function __toString() {
        return (string)$this->tutorId.'-'.$this->dictMrtStationId;
    }
}
