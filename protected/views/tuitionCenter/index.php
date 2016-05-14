<?php
/* @var $this TuitionCenterController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Tuition Centers',
);

$this->menu=array(
array('label'=>'Create TuitionCenter','url'=>array('create')),
array('label'=>'Manage TuitionCenter','url'=>array('admin')),
);
?>

<h1>Tuition Centres</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>