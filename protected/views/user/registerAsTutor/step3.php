<?php
/* @var $this SiteController */
/* @var $mrtMessage string */
/* @var $scheduleMessage string */
/* @var $mrtStations array */
/* @var $schedules array */
$this->renderPartial('registerAsTutor/partial/_register_caption');
?>
<style>
    select option {
        color: #000;
        overflow: hidden;
    }
</style>

<div class="form-container">
    
    <?php if ($mrtMessage || $scheduleMessage):?>
        <div class="alert alert-error form-alert" style="width: 570px">
            <?= $mrtMessage . ($mrtMessage && $scheduleMessage ? '<br>':'') . $scheduleMessage ?>
        </div>
    <?php endif;?>
    
    <div class="form-block" style="width: 620px">
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'location-timeslot-form',
            'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
            'enableAjaxValidation' => false,
        ));?>
        <h4>Preferred tutoring locations</h4>
        <p class="hint">Please select locations by nearest MRT stations</p>
        <table class="table table-condensed" id="location-select-group" style="width:730px">
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
                <td></td>
            </tr>
            <?php foreach ($mrtStations as $mrtStation):?>
            <tr id="station-row-<?=$mrtStation->id?>" class="item-row">
                <td><?=$mrtStation->mrtLine->name?></td>
                <td><?=$mrtStation->fullLabel?><a onclick="removeMrtStation(<?=$mrtStation->id?>)" class="btn-remove" href="javascript:void(0);"><span class="icon-remove"></span>Remove</a></td>
                <input type="hidden" value="<?=$mrtStation->id?>" name="Station[<?= $mrtStation->id ?>]">
            </tr>
            <?php endforeach;?>
        </table>
        <br>
        <h4>Available Timeslots</h4>
        <table class="table table-condensed" id="timeslot-select-group" style="width:730px">
            <tr class="table-header">
                <th style="width: 250px;">Week Day</th>
                <th style="width: 250px;">Slot</th>
            </tr>
            <tr>
                <td><?=CHtml::dropDownList('weekday-select-new', null,DictSchedule::getWeekdayList(),array(
                        'multiple'=>'multiple',
                        'style'=>'height: 125px; width: 100%',
                    ))?>
                </td>
                <td><?=CHtml::dropDownList('timeslot-select-new', null,DictSchedule::getTimeSlotList(),array(
                        'multiple'=>'multiple',
                        'style'=>'height: 60px; width: 100%',
                    ))?>
                </td>
                <td><a href="javascript:void(0);" class="button" id="btn-add-slot-new" style="width: 60px">Add</a></td>
            </tr>
            <?php foreach ($schedules as $schedule):?>
            <tr id="timeslot-row-<?=$schedule->id?>" class="item-row">
                <td><?=$schedule->weekday?></td>
                <td><?=$schedule->slot?><a onclick="removeTimeSlot(<?=$schedule->id?>)" class="btn-remove" href="javascript:void(0);"><span class="icon-remove"></span>Remove</a></td>
                <input type="hidden" value="<?=$schedule->id?>" name="TimeSlot[]">
            </tr>
            <?php endforeach;?>
        </table>

        <?php
        echo CHtml::submitButton('Next', array(
            'class'=>'green-btn submit-btn',
            'style'=>'margin-left: 287px; width: 312px;'
        ));?>

        <?php $this->endWidget(); ?>
    </div>
</div>