<?php

/**
 * This is the model class for table "assignmentreview".
 *
 * The followings are the available columns in table 'assignmentreview':
 * @property string $id
 * @property string $assignmentId
 * @property string $tutorId
 * @property string $tutorRating
 * @property string $comment
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property Tutor $tutor
 * @property Assignment $assignment
 */
class AssignmentReview extends ActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'assignmentreview';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('assignmentId, tutorId, tutorRating', 'required'),
            array('tutorRating', 'numerical', 'min' => 0, 'max' => 10),
            array('assignmentId, tutorId, tutorRating', 'length', 'max' => 10),
            array('comment', 'length', 'max' => 500),
            array('created', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, assignmentId, tutorId, tutorRating, comment, created, modified', 'safe', 'on' => 'search'),
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
            'tutorRating' => 'Tutor Rating',
            'comment' => 'Comment',
            'created' => 'Created',
            'modified' => 'Modified',
        );
    }
    
    public function getRatingStr() {
        return $this->tutorRating.'/10';
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
        $criteria->compare('tutorRating', $this->tutorRating, true);
        $criteria->compare('comment', $this->comment, true);
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
     * @return AssignmentReview the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    

}
