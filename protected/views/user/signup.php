<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'User' => array('index'),
    'Registration',
);

$accountTypeString = Lookup::item(Lookup::TYPE_ACCOUNT_TYPE, $model->accountType);
?>

<h1>Registration <?php echo $accountTypeString == null ? '' : ' : ' . $accountTypeString ?> </h1>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'signup-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php //echo $form->errorSummary($model);  ?>

    <?php echo $form->textFieldControlGroup($model, 'username', array('span' => 2, 'maxlength' => 254)); ?>
    <?php echo $form->passwordFieldControlGroup($model, 'password', array('span' => 2, 'maxlength' => 40)); ?>
    <?php echo $form->passwordFieldControlGroup($model, 'repeat_password', array('span' => 2, 'maxlength' => 40)); ?>
    <div class="form-actions">
        <?php
        echo TbHtml::submitButton('Register', array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_LARGE,
        ));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->