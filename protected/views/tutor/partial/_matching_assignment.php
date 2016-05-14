<?php
/* @var $this TutorController */
/* @var $assignment Assignment */
?>

<div class="view tutor-assignment-item">
    <table>
        <tr>
            <th width="150"></th>
            <th>
                <a href="<?=$assignment->getUrl()?>">
                    <?=DictCategory::getCategoryLabel($assignment->dictCategoryId)?> - <?=$assignment->subjectStr?>
                </a>
            </th>
        </tr>
        <tr>
            <th>Location</th>
            <td><?= DictMrtStation::getStationLabel($assignment->requestor->dictMrtStationId)?></td>
        </tr>
        <tr>
            <th>Frequency</th>
            <td><?=$assignment->lessionPerMonthStr?>, <?=$assignment->hourPerLessionStr?></td>
        </tr>
        <tr>
            <th>Available Timeslots</th>
            <td><?=$assignment->scheduleStr?></td>
        </tr>
        <tr>
            <th>Price</th>
            <td><?=$assignment->priceStr?></td>
        </tr>
        <tr>
            <th>Tutor Gender</th>
            <td><?=$assignment->tutorGenderStr?></td>
        </tr>
        <tr>
            <th>Tutor Profile</th>
            <td><?=$assignment->tutorProfileStr?></td>
        </tr>
        <tr>
            <th>Posted On</th>
            <td><?=$assignment->postedTime?></td>
        </tr>
    </table>
    <div class="button-group">
        <a class="btn btn-primary btn-apply" href="<?=Yii::app()->baseUrl?>/assignment/apply?id=<?=$assignment->id?>">Apply</a>
    </div>
</div>

