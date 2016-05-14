<?php
/* @var $this UserController */
/* @var $model LoginForm */
/* @var $form PasswordChangeForm  */
$this->pageTitle = Yii::app()->name . ' - Change Password';
?>
<style>
    .control-group input, .control-group select {
        margin-bottom: 10px;
    }
</style>

<div class="item-name page-caption">Change Password</div>
<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'changePassword-form',
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
));
echo $form->errorSummary($model);
?>

<?php echo $form->passwordFieldControlGroup($model, 'currentPassword', array('maxlength' => 40)); ?>
<?php echo $form->passwordFieldControlGroup($model, 'newPassword', array('maxlength' => 40)); ?>
<?php echo $form->passwordFieldControlGroup($model, 'newPassword_repeat', array('maxlength' => 40)); ?>

<?php
echo TbHtml::submitButton('Change Password', array(
    'class'=>'button submit-btn',
    'style'=>'width: 220px; margin: 0 0 40px 180px;'
));
?>
<?php $this->endWidget(); ?>
<?php
$this->widget('bootstrap.widgets.TbAlert', array(
    'block' => true, // display a larger alert block?
    'fade' => true, // use transitions?
    'closeText' => '&times;', // close link text - if set to false, no close link is displayed
    'alerts' => array(// configurations per alert type
        'success' => array(
            'block' => true,
            'fade' => true,
            'closeText' => '&times;',
        ), // success, info, warning, error or danger
    ),
));
?>