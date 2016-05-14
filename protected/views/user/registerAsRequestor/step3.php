<?php
/* @var $this SiteController */
/* @var $assignment Assignment */
?>

<h1>Create Assignment - step 2</h1>
<br>
<h3>Tutor Preference</h3>
<br>
<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'tutor-preference-form',
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        'enableAjaxValidation' => false,
    ));
    ?>
    
    <?php echo $form->dropdownListControlGroup($assignment, 'tutorGenderCode', array(99=>'No Preference') + Lookup::items('gender'), array('span' => 2))?>
    <?php echo $form->dropdownListControlGroup($assignment, 'tutorRaceCode', array(99=>'No Preference') + Lookup::items('race'), array('span' => 2))?>
    <?php echo $form->dropdownListControlGroup($assignment, 'minQualificationId', array(99=>'No Preference') + Lookup::items('qualification'), array('span' => 2))?>
    <?php echo $form->dropdownListControlGroup($assignment, 'teachingCredential', array(99=>'No Preference',1=>'Prefer either trainee, current or ex school teacher'), array('span' => 2))?>
    
    <h3>Tutoring Preference</h3>
    <br>
    <?php echo $form->dropdownListControlGroup($assignment, 'lessonPerMonth', array('2'=>2,'4'=>4,'8'=>8,'12'=>12,'16'=>16,'20'=>20), array('span' => 1))?>
    <?php echo $form->dropdownListControlGroup($assignment, 'hourPerLesson', array('1'=>1,'1.5'=>1.5,'2'=>2,'2.5'=>2.5,'3'=>3,'4'=>4), array('span' => 1))?>
    <?php echo $form->textFieldControlGroup($assignment, 'budgetRate', array('span' => 1, 'maxlength' => 10)); ?> 
    <?php echo $form->textAreaControlGroup($assignment, 'remark', array('span' => 5, 'maxlength' => 500)); ?> 
    
    <div class="form-actions">
        <?php
        echo TbHtml::submitButton('Submit my request', array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_LARGE,
        ));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->