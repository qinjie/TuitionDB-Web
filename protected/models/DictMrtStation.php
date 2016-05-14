<?php

/**
 * This is the model class for table "dictmrtstation".
 *
 * The followings are the available columns in table 'dictmrtstation':
 * @property string $id
 * @property string $dictMrtLineId
 * @property string $label
 * @property string $code
 * @property string $position
 *
 * The followings are the available model relations:
 * @property Dictmrtline $dictMrtLine
 * @property Requestor[] $requestors
 * @property Tutorlocation[] $tutorlocations
 */
class DictMrtStation extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'dictmrtstation';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('dictMrtLineId, label, code', 'required'),
            array('dictMrtLineId', 'length', 'max' => 10),
            array('label', 'length', 'max' => 40),
            array('code', 'length', 'max' => 20),
            array('position', 'length', 'max' => 5),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, dictMrtLineId, label, code, position', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'mrtLine' => array(self::BELONGS_TO, 'DictMrtLine', 'dictMrtLineId'),
            'requestors' => array(self::HAS_MANY, 'Requestor', 'dictMrtStationId'),
            'tutorlocations' => array(self::HAS_MANY, 'TutorLocation', 'dictMrtStationId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'dictMrtLineId' => 'MRT Line',
            'label' => 'Label',
            'code' => 'Code',
            'position' => 'Position',
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
        $criteria->compare('dictMrtLineId', $this->dictMrtLineId, true);
        $criteria->compare('label', $this->label, true);
        $criteria->compare('code', $this->code, true);
        $criteria->compare('position', $this->position, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DictMrtStation the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    private static $stationTree = array();

    public static function getStationTree() {
        if (count(self::$stationTree) == 0) {
            $stations = self::model()->with('mrtLine')->findAll(array('order' => 'mrtLine.position, t.position'));
            foreach ($stations as $station) {
                if (!isset(self::$stationTree[$station->mrtLine->name])) {
                    self::$stationTree[$station->mrtLine->name] = array();
                }
                self::$stationTree[$station->mrtLine->name][$station->id] = $station->code . ' - ' . $station->label;
            }
        }
        return self::$stationTree;
    }

    public static function getStationLabel($id) {
        $mrtStation = self::model()->findByPk($id);
        if ($mrtStation) {
            return $mrtStation->fullLabel;
        }
        return null;
    }
    
    public function getFullLabel() {
        return  $this->code . ' - ' . $this->label;
    }
    
    public function __toString() {
        return $this->id;
    }
}
