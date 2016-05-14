<?php
/* @var $this UserController */
/* @var $model UserResetForm */
/* @var $form PasswordResetForm */

$this->pageTitle = Yii::app()->name . ' - Reset Password';
?>

<div class="title">Reset <span class="highlight">Password</span></div>

<p class="hint">Enter the email address you have registered.</p>

<div class="form">

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'password-reset-form',
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
));
?>
    <?php echo $form->textFieldControlGroup($model, 'email'); ?>

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

    <?php
    echo TbHtml::submitButton('Submit', array(
        'class' => 'green-button button',
        'style' => 'margin: 10px 0 0 178px;',
    ));
    ?>

<?php $this->endWidget(); ?>

</div><!-- form -->