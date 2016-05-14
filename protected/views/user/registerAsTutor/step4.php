<?php
/* @var $this SiteController */
/* @var $schools array */
/* @var $tutorExamResults array */
/* @var $otherSkills array */
/* @var $openForms array */
//Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
Yii::app()->bootstrap->registerCoreScripts(null,  CClientScript::POS_HEAD);
$this->renderPartial('registerAsTutor/partial/_register_caption');

?>
<style>
    .form-block textarea{
        height: 60px;
    }
</style>

<div class="form-container">
    
    <?php if (!$validate):?>
        <div class="alert alert-error form-alert" style="width: 700px;">
            <?php echo CHtml::errorSummary($schools + $otherSkills + call_user_func_array('array_merge', $tutorExamResults)); ?>
        </div>
    <?php endif;?>
    
    <div class="form-block" style="width: 730px">
        <h3>Past and Current Education Information</h3>
        <br>
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'education-info-form',
            'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
        ));
        
        $school = new TutorSchool;
        ?>
        <h4>University / Polytechnic</h4>
        <div class="hint">Fill the form and click Add school.</div>
        
        <div class="school-form" style="margin-bottom: 15px">
            <?php echo $form->textFieldControlGroup($school, 'school', array('class'=>'input-school','autocomplete'=>'off')) ?>
            <div class="hint">(type and select your school)</div>

            <?= $form->textFieldControlGroup($school, 'course') ?>
            <div class="hint">(Faculty/Major/Minor)</div>

            <?= $form->textFieldControlGroup($school, 'achievement') ?>
            <div class="hint">(GPA, Awards, distinction subjects etc)</div>

            <a href="javascript:void(0)" class="btn button btn-add-school" id="btn-add-school">Add school</a>
        </div>
        
        <table id="table-tutor-school" class="table table-condensed" style="<?=count($schools) == 0 ? 'display:none' : '' ?>; width: auto;">
            <tr>
                <th width="200">School</th>
                <th width="180">Course</th>
                <th width="200">Achievement</th>
                <th width="70"></th>
            </tr>
            <?php
            $lastSchool = 0;
            foreach ($schools as $school) {
                $lastSchool++;
                if ($school->isNewRecord) {
                    $school->id = 'newRow'.$lastSchool;
                }
                $this->renderPartial('registerAsTutor/partial/_row_tutor_school', array('school' => $school));
            }?>
        </table>
        <br>

        <h4>IB Results</h4>
        <?php $this->renderPartial('registerAsTutor/partial/_form_exam_result', array('form' => $form, 'examCode' => 2, 'tutorExamResults' => $tutorExamResults[2])); ?>
        <br>

        <h4>A Level Results</h4>
        <?php $this->renderPartial('registerAsTutor/partial/_form_exam_result', array('form' => $form, 'examCode' => 1, 'tutorExamResults' => $tutorExamResults[1])); ?>
        <br>

        <h4>O Level Results</h4>
        <?php $this->renderPartial('registerAsTutor/partial/_form_exam_result', array('form' => $form, 'examCode' => 0, 'tutorExamResults' => $tutorExamResults[0])); ?>
        <br>

        <h4>Others</h4>
        <div class="hint">Music, language or other skills, please indicate your achievements.</div>
        <div class="hint">Example: graduate from special schools, certifications, past performances etc.</div>
        <?php $this->renderPartial('registerAsTutor/partial/_form_other_skill', array('form' => $form, 'otherSkills' => $otherSkills)); ?>

        <?= CHtml::submitButton('Next', array(
            'class'=>'green-btn submit-btn',
            'style'=>'margin: 30px 0 0 380px; width: 312px;'
        ));?>

        <?php $this->endWidget(); ?>
    </div>
</div>

<script>
    $('.input-school').typeahead({'source':<?= CJSON::encode(DictSchool::getSchools())?>,'items':20, 'minLength':1});
    $('.exam-grade').typeahead({'source': <?= CJSON::encode(DictGrade::getGrades())?>,'items':20, 'minLength':1});
//    $('.submit-btn').click(function(event){
//        console.log('Submit clicked');
//        event.preventDefault();
//        var ok = true;
//        $('#TutorSchool_school, #TutorSchool_course, #TutorSchool_course, #other-skill-type, #other-skill-achievement').each(function(){
//            if ($(this).val().trim().length > 0)
//                ok = false;
//        });
//        if (ok) {
//            $('#education-info-form').submit();
//        } else {
//            if(confirm('There are still some text in the text fields. Are you sure you did not forget to click the Add buttons?')) {
//                $('#education-info-form').submit();
//            }
//        }
//    });
</script>
