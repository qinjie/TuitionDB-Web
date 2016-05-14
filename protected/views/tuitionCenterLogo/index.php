<?php
/* @var $this TuitionCenterLogoController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Tuition Center Logos',
);

$this->menu=array(
array('label'=>'Create TuitionCenterLogo','url'=>array('create')),
array('label'=>'Manage TuitionCenterLogo','url'=>array('admin')),
);
?>

<h1>Tuition Center Logos</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>