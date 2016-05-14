<?php

/**
 * This is the model class for table "tuitionbranch".
 *
 * The followings are the available columns in table 'tuitionbranch':
 * @property string $id
 * @property string $tuitionCenterId
 * @property string $name
 * @property string $address
 * @property integer $postal
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property string $website
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property TuitionCenter $center
 * @property TuitioncClass[] $classes
 */
class TuitionBranch extends ActiveRecord {

    public function tableName() {
        return 'tuitionbranch';
    }

    public function rules() {
        return array(
            array('tuitionCenterId, postal, phone, dictMrtStationId', 'required'),
            array('postal', 'numerical', 'integerOnly' => true),
            array('tuitionCenterId', 'length', 'max' => 10),
            array('name, website', 'length', 'max' => 200),
            array('address, email', 'length', 'max' => 255),
            array('phone, fax', 'length', 'max' => 20),
            array('created', 'safe'),
            array('id, tuitionCenterId, name, address, postal, phone, fax, email, website, created, modified', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'center' => array(self::BELONGS_TO, 'TuitionCenter', 'tuitionCenterId'),
            'classes' => array(self::HAS_MANY, 'TuitionClass', 'tuitionBranchId'),
            'mrtStation' => array(self::BELONGS_TO, 'DictMrtStation', 'dictMrtStationId'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'tuitionCenterId' => 'Tuition Center',
            'name' => 'Name',
            'address' => 'Address',
            'postal' => 'Postal',
            'phone' => 'Phone',
            'fax' => 'Fax',
            'email' => 'Email',
            'website' => 'Website',
            'dictMrtStationId' => 'Nearest MRT Station',
            'created' => 'Created',
            'modified' => 'Modified',
        );
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('tuitionCenterId', $this->tuitionCenterId, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('postal', $this->postal);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('fax', $this->fax, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('website', $this->website, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getIdStr()
    {
        return str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }

}
