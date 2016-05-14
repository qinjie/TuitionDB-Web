<?php
/* @var $this TuitionCenterPhotoController */
/* @var $model TuitionCenterPhoto */
?>

<?php
$this->breadcrumbs=array(
	'Tuition Center Photos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
array('label'=>'List TuitionCenterPhoto', 'url'=>array('index')),
array('label'=>'Create TuitionCenterPhoto', 'url'=>array('create')),
array('label'=>'View TuitionCenterPhoto', 'url'=>array('view', 'id'=>$model->id)),
array('label'=>'Manage TuitionCenterPhoto', 'url'=>array('admin')),
);
?>

<h1>Update TuitionCenterPhoto <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>