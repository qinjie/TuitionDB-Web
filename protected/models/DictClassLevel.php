<?php

/**
 * This is the model class for table "dictclasslevel".
 *
 * The followings are the available columns in table 'dictclasslevel':
 * @property string $id
 * @property string $dictCategoryId
 * @property string $label
 * @property string $abbreviate
 * @property string $position
 *
 * The followings are the available model relations:
 * @property Dictcategory $dictCategory
 * @property Tuitionclass[] $tuitionclasses
 */
class DictClassLevel extends CActiveRecord {

    public function tableName() {
        return 'dictclasslevel';
    }

    public function rules() {
        return array(
            array('dictCategoryId', 'required'),
            array('dictCategoryId, abbreviate, position', 'length', 'max' => 10),
            array('label', 'length', 'max' => 50),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, dictCategoryId, label, abbreviate, position', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'dictCategory' => array(self::BELONGS_TO, 'Dictcategory', 'dictCategoryId'),
            'tuitionclasses' => array(self::HAS_MANY, 'Tuitionclass', 'dictClassLevelId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'dictCategoryId' => 'Dict Category',
            'label' => 'Label',
            'abbreviate' => 'Abbreviate',
            'position' => 'Position',
        );
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('dictCategoryId', $this->dictCategoryId, true);
        $criteria->compare('label', $this->label, true);
        $criteria->compare('abbreviate', $this->abbreviate, true);
        $criteria->compare('position', $this->position, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    private static $classLevelList = null;
    public static function getClassLevels() {
        if (empty(self::$classLevelList)) {
            $classLevels = self::model()->findAll(array('order' => 'position'));
            self::$classLevelList = CHtml::listData($classLevels, 'id', 'label');
        }
        return self::$classLevelList;
    }

    public static function getLabel($classLevelId) {
        $classLevel = self::model()->findByPk($classLevelId);
        return $classLevel->label;
    }
    
    private static $classLevel2Category = array();
    public static function getClassLevel2Category() {
        if (empty(self::$classLevel2Category)) {
            $classLevels = self::model()->findAll(array('order' => 'position'));
            foreach ($classLevels as $classLevel) {
                self::$classLevel2Category[$classLevel->id] = DictCategory::getCategoryLabel($classLevel->dictCategoryId);
            }
        }
        return self::$classLevel2Category;
    }
}
