<?php

/**
 * This is the model class for table "dictsubject".
 *
 * The followings are the available columns in table 'dictsubject':
 * @property string $id
 * @property string $dictCategoryId
 * @property string $subject
 * @property string $position
 * @property string $status
 *
 * The followings are the available model relations:
 * @property Assignmentsubject[] $assignmentsubjects
 * @property Dictcategory $dictCategory
 * @property Tutorexamresult[] $tutorexamresults
 * @property Tutorsubject[] $tutorsubjects
 */
class DictSubject extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'dictsubject';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('dictCategoryId, subject', 'required'),
            array('dictCategoryId', 'length', 'max' => 10),
            array('subject', 'length', 'max' => 100),
            array('position, status', 'length', 'max' => 5),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, dictCategoryId, subject, position, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'assignmentsubjects' => array(self::HAS_MANY, 'AssignmentSubject', 'dictSubjectId'),
            'category' => array(self::BELONGS_TO, 'DictCategory', 'dictCategoryId'),
            'tutorexamresults' => array(self::HAS_MANY, 'TutorExamResult', 'dictSubjectId'),
            'tutorsubjects' => array(self::HAS_MANY, 'TutorSubject', 'dictSubjectId'),
            // tutors who can teach this subject
            'tutors' => array(self::MANY_MANY, 'Tutor', 'tutorsubject(dictSubjectId, tutorId)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'dictCategoryId' => 'Category',
            'subject' => 'Subject',
            'position' => 'Position',
            'status' => 'Status',
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
        $criteria->compare('dictCategoryId', $this->dictCategoryId, true);
        $criteria->compare('subject', $this->subject, true);
        $criteria->compare('position', $this->position, true);
        $criteria->compare('status', $this->status, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DictSubject the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    private static $subjectTree = array();

    public static function getSubjectTree() {
        if (count(self::$subjectTree) == 0) {
            $subjects = self::model()->with('category')->findAll(array('order' => 'category.position, t.subject'));
            foreach ($subjects as $subject) {
                if (!isset(self::$subjectTree[$subject->category->label])) {
                    self::$subjectTree[$subject->category->label] = array('categoryId' => $subject->category->id);
                }
                self::$subjectTree[$subject->category->label][$subject->id] = $subject->label;
            }
        }
        return self::$subjectTree;
    }

    private static $allSubjects = array();

    public static function getAllSubjects() {
        if (count(self::$allSubjects) == 0) {
            $subjects = self::model()->findAll();
            foreach ($subjects as $subject) {
                self::$allSubjects[$subject->id] = $subject->subject;
            }
        }
        return self::$allSubjects;
    }

    public static function getSubjectsByCategory($categoryId) {
        $subjects = self::model()->findAllByAttributes(array('dictCategoryId' => $categoryId), array('order' => 'subject'));
        $array = array();
        if (count($subjects) > 0) {
            foreach ($subjects as $subject) {
                $array[$subject->id] = $subject->subject;
            }
        }
        return $array;
    }
    
    public static function getSubjectLabel($id) {
        $subject = self::model()->findByPk($id);
        if ($subject)
            return $subject->subject . ' (' . $subject->category->shortLabel . ')';
        return null;
    }

    public static function getSubjectStr($id) {
        $subject = self::model()->findByPk($id);
        if ($subject)
            return $subject->subject;
        return null;
    }

    public function getLabel() {
        return $this->subject . ' (' . $this->category->shortLabel . ')';
    }
    
    public function __toString() {
        return $this->id;
    }

}
