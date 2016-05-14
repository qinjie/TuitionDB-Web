<?php
/* @var $this UserController */
/* @var $model User */
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

    <?php echo $form->textFieldControlGroup($model, 'username', array('span' => 5, 'maxlength' => 254)); ?>

    <?php echo $form->textFieldControlGroup($model, 'sessionToken', array('span' => 5, 'maxlength' => 40)); ?>

    <?php echo $form->textFieldControlGroup($model, 'accountType', array('span' => 5, 'maxlength' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'isVerified', array('span' => 5, 'maxlength' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'lastLogin', array('span' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'created', array('span' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'modified', array('span' => 5)); ?>

    <div class="form-actions">
        <?php echo TbHtml::submitButton('Search', array('color' => TbHtml::BUTTON_COLOR_PRIMARY,)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->