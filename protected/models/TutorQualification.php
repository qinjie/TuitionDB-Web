<?php

/**
 * This is the model class for table "tutorqualification".
 *
 * The followings are the available columns in table 'tutorqualification':
 * @property string $id
 * @property string $tutorId
 * @property string $tutoringMode
 * @property string $dictTutorQualificationId
 * @property string $dictTutorCredentialId
 * @property string $experienceStyle
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property Tutor $tutor
 * @property Dicttutorqualification $dictTutorQualification
 * @property Dicttutorcredential $dictTutorCredential
 */
Yii::import('ext.validators.DropdownListSelected');
class TutorQualification extends ActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tutorqualification';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tutorId, tutoringMode, dictTutorQualificationId, experienceStyle', 'required'),
            array('tutorId, dictTutorQualificationId, dictTutorCredentialId', 'length', 'max' => 10),
            array('dictTutorQualificationId', 'ext.validators.DropdownListSelected'),
            array('experienceStyle', 'length', 'max' => 500),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, tutorId, tutoringMode, dictTutorQualificationId, dictTutorCredentialId, experienceStyle, created, modified', 'safe', 'on' => 'search'),
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
            'dictTutorQualification' => array(self::BELONGS_TO, 'DictTutorQualification', 'dictTutorQualificationId'),
            'dictTutorCredential' => array(self::BELONGS_TO, 'DictTutorCredential', 'dictTutorCredentialId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'tutorId' => 'Tutor',
            'tutoringMode' => 'Tutoring Mode',
            'dictTutorQualificationId' => 'Qualification Level',
            'dictTutorCredentialId' => 'Teaching Credential',
            'experienceStyle' => 'Experience Style',
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
        $criteria->compare('tutoringMode', $this->tutoringMode, true);
        $criteria->compare('dictTutorQualificationId', $this->dictTutorQualificationId, true);
        $criteria->compare('dictTutorCredentialId', $this->dictTutorCredentialId, true);
        $criteria->compare('experienceStyle', $this->experienceStyle, true);
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
     * @return TutorQualification the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeSave() {
        if ($this->dictTutorCredentialId == 0)
            $this->dictTutorCredentialId = null;
        return parent::beforeSave();
    }

}
