<?php
/* @var $this TutorController */
/* @var $successfulAssignments SuccessfulAssignment[] */
/* @var $applications AssignmentApplication[] */
/* @var $appProvider CActiveDataProvider */
/* @var $successfulAssProvider CActiveDataProvider */
/* @var $tutor Tutor */
?>
<style>
    .item-name {    
        margin: 40px auto 16px;
    }
</style>

<div class="item-name">Assignment Applications (<?=$appProvider->getTotalItemCount()?>)</div>
<p class="hint">Following are the assignments which you have applied</p>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => TbHtml::GRID_TYPE_CONDENSED,
    'dataProvider' => $appProvider,
    'columns' => array(
        array('value'=>'$data->assignment->idStr', 'name'=>'ID'),
        array('value'=>'DictCategory::getCategoryLabel($data->assignment->dictCategoryId)', 'name'=>'Level'),
        array('value'=>'$data->assignment->subjectStr', 'name'=>'Subjects'),
        array('value'=>'DictMrtStation::getStationLabel($data->assignment->requestor->dictMrtStationId)', 'name'=>'Location'),
        array('value'=>'$data->appliedDate', 'name'=>'Applied On'),
        array('value'=>'Lookup::item(Lookup::TYPE_APPLICATION_STATUS,$data->statusCode)','name'=>'Application Status'),
        array(
            'class'=>'CLinkColumn',
            'label'=>'View',
            'urlExpression'=>'Yii::app()->createUrl("assignment/".$data->assignmentId)',
        ),
    ),
    'template' => '{items}{pager}',
    'enableSorting' => true,
));
?>

<div class="item-name">History Assignments (<?=$successfulAssProvider->getTotalItemCount()?>)</div>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => TbHtml::GRID_TYPE_CONDENSED,
    'dataProvider' => $successfulAssProvider,
    'columns' => array(
        array('value'=>'$data->assignment->idStr', 'name'=>'ID'),
        array('value'=>'DictCategory::getCategoryLabel($data->assignment->dictCategoryId)', 'name'=>'Level'),
        array('value'=>'$data->assignment->subjectStr', 'name'=>'Subjects'),
        array('value'=>'DictMrtStation::getStationLabel($data->assignment->requestor->dictMrtStationId)', 'name'=>'Location'),
        array('value'=>'$data->startDate', 'name'=>'Started On'),
        array(
            'class'=>'CLinkColumn',
            'label'=>'View',
            'urlExpression'=>'Yii::app()->createUrl("assignment/".$data->assignmentId)',
        ),
    ),
    'template' => '{items}{pager}',
    'enableSorting' => true,
));?>

<div class="item-name">Reviews Received (<?=count($tutor->assignmentReviews)?>)</div>
<p>Average Rating: <?= $tutor->averageRating?></p>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => TbHtml::GRID_TYPE_CONDENSED,
    'dataProvider' => $reviewProvider,
    'columns' => array(
        array('value'=>'$data->assignment->idStr', 'name'=>'Assignment ID'),
        array('value'=>'$data->ratingStr', 'name'=>'Rating'),
        array('value'=>'$data->comment', 'name'=>'Comment'),
        array('value'=>'$data->created', 'name'=>'Posted On'),
    ),
    'template' => '{items}{pager}',
));
?>

<div class="item-name">Recommended Assignments</div>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => TbHtml::GRID_TYPE_CONDENSED,
    'dataProvider' => $recommendedAssProvider,
    'columns' => array(
        array('value'=>'$data->idStr', 'name'=>'Assignment ID'),
        array('value'=>'$data->requestor->fullName', 'name'=>'Requestor'),
        array('value'=>'DictCategory::getCategoryLabel($data->dictCategoryId)', 'name'=>'Level to be tutored'),
        array('value'=>'$data->subjectStr', 'name'=>'Subjects'),
        array('value'=>'$data->lessonPerMonth', 'name'=>'Lessons per month'),
        array('value'=>'$data->hourPerLesson', 'name'=>'Hours per lession'),
        array(
            'class' => 'CLinkColumn',
            'label' => 'View',
            'urlExpression' => '$data->url',
            'htmlOptions' => array('width' => '50px')
        ),
    ),
    'template' => '{items}{pager}',
));
?>
<div style="margin-bottom: 40px"></div>