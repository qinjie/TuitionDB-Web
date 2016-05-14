<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form TbActiveForm */

$this->pageTitle = Yii::app()->name . ' - Login';
?>
<style>
    div.links a {
        display: block;
        margin-left: 180px;
    }
    #login-form .control-group label.checkbox {
        padding-top: 0;
    }
</style>

<div class="inner-container">
    <div class="item-name page-caption">Login</div>
    <div class="form">
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'login-form',
            'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
            'enableAjaxValidation' => false,
            'focus'=>array($model, 'username'),
        ));
        echo $form->errorSummary($model);
        ?>
        <?php echo $form->textFieldControlGroup($model, 'username', array('span' => 2, 'maxlength' => 254)); ?>
        <?php echo $form->passwordFieldControlGroup($model, 'password', array('span' => 2, 'maxlength' => 40)); ?>
        <?php echo $form->checkBoxControlGroup($model, 'rememberMe', array('span' => 5, 'maxlength' => 5)); ?>

        <div class="links">
            <?= CHtml::link('Forget Password', array('user/passwordReset')) ?>
            <?= CHtml::link('Register', array('user/register')) ?>
        </div>
        <?php
        echo TbHtml::submitButton('Login', array(
            'class' => 'green-button button',
            'style' => 'margin: 10px 0 0 178px; width: 94px;',
        ));
        ?>
        <?php $this->endWidget(); ?>
    </div>
</div>
