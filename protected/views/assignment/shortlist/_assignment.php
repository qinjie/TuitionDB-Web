<?php
/* @var $this AssignmentController */
/* @var $data Assignment */
/* @var $tutorId int */
?>

<div class="list-item assignment-item">
    
    <div class="item-details">
        <a href="<?=$this->createAbsoluteUrl('assignment/shortlist', array('tutorId'=>$tutorId,'assignmentId'=>$data->id))?>" class="name">
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
</div>