<?php
/* @var $user User */
$url = Yii::app()->createAbsoluteUrl('user/verifyEmail',array('userId'=>$user->id, 'token'=>$user->sessionToken));
?>

<p>Dear <?=$user->fullName?>,</p>

<p>Thank you for joining TuitionDB. Please click on following link to confirm your email address.</p><p>If you have problems, please paste the above URL into your web browser.
<br>
<?= CHtml::link($url,$url) ?></p>


<p>Thanks,</p>
<p>Sincerely<br>
TuitionDB Team
<?= CHtml::link("http://www.tuitiondb.com","http://www.tuitiondb.com"); ?></p>
