<?php

class PasswordResetForm extends CFormModel {

    public $email;
    public $verifyCode;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            // name, email, subject and body are required
            array('email', 'required'),
            // email has to be a valid email address
            array('email', 'email'),
            array('email', 'checkAvailableEmail'),
            // verifyCode needs to be entered correctly
            array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements()),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'email' => 'Email Address',
            'verifyCode' => 'Verification Code',
        );
    }

    public function checkAvailableEmail($attribute, $params) {
        if (User::model()->findByAttributes(array('username' => $this->$attribute)) == null) {
            $this->addError($attribute, 'This email is not registered.');
        }
    }

}
