<?php
/* @var $this TuitionClassController */
/* @var $model TuitionClass */
/* @var $branch TuitionBranch */
$this->breadcrumbs=array(
	'Tuition Branches'=>array('tuitionBranch/index'),
        $model->tuitionBranch->name=>array('tuitionBranch/view','id'=>$branch->id),
	'Create Class',
);?>

<div class="title">Create Tuition Class for <span class="highlight"><?=CHtml::link($branch->name, $branch->url, array('style'=>'color: #00676c'))?></span></div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>