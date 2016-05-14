<?php
/* @var $this UserController */
/* @var $model PasswordResetForm */

$this->pageTitle = Yii::app()->name . ' - Enter New Password';
?>

<h2>Enter New Password</h2>
<div class="form">
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'enter-new-pass-form',
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
));
?>
    <?php echo $form->passwordFieldControlGroup($model, 'newPassword'); ?>
    <?php echo $form->passwordFieldControlGroup($model, 'newPassword_repeat'); ?>

    <div class="form-actions">
        <?php
        echo TbHtml::submitButton('Submit', array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_LARGE,
        ));
        ?>
    </div>

<?php $this->endWidget(); ?>
</div>