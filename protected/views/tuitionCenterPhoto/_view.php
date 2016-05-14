<?php
/* @var $this TuitionCenterPhotoController */
/* @var $data TuitionCenterPhoto */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tuitionCenterId')); ?>:</b>
	<?php echo CHtml::encode($data->tuitionCenterId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caption')); ?>:</b>
	<?php echo CHtml::encode($data->caption); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fileBinary')); ?>:</b>
	<?php echo CHtml::encode($data->fileBinary); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fileName')); ?>:</b>
	<?php echo CHtml::encode($data->fileName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fileType')); ?>:</b>
	<?php echo CHtml::encode($data->fileType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
	<?php echo CHtml::encode($data->modified); ?>
	<br />

	*/ ?>

</div>