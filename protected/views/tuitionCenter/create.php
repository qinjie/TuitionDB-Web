<?php
/* @var $this TuitionCenterController */
/* @var $model TuitionCenter */
?>

<?php
$this->breadcrumbs=array(
	'Tuition Centers'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List TuitionCenter', 'url'=>array('index')),
array('label'=>'Manage TuitionCenter', 'url'=>array('admin')),
);
?>

<h1>Create TuitionCenter</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>