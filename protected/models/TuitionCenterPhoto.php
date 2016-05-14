<?php

/**
 * This is the model class for table "tuitioncenterphoto".
 *
 * The followings are the available columns in table 'tuitioncenterphoto':
 * @property string $id
 * @property string $tuitionCenterId
 * @property string $caption
 * @property string $fileBinary
 * @property string $fileName
 * @property string $fileType
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property Tuitioncenter $tuitionCenter
 */
class TuitionCenterPhoto extends ActiveRecord
{
    public function tableName()
    {
        return 'tuitioncenterphoto';
    }

    public function rules()
    {
        return array(
            array('tuitionCenterId', 'required'),
            array('tuitionCenterId, fileType', 'length', 'max' => 10),
            array('caption', 'length', 'max' => 255),
            array('fileName', 'length', 'max' => 50),
            array('fileBinary, created', 'safe'),
            // The following rule is used by search().
            array('id, tuitionCenterId, caption, fileBinary, fileName, fileType', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'tuitionCenter' => array(self::BELONGS_TO, 'TuitionCenter', 'tuitionCenterId'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'tuitionCenterId' => 'Tuition Center',
            'caption' => 'Caption',
            'fileBinary' => 'File Binary',
            'fileName' => 'File Name',
            'fileType' => 'File Type',
            'created' => 'Created',
            'modified' => 'Modified',
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

//        $criteria->compare('id', $this->id, true);
        $criteria->compare('tuitionCenterId', $this->tuitionCenterId, true);
        $criteria->compare('caption', $this->caption, true);
        $criteria->compare('fileBinary', $this->fileBinary, true);
        $criteria->compare('fileName', $this->fileName, true);
        $criteria->compare('fileType', $this->fileType, true);
//        $criteria->compare('created', $this->created, true);
//        $criteria->compare('modified', $this->modified, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function getUrl()
    {
        return Yii::app()->getBaseUrl() . '/tuitionCenter/photo/' . $this->tuitionCenterId . '?photoId=' . $this->id . '.jpg';
    }

}
