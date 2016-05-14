<?php
/* @var $this LookupController */
/* @var $model Lookup */
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

    <?php echo $form->textFieldControlGroup($model, 'name', array('span' => 5, 'maxlength' => 50)); ?>

    <?php echo $form->textFieldControlGroup($model, 'code', array('span' => 5, 'maxlength' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'type', array('span' => 5, 'maxlength' => 20)); ?>

    <?php echo $form->textFieldControlGroup($model, 'position', array('span' => 5, 'maxlength' => 5)); ?>

    <div class="form-actions">
        <?php echo TbHtml::submitButton('Search', array('color' => TbHtml::BUTTON_COLOR_PRIMARY,)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->