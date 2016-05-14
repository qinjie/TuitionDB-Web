<?php
/* @var $this TuitionCenterStaffController */
/* @var $model TuitionCenterStaff */


$this->breadcrumbs = array(
    'Tuition Centre Staff' => array('admin'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List TuitionCenterStaff', 'url' => array('index')),
    array('label' => 'Create TuitionCenterStaff', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$('#tuition-center-staff-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Tuition Centre Staff</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
        &lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button btn')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', array(
        'model' => $model,
    )); ?>
</div><!-- search-form -->

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'tuition-center-staff-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'template' => '{items} {pager}',
    'columns' => array(
        'id',
        array('name' => 'tuitionCenterName', 'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->tuitionCenter->name), array("tuitionCenter/view", "id" => $data->tuitionCenter->id))'),
//		'tuitionCenterId',
        array('name' => 'username', 'type' => 'raw',
            'value' => 'CHtml::encode($data->user->username)'),
//        'userId',
        'fullName',
        'email',
        'mobilePhone',
        /*
        'created',
        'modified',
        */
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));

$tuitionCenterId = Yii::app()->user->profile->tuitionCenterId;

?>
<p align="left">
    <u><?php echo CHtml::link('Add Staff', Yii::app()->createUrl('tuitionCenterStaff/invite', array('tuitionCenterId' => $tuitionCenterId))) ?></u>
</p>