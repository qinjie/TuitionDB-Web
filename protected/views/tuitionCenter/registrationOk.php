<?php
/* @var $this UserController */
/* @var $model UserResetForm */
/* @var $form TbActiveForm */

$this->pageTitle = Yii::app()->name . ' - Registration OK';
?>
<div class="title">Registration <span class="highlight">Successful</span></div>

<p style="margin: 60px 0 60px;">Thank you for registering with us. A verification email has been sent to your email address <?php echo $model == null ? '' : '<a href="mailto:' . $model->username . '">' . $model->username . '</a>' ?>. Please verify your email account.</p>

