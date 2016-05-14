<?php
/* @var $this AssignmentController */
/* @var $tutor Tutor */
/* @var $assignment Assignment */
/* @var $assignmentReview AssignmentReview */

?>

<div class="inner-container">
    <h3>Review <?=CHtml::link($tutor->fullName,array('tutor/view','id'=>$tutor->id))?> for assignment <?=CHtml::link($assignment->title,array('assignment/view','id'=>$assignment->id))?></h3>
    <div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'tutor-review-form',
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        'enableAjaxValidation' => false,
    ));
    echo $form->dropdownListControlGroup($assignmentReview,'tutorRating',range(0,10),array('span'=>1));
    echo $form->textAreaControlGroup($assignmentReview,'comment',array('span'=>4));
    ?>
        <div class="form-actions">
            <?php
            echo TbHtml::submitButton('Submit', array(
                'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            ));
            ?>
        </div>    
    <?php
    $this->endWidget();
    ?>
    </div>
</div>




