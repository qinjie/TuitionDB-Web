<?php
/* @var $this AssignmentController */
/* @var $assignment Assignment */
/* @var $subjects array */
/* @var $schedules array */
/* @var $skippable boolean */
//Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
Yii::app()->bootstrap->registerCoreScripts(null,  CClientScript::POS_HEAD);
?>
<style>
    #student-info-form .controls > select {
        vertical-align: top;
    }
</style>

<div class="inner-container">
    <div class="title">Create <span class="highlight">Assignment</span> - Step 1</div>
    <?php if ($skippable):?>
        <a href="<?=Yii::app()->getBaseUrl()?>" class="btn btn-primary">Skip</a>
    <?php endif;?>
    <div class="item-name">Student Information</div>

    
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'student-info',
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        'enableAjaxValidation' => false,
    ));
    
    if ($assignment->hasErrors()):?>
        <div class="alert alert-error form-alert">
            <?php echo CHtml::errorSummary(array($assignment)); ?>
        </div>
    <?php endif;
    
    $this->renderPartial('partial/_form_student_info',array(
        'form'=>$form,
        'assignment'=>$assignment,
        'subjects'=>$subjects,
        'schedules'=>$schedules,
    ));
    ?>

    <?php
    echo TbHtml::submitButton('Next', array(
        'class'=>'btn button',
        'style'=>'width: 140px; margin: 20px 0 40px 180px;'
    ));
    ?>

    <?php $this->endWidget(); ?>

</div>