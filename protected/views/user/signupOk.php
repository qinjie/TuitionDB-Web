<?php
/* @var $this UserController */
/* @var $model UserResetForm */
/* @var $form TbActiveForm */

$this->pageTitle = Yii::app()->name . ' - Reset Password';
?>

<h1>Registration Successful</h1>
<br>

<p>Thank you for registering with us. A verification email has been sent to your email address <?php echo $model == null ? '' : '<a href="mailto:' . $model->email . '">' . $model->email . '</a>' ?>. Please verify your email account.</p>