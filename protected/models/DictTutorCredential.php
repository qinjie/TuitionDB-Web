<?php

/**
 * This is the model class for table "dicttutorcredential".
 *
 * The followings are the available columns in table 'dicttutorcredential':
 * @property string $id
 * @property string $credential
 * @property string $position
 *
 * The followings are the available model relations:
 * @property Tutorqualification[] $tutorqualifications
 */
class DictTutorCredential extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'dicttutorcredential';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('position', 'required'),
            array('credential', 'length', 'max' => 50),
            array('position', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, credential, position', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'tutorqualifications' => array(self::HAS_MANY, 'TutorQualification', 'dictTutorCredentialId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'credential' => 'Credential',
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
        $criteria->compare('credential', $this->credential, true);
        $criteria->compare('position', $this->position, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DictTutorCredential the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    private static $credentialList = array();

    public static function getAllCredentials() {
        if (empty(self::$credentialList)) {
            $credentials = self::model()->findAll(array('order' => 'position'));
            foreach ($credentials as $credential) {
                self::$credentialList[$credential->id] = $credential->credential;
            }
        }
        return self::$credentialList;
    }
    
    public static function getCredentialLabel($id) {
        if (empty(self::$credentialList)) {
            self::getAllCredentials();
        }
        if (isset(self::$credentialList[$id])) {
            return self::$credentialList[$id];
        }
        return null;
    }

}
