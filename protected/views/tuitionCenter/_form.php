<?php
/* @var $this TuitionCenterController */
/* @var $model TuitionCenter */
/* @var $form TbActiveForm */
?>


<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'tuition-center-form',
    'enableAjaxValidation' => false,
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
)); 
echo $form->errorSummary($model); 
echo $form->textFieldControlGroup($model, 'name', array('span' => 5, 'maxlength' => 200)); 
echo $form->textFieldControlGroup($model, 'phone', array('span' => 5, 'maxlength' => 20)); 
echo $form->textFieldControlGroup($model, 'fax', array('span' => 5, 'maxlength' => 20)); 
echo $form->emailFieldControlGroup($model, 'email', array('span' => 5, 'maxlength' => 255)); 
echo $form->urlFieldControlGroup($model, 'website', array('span' => 5, 'maxlength' => 255)); 
echo $form->textAreaControlGroup($model, 'info', array('span' => 5, 'rows' => 5, 'maxlength' => 1000)); 
?>
<div class="control-group">
    <div class="control-label">
        <?php echo $form->labelEx($model, 'nick'); ?>
    </div>
    <div class="controls">
        http://www.tuitiondb.com/center/public/
        <?php echo $form->textField($model, 'nick', array('span' => 1, 'maxlength' => 20)); ?>
    </div>
</div>

<?php 
echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
    'class' => 'submit-btn button',
    'style' => 'margin-left: 180px; width: 100px'
));?>

<?php $this->endWidget(); ?>
