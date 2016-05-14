<?php
/* @var $this TuitionClassController */
/* @var $model TuitionClass */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5,'maxlength'=>10)); ?>

                    <?php echo $form->textFieldControlGroup($model,'tuitionBranchId',array('span'=>5,'maxlength'=>10)); ?>

                    <?php echo $form->textFieldControlGroup($model,'dictClassLevelId',array('span'=>5,'maxlength'=>10)); ?>

                    <?php echo $form->textFieldControlGroup($model,'dictSubjectId',array('span'=>5,'maxlength'=>10)); ?>

                    <?php echo $form->textFieldControlGroup($model,'weekday',array('span'=>5,'maxlength'=>3)); ?>

                    <?php echo $form->textFieldControlGroup($model,'startTime',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'endTime',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'startDate',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'endDate',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'lessonCount',array('span'=>5,'maxlength'=>10)); ?>

                    <?php echo $form->textFieldControlGroup($model,'classSize',array('span'=>5,'maxlength'=>10)); ?>

                    <?php echo $form->textFieldControlGroup($model,'status',array('span'=>5,'maxlength'=>10)); ?>

                    <?php echo $form->textFieldControlGroup($model,'created',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'modified',array('span'=>5)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->