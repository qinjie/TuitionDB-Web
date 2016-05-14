<?php
/* @var $this TuitionCenterStaffController */
/* @var $data TuitionCenterStaff */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('tuitionCenterId')); ?>:</b>
    <?php echo CHtml::encode($data->tuitionCenterId); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('userId')); ?>:</b>
    <?php echo CHtml::encode($data->userId); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('fullName')); ?>:</b>
    <?php echo CHtml::encode($data->fullName); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
    <?php echo CHtml::encode($data->email); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('mobilePhone')); ?>:</b>
    <?php echo CHtml::encode($data->mobilePhone); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
    <?php echo CHtml::encode($data->created); ?>
    <br/>

    <?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
	<?php echo CHtml::encode($data->modified); ?>
	<br />

	*/
    ?>

</div>