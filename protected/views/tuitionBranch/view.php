<?php
/* @var $this TuitionBranchController */
/* @var $model TuitionBranch */
/* @var $classProvider CActiveDataProvider */
$this->breadcrumbs = array(
    $model->center->name => $model->center->url,
//    'Tuition Branches' => array('tuitionBranch/index'),
    $model->name,
);
?>
<style>
    .info-table td.name {
        padding-left: 50px;
        width: 160px;
    }
</style>

<div class="title" style="font-size: 32px">[<?=$model->idStr?>] <span class="highlight"><?= $model->name;?></span></div>
<table class="info-table" style="margin-bottom: 40px">
    <tr>
        <td class="name">Tuition Center</td>
        <td class="colon">:</td>
        <td class="value"><?=CHtml::link($model->center->name, $model->center->url, array('class'=>'underline'))?></td>
    </tr>
    <tr>
        <td class="name">Name</td>
        <td class="colon">:</td>
        <td class="value"><?=$model->name?></td>
    </tr>
    <tr>
        <td class="name">Address</td>
        <td class="colon">:</td>
        <td class="value"><?=$model->address?></td>
    </tr>
    <tr>
        <td class="name">Postal</td>
        <td class="colon">:</td>
        <td class="value"><?=$model->postal?></td>
    </tr>
    <tr>
        <td class="name">Phone</td>
        <td class="colon">:</td>
        <td class="value"><?=$model->phone?></td>
    </tr>
    <tr>
        <td class="name">Fax</td>
        <td class="colon">:</td>
        <td class="value"><?=$model->fax?></td>
    </tr>
    <tr>
        <td class="name">Email</td>
        <td class="colon">:</td>
        <td class="value"><?=$model->email?></td>
    </tr>
    <tr>
        <td class="name">Website</td>
        <td class="colon">:</td>
        <td class="value"><?=$model->website?></td>
    </tr>
</table>

<div class="section">
    <div id="assignments" class="section-title">
        <i></i>
        <div class="text">Tuition classes</div>
    </div>
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'tuition-class-grid',
        'dataProvider' => $classProvider,
        'summaryText' => false,
        'cssFile' => false,
        'columns' => array(
            'id',
            array(
                'name' => 'dictClassLevelId',
                'value' => 'DictClassLevel::getLabel($data->dictClassLevelId)',
                'htmlOptions' => array(
                )
            ),
            array(
                'name' => 'dictSubjectId',
                'value' => 'DictSubject::getSubjectLabel($data->dictSubjectId)',
                'htmlOptions' => array(
                )
            ),
            array(
                'name' => 'weekday',
                'value' => 'Helper::getWeekdayName($data->weekday)',
            ),
            array(
                'name' => 'Time',
                'value' => '$data->timeStr',
            ),
            'startDate',
            'endDate',
            'lessonCount',
            'classSize',
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'viewButtonUrl' => 'Yii::app()->createUrl(\'tuitionClass/view\',array(\'id\'=>$data->id))',
                'updateButtonUrl' => 'Yii::app()->createUrl(\'tuitionClass/update\',array(\'id\'=>$data->id))',
                'deleteButtonUrl' => 'Yii::app()->createUrl(\'tuitionClass/delete\',array(\'id\'=>$data->id))',
            ),
        ),
    ));

    if ($model->center->hasRights() && Yii::app()->user->isVerified)
        echo CHtml::link('Create new Class', array('tuitionClass/create','branchId'=>$model->id),array(
            'class' => 'btn button'
        ));
    ?>
</div>
<div style="margin-bottom:50px"></div>