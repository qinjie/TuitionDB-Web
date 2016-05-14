<?php

/**
 * This is the model class for table "tuitioncenterstaff".
 *
 * The followings are the available columns in table 'tuitioncenterstaff':
 * @property string $id
 * @property string $tuitionCenterId
 * @property string $userId
 * @property string $fullName
 * @property string $email
 * @property string $mobilePhone
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property Tuitioncenter $tuitionCenter
 * @property User $user
 */
class TuitionCenterStaff extends ActiveRecord
{
    public $tuitionCenterName;
    public $username;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tuitioncenterstaff';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('fullName', 'required'),
            array('tuitionCenterId, userId', 'length', 'max' => 10),
            array('fullName', 'length', 'max' => 255),
            array('mobilePhone', 'length', 'max' => 20),
            array('created, modified', 'safe'),
            // The following rule is used by search().
            array('id, tuitionCenterId, userId, fullName, email, mobilePhone, tuitionCenterName, username', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'tuitionCenter' => array(self::BELONGS_TO, 'TuitionCenter', 'tuitionCenterId'),
            'user' => array(self::BELONGS_TO, 'User', 'userId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'tuitionCenterId' => 'Tuition Center',
            'userId' => 'Username',
            'fullName' => 'Staff Name',
            'email' => 'Email',
            'mobilePhone' => 'Mobile Phone',
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
    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->with = array('user', 'tuitionCenter');

        $criteria->compare('id', $this->id, true);
        $criteria->compare('tuitionCenterId', $this->tuitionCenterId, true);
        $criteria->compare('userId', $this->userId, true);
        $criteria->compare('fullName', $this->fullName, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('mobilePhone', $this->mobilePhone, true);

        // comparing for virtual attributes
        $criteria->compare('user.username', $this->username, true);
        $criteria->compare('tuitionCenter.name', $this->tuitionCenterName, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'tuitionCenterName' => array(
                        'asc' => 'tuitionCenter.name',
                        'desc' => 'tuitionCenter.name DESC',
                    ),
                    'username' => array(
                        'asc' => 'user.username ASC',
                        'desc' => 'user.username DESC',
                    ),
                    '*',
                ),
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TuitionCenterStaff the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function isProfileCompleted()
    {

        return $this->validate();
    }

    // either admin or owner has rights on this record
    public function hasRights($userId = null)
    {
        if ($userId == null) {
            // get logon user
            $userId = Yii::app()->user->user->id;
        }
        $user = User::model()->findByPk($userId);
        if ($user->isAdmin) {
            // admin user always has rights
            return true;
        }
        if ($this->userId = $userId){
            // or direct owner has rights
            return true;
        }
        return false;
    }
}
