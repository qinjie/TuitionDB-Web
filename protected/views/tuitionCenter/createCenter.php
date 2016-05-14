<?php
/* @var $this TuitionCenterController */
/* @var $model TuitionCenter */
/* @var $form TbActiveForm */
?>

<?php
$this->breadcrumbs = array(
    'Tuition Centers' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List TuitionCenter', 'url' => array('index')),
    array('label' => 'Manage TuitionCenter', 'url' => array('admin')),
);
?>

<h1>Create TuitionCenter</h1>


<div class="form">

    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'tuition-center-form',
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        'enableAjaxValidation' => false,
        'focus' => array($model, 'name'),
    )); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model, 'name', array('span' => 5, 'maxlength' => 200)); ?>

    <?php echo $this->widget(
        'yiiwheels.widgets.formhelpers.WhPhone',
        array(
            'name' => 'phone',
            'format' => 'dddd-dddd',
        )
    );?>

    <?php echo $form->textFieldControlGroup($model, 'phone', array('span' => 5, 'maxlength' => 20)); ?>

    <?php echo $form->textFieldControlGroup($model, 'fax', array('span' => 5, 'maxlength' => 20)); ?>

    <?php echo $form->textFieldControlGroup($model, 'email', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->textFieldControlGroup($model, 'website', array('span' => 5, 'maxlength' => 255)); ?>

    <?php echo $form->textFieldControlGroup($model, 'info', array('span' => 5, 'maxlength' => 1000)); ?>

    <!--                --><?php //echo $form->textFieldControlGroup($model,'created',array('span'=>5)); ?>
    <!---->
    <!--                --><?php //echo $form->textFieldControlGroup($model,'modified',array('span'=>5)); ?>

    <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_LARGE,
        )); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
