<?php
/* @var $this QuestionController */

$this->breadcrumbs = array(
    'FAQ',
);
?>

<div class="title"><span class="highlight">Frequently Asked Questions</span></div>
<p>We would like to hear from you! If you have any enquiry or feedback, feel free to email us 
    <a href="mailto:admin@tuitiondb.com" class="underline">admin@tuitiondb.com</a>, or call/SMS us <a href="tel:31505186" target="_top" class="underline">31505186</a>.</p>
<br>
<?php if (Question::model()->exists('type = ' . Question::TYPE_GENERAL)) { ?>
    <div class="item-name">General</div>
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'question-form',
        'enableAjaxValidation' => false,
    ));
    $this->widget('zii.widgets.jui.CJuiAccordion', array(
        'panels' => CHtml::listData(Question::model()->findAllByAttributes(array('type' => Question::TYPE_GENERAL)), 'question', 'answer'),
        'options' => array(
            'collapsible' => true,
            'active' => null, // make all collapse
//        'animated'=>'bounceslide',
            'autoHeight' => false,
        ),
        'htmlOptions' => array(),
    ));
    $this->endWidget(); ?>
<?php } ?>

<?php if (Question::model()->exists('type = ' . Question::TYPE_REQUESTOR)) { ?>
    <div class="item-name">For Parents/Students</div>
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'question-form',
        'enableAjaxValidation' => false,
    ));
    $this->widget('zii.widgets.jui.CJuiAccordion', array(
        'panels' => CHtml::listData(Question::model()->findAllByAttributes(array('type' => Question::TYPE_REQUESTOR)), 'question', 'answer'),
        'options' => array(
            'collapsible' => true,
            'active' => null,
        ),
        'htmlOptions' => array(),
    ));
    $this->endWidget(); ?>
<?php } ?>

<?php if (Question::model()->exists('type = ' . Question::TYPE_TUTOR)) { ?>
    <div class="item-name">For Tutors</div>
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'question-form',
        'enableAjaxValidation' => false,
    ));
    $this->widget('zii.widgets.jui.CJuiAccordion', array(
        'panels' => CHtml::listData(Question::model()->findAllByAttributes(array('type' => Question::TYPE_TUTOR)), 'question', 'answer'),
        'options' => array(
            'collapsible' => true,
            'active' => null,
        ),
        'htmlOptions' => array(),
    ));
    $this->endWidget(); ?>
<?php } ?>

<?php if (Question::model()->exists('type = ' . Question::TYPE_CENTER)) { ?>
    <div class="item-name">For Tuition Centres</div>
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'question-form',
        'enableAjaxValidation' => false,
    ));
    $this->widget('zii.widgets.jui.CJuiAccordion', array(
        'panels' => CHtml::listData(Question::model()->findAllByAttributes(array('type' => Question::TYPE_CENTER)), 'question', 'answer'),
        'options' => array(
            'collapsible' => true,
            'active' => null,
        ),
        'htmlOptions' => array(),
    ));
    $this->endWidget(); ?>
<?php } ?>