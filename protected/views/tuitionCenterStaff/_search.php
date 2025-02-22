<?php
/* @var $this TuitionCenterStaffController */
/* @var $model TuitionCenterStaff */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    <?php echo $form->textFieldControlGroup($model, 'tuitionCenterId', array('span' => 5, 'maxlength' => 10)); ?>

    <?php echo $form->textFieldControlGroup($model, 'userId', array('span' => 5, 'maxlength' => 10)); ?>

    <?php echo $form->textFieldControlGroup($model, 'fullName', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->textFieldControlGroup($model, 'email', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->textFieldControlGroup($model, 'mobilePhone', array('span' => 5, 'maxlength' => 20)); ?>

    <div class="form-actions">
        <?php echo TbHtml::submitButton('Search', array('color' => TbHtml::BUTTON_COLOR_PRIMARY,)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->