<?php

/**
 * @property boolean $isAdmin
 * @property boolean $isTutor
 * @property boolean $isRequestor
 * @property boolean $isCenter
 * @property User $_user
 */
class WebUser extends CWebUser
{

    /**
     * @var User $user
     */
    private $_user = null;

//    public function getModel()
//    {
//        return Yii::app()->getSession()->get('user');
//    }

    public function login($identity, $duration)
    {
//        Yii::app()->getSession()->add('User', $this->user);
        parent::login($identity, $duration);
    }

    protected function afterLogin()
    {
        // update last login datetime
        $this->user->updateLastLogin();

        return true;
    }

    public function logout($destroySession = true)
    {
        // I always remove the session variable model.
//        Yii::app()->getSession()->remove('User');
        parent::logout($destroySession);
    }

//    public function setUser($user)
//    {
//        if ($user instanceof User) {
//            $this->_user = $user;
//        }
//    }

    public function getUser()
    {
        if ($this->isGuest)
            return null;
        if ($this->_user === null) {
            $this->_user = User::model()->findByPk($this->id);
        }
        return $this->_user;
    }

    public function getIsAdmin()
    {
        return ($this->user && $this->user->isAdmin);
    }

    public function getIsTutor()
    {
        return ($this->user && $this->user->isTutor);
    }

    public function getIsRequestor()
    {
        return ($this->user && $this->user->isRequestor);
    }

    public function getIsCenter()
    {
        return ($this->user && $this->user->isCenter);
    }

    public function getAccountType()
    {
        if ($this->user && $this->user->accountType) {
            return $this->user->accountType;
        } else
            return null;
    }

    public function getLastLogin()
    {
        if ($this->user && $this->user->lastLogin) {
            return $this->user->lastLogin;
        } else
            return null;
    }

    public function getIsVerified()
    {
        return ($this->user && $this->user->isVerified);
    }

    public function getProfile()
    {
        if ($this->user && $this->user->profile)
            return $this->user->profile;
        else
            return null;
    }

    public function getReturnUrl()
    {
        if ($this->user && $this->user->returnUrl)
            return $this->user->returnUrl;
        else
            return null;
    }
}
