<?php
/* @var $this TuitionCenterLogoController */
/* @var $model TuitionCenterLogo */
?>

<?php
$this->breadcrumbs=array(
	'Tuition Center Logos'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List TuitionCenterLogo', 'url'=>array('index')),
array('label'=>'Manage TuitionCenterLogo', 'url'=>array('admin')),
);
?>

<h1>Create TuitionCenterLogo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>