<?php
/* @var $this TuitionCenterLogoController */
/* @var $model TuitionCenterLogo */
?>

<?php
$this->breadcrumbs=array(
	'Tuition Center Logos'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List TuitionCenterLogo', 'url'=>array('index')),
array('label'=>'Create TuitionCenterLogo', 'url'=>array('create')),
array('label'=>'Update TuitionCenterLogo', 'url'=>array('update', 'id'=>$model->id)),
array('label'=>'Delete TuitionCenterLogo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage TuitionCenterLogo', 'url'=>array('admin')),
);
?>

<h1>View TuitionCenterLogo #<?php echo $model->id; ?></h1>

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