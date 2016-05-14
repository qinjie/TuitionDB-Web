<?php
/* @var $this TuitionCenterStaffController */
/* @var $model TuitionCenterStaff */
?>

<?php
$this->breadcrumbs=array(
	'Tuition Center Staff'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List TuitionCenterStaff', 'url'=>array('index')),
array('label'=>'Manage TuitionCenterStaff', 'url'=>array('admin')),
);
?>

<h1>Create TuitionCenterStaff</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>