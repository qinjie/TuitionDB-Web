<?php

/**
 * This is the model class for table "option".
 *
 * The followings are the available columns in table 'option':
 * @property string $id
 * @property string $name
 * @property string $value
 */
class ConfigStore extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'configstore';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, value', 'length', 'max' => 50),
            // The following rule is used by search().
            array('name, value', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'value' => 'Value',
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

        $criteria->compare('name', $this->name, true);
        $criteria->compare('value', $this->value, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ConfigStore the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Loads the lookup items for the specified type from the database.
     * @param string the item type
     */
    public function item($name)
    {
        $model = self::model()->find(array(
            'condition' => 'name=:name',
            'params' => array(':name' => $name),
        ));
        return $model->value;
    }

    public function updateItem($name, $value)
    {
        $model = self::model()->find(array(
            'condition' => 'name=:name',
            'params' => array(':name' => $name),
        ));
        if ($model) {
            $model->value = $value;
            return $model->save(false);
        }else{
            return self::insertItem($name, $value);
        }
    }

    public function insertItem($name, $value){
        if(self::model()->exists('name=:name', array(':name'=>$name))) {
            $model = new ConfigStore();
            $model->name = $name;
            $model->value = $value;
            return $model->save();
        }
        return false;
    }
}
