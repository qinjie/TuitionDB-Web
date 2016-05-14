<?php
/* @var $this TuitionCenterStaffController */
/* @var $model TuitionCenterStaff */
/* @var $form TbActiveForm */

$this->breadcrumbs = array(
    $model->tuitionCenter->name => array($model->tuitionCenter->url),
    'Manage Staff' => array('myStaffs'),
    'Invite Staff',
);?>
<div class="inner-container">
    <div class="item-name page-caption">Invite Staff</div>

        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'tuition-center-staff-form',
            'enableAjaxValidation' => false, 
            'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        )); 
        echo $form->errorSummary(array($model,$user));
        ?>
        <p class="help-block" style="margin-bottom: 16px;">Register a new user account as staff for your center. 
        <br>The default password for new account is '12345'.</p>

        <?php  
        echo $form->hiddenField($model, 'tuitionCenterId', array('maxlength' => 10)); 
        echo $form->textFieldControlGroup($model, 'fullName', array('span' => 3, 'maxlength' => 255)); 
        echo $form->emailFieldControlGroup($user, 'username', array('span' => 3, 'maxlength' => 255)); 
        echo $form->textFieldControlGroup($model, 'mobilePhone', array('span' => 3, 'maxlength' => 20)); 
        echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
            'class' => 'button submit-btn',
            'style' => 'margin-left: 180px;'
        )); 
        ?>
        <?php $this->endWidget(); ?>
</div>