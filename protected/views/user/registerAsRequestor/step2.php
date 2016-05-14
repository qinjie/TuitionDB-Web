<?php
/* @var $this SiteController */
/* @var $assignment Assignment */
/* @var $subjects array */
/* @var $schedules array */
//Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
Yii::app()->bootstrap->registerCoreScripts(null,  CClientScript::POS_HEAD);
?>

<h1>Create Assignment - step1</h1>
<br>
<a href="<?=Yii::app()->getBaseUrl()?>" class="btn btn-primary">Skip</a>
<h3>Student Information</h3>
<br>
<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'student-info-form',
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php echo $form->dropdownListControlGroup($assignment, 'genderCode', Lookup::items('gender'), array('span' => 2)) ?>
    <?php echo $form->dropdownListControlGroup($assignment, 'raceCode', Lookup::items('race'), array('span' => 2)) ?>
    <?php echo $form->textFieldControlGroup($assignment, 'yearOfBirth', array('span' => 2, 'maxlength' => 10)); ?> 
    <?php echo $form->textFieldControlGroup($assignment, 'currentSchool', array('span' => 3, 'maxlength' => 100,'autocomplete'=>'off')); ?> 
    <?php echo $form->dropdownListControlGroup($assignment, 'dictCategoryId', array(0 => 'Select Level') + DictCategory::getCategories(), array('span' => 2)) ?>
    <div class="control-group <?= $assignment->hasErrors('subject') ? 'error' : '' ?>">
        <label for="subject-select" class="control-label required <?= $assignment->hasErrors('subject') ? 'error' : '' ?>">Subjects <span class="required">*</span></label>
        <div class="controls">
            <select id="subject-select" name="subject-select" class="span2">
                <option>Choose Subject</option>
            </select>
            <a href="javascript:void(0)" class="btn" id="btn-add-subject">Add</a>
            <?= $form->error($assignment,'subject',array('class'=>$assignment->hasErrors('subject')?'error':''))?>
            <table class="table table-condensed table-striped table-hover" id="table-subjects" style="width:400px">
                <?php foreach ($subjects as $subject):?>
                    <tr catid="1" id="subject-row-<?=$subject->dictSubjectId?>" class="subject-row">
                        <td><?=$subject->dictSubject->subject?></td>
                        <td><a onclick="removeSubject(<?=$subject->dictSubjectId?>)" class="btn-remove-subject" href="javascript:void(0);">Remove</a></td>
                        <input type="hidden" value="<?=$subject->dictSubjectId?>" name="Subject[]">
                    </tr>
                <?php endforeach;?>
            </table>
        </div>
    </div>
    <div class="control-group <?= $assignment->hasErrors('schedule') ? 'error' : '' ?>">
        <label for="schedule-select" class="control-label required <?= $assignment->hasErrors('schedule') ? 'error' : '' ?>">Available Timeslots <span class="required">*</span></label>
        <div class="controls">
            <select id="weekday-select" name="weekday-select" class="span2">
                <option>Choose week day</option>
            </select>
            <select id="timeslot-select" name="timeslot-select" class="span2">
                <option>Choose slot</option>
            </select>
            <a href="javascript:void(0)" class="btn" id="btn-add-slot">Add</a>
            <?= $form->error($assignment,'schedule',array('class'=>$assignment->hasErrors('schedule')?'error':''))?>
            <table class="table table-condensed table-striped table-hover" id="table-slots" style="width:400px">
                <?php foreach ($schedules as $schedule):?>
                    <?php $dictSchedule = DictSchedule::model()->findByPk($schedule->dictScheduleId) ?>
                    <tr id="timeslot-row-<?=$schedule->dictScheduleId?>" class="timeslot-row">
                        <td><?=$dictSchedule->weekday?></td>
                        <td><?=$dictSchedule->slot?></td>
                        <td><a onclick="removeTimeSlot(<?=$schedule->dictScheduleId?>)" class="btn-remove-timeslot" href="javascript:void(0);">Remove</a></td>
                        <input type="hidden" value="<?=$schedule->dictScheduleId?>" name="Schedule[]">
                    </tr>
                <?php endforeach;?>
            </table>
        </div>
    </div>
    <div class="form-actions">
        <?php
        echo TbHtml::submitButton('Next', array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_LARGE,
        ));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<script>
var subjects = <?= CJSON::encode(DictSubject::getSubjectTree()) ?>;

function removeSubject(subjectId){
    $('#subject-row-' + subjectId).detach();
}
function removeTimeSlot(slotId){
    $('#timeslot-row-' + slotId).detach();
}
function populateSubjectSelect($catSelect) {
    var category = $catSelect.children('option:selected').text();
        for (var subjectId in subjects[category]) {
            if (subjectId != 'categoryId') {
                $('#subject-select').append('<option value="' + subjectId + '">' + subjects[category][subjectId] + '</option>');
            }
        }
}
$(document).ready(function(){
    populateSubjectSelect($('#Assignment_dictCategoryId'));
    $('#Assignment_dictCategoryId').change(function(){
        $('#subject-select').html('<option value="0">Choose Subject</option>');
        populateSubjectSelect($(this));
        $('#table-subjects').html('');
    });
    $('#btn-add-subject').click(function(){
        var category = $('#Assignment_dictCategoryId').children('option:selected').text();; // get category name
        var subjectId = $('#subject-select').val();
        if (subjectId != 0) {
            // Check if this subject is already added
            if ($('#subject-row-' + subjectId).length == 0) { 
                $('table#table-subjects').append(
                        '<tr class="subject-row"  id="subject-row-' + subjectId + '" catId="' + subjects[category].categoryId +'">'
                        + '<td>' + $('#subject-select option[value="' + subjectId + '"]').text() + '</td>'
                        + '<td><a href="javascript:void(0);" class="btn-remove-subject" onclick=removeSubject(' + subjectId + ')>Remove</a></td>'
                        + '<input type="hidden" name="Subject[]" value="' + subjectId + '">'
                     + '</tr>');
            }
        }
    });
    
    // For time slot select
    var slots = <?=CJSON::encode(DictSchedule::getScheduleTree())?>;
    for (var weekday in slots) {
        $('#weekday-select').append('<option value="' + weekday + '">' + weekday + '</option>');
    }
    function removeTimeSlot(slotId) {
        $('#timeslot-row-' + slotId).detach();
    }

    $('#weekday-select').change(function() {
        $('#timeslot-select').html('<option value="0">Choose Slot</option>');
        var weekday = $(this).val();
        for (var slotId in slots[weekday]) {
            $('#timeslot-select').append('<option value="' + slotId + '">' + slots[weekday][slotId] + '</option>');
        }
    });
    $('#btn-add-slot').click(function() {
        var weekday = $('#weekday-select').val();
        var slotId = $('#timeslot-select').val();
        if (slotId != 0) {
            // Check if this slot is already added
            if ($('#timeslot-row-' + slotId).length == 0) {
                $('table#table-slots').append(
                        '<tr class="timeslot-row"  id="timeslot-row-' + slotId + '">'
                        + '<td>' + weekday + '</td>'
                        + '<td>' + $('#timeslot-select option[value="' + slotId + '"]').text() + '</td>'
                        + '<td><a href="javascript:void(0);" class="btn-remove-timeslot" onclick=removeTimeSlot(' + slotId + ')>Remove</a></td>'
                        + '<input type="hidden" name="Schedule[]" value="' + slotId + '">'
                        + '</tr>');
            }
        }
    });
    
    // Current School auto complete
    var schoolList = <?= CJSON::encode(DictSchool::getSchools())?>;
//    $('#Assignment_currentSchool').autocomplete({
//        source: schoolList,
//        messages: null,
//    });
    $('#Assignment_currentSchool').typeahead({'source':schoolList,'items':20, 'minLength':1});
});


</script>
