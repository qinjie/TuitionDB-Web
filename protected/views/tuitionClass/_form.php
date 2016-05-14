<?php
/* @var $this TuitionClassController */
/* @var $model TuitionClass */
/* @var $form TbActiveForm */
?>
<style>
    span.add-on {
        margin: 0.2em 0 0.5em;
    }
</style>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'tuition-class-form',
    'enableAjaxValidation' => false,
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
));
echo $form->errorSummary($model); 
echo $form->dropDownListControlGroup($model, 'dictClassLevelId', array('Choose Class Level') + DictClassLevel::getClassLevels(), array('id'=>'class-level-select')); 
echo $form->dropDownListControlGroup($model, 'dictSubjectId', array('Choose Subject'), array('id'=>'subject-select', 'disabled'=>'disabled')); 
echo $form->dropDownListControlGroup($model, 'weekday', Helper::getWeekdayArray()); 
?>

<div class="control-group <?=$model->hasErrors('startTime') ? 'error' : ''?>">
    <label for="TuitionClass_startTime" class="control-label required <?=$model->hasErrors('startTime') ? 'error' : ''?>">Start Time <span class="required">*</span></label>
    <div class="controls">
        <?php $this->widget(
            'yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
                'name' => 'TuitionClass[startTime]',
                'id' => 'TuitionClass_startTime',
                'format' => 'hh:mm:ss',
                'value' => $model->startTime,
                'pluginOptions' => array(
                    'pickDate' => false,
                ),
            )
        );?>
        <p class="help-block"><?=$form->error($model,'startTime');?></p>
    </div>
</div>

<div class="control-group <?=$model->hasErrors('endTime') ? 'error' : ''?>">
    <label for="TuitionClass_endTime" class="control-label required <?=$model->hasErrors('endTime') ? 'error' : ''?>">End Time <span class="required">*</span></label>
    <div class="controls">
        <?php $this->widget(
            'yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
                'name' => 'TuitionClass[endTime]',
                'id' => 'TuitionClass_endTime',
                'format' => 'hh:mm:ss',
                'value' => $model->endTime,
                'pluginOptions' => array(
                    'pickDate' => false,
                ),
            )
        );?>
        <p class="help-block"><?=$form->error($model,'endTime');?></p>
    </div>
</div>

<div class="control-group <?=$model->hasErrors('startDate') ? 'error' : ''?>">
    <label for="TuitionClass_startDate" class="control-label required <?=$model->hasErrors('startDate') ? 'error' : ''?>">Start Date</label>
    <div class="controls">
        <?php $this->widget(
            'yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
                'name' => 'TuitionClass[startDate]',
                'id' => 'TuitionClass_startDate',
                'format' => 'dd-MM-yyyy',
                'value' => Helper::convertDateForDisplay($model->startDate),
                'pluginOptions' => array(
                    'pickTime' => false,
                ),
            )
        );?>
        <p class="help-block"><?=$form->error($model,'startDate');?></p>
    </div>
</div>

<div class="control-group <?=$model->hasErrors('endDate') ? 'error' : ''?>">
    <label for="TuitionClass_endDate" class="control-label required <?=$model->hasErrors('endDate') ? 'error' : ''?>">End Date</label>
    <div class="controls">
        <?php $this->widget(
            'yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
                'name' => 'TuitionClass[endDate]',
                'id' => 'TuitionClass_endDate',
                'format' => 'dd-MM-yyyy',
                'value' => Helper::convertDateForDisplay($model->endDate),
                'pluginOptions' => array(
                    'pickTime' => false,
                ),
            )
        );?>
        <p class="help-block"><?=$form->error($model,'endDate');?></p>
    </div>
</div>

<?php 
echo $form->textFieldControlGroup($model, 'lessonCount', array('span' => 1, 'maxlength' => 10)); 
echo $form->textFieldControlGroup($model, 'classSize', array('span' => 1, 'maxlength' => 10)); 
echo $form->dropDownListControlGroup($model, 'status', Lookup::items(Lookup::TYPE_CLASS_STATUS), array('span' => 2)); 
?>

<?php
echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
    'class' => 'button submit-btn',
    'style' => 'margin-left: 180px;'
));
?>

<?php $this->endWidget(); ?>


<script>
    var subjectTree = <?=  CJSON::encode(DictSubject::getSubjectTree())?>;
    var classLevel2Category = <?=  CJSON::encode(DictClassLevel::getClassLevel2Category())?>;
    $('#class-level-select').change(function(){
        $('#subject-select').html('<option value="0">Choose Subject</option>');
        var classLevel = $(this).val();
        var category = classLevel2Category[classLevel];
        if (classLevel == 0) {
            $('#subject-select').prop('disabled',true);
        } else {
            $('#subject-select').prop('disabled',false);
        }
        for (var subjectId in subjectTree[category]) {
            if (subjectId != 'categoryId') {
                $('#subject-select').append('<option value="' + subjectId + '">' + subjectTree[category][subjectId] + '</option>');
            }
        }
    });
    $('#class-level-select').change();
    $('#subject-select').val(<?=$model->dictSubjectId?>);
</script>