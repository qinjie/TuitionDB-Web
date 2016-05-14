<?php
/* @var $this AssignmentController */
/* @var $assignment Assignment */
/* @var $form TbActiveForm */
?>
<div id="student-info-form">
<?php echo $form->dropdownListControlGroup($assignment, 'genderCode', Lookup::items('gender'), array('span' => 2)) ?>
<?php echo $form->dropdownListControlGroup($assignment, 'raceCode', Lookup::items('race'), array('span' => 2)) ?>
<?php echo $form->textFieldControlGroup($assignment, 'yearOfBirth', array('span' => 2, 'maxlength' => 10)); ?> 
<?php echo $form->textFieldControlGroup($assignment, 'currentSchool', array('maxlength' => 100,'autocomplete'=>'off','style'=>'width: 316px')); ?> 
<?php echo $form->dropdownListControlGroup($assignment, 'dictCategoryId', array(0 => 'Select Level') + DictCategory::getCategories(), array('span' => 2,'id'=>'level-select')) ?>
<div class="control-group <?= $assignment->hasErrors('subject') ? 'error' : '' ?>">
    <label for="subject-select" class="control-label required <?= $assignment->hasErrors('subject') ? 'error' : '' ?>" style="padding-top: 5px">
        Subjects <span class="required">*</span>
    </label>
    <div class="controls">
        <select id="subject-select" name="Subject[]" multiple="" style="width: 330px" disabled title="<?=$assignment->getError('subject')?>"></select>
    </div>
</div>
<div class="control-group <?= $assignment->hasErrors('schedule') ? 'error' : '' ?>">
    <label for="schedule-select" class="control-label required <?= $assignment->hasErrors('schedule') ? 'error' : '' ?>">Available Timeslots <span class="required">*</span></label>
    <div class="controls">
        <table class="table table-condensed" id="timeslot-select-group" style="width: 450px; position: relative;">
            <tr>
                <th style="width: 250px">
                    <?=CHtml::dropDownList('weekday-select-new', null,DictSchedule::getWeekdayList(),array(
                        'multiple'=>'multiple',
                        'style'=>'height: 130px; width: 220px;',
                    ))?>
                </th>
                <th style="width: 225px">
                    <?=CHtml::dropDownList('timeslot-select-new', null,DictSchedule::getTimeSlotList(),array(
                        'multiple'=>'multiple',
                        'style'=>'height: 60px; width: 225px;',
                    ))?>
                </th>
                <th><a href="javascript:void(0)" class="button" id="btn-add-slot-new" style="width: 70px">Add</a></th>
            </tr>
            <?php foreach ($schedules as $schedule):?>
                <?php $dictSchedule = DictSchedule::model()->findByPk($schedule->dictScheduleId) ?>
                <tr id="timeslot-row-<?=$schedule->dictScheduleId?>" class="item-row">
                    <td><?=$dictSchedule->weekday?></td>
                    <td><?=$dictSchedule->slot?><a onclick="removeTimeSlot(<?=$schedule->dictScheduleId?>)" class="btn-remove" href="javascript:void(0);"><span class="icon-remove"></span>Remove</a></td>
                    <input type="hidden" value="<?=$schedule->dictScheduleId?>" name="TimeSlot[]">
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>
</div>

<script>
    $(document).ajaxComplete(function() {
        $('#level-select').val(<?=$assignment->dictCategoryId?>).trigger('change');
        <?php
        $subjectArray = array();
        foreach ($subjects as $subject) {
            array_push($subjectArray, $subject->dictSubjectId."");
        }
        if (count($subjectArray) > 0) {
        ?>
        $("#subject-select").select2('enable');
        $("#subject-select").val(<?=CJSON::encode($subjectArray)?>).trigger("change");
        <?php
        }
        ?>
    });
</script>