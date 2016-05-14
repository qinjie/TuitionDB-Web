<?php
/* @var $this TuitionCenterStaffController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Tuition Center Staff',
);

$this->menu=array(
array('label'=>'Create TuitionCenterStaff','url'=>array('create')),
array('label'=>'Manage TuitionCenterStaff','url'=>array('admin')),
);
?>

<h1>Tuition Center Staff</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>