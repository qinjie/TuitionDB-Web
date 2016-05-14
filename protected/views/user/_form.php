<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'user-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php //echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model, 'username', array('span' => 2, 'maxlength' => 254)); ?>
    <?php echo $form->passwordFieldControlGroup($model, 'password', array('span' => 2, 'maxlength' => 40)); ?>
    <?php echo $form->passwordFieldControlGroup($model, 'repeat_password', array('span' => 2, 'maxlength' => 40)); ?>
    <?php echo $form->dropDownListControlGroup($model, 'accountType', Lookup::items(Lookup::TYPE_ACCOUNT_TYPE), array('empty' => '', 'span' => 3)); ?>
    <div class="form-actions">
        <?php
        echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_LARGE,
        ));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->