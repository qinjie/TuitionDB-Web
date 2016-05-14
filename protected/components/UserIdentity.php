<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 * 
 * var @user User;
 * 
 */
class UserIdentity extends CUserIdentity {

    private $id;

    public function getId() {
        return $this->id;
    }

    public function authenticate() {
        $user = null;
        if ($this->isValidEmail($this->username)) {
            $user = User::model()->find('LOWER(username)=?', array(strtolower($this->username)));
        }

        if ($user === null) {
            $this->errorCode = CBaseUserIdentity::ERROR_UNKNOWN_IDENTITY;
        } elseif (!$user->validatePassword($this->password)) {
            $this->errorCode = CBaseUserIdentity::ERROR_PASSWORD_INVALID;
        } else {
            $this->id = $user->id;
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

}
