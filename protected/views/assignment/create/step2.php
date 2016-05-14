<?php
/* @var $this AssignmentController */
/* @var $assignment Assignment */
?>

<div class="inner-container">
    <div class="title">Create <span class="highlight">Assignment</span> - Step 2</div>
    <div class="item-name">Tutor Preference</div>
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'tutor-preference-form',
            'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
            'enableAjaxValidation' => false,
        ));
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
        
        echo TbHtml::submitButton('Submit my request', array(
            'class'=>'submit-btn button',
            'style'=>'width: 200px; margin: 20px 0 40px 180px;'
        ));
        
        $this->endWidget(); ?>

</div>