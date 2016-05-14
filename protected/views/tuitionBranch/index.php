<?php
/* @var $this TuitionBranchController */
/* @var $dataProvider CActiveDataProvider */
$this->breadcrumbs=array(
    $tuitionCenter->name => $tuitionCenter->url,
    'Tuition Branches',
);
?>

<div class="title" style="font-size: 32px">
    Tuition <span class="highlight">Branches</span>
</div>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'tuition-branch-grid',
    'dataProvider' => $dataProvider,
    'columns' => array(
        'id',
        'name',
        'address',
        'postal',
        'phone',
        'fax',
        'email',
        'website',
        array(
            'name' => 'dictMrtStationId',
            'value' => 'DictMrtStation::getStationLabel($data->dictMrtStationId)'
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));

if (Yii::app()->user->isVerified)
    echo CHtml::link('Create new Branch', array('/tuitionBranch/create'), array(
        'class'=>'btn button',
        'style'=>'width: 200px;'
    ));
?>
<div style="margin-bottom: 40px"></div>