<?php
/* @var $id int */
/* @var $form TbActiveForm */
/* @var $school TutorSchool */

?>
<div class="school-form">

    <?php echo $form->textFieldControlGroup($school, 'school', array(
        'id'=>'school_school',
        'class'=>'input-school',
        'autocomplete'=>'off',
        'onchange'=>'validateMaxLength(this,255)'
    )) ?>
    <span class="suggestion">(type and select your school)</span>

    <?= $form->textFieldControlGroup($school, 'course', array(
        'id'=>'school_course',
        'onchange'=>'validateMaxLength(this,255)'
    )) ?>
    <span class="suggestion">(Faculty/Major/Minor)</span>

    <?= $form->textFieldControlGroup($school, 'achievement', array(
        'id'=>'school_achievement',
        'onchange'=>'validateMaxLength(this,255)'
    )) ?>
    <span class="suggestion">(GPA, Awards, distinction subjects etc)</span>
    
    <a href="javascript:void(0)" class="btn button btn-add-school" id="btn-add-school">Add school</a>
    
</div>