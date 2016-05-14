<?php
/* @var $this TuitionCenterPhotoController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Tuition Center Photos',
);

$this->menu=array(
array('label'=>'Create TuitionCenterPhoto','url'=>array('create')),
array('label'=>'Manage TuitionCenterPhoto','url'=>array('admin')),
);
?>

<h1>Tuition Center Photos</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>