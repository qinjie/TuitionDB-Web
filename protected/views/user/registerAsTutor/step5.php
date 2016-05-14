<?php
/* @var $this SiteController */
/* @var $form TbActiveForm */
/* @var $tutorQualification TutorQualification */
$this->renderPartial('registerAsTutor/partial/_register_caption');
?>
<style>
    .form-block .control-group {
        margin-bottom: 15px;
    }
    .form-block .control-group .control-label {
        margin-top: 10px;
    }
</style>
<div class="form-container">
    
    <?php if ($tutorQualification->hasErrors()):?>
        <div class="alert alert-error form-alert" style="width: 700px;">
            <?php echo CHtml::errorSummary($tutorQualification); ?>
        </div>
    <?php endif;?>

    <div class="form-block" style="width: 730px">
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'tutor-qualification-form',
            'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
            'enableAjaxValidation' => false,
        ));?>
        <h4>Tutor Qualification</h4>
        <br>
        <?php
        echo $form->dropDownListControlGroup($tutorQualification, 'tutoringMode', Lookup::items('tutoringMode'));
        echo $form->dropDownListControlGroup($tutorQualification, 'dictTutorQualificationId', array(99 => 'Choose Qualification') + DictTutorQualification::getAllTutorQualifications());
        echo $form->dropDownListControlGroup($tutorQualification, 'dictTutorCredentialId', array(0 => 'No Formal Teaching Experience') + DictTutorCredential::getAllCredentials());
        ?>
        <div class="clear"></div>
        
        <h4>Experience / Teaching Style</h4>
        <p class="hint">You are encouraged to write a short description of yourself, teaching experience and teaching method.
            <br>Note: Parents use this input (to a large extend) to select tutors for their assignments.</p>
        <p class="hint">Example guidelines:</p>
        <ul class="hint">
            <li>Teaching experience (number of years, post teaching assignments).</li>
            <li>Total number of students that you have taught.</li>
            <li>Level and subjects that you have taught.</li>
            <li>The improvements that your students have made.</li>
            <li>Other achievements/experience (Dean's list, scholarship, public speaking etc).</li>
            <li>For music, computer and other skills, state any professional certificates, performances.</li>
        </ul>
        <div align="left">
            <textarea id="ta-experience-style" name="TutorQualification[experienceStyle]" style="width:690px" rows="8" 
                class="<?=$tutorQualification->hasErrors('experienceStyle') ? 'error':''?>"
                data-placement="right" data-original-title="<?=$tutorQualification->getError('experienceStyle')?>" 
                data-toggle="tooltip"><?= $tutorQualification->experienceStyle ?></textarea>
            <br>
            <div class="character-count-group pull-left hint">
                Max 500 characters. Character count: <span id="character-count"><?= strlen($tutorQualification->experienceStyle)?></span>
            </div>
        </div>
        <br>
        <?php
        echo CHtml::submitButton('Next', array(
            'class'=>'green-btn submit-btn',
            'style'=>'margin: 30px 0 0 345px; width: 360px;'
        ));?>

        <?php $this->endWidget(); ?>
    </div>
</div>
