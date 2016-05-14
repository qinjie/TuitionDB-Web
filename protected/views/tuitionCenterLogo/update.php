<?php
/* @var $this TuitionCenterLogoController */
/* @var $model TuitionCenterLogo */
?>

<?php
$this->breadcrumbs=array(
	'Tuition Center Logos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
array('label'=>'List TuitionCenterLogo', 'url'=>array('index')),
array('label'=>'Create TuitionCenterLogo', 'url'=>array('create')),
array('label'=>'View TuitionCenterLogo', 'url'=>array('view', 'id'=>$model->id)),
array('label'=>'Manage TuitionCenterLogo', 'url'=>array('admin')),
);
?>

<h1>Update TuitionCenterLogo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>