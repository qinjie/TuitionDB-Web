<?php

/**
 * This is the model class for table "tutorstatus".
 *
 * The followings are the available columns in table 'tutorstatus':
 * @property string $id
 * @property string $tutorId
 * @property string $tutorStatusCode
 * @property string $nick
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property Tutor $tutor
 */
class TutorStatus extends CActiveRecord
{

    const STATUS_AVAILABLE = 0;
    const STATUS_NOT_AVAILABLE = 1;
    const STATUS_BLACKLISTED = 999;

    public function tableName()
    {
        return 'tutorstatus';
    }

    public function rules()
    {
        return array(
            array('tutorId, tutorStatusCode', 'required'),
            array('tutorId', 'length', 'max' => 10),
            array('tutorStatusCode', 'length', 'max' => 5),
            array('nick', 'length', 'max' => 20),
            array('nick', 'unique','className'=>'TutorStatus', 'attributeName'=>'nick', 'allowEmpty' => true, 'message'=>'This url is already taken. Change another one.'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, tutorId, tutorStatusCode, nick', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'tutor' => array(self::BELONGS_TO, 'Tutor', 'tutorId'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'tutorId' => 'Tutor',
            'tutorStatusCode' => 'Tutor Status Code',
            'nick' => 'Public Profile Url',
            'modified' => 'Modified',
        );
    }

    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('tutorId', $this->tutorId, true);
        $criteria->compare('tutorStatusCode', $this->tutorStatusCode, true);
        $criteria->compare('modified', $this->modified, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function beforeSave()
    {
        $this->modified = null;
        return parent::beforeSave();
    }

}
