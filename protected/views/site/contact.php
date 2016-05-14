<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Contact Us';
$this->breadcrumbs = array(
    'Contact',
);
?>

<div class="item-name page-caption">Contact Us</div>

<?php if (Yii::app()->user->hasFlash('contact')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('contact'); ?>
    </div>
<?php else: ?>
    <p>If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.</p>
    <div class="form">
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'contact-form',
            'enableClientValidation' => true,
            'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        ));
        echo $form->errorSummary($model); 
        echo $form->textFieldControlGroup($model,'name');
        echo $form->textFieldControlGroup($model,'email');
        echo $form->textFieldControlGroup($model,'subject');
        echo $form->textAreaControlGroup($model,'body');
        ?>

        <?php if (CCaptcha::checkRequirements()): ?>
        <?php echo $form->textFieldControlGroup($model, 'verifyCode'); ?>
        <div class="control-group">
            <div class="controls">
            <?php $this->widget('CCaptcha',array(
                'buttonOptions' => array(
                    'class' => 'underline'
                )
            )); ?>
            <div class="hint">
                Please enter the letters as they are shown in the image above.
                <br/>Letters are not case-sensitive.
            </div>
            </div>
        </div>
        <?php endif; ?>

        <?php echo CHtml::submitButton('Submit', array(
            'class' => 'button submit-btn',
            'style' => 'margin-left: 180px',
        )); ?>

        <?php $this->endWidget(); ?>

    </div><!-- form -->

<?php endif; ?>