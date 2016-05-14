<?php

/**
 * This is the model class for table "tuitioncenter".
 *
 * The followings are the available columns in table 'tuitioncenter':
 * @property string $id
 * @property string $name
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property string $website
 * @property string $info
 * @property string $nick
 * @property string $ownerId
 * @property string $verified
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property User $owner
 * @property TuitionBranch[] $branches
 * @property TuitionCenterLogo $logo
 * @property TuitionCenterPhoto[] $photos
 * @property TuitionCenterStaff[] $staffs
 */
class TuitionCenter extends ActiveRecord
{
    public function tableName()
    {
        return 'tuitioncenter';
    }

    public function rules()
    {
        return array(
            array('name,phone,email,nick', 'required'),
            array('name', 'length', 'max' => 200),
            array('phone, fax', 'length', 'max' => 20),
            array('email, website', 'length', 'max' => 255),
            array('info', 'length', 'max' => 1000),
            array('name, phone, fax, email, website, info, ownerId', 'safe'),
            array('website', 'unique', 'className' => 'TuitionCenter',
                'attributeName' => 'website', 'allowEmpty' => true,
                'message'=>'This website is already registered.'),
            array('nick', 'unique', 'className' => 'TuitionCenter',
                'attributeName' => 'nick', 'allowEmpty' => true,
                'message'=>'This url is already in use'),
            // The following rule is used by search().
            array('name, phone, fax, email, website, info, nick', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'branches' => array(self::HAS_MANY, 'TuitionBranch', 'tuitionCenterId'),
            'logo' => array(self::HAS_ONE, 'TuitionCenterLogo', 'tuitionCenterId'),
            'photos' => array(self::HAS_MANY, 'TuitionCenterPhoto', 'tuitionCenterId'),
            'staffs' => array(self::HAS_MANY, 'TuitionCenterStaff', 'tuitionCenterId'),
            'owner' => array(self::BELONGS_TO, 'User', 'ownerId'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Center Name',
            'phone' => 'Phone',
            'fax' => 'Fax',
            'email' => 'Email',
            'website' => 'Website',
            'info' => 'Additional Info',
            'nick' => 'Public Profile Url',
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
        $criteria = new CDbCriteria;

//		$criteria->compare('id',$this->id,true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('fax', $this->fax, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('website', $this->website, true);
        $criteria->compare('info', $this->info, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TuitionCenter the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function beforeSave()
    {
        if ($this->isNewRecord || $this->id === NULL) {
            if (!Yii::app()->params['sendActivationMail']) {
                $this->verified = 1;
            }
        }
        return parent::beforeSave();
    }

    public function isProfileCompleted()
    {
        return $this->validate();
    }

    public function getPublicUrl(){
        $base = Yii::app()->getBaseUrl(true);
        if($this->nick)
            $base = $base . '/center/public/' . $this->nick;
        else
            $base = $this->url;
        return $base;
    }

    public function getUrl()
    {
        $controller = get_class($this);
//        $controller[0] = strtolower($controller[0]);

        $params = array("id" => $this->id);
        // add the title parameter to the URL
        if ($this->hasAttribute('title'))
            $params['title'] = $this->title;
        if ($this->hasAttribute('name'))
            $params['name'] = $this->name;
        return Yii::app()->createAbsoluteUrl($controller . '/profile', $params);
    }
    
    // either admin or owner has rights on this record
    public function hasRights($userId = null)
    {
        if ($userId == null) {
            // get logon user
            $userId = Yii::app()->user->user->id;
        }
        $user = User::model()->findByPk($userId);
        // admin user always has rights
        if ($user->isAdmin) {
            return true;
        }
        //or any staff from the center has rights
        if(TuitionCenterStaff::model()->exists('tuitionCenterId=:centerId AND userId=:userId', array(':centerId'=>$this->id, ':userId'=>$userId))){
            return true;
        }
        return false;
    }
    
    public function getIdStr()
    {
        return str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }
    
    public function getLogoUrl() {
        return Yii::app()->getBaseUrl() . '/tuitionCenter/logo/' . $this->id;
    }
    
    public function getLogoFileUrl() {
        $url = null;
        if($this->logo && $this->logo->fileName) {
            $filename = $this->logo->fileName;
            $url = "/photo/center/$filename";
            if (!file_exists('.' . $url)){
                $url = null;
            }
        }
        if($url)
            return Yii::app()->getBaseUrl(true). $url;
        else
            return '';
    }

    public function getClasses() {
//        $classes = array();
//        foreach ($this->branches as $branch) {
//            foreach ($branch->classes as $class) {
//                array_push($classes, $class);
//            }
//        }
        $classesProvider = new CActiveDataProvider('TuitionClass', array(
            'criteria' => array(
                'condition' => 'tuitionbranch.tuitionCenterId = :centerId',
                'join' => 'JOIN tuitionbranch on t.tuitionBranchId = tuitionbranch.id',
                'params' => array(
                    ':centerId' => $this->id
                )
            )
        ));
        return $classesProvider->getData();
    }

    public function getLocationStr() {
        $locationStr = '';
        foreach ($this->branches as $branch) {
            if ($branch->address)
                $locationStr .= $branch->address . ', ';
        }
        return substr($locationStr, 0, strlen($locationStr) - 2);
    }
    
    public function getSubjectStr() {
        $subjectStr = '';
        foreach ($this->classes as $class) {
            $subjectStr .= DictSubject::getSubjectLabel($class->dictSubjectId) . ', ';
        }
        return substr($subjectStr, 0, strlen($subjectStr) - 2);
    }
    
    public function scopes()
    {
        $t = $this->getTableAlias(false);
        return array(
            'available' => array(
                'condition' => "verified = 1",
            ),
        );
    }
          
}
