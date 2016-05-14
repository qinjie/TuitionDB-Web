<?php

/**
 * This is the model class for table "requestor".
 *
 * The followings are the available columns in table 'requestor':
 * @property string $id
 * @property string $userId
 * @property string $fullName
 * @property string $relation
 * @property string $email
 * @property string $mobilePhone
 * @property string $homeTel
 * @property string $homeAddress
 * @property string $homePostal
 * @property string $dictMrtStationId
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property Assignment[] $assignments
 * @property Favoritetutor[] $favoritetutors
 * @property Tutortestimonial[] $tutortestimonials
 */
class Requestor extends ActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'requestor';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('relation, fullName, email, mobilePhone, homePostal, dictMrtStationId', 'required'),
            array('fullName, email, mobilePhone, homeTel, homeAddress, homePostal', 'filter', 'filter' => 'trim'),
            array('userId', 'length', 'max' => 10),
            array('mobilePhone, homeTel, homePostal', 'length', 'max' => 20),
            array('fullName, homeAddress', 'length', 'max' => 100),
            array('email', 'length', 'max' => 254),
            array('mobilePhone, homeTel, homePostal', 'match', 'pattern' => '/^\d+$/'), // Allow only numbers
            array('dictMrtStationId', 'ext.validators.DropdownListSelected'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, userId, title, fullName, email, mobilePhone, homeTel, homeAddress, homePostal, dictMrtStationId, created, modified', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'userId'),
            'assignments' => array(self::HAS_MANY, 'Assignment', 'requestorId'),
            'tutorTestimonials' => array(self::HAS_MANY, 'TutorTestimonial', 'requestorId'),
            'favoriteTutors' => array(self::HAS_MANY, 'FavoriteTutor', 'requestorId'),
            'dictMrtStation' => array(self::BELONGS_TO, 'DictMrtStation', 'dictMrtStationId'),
            'goodTutors' => array(self::MANY_MANY, 'Tutor', 'favoritetutor(requestorId, tutorId)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'userId' => 'User',
            'fullName' => 'Full Name',
            'relation' => 'You are a',
            'email' => 'Email',
            'mobilePhone' => 'Mobile Phone',
            'homeTel' => 'Home Tel',
            'homeAddress' => 'Home Address',
            'homePostal' => 'Home Postal',
            'dictMrtStationId' => 'Nearest Mrt Station',
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
        $criteria->compare('userId', $this->userId, true);
        $criteria->compare('fullName', $this->fullName, true);
        $criteria->compare('relation', $this->relation, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('mobilePhone', $this->mobilePhone, true);
        $criteria->compare('homeTel', $this->homeTel, true);
        $criteria->compare('homeAddress', $this->homeAddress, true);
        $criteria->compare('homePostal', $this->homePostal, true);
        $criteria->compare('dictMrtStationId', $this->dictMrtStationId, true);
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
     * @return Requestor the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function isFavorite($tutorId) {
        return FavoriteTutor::model()->exists('requestorId = :requestorId AND tutorId = :tutorId', array(
            ':requestorId' => $this->id,
            ':tutorId' => $tutorId,
        ));
    }
    
    public function getSuccessfulAssignmentCount() {
        return SuccessfulAssignment::model()->count(array(
            'join' => 'JOIN assignment ON assignment.id = t.assignmentId',
            'condition' => 'assignment.requestorId = '.$this->id,
        ));
    }

}
