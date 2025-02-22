<?php

/**
 * This is the model class for table "question".
 *
 * The followings are the available columns in table 'question':
 * @property string $id
 * @property string $question
 * @property string $answer
 * @property integer $type
 * @property string $created
 * @property string $modified
 */
class Question extends CActiveRecord
{

    const TYPE_GENERAL = 0;
    const TYPE_TUTOR = 1;
    const TYPE_REQUESTOR = 2;
    const TYPE_CENTER = 3;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'question';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question, answer, type', 'required'),
			array('type', 'numerical', 'integerOnly'=>true),
			array('question', 'length', 'max'=>100),
			array('answer', 'length', 'max'=>300),
			array('created', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, question, answer, type, created, modified', 'safe', 'on'=>'search'),
		);
	}

    public function scopes(){
        $t=$this->getTableAlias(false);
        return array(
            'general' => array(
                'condition' => "$t.type = " . Question::TYPE_GENERAL,
            ),
            'tutor' => array(
                'condition' => '$t.type = ' . Question::TYPE_TUTOR,
            ),
            'requestor' => array(
                'condition' => '$t.type = ' . Question::TYPE_REQUESTOR,
            ),
            'requestor' => array(
                'condition' => '$t.type = ' . Question::TYPE_CENTER,
            ),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'question' => 'Question',
			'answer' => 'Answer',
			'type' => 'For Whom',
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
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('question',$this->question,true);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Question the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
