<?php
/* @var $this TuitionCenterPhotoController */
/* @var $model TuitionCenterPhoto */
?>

<?php
$this->breadcrumbs=array(
	'Tuition Center Photos'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List TuitionCenterPhoto', 'url'=>array('index')),
array('label'=>'Create TuitionCenterPhoto', 'url'=>array('create')),
array('label'=>'Update TuitionCenterPhoto', 'url'=>array('update', 'id'=>$model->id)),
array('label'=>'Delete TuitionCenterPhoto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage TuitionCenterPhoto', 'url'=>array('admin')),
);
?>

<h1>View TuitionCenterPhoto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
'htmlOptions' => array(
'class' => 'table table-striped table-condensed table-hover',
),
'data'=>$model,
'attributes'=>array(
		'id',
		'tuitionCenterId',
		'caption',
		'fileBinary',
		'fileName',
		'fileType',
		'created',
		'modified',
),
)); ?>