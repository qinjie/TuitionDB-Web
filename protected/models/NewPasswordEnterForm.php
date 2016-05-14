<?php

/**
 * Description of NewPasswordEnterForm
 *
 * @author Ndnam
 */
class NewPasswordEnterForm  extends CFormModel {
    
    public $newPassword;
    public $newPassword_repeat;
    
    public function rules() {
        return array(
            array('newPassword, newPassword_repeat', 'required',),
            array('newPassword, newPassword_repeat', 'length', 'min' => 5, 'max' => 40),
            array(
                'newPassword_repeat', 'compare',
                'compareAttribute' => 'newPassword',
                'message' => 'New password must be repeated exactly',
            ),
        );
    }
    
    public function attributeLabels() {
        return array(
            'newPassword' => 'New Password',
            'newPassword_repeat' => 'New Password (repeat)',
        );
    }
}
