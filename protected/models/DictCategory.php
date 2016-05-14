<?php

/**
 * This is the model class for table "dictCategory".
 *
 * The followings are the available columns in table 'dictCategory':
 * @property string $id
 * @property string $label
 * @property string $position
 */
class DictCategory extends CActiveRecord {

    public function tableName() {
        return 'dictcategory';
    }

    public function rules() {
        return array(
            array('label', 'length', 'max' => 50),
            array('position', 'length', 'max' => 5),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, label, position', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'dictsubjects' => array(self::HAS_MANY, 'DictSubject', 'dictCategoryId'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'label' => 'Label',
            'position' => 'Position',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('label', $this->label, true);
        $criteria->compare('position', $this->position, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    private static $categorieList = array();

    public static function getCategories() {
        if (empty(self::$categorieList)) {
            $categories = DictCategory::model()->findAll(array('order' => 'position'));
            foreach ($categories as $category) {
                self::$categorieList[$category->id] = $category->label;
            }
        }
        return self::$categorieList;
    }

    public static function getCategoryLabel($categoryId) {
        $category = DictCategory::model()->findByPk($categoryId);
        return $category->label;
    }

}
