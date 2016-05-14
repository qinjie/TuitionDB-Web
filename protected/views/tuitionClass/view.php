<?php
/* @var $this TuitionClassController */
/* @var $model TuitionClass */
$this->breadcrumbs=array(
	$model->tuitionBranch->center->name => $model->tuitionBranch->center->url,
        $model->tuitionBranch->name=>array('tuitionBranch/view','id'=>$model->tuitionBranch->id),
	'Class #'.$model->id,
);?>
<style>
    .info-table td.name {
        padding-left: 50px;
        width: 160px;
    }
</style>

<div class="title" style="font-size: 32px">
    [<?=$model->idStr?>]<span class="highlight"> <?= $model->dictClassLevel->label . ' - ' . $model->dictSubject->subject ?></span>
</div>
<?php
$this->widget('application.extensions.TuitionDbExtension.TDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'Tuition Center',
            'value' => CHtml::link($model->tuitionBranch->center->name, $model->tuitionBranch->center->url, array('class'=>'underline')),
            'type' => 'raw'
        ),
        array(
            'name' => 'tuitionBranchId',
            'value' => CHtml::link($model->tuitionBranch->name, $model->tuitionBranch->url, array('class'=>'underline')),
            'type' => 'raw'
        ),
        array(
            'name' => 'dictClassLevelId',
            'value' => DictClassLevel::getLabel($model->dictClassLevelId),
        ),
        array(
            'name' => 'dictSubjectId',
            'value' => DictSubject::getSubjectStr($model->dictSubjectId),
        ),
        array(
            'name' => 'weekday',
            'value' => Helper::getWeekdayName($model->weekday),
        ),
        array(
            'name' => 'Time',
            'value' => $model->timeStr,
        ),
        'startDate',
        'endDate',
        'lessonCount',
        'classSize',
        array(
            'name' => 'status',
            'value' => Lookup::item(Lookup::TYPE_CLASS_STATUS, $model->status),
        ),
    ),
    'nullDisplay' => false,
));
?>
<div  style="margin-bottom: 40px"></div>