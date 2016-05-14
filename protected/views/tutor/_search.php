<?php
/* @var $this TutorController */
/* @var $model Tutor */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>

    <?php echo $form->textFieldControlGroup($model, 'id', array('span' => 5, 'maxlength' => 10)); ?>

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
        <?php echo TbHtml::submitButton('Search', array('color' => TbHtml::BUTTON_COLOR_PRIMARY,)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->