<?php

/**
 * This is the model class for table "assignmentapplication".
 *
 * The followings are the available columns in table 'assignmentapplication':
 * @property string $id
 * @property string $assignmentId
 * @property string $tutorId
 * @property string $statusCode
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property Assignment $assignment
 * @property Tutor $tutor
 */
class AssignmentApplication extends ActiveRecord {

    const STATUS_ENT_BY_ADMIN = 0;
    const STATUS_SHORTLISTED_BY_PARENT = 1;
    const STATUS_SELFREC_BY_TUTOR = 2;
    const STATUS_REJECT_BY_TUTOR = 3;
    const STATUS_REJECT_BY_PARENT = 4;
    const STATUS_ACCEPT_BY_TUTOR = 5;
    const STATUS_ACCEPT_BY_PARENT = 6;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'assignmentapplication';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('assignmentId, tutorId, statusCode', 'required'),
            array('assignmentId, tutorId', 'length', 'max' => 10),
            array('statusCode', 'length', 'max' => 5),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, assignmentId, tutorId, statusCode, created, modified', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'assignment' => array(self::BELONGS_TO, 'Assignment', 'assignmentId'),
            'tutor' => array(self::BELONGS_TO, 'Tutor', 'tutorId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'assignmentId' => 'Assignment',
            'tutorId' => 'Tutor',
            'statusCode' => 'Status Code',
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
        $criteria->compare('assignmentId', $this->assignmentId, true);
        $criteria->compare('tutorId', $this->tutorId, true);
        $criteria->compare('statusCode', $this->statusCode, true);
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
     * @return AssignmentApplication the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function getAppliedDate() {
        return date('d M Y',  strtotime($this->created));
    }
    
    public function getIsAccepted() {
        return $this->statusCode == self::STATUS_ACCEPT_BY_PARENT || $this->statusCode == self::STATUS_ACCEPT_BY_TUTOR;
    }
    
    public function getIsRejected() {
        return $this->statusCode == self::STATUS_REJECT_BY_PARENT || $this->statusCode == self::STATUS_ACCEPT_BY_TUTOR;
    }
    
    /**
     * Awaiting decision from tutor or requestor
     */
    public function getIsPending() {
        return $this->statusCode == self::STATUS_SHORTLISTED_BY_PARENT || $this->statusCode == self::STATUS_SELFREC_BY_TUTOR;
    }

}
