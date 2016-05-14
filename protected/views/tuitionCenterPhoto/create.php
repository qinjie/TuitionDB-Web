<?php
/* @var $this TuitionCenterPhotoController */
/* @var $model TuitionCenterPhoto */
?>

<?php
$this->breadcrumbs=array(
	'Tuition Center Photos'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List TuitionCenterPhoto', 'url'=>array('index')),
array('label'=>'Manage TuitionCenterPhoto', 'url'=>array('admin')),
);
?>

<h1>Create TuitionCenterPhoto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>