<?php

/**
 * This is the model class for table "tutorexamresult".
 *
 * The followings are the available columns in table 'tutorexamresult':
 * @property string $id
 * @property string $tutorId
 * @property string $examCode
 * @property string $dictSubjectId
 * @property string $grade
 *
 * The followings are the available model relations:
 * @property Tutor $tutor
 * @property Dictsubject $dictSubject
 */
class TutorExamResult extends CActiveRecord {

    const EXAM_OLEVEL = 0;
    const EXAM_ALEVEL = 1;
    const EXAM_IB = 2;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tutorexamresult';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tutorId, examCode, dictSubjectId, grade', 'required'),
            array('tutorId, dictSubjectId, grade', 'length', 'max' => 10),
            array('examCode', 'length', 'max' => 5),
            array('dictSubjectId', 'ext.validators.DropdownListSelected'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, tutorId, examCode, dictSubjectId, grade', 'safe', 'on' => 'search'),
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
            'subject' => array(self::BELONGS_TO, 'DictSubject', 'dictSubjectId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'tutorId' => 'Tutor',
            'examCode' => 'Exam Code',
            'dictSubjectId' => 'Subject',
            'grade' => 'Grade',
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
        $criteria->compare('examCode', $this->examCode, true);
        $criteria->compare('dictSubjectId', $this->dictSubjectId, true);
        $criteria->compare('grade', $this->grade, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TutorExamResult the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
        
    public function __toString() {
        return (string)$this->tutorId.'-'.$this->dictSubjectId;
    }

    public function getSubjectLabel(){
        return $this->subject->subject;
    }
}
