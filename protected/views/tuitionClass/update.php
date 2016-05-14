<?php
/* @var $this TuitionClassController */
/* @var $model TuitionClass */
$this->breadcrumbs=array(
	'Tuition Branches'=>array('tuitionBranch/index'),
        $model->tuitionBranch->name=>array('tuitionBranch/view','id'=>$model->tuitionBranch->id),
	'Class #'.$model->id=>array('view','id'=>$model->id),
	'Update',
);?>

<div class="item-name page-caption">Update TuitionClass <?php echo $model->id; ?></div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>