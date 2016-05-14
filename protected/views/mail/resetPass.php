<?php
/* @var $user User */
$url = Yii::app()->createAbsoluteUrl('user/enterNewPass',array('userId'=>$user->id,'token'=>$user->sessionToken));
?>
<p> Please click below link to reset your password:<br>
<?= CHtml::link($url,$url); ?></p>