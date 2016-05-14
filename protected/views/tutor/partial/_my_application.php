<?php
/* @var $this TutorController */
/* @var $application AssignmentApplication */
$assignment = $application->assignment;
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
        <tr>
            <th>Application Status</th>
            <td class="app-status"><?=  Lookup::item(Lookup::TYPE_APPLICATION_STATUS, $application->statusCode)?></td>
        </tr>
    </table>
    <div class="button-group">
    <?php 
    if ($application->tutorId == $_SESSION['User']->tutor->id) {
        if ($application->statusCode == AssignmentApplication::STATUS_SHORTLISTED_BY_PARENT) {
    ?>
        <a class="btn btn-primary btn-accept-app" href="javascript:void(0);" appId="<?=$application->id?>">Accept</a>
    <?php }
        if ($application->statusCode == AssignmentApplication::STATUS_SELFREC_BY_TUTOR || $application->statusCode == AssignmentApplication::STATUS_SHORTLISTED_BY_PARENT) {
    ?>
        <a class="btn btn-danger btn-reject-app" href="javascript:void(0);" appId="<?=$application->id?>">Reject</a>
    <?php }
    }?>
    </div>
</div>

