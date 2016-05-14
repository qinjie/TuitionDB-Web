<?php
/* @var $this TuitionCenterStaffController */
/* @var $model TuitionCenterStaff */
/* @var $form TbActiveForm */

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'tuition-center-staff-form',
    'enableAjaxValidation' => false,
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldControlGroup($model->tuitionCenter, 'name', array('span' => 5, 'maxlength' => 10, 'readonly' => true)); ?>

<?php echo $form->emailFieldControlGroup($model->user, 'username', array('span' => 3, 'maxlength' => 10, 'readonly' => true)); ?>

<?php echo $form->textFieldControlGroup($model, 'fullName', array('span' => 5, 'maxlength' => 255)); ?>

<?php // echo $form->emailFieldControlGroup($model, 'email', array('span' => 5, 'maxlength' => 255)); ?>

<?php echo $form->textFieldControlGroup($model, 'mobilePhone', array('span' => 5, 'maxlength' => 20)); ?>

<?php 
echo CHtml::submitButton('Save', array(
    'class' => 'submit-btn button',
    'style' => 'margin-left: 180px; width: 100px'
));?>

<?php $this->endWidget(); ?>