<?php
/* @var $this TutorController */
/* @var $subjects array */
/* @var $hrates array */
/* @var $subjectError string */
/* @var $mrtMessage string */
/* @var $timeslotMessage string */
/* @var $tutorLocations array */
/* @var $schedules array */
$errors = array();
if (count($subjects) == 0) {
    $errors['subject'] = 'You need to add at least one subject';
}
if (count($tutorLocations) == 0) {
    $errors['location'] = 'You need to add at least one MRT station';
}
if (count($schedules) == 0)  {
    $errors['schedule'] = 'You need to add at least one time slot';
}
?>
<div class="item-name page-caption">Tutoring Information</div>

<?php 
if (count($errors) > 0){
    $message = '';
    foreach($errors as $error) {
        $message .= $error . '<br>';
    }
    $message = substr($message, 0, strlen($message) - 4);
    echo '<div class="alert alert-error" style="width: 515px">' . $message . '</div>';
}

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'tutoring-form',
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    'enableAjaxValidation' => false,
));
?>
<div class="item-name">Subjects</div>
<table class="table table-condensed" id="subject-select-group" style="width:580px">
    <tr class="table-header">
        <th style="width: 250px;">Category</th>
        <th style="width: 300px;">Subject</th>
    </tr>
    <tr class="input-controls">
        <td>
            <select id="category-select" name="subject-category" style="width: 100%;">
                <option value="0">Choose category</option>
            </select>
        </td>
        <td>
            <select id="subject-select" name="subject" style="width: 100%;" disabled>
                <option value="0">Choose subject</option>
            </select>
        </td>
        <td></td>
    </tr>
    <?php
    foreach ($subjects as $subject) {
        $this->renderPartial('//user/registerAsTutor/partial/_row_tutor_subject', array('subject' => $subject));
    }?>
</table>
<p id="subject-message" style="color:#b94a48"><?= count($subjects) == 0 ? 'You need to add at least one subject' : ''?></p>

<br>
<div class="item-name">Hourly rates</div>
<p class="hint">If you leave the hourly rate blank, it's negotiable.</p>
<?php
$categories = DictCategory::getCategories();
?>
<table class="table table-condensed" id="table-hourly-rate" style="width:auto">
    <tr></tr>
    <tr>
        <th>Category</th>
        <th>Hourly rate</th>
    </tr>
    <?php
    foreach ($hourlyRates as $hrate) {
        $this->renderPartial('//user/registerAsTutor/partial/_row_tutor_hrate', array('hrate' => $hrate, 'form' => $form));
    } ?>
</table>

<br>
<div class="item-name">Preferred tutoring locations</div>
<p class="hint">Please select locations by nearest MRT stations</p>
<table class="table table-condensed" id="location-select-group" style="width:500px">
    <tr class="table-header">
        <th style="width: 250px;">MRT line</th>
        <th style="width: 250px;">Nearest MRT station</th>
    </tr>
    <tr class="input-controls">
        <td>
            <select id="mrt-line-select" name="mrt-line" style="width: 100%;">
                <option value="0">Choose MRT line</option>
            </select>
        </td>
        <td>
            <select id="mrt-station-select" name="mrt-station" style="width: 100%;" disabled>
                <option value="0">Choose MRT station</option>
            </select>
        </td>
    </tr>
    <?php foreach ($tutorLocations as $tutorLocation):?>
    <?php $mrtStation = $tutorLocation->dictMrtStation;?>
    <tr id="station-row-<?=$mrtStation->id?>" class="item-row">
        <td><?=$mrtStation->mrtLine->name?></td>
        <td><?=$mrtStation->fullLabel?><a onclick="removeMrtStation(<?=$mrtStation->id?>)" class="btn-remove" href="javascript:void(0);"><span class="icon-remove"></span>Remove</a></td>
        <input type="hidden" value="<?=$mrtStation->id?>" name="Station[<?=$tutorLocation->id?>]">
    </tr>
    <?php endforeach;?>
</table>
<p id="mrt-message" style="color:#b94a48"><?= count($tutorLocations) == 0 ? 'You need to add at least one MRT station' : ''?></p>

<br>
<div class="item-name">Available Timeslots</div>
<p class="hint">Hold down Ctrl to select multiple options</p>
<table class="table table-condensed" id="timeslot-select-group" style="width:730px">
    <tr class="table-header">
        <th style="width: 250px;">Week Day</th>
        <th style="width: 250px;">Slot</th>
    </tr>
    <tr>
        <td><?=CHtml::dropDownList('weekday-select-new', null,DictSchedule::getWeekdayList(),array(
                'multiple'=>'multiple',
                'style'=>'height: 122px; width: 100%',
            ))?>
        </td>
        <td><?=CHtml::dropDownList('timeslot-select-new', null,DictSchedule::getTimeSlotList(),array(
                'multiple'=>'multiple',
                'style'=>'height: 60px; width: 100%',
            ))?>
        </td>
        <td><a href="javascript:void(0);" class="button" id="btn-add-slot-new" style="width: 70px">Add</a></td>
    </tr>
    <?php foreach ($schedules as $schedule):?>
    <tr id="timeslot-row-<?=$schedule->id?>" class="item-row">
        <td><?=$schedule->weekday?></td>
        <td><?=$schedule->slot?><a onclick="removeTimeSlot(<?=$schedule->id?>)" class="btn-remove" href="javascript:void(0);"><span class="icon-remove"></span>Remove</a></td>
        <input type="hidden" value="<?=$schedule->id?>" name="TimeSlot[]">
    </tr>
    <?php endforeach;?>
</table>
<p id="timeslot-message" style="color:#b94a48"><?= count($schedules) == 0 ? 'You need to add at least one time slot' : ''?></p>

<?php
echo TbHtml::submitButton('Save changes', array(
    'class'=>'button submit-btn',
    'style'=>'margin: 20px 0 0 266px; width: 180px;'
));
?> 
<?php $this->endWidget(); ?>

<div style="margin-bottom: 60px"></div>
