<?php
/* @var $this RequestorController */
/* @var $data Assignment */
?>

<div class="list-item assignment-item">
    
    <div class="item-details">
        <a href="<?=$data->getUrl()?>" class="name">
            <b><?= DictCategory::getCategoryLabel($data->dictCategoryId). ' - ' . $data->subjectStr?></b>
        </a>
        <?php
        $this->widget('application.extensions.TuitionDbExtension.TDetailView', array(
            'data' => $data,
            'attributes' => array(
                array(
                    'name'=>'Location',
                    'value'=>DictMrtStation::getStationLabel($data->requestor->dictMrtStationId),
                ),
                array(
                    'name'=>'Frequency',
                    'value'=>$data->lessionPerMonthStr . ', ' . $data->hourPerLessionStr,
                ),
                array(
                    'name'=>'Available Timeslots',
                    'value'=>$data->scheduleStr,
                    'type'=>'raw',
                ),
                array(
                    'name'=>'Tutor Gender & Race',
                    'value'=>$data->tutorGenderStr.', '.$data->tutorRaceStr,
                ),
                array(
                    'name'=>'Tutor Rate',
                    'value'=>$data->priceStr,
                ),
                array(
                    'name'=>'Tutor Profile',
                    'value'=>$data->tutorProfileStr,
                ),
                array(
                    'name'=>'Posted On',
                    'value'=>$data->postedTime,
                ),
            )
        ));?>
    </div>
    
    <div class="btn-box">
    <?php
    if (Yii::app()->user->isTutor && Yii::app()->user->isVerified) {
        if (($application = Yii::app()->user->user->tutor->appliedTo($data->id)) !== false) {
            if ($application->statusCode == AssignmentApplication::STATUS_SHORTLISTED_BY_PARENT) {
                echo "<a class=\"button\" href=\"javascript:void(0)\" onclick=acceptApplication($application->id)>Accept Invitation</a>";
            } else {
                echo "<a class=\"button disabled\">Applied</a>";
            }
        } else {
            echo "<a class=\"button btn-apply\" href=\"".Yii::app()->baseUrl."/assignment/apply?id=$data->id\">Apply</a>";
        }
    }
    ?>
    </div>
</div>
