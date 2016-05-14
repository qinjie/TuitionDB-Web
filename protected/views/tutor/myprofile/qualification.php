<?php
/* @var $this TutorController */
/* @var $form TbActiveForm */
/* @var $tutorQualification TutorQualification */
?>

<div class="item-name page-caption">Tutor Qualification</div>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'tutor-qualification-form',
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    'enableAjaxValidation' => false,
));
echo $form->dropDownListControlGroup($tutorQualification, 'tutoringMode', Lookup::items('tutoringMode'));
echo $form->dropDownListControlGroup($tutorQualification, 'dictTutorQualificationId', array(0 => 'Choose Qualification') + DictTutorQualification::getAllTutorQualifications());
echo $form->dropDownListControlGroup($tutorQualification, 'dictTutorCredentialId', array(0 => 'No Formal Teaching Experience') + DictTutorCredential::getAllCredentials());
?>

<br>
<div class="item-name">Experience / Teaching Style</div>
<p class="hint">You are encouraged to write a short description of yourself, teaching experience and teaching method.<br><b>Note:</b> Parents use this input (to a large extend) to select tutors for their assignments.</p>
<p class="hint">Example guidelines:</p>
<ul class="hint">
    <li>Teaching experience (number of years, post teaching assignments).</li>
    <li>Total number of students that you have taught.</li>
    <li>Level and subjects that you have taught.</li>
    <li>The improvements that your students have made.</li>
    <li>Other achievements/experience (Dean's list, scholarship, public speaking etc).</li>
    <li>For music, computer and other skills, state any professional certificates, performances.</li>
</ul>

<textarea id="ta-experience-style" name="TutorQualification[experienceStyle]" style="width: 70%; min-height: 100px; "><?= $tutorQualification->experienceStyle ?></textarea>
<?= $form->error($tutorQualification, 'experienceStyle', array('class' => 'error')) ?>
<div class="character-count-group" style="margin-left: 486px">
    Max 1000 characters. Character count: <span id="character-count"><?=strlen($tutorQualification->experienceStyle)?></span>
</div>

<?php
echo TbHtml::submitButton('Save changes', array(
    'class' => 'button submit-btn',
    'style' => 'margin: 40px 0 40px 0px',
));
?>

<?php $this->endWidget(); ?>

