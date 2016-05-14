<?php
/* @var $this QuestionController */
/* @var $model Question */
?>

<?php
$this->breadcrumbs=array(
	'Questions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
array('label'=>'List Question', 'url'=>array('index')),
array('label'=>'Create Question', 'url'=>array('create')),
array('label'=>'View Question', 'url'=>array('view', 'id'=>$model->id)),
array('label'=>'Manage Question', 'url'=>array('admin')),
);
?>

<h1>Update Question <?php echo $model->id; ?></h1>

<?php //$this->renderPartial('_form', array('model'=>$model)); ?>

<div class="form">

    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'question-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    )); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model, 'question', array('span' => 5, 'maxlength' => 100)); ?>

    <?php echo $form->textFieldControlGroup($model, 'answer', array('span' => 5, 'maxlength' => 300)); ?>

    <?php echo $form->dropDownListControlGroup($model, 'type', Lookup::items(Lookup::TYPE_QUESTION_TYPE), array('span' => 5)); ?>

    <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_LARGE,
        )); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->