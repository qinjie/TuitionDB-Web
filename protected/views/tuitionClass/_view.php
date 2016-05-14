<?php
/* @var $this TuitionClassController */
/* @var $data TuitionClass */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tuitionBranchId')); ?>:</b>
	<?php echo CHtml::encode($data->tuitionBranchId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dictClassLevelId')); ?>:</b>
	<?php echo CHtml::encode($data->dictClassLevelId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dictSubjectId')); ?>:</b>
	<?php echo CHtml::encode($data->dictSubjectId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weekday')); ?>:</b>
	<?php echo CHtml::encode($data->weekday); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('startTime')); ?>:</b>
	<?php echo CHtml::encode($data->startTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('endTime')); ?>:</b>
	<?php echo CHtml::encode($data->endTime); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('startDate')); ?>:</b>
	<?php echo CHtml::encode($data->startDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('endDate')); ?>:</b>
	<?php echo CHtml::encode($data->endDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lessonCount')); ?>:</b>
	<?php echo CHtml::encode($data->lessonCount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('classSize')); ?>:</b>
	<?php echo CHtml::encode($data->classSize); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
	<?php echo CHtml::encode($data->modified); ?>
	<br />

	*/ ?>

</div>