<?php

/**
 * This is the model class for table "tutorhourlyrate".
 *
 * The followings are the available columns in table 'tutorhourlyrate':
 * @property string $id
 * @property string $tutorId
 * @property string $dictCategoryId
 * @property string $hourlyRate
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property Tutor $tutor
 * @property Dictcategory $dictCategory
 */
class TutorHourlyRate extends ActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tutorhourlyrate';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tutorId, dictCategoryId', 'required'),
            array('tutorId, dictCategoryId', 'length', 'max' => 10),
            array('hourlyRate', 'filter', 'filter' => 'trim'),
            array('hourlyRate', 'length', 'max' => 6),
            array('hourlyRate', 'match', 'pattern' => '/^[0-9]*\.?[0-9]*$/'),
            array('hourlyRate','numerical','max'=>999),
            array('created, modified', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, tutorId, dictCategoryId, hourlyRate, created, modified', 'safe', 'on' => 'search'),
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
            'dictCategory' => array(self::BELONGS_TO, 'DictCategory', 'dictCategoryId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'tutorId' => 'Tutor',
            'dictCategoryId' => 'Dict Category',
            'hourlyRate' => 'Hourly Rate',
            'created' => 'Created',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('tutorId', $this->tutorId, true);
        $criteria->compare('dictCategoryId', $this->dictCategoryId, true);
        $criteria->compare('hourlyRate', $this->hourlyRate, true);
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
     * @return TutorHourlyRate the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
        
    public function __toString() {
        return (string)$this->tutorId.'-'.$this->dictCategoryId;
    }

}
