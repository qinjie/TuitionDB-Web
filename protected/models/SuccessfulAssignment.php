<?php

/**
 * This is the model class for table "successfulassignment".
 *
 * The followings are the available columns in table 'successfulassignment':
 * @property string $id
 * @property string $assignmentId
 * @property string $tutorId
 * @property string $matchedDate
 * @property string $startDate
 * @property string $feePayable
 * @property string $feePaid
 * @property string $paymentDate
 * @property string $paymentModeCode
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property Tutor $tutor
 * @property Assignment $assignment
 */
class SuccessfulAssignment extends ActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'successfulassignment';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('assignmentId, tutorId', 'required'),
            array('assignmentId, tutorId', 'length', 'max' => 10),
            array('feePayable, feePaid', 'length', 'max' => 6),
            array('paymentModeCode', 'length', 'max' => 5),
            array('matchedDate, startDate, paymentDate', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, assignmentId, tutorId, matchedDate, startDate, feePayable, feePaid, paymentDate, paymentModeCode, created, modified', 'safe', 'on' => 'search'),
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
            'assignment' => array(self::BELONGS_TO, 'Assignment', 'assignmentId'),
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
            'matchedDate' => 'Matched Date',
            'startDate' => 'Start Date',
            'feePayable' => 'Fee Payable',
            'feePaid' => 'Fee Paid',
            'paymentDate' => 'Payment Date',
            'paymentModeCode' => 'Payment Mode Code',
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
        $criteria->compare('matchedDate', $this->matchedDate, true);
        $criteria->compare('startDate', $this->startDate, true);
        $criteria->compare('feePayable', $this->feePayable, true);
        $criteria->compare('feePaid', $this->feePaid, true);
        $criteria->compare('paymentDate', $this->paymentDate, true);
        $criteria->compare('paymentModeCode', $this->paymentModeCode, true);
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
     * @return SuccessfulAssignment the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function getPaid() {
        return $this->feePaid > 0;
    }

}
