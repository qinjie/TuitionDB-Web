<?php
/* @var $this TuitionCenterController */
/* @var $model User */
/* @var $form TbActiveForm */
?>
<div class="caption-band">
    <div class="inner-container">
        <div class="page-caption">Register as <span class="highlight">Tuition Centre</span></div>
        <p>Register with us and you can promote your tutorial classes.</p>
    </div>
</div>

<div class="form-container">
    
    <?php if ($model->hasErrors() || $center->hasErrors() || $centerStaff->hasErrors()):?>
        <div class="alert alert-error form-alert">
            <?php echo CHtml::errorSummary(array($centerStaff,$model,$center)); ?>
        </div>
    <?php endif;?>
    
    <div class="form-block" style="width: 760px">
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'user-form',
            'enableAjaxValidation' => false,
            'focus' => array($centerStaff, 'fullName'),
        ));

        echo $form->textFieldControlGroup($centerStaff, 'fullName', array('maxlength' => 255, 'groupOptions' => array('class' => 'mgr20'))); 
        echo $form->emailFieldControlGroup($model, 'username', array('maxlength' => 254)); 
        echo $form->passwordFieldControlGroup($model, 'password', array('maxlength' => 40, 'groupOptions' => array('class' => 'mgr20'))); 
        echo $form->passwordFieldControlGroup($model, 'repeat_password', array('maxlength' => 40)); 
        echo $form->textFieldControlGroup($center, 'name', array('maxlength'=>200, 'groupOptions' => array('class' => 'mgr20'))); 
        echo CHtml::submitButton('Submit', array(
            'class' => 'green-btn submit-btn',
            'style' => 'margin: 24px 0 0;',
        ));

        $this->endWidget(); 
        ?>
    </div>
</div>