<?php
/* @var $this Controller */
/* @var $schools array */
/* @var $tutorExamResults array */
/* @var $otherSkills array */
/* @var $openForms array */
Yii::app()->bootstrap->registerCoreScripts(null,  CClientScript::POS_HEAD);
?>
<style>
    input {
        width: 346px;
    }
</style>

<div class="item-name page-caption">Past and Current Education Information</div>

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'education-info-form',
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
    ));?>
    <br>
    <div class="item-name">University / Polytechnic</div>
    <?php
    $school = new TutorSchool;
    ?>
    <div class="school-form" style="margin-bottom: 15px">
        <?= $form->textFieldControlGroup($school, 'school', array('class'=>'input-school','autocomplete'=>'off')) ?>
        <div class="hint">(type and select your school)</div>

        <?= $form->textFieldControlGroup($school, 'course') ?>
        <div class="hint">(Faculty/Major/Minor)</div>

        <?= $form->textFieldControlGroup($school, 'achievement') ?>
        <div class="hint">(GPA, Awards, distinction subjects etc)</div>

        <a href="javascript:void(0)" class="btn button btn-add-school" id="btn-add-school">Add school</a>
    </div>
    
    <table id="table-tutor-school" class="table table-condensed" style="width: auto; <?= count($schools) == 0 ? 'display:none' : '' ?>">
        <tr>
            <th width="200">School</th>
            <th width="180">Course</th>
            <th width="200">Achievement</th>
            <th width="75"></th>
        </tr>
        <?php
        $lastSchool = 0;
        foreach ($schools as $school) {
            $lastSchool++;
            if ($school->isNewRecord) {
                $school->id = 'newRow'.$lastSchool;
            }
            $this->renderPartial('//user/registerAsTutor/partial/_row_tutor_school', array('school' => $school));
        }?>
    </table>
    <br>
    
    <div class="item-name">IB Results</div>
    <?php $this->renderPartial('//user/registerAsTutor/partial/_form_exam_result', array('form' => $form, 'examCode' => 2, 'tutorExamResults' => $tutorExamResults[2])); ?>
    <br>
    
    <div class="item-name">A Level Results</div>
    <?php $this->renderPartial('//user/registerAsTutor/partial/_form_exam_result', array('form' => $form, 'examCode' => 1, 'tutorExamResults' => $tutorExamResults[1])); ?>
    <br>
    
    <div class="item-name">O Level Results</div>
    <?php $this->renderPartial('//user/registerAsTutor/partial/_form_exam_result', array('form' => $form, 'examCode' => 0, 'tutorExamResults' => $tutorExamResults[0])); ?>
    <br>
    
    <div class="item-name">Others</div>
    <p class="hint">Music, language or other skills, please indicate your achievements.</p>
    <p class="hint">Example: graduate from special schools, certifications, past performances etc</p>
    <?php $this->renderPartial('//user/registerAsTutor/partial/_form_other_skill', array('form' => $form, 'otherSkills' => $otherSkills)); ?>

    <?= TbHtml::submitButton('Save changes', array(
        'class' => 'button submit-btn',
        'style' => 'margin: 40px 0 40px 200px',
    ));?>

    <?php $this->endWidget(); ?>


<script>
    $('.input-school').typeahead({'source':<?= CJSON::encode(DictSchool::getSchools())?>,'items':20, 'minLength':1});
    $('.exam-grade').typeahead({'source': <?= CJSON::encode(DictGrade::getGrades())?>,'items':20, 'minLength':1});
</script>