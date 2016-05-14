<?php

/**
 * This is the model class for table "tutorResume".
 *
 * The followings are the available columns in table 'tutorResume':
 * @property string $id
 * @property string $tutorId
 * @property string $fileName
 * @property string $fileType
 * @property string $created
 * @property string $modified
 */
class TutorResume extends ActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tutorresume';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tutorId', 'required'),
            array('tutorId, fileType', 'length', 'max' => 10),
            array('fileName', 'length', 'max' => 50),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, tutorId, fileName, fileType, created, modified', 'safe', 'on' => 'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'tutorId' => 'Tutor',
            'fileName' => 'File Name',
            'fileType' => 'File Type',
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
        $criteria->compare('fileName', $this->fileName, true);
        $criteria->compare('fileType', $this->fileType, true);
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
     * @return TutorResume the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
