<?php
/* @var $this TuitionBranchController */
/* @var $model TuitionBranch */
$this->breadcrumbs=array(
	'Tuition Branches'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
?>

<div class="item-name page-caption">Update TuitionBranch <?php echo $model->id; ?></div>

<?php $this->renderPartial('_form', array('model'=>$model, 'mrtStation' => $mrtStation)); ?>