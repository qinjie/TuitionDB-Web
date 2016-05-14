<?php
/* @var $this QuestionController */
/* @var $model Question */
$this->breadcrumbs=array(
	'Questions'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Question', 'url'=>array('index')),
array('label'=>'Manage Question', 'url'=>array('admin')),
);
?>

<div class="title">Create <span class="highlight">Questions</span></div>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>