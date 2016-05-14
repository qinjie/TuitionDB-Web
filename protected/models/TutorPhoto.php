<?php

/**
 * This is the model class for table "tutorPhoto".
 *
 * The followings are the available columns in table 'tutorPhoto':
 * @property string $id
 * @property string $tutorId
 * @property string $fileBinary
 * @property string $fileName
 * @property string $fileType
 * @property string $created
 * @property string $modified
 */
class TutorPhoto extends ActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tutorphoto';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tutorId', 'required'),
            array('tutorId, fileType', 'length', 'max' => 10),
            array('fileName', 'length', 'max' => 50),
            array('fileBinary', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, tutorId, fileBinary, fileName, fileType, created, modified', 'safe', 'on' => 'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'tutorId' => 'Tutor',
            'fileBinary' => 'File Binary',
            'fileName' => 'File Name',
            'fileType' => 'File Type',
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
        $criteria->compare('tutorId', $this->tutorId, true);
        $criteria->compare('fileBinary', $this->fileBinary, true);
        $criteria->compare('fileName', $this->fileName, true);
        $criteria->compare('fileType', $this->fileType, true);
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
     * @return TutorPhoto the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * 
     * @param string $uploadedFile CUploadedFile
     * return boolean
     */
    const MAX_X = 400;
    const MAX_Y = 514;
    public function processPhoto($uploadedFile, $cropParams) {
        if (!(is_array($cropParams) && isset($cropParams['x']) && isset($cropParams['y']) && isset($cropParams['x2']) && isset($cropParams['y2']))) {
            return false;
        }
        $cropX = (int)$cropParams['x'];
        $cropY = (int)$cropParams['y'];
        $cropX2 = (int)$cropParams['x2'];
        $cropY2 = (int)$cropParams['y2'];
        if ($cropX < 0 || $cropY < 0 || $cropX2 <= $cropX || $cropY2 <= $cropY) {
            return false;
        }
        
        $imageType = $uploadedFile->type;
        $tempSrc = $uploadedFile->tempName;
        switch (strtolower($imageType)) {
            case 'image/png':
                $createdImage = imagecreatefrompng($tempSrc);
                break;
            case 'image/gif':
                $createdImage = imagecreatefromgif($tempSrc);
                break;
            case 'image/jpeg':
            case 'image/pjpeg':
                $createdImage = imagecreatefromjpeg($tempSrc);
                break;
            default:
                return false;
        }
        list($curWidth, $curHeight) = getimagesize($tempSrc);
        
        if ($curWidth <= 0 || $curHeight <= 0) {
            return false;
        }
        while ($cropX2 > $curWidth || $cropY2 > $curHeight) {
            if ($cropX2 > $curWidth) {
                $cropX2 = $curWidth;
                $cropY2 = (int)($cropY + (float)($curWidth - $cropX) * self::MAX_Y / self::MAX_X);
            }
            if ($cropY2 > $curHeight) {
                $cropY2 = $curHeight;
                $cropX2 = (int)($cropX + (float)($curHeight - $cropY) * self::MAX_X / self::MAX_Y);
            }
        }
        
        $imageScale = min(array(self::MAX_X / ($cropX2 - $cropX), self::MAX_Y / ($cropY2 - $cropY)));
        if ($imageScale < 1) {
            $newHeight = self::MAX_Y;
            $newWidth  = self::MAX_X;
        } else {
            $newHeight = $cropY2 - $cropY;
            $newWidth  = $cropX2 - $cropX;
        }
        $newCanvas = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($newCanvas, $createdImage, 0, 0, $cropX, $cropY, $newWidth, $newHeight, $cropX2 - $cropX, $cropY2 - $cropY);
        $quality = 100;
        ob_start();
        imagejpeg($newCanvas, null, $quality);
        $resizedImage = ob_get_contents();
        ob_end_clean();
        if (is_resource($newCanvas)) {
            imagedestroy($newCanvas);
        }
        $this->fileBinary = $resizedImage;
        $this->fileName = $uploadedFile->name;
        $this->fileType = $uploadedFile->type;
        
        // Copy image file to /photo/tutor
        if (isset($this->tutorId)) {
            $newFileName = $this->tutorId . '.' . $uploadedFile->extensionName;
            $photoFolder = Yii::getPathOfAlias('webroot') . '/photo/tutor/';
            if (!file_exists($photoFolder) && !is_dir($photoFolder))
                mkdir($photoFolder, 0777, TRUE);
            if (file_exists($tempSrc) && is_writable($photoFolder)) {
                $ok = copy($tempSrc, $photoFolder . $newFileName);
            }
            $this->fileName = $this->tutorId . '.jpg';
        }
        return true;
    }

}
