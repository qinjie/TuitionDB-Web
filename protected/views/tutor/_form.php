<?php
/* @var $this TutorController */
/* @var $model Tutor */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'tutor-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model, 'userId', array('span' => 5, 'maxlength' => 10)); ?>
    <?php echo $form->textFieldControlGroup($model, 'fullName', array('span' => 5, 'maxlength' => 255)); ?>
    <?php echo $form->textFieldControlGroup($model, 'genderCode', array('span' => 5, 'maxlength' => 5)); ?>
    <?php echo $form->textFieldControlGroup($model, 'yearOfBirth', array('span' => 5, 'maxlength' => 10)); ?>
    <?php echo $form->textFieldControlGroup($model, 'raceCode', array('span' => 5, 'maxlength' => 5)); ?>
    <?php echo $form->textFieldControlGroup($model, 'nationality', array('span' => 5, 'maxlength' => 100)); ?>
    <?php echo $form->textFieldControlGroup($model, 'passport', array('span' => 5, 'maxlength' => 20)); ?>
    <?php echo $form->textFieldControlGroup($model, 'email', array('span' => 5, 'maxlength' => 255)); ?>
    <?php echo $form->textFieldControlGroup($model, 'mobilePhone', array('span' => 5, 'maxlength' => 20)); ?>
    <?php echo $form->textFieldControlGroup($model, 'homeTel', array('span' => 5, 'maxlength' => 20)); ?>
    <?php echo $form->textFieldControlGroup($model, 'homeAddress', array('span' => 5, 'maxlength' => 255)); ?>
    <?php echo $form->textFieldControlGroup($model, 'homePostal', array('span' => 5, 'maxlength' => 10)); ?>
    <?php echo $form->textFieldControlGroup($model, 'created', array('span' => 5)); ?>
    <?php echo $form->textFieldControlGroup($model, 'modified', array('span' => 5)); ?>

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