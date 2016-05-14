<?php
/* @var $this RequestorController */
/* @var $data Assignment */
?>

<a href="<?=$this->createAbsoluteUrl('assignment/view', array('id'=>$data->id))?>">
    
    <div class="box">

	<b><?php echo CHtml::encode($data->getAttributeLabel('genderCode')); ?>:</b>
	<?php echo CHtml::encode(Lookup::item(Lookup::TYPE_GENDER, $data->genderCode)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dictCategoryId')); ?>:</b>
	<?php echo CHtml::encode(DictCategory::getCategoryLabel($data->dictCategoryId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statusCode')); ?>:</b>
	<?php echo CHtml::encode(Lookup::item(Lookup::TYPE_ASSSIGNMENT_STATUS, $data->statusCode)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />
        
    </div>
    
</a>