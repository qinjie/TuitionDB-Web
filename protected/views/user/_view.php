<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
    <?php echo CHtml::encode($data->username); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
    <?php echo CHtml::encode($data->password); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('sessionToken')); ?>:</b>
    <?php echo CHtml::encode($data->sessionToken); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('accountType')); ?>:</b>
    <?php echo CHtml::encode($data->accountType); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('isVerified')); ?>:</b>
    <?php echo CHtml::encode($data->isVerified); ?>
    <br />

    <?php /*
      <b><?php echo CHtml::encode($data->getAttributeLabel('lastLogin')); ?>:</b>
      <?php echo CHtml::encode($data->lastLogin); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
      <?php echo CHtml::encode($data->created); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
      <?php echo CHtml::encode($data->modified); ?>
      <br />

     */ ?>

</div>