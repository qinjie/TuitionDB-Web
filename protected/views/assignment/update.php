<?php
/* @var $this AssignmentController */
/* @var $assignment Assignment */

$this->breadcrumbs=array(
	'Assignments'=>array('requestor/myassignment'),
        CHtml::encode($assignment->idStr) => array('assignment/view', 'id'=>$assignment->id),
	'Update',
);

?>
<style>
    #assignment-form .controls > select {
        vertical-align: top;
    }
</style>

<div class="inner-container">
    <div class="item-name page-caption">Update Assignment <?php echo $assignment->id; ?></div>

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'=>'assignment-form',
            'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
            'enableAjaxValidation'=>false,
    )); ?>

    <div class="item-name">Student Information</div>
    <?php 
    $this->renderPartial('partial/_form_student_info',array(
        'form'=>$form,
        'assignment'=>$assignment,
        'subjects'=>$subjects,
        'schedules'=>$schedules,
    ));?>

    <div class="item-name">Tutor Preference</div>
    <?php 
    $this->renderPartial('partial/_form_tutor_pref',array(
        'form'=>$form,
        'assignment'=>$assignment
    ));
    ?>
    <div class="item-name">Tutoring Preference</div>
    <?php 
    $this->renderPartial('partial/_form_tutoring_pref',array(
        'form'=>$form,
        'assignment'=>$assignment
    ));
    ?>

    <?php
    echo CHtml::submitButton('Save', array(
        'class' => 'button submit-btn',
        'style' => 'margin-left: 180px; width: 100px'
    ));
    ?>

    <?php $this->endWidget(); ?>
    <div style="margin-bottom: 30px"></div>
</div>