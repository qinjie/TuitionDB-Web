<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $sessionToken
 * @property string $accountType
 * @property string $isVerified
 * @property string $lastLogin
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property Tutor[] $tutors
 */
class User extends ActiveRecord
{

    const TYPE_ADMIN = 0;
    const TYPE_TUTOR = 1;
    const TYPE_REQUESTOR = 2;
    const TYPE_CENTER = 3;

    // holds the password confirmation word
    public $repeat_password;

    private $_profile;
    private $_returnUrl;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username', 'filter', 'filter' => 'trim'),
            array('username, password', 'required'),
            array('username', 'length', 'max' => 254),
            array('username', 'email'),
            array('repeat_password', 'required', 'on' => 'insert'),
            array('password, repeat_password', 'length', 'min' => 5, 'max' => 40, 'on' => 'insert'),
//            array('lastLogin, created', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('username, accountType', 'safe', 'on' => 'search'),
            array('repeat_password', 'compare', 'compareAttribute' => 'password', 'on' => 'insert'),
            array('username', 'checkAvailableUsername', 'on' => 'insert'),
            array('username', 'unique', 'className'=>'User', 'attributeName'=>'username', 'message'=>'This email is already registered'),
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
            'tutor' => array(self::HAS_ONE, 'Tutor', 'userId'),
            'requestor' => array(self::HAS_ONE, 'Requestor', 'userId'),
            'tuitioncenterstaff' => array(self::HAS_ONE, 'TuitionCenterStaff', 'userId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'username' => 'Email Address',
            'password' => 'Password',
            'sessionToken' => 'Session Token',
            'accountType' => 'Account Type',
            'isVerified' => 'Verified',
            'lastLogin' => 'Last Login',
            'created' => 'Created',
            'modified' => 'Modified',
            'accountTypeString' => 'Account Type',
            'repeat_password' => 'Confirm Password',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('accountType', $this->accountType, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'accountTypeString' => array(),
                ),
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Checks if the given password is correct.
     * @param string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password)
    {
        return CPasswordHelper::verifyPassword($password, $this->password);
    }

    /**
     * Generates the password hash.
     * @param string password
     * @return string hash
     */
    public function hashPassword($password)
    {
        return CPasswordHelper::hashPassword($password);
    }

    public function checkAvailableEmail($attribute, $params)
    {
        if (!$this->isNewRecord) {
            if (User::model()->findByAttributes(array('email' => $this->$attribute)) != null) {
                $url = Yii::app()->createAbsoluteUrl('site/login', array('username' => $this->$attribute));
                $this->addError($attribute, 'This email is already registered. <a href="' . $url . '">Login with this email.</a>');
            }
        }
    }

    public function checkAvailableUsername($attribute, $params)
    {
        if ($this->isNewRecord) {
            if (User::model()->findByAttributes(array('username' => $this->$attribute)) != null) {
                //$this->addError($attribute, 'Username not available. Consider another one.');
                $url = Yii::app()->createAbsoluteUrl('site/login', array('username' => $this->$attribute));
                $this->addError($attribute, 'This email is already registered. <a class="underline" href="' . $url . '">Login with this email.</a>');
            }
        }
    }

    /**
     * @return string the URL that shows the detail of the post
     */
    public function getUrl()
    {
        return Yii::app()->createUrl('user/view', array(
            'id' => $this->id,
            'title' => $this->username . ' : ' . Lookup::item(Lookup::TYPE_ACCOUNT_TYPE, $this->accountType),
        ));
    }
    
    public function getProfilePageUrl() {
        if ($this->isTutor) {
            return Yii::app()->createUrl('tutor/profile');
        }
        if ($this->isRequestor) {
            return Yii::app()->createUrl('requestor/profile');
        }
        if ($this->isCenter) {
            return Yii::app()->createUrl('tuitionCenterStaff/view');
        }
        return null;
    }

    public function updateLastLogin()
    {
        $this->lastLogin = date('Y-m-d H:i:s');
        $this->save(false, array('lastLogin'));
    }

    public function beforeSave()
    {
        if ($this->isNewRecord || $this->id === NULL) {
            $this->password = $this->hashPassword($this->password);
            if (Yii::app()->params['sendActivationMail'] === false) {
                $this->isVerified = 1;
            } else {
                $this->isVerified = 0;
            }
            $this->sessionToken = session_id();
        }
        return parent::beforeSave();
    }

    public function getIsTutor()
    {
        return $this->accountType == User::TYPE_TUTOR;
    }

    public function getIsAdmin()
    {
        return ($this->accountType == User::TYPE_ADMIN);
    }

    public function getIsCenter()
    {
        return ($this->accountType == User::TYPE_CENTER);
    }

    public function getIsRequestor()
    {
        return $this->accountType == User::TYPE_REQUESTOR;
    }

    public function sendVerificationMail()
    {
        $message = new YiiMailMessage;
        $message->setFrom(Yii::app()->params['adminEmail']);
        $message->setSubject('Welcome to TuitionDB');
        $message->addTo($this->username);
        if (isset(Yii::app()->controller))
            $controller = Yii::app()->controller;
        else
            $controller = new CController('YiiMail');
        // Render the verification email view
        $viewPath = Yii::getPathOfAlias(Yii::app()->mail->viewPath . '.verify') . '.php';
        $body = $controller->renderInternal($viewPath, array('user' => $this), true);
        $message->setBody($body, 'text/html', null);

        $result = 0;
        try {
            $result = Yii::app()->mail->send($message);
        } catch (Exception $e) {
            Yii::log($e->getMessage(), 'error', 'emailing');
            $result = 0;
        }

        return $result;
    }

    public static function sendPasswordResetMail($email)
    {
        $user = self::model()->findByAttributes(array('username' => $email));
        $message = new YiiMailMessage;
        $message->setFrom(Yii::app()->params['adminEmail']);
        $message->setSubject('Password Reset for TuitionDB');
        $message->addTo($email);
        if (isset(Yii::app()->controller))
            $controller = Yii::app()->controller;
        else
            $controller = new CController('YiiMail');
        // Render the verification email view
        $viewPath = Yii::getPathOfAlias(Yii::app()->mail->viewPath . '.resetPass') . '.php';
        $body = $controller->renderInternal($viewPath, array('user' => $user), true);
        $message->setBody($body, 'text/html', null);
        return Yii::app()->mail->send($message);
    }

    public function getFullName()
    {
        if ($this->profile)
            return $this->profile->fullName;
        else
            return $this->username;
    }

    public function setReturnUrl()
    {
        return $this->_returnUrl;
    }

    public function getReturnUrl()
    {
        if ($this->_returnUrl == null) {
            if ($this->isTutor) {
                $this->_returnUrl = array('tutor/myassignment');
            } elseif ($this->isCenter) {
                if ($this->isVerified) {
                    $this->_returnUrl = array('tuitionCenter/profile');
                } else {
                    $this->_returnUrl = array('tuitionCenterStaff/view');
                }
            } elseif ($this->isRequestor) {
                $this->_returnUrl = array('requestor/myassignment');
            } elseif ($this->isAdmin) {
                $this->_returnUrl = array('assignment/admin');
            } else {
                $$this->_returnUrl = array('site/index');
            }
        }

        return $this->_returnUrl;
    }

    public function getProfile()
    {
        if ($this->_profile == null) {
            if ($this->isCenter && $this->tuitioncenterstaff) {
                $this->_profile = $this->tuitioncenterstaff;
            }
            if ($this->isTutor && $this->tutor) {
                $this->_profile = $this->tutor;
            }
            if ($this->isRequestor && $this->requestor) {
                $this->_profile = $this->requestor;
            }
        }

        return $this->_profile;
    }
}
