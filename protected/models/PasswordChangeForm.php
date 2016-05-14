<?php

class PasswordChangeForm extends CFormModel {

    public $currentPassword;
    public $newPassword;
    public $newPassword_repeat;
    private $_user;

    public function rules() {
        return array(
            array('currentPassword', 'compareCurrentPassword'),
            array('currentPassword, newPassword, newPassword_repeat', 'required',),
            array('newPassword, newPassword_repeat', 'length', 'min' => 5, 'max' => 40),
            array(
                'newPassword_repeat', 'compare',
                'compareAttribute' => 'newPassword',
                'message' => 'New password must be repeated exactly',
            ),
        );
    }

    public function compareCurrentPassword($attribute, $params) {
        $user = $this->getUser(Yii::app()->user->id);
        if (!CPasswordHelper::verifyPassword($this->currentPassword, $user->password)) {
            $this->addError($attribute, 'Password is incorrect');
        }
    }

//    public function init() {
//        $this->_user = User::model()->findByAttributes(array('username' => Yii::app()->user->username));
//    }

    public function attributeLabels() {
        return array(
            'currentPassword' => 'Current Password',
            'newPassword' => 'New Password',
            'newPassword_repeat' => 'New Password (repeat)',
        );
    }

    public function changePassword() {
        $user = $this->getUser(Yii::app()->user->id);
        $user->password = $user->hashPassword($this->newPassword);
        if ($user->save(false))
            return true;
        return false;
    }
    
    public function getUser($id) {
        if (empty($this->_user)) {
            $user = User::model()->findByPk($id);
            $this->_user = $user;
        }
        return $this->_user;
    }

}
