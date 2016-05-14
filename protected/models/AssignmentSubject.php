<?php

/**
 * This is the model class for table "assignmentsubject".
 *
 * The followings are the available columns in table 'assignmentsubject':
 * @property string $id
 * @property string $assignmentId
 * @property string $dictSubjectId
 *
 * The followings are the available model relations:
 * @property Assignment $assignment
 * @property Dictsubject $dictSubject
 */
class AssignmentSubject extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'assignmentsubject';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('assignmentId, dictSubjectId', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, assignmentId, dictSubjectId', 'safe', 'on' => 'search'),
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
            'dictSubject' => array(self::BELONGS_TO, 'DictSubject', 'dictSubjectId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'assignmentId' => 'Assignment',
            'dictSubjectId' => 'Dict Subject',
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
        $criteria->compare('dictSubjectId', $this->dictSubjectId, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AssignmentSubject the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function __toString() {
        return $this->assignmentId.'-'.$this->dictSubjectId;
    }
}
