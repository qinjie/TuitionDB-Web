<?php
class ConfirmationForm extends CFormModel {

    public $confirm;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('confirm', 'required'),
            array('confirm', 'compare','compareValue' => 1, 'message'=>'You need to accept the terms and conditions.'),
        );
    }

    public function attributeLabels() {
        return array(
            'confirm' => 'I have read all the terms and conditions',
        );
    }

}
