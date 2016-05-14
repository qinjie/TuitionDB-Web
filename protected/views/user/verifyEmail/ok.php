<?php
?>
<div class="item-name page-caption">Email Verified</div>
<hr />
<p>Thank you for verifying your email address. Now you can enjoy the personalized recommendations and email alerts from <a href="http://www.tuitiondb.com" class="underline">TuitionDB</a> website (http://www.tuitiondb.com).</p>
<p>Visit your <?=CHtml::link('account settings page',$model->profilePageUrl, array('class'=>'underline'))?> to change your email and other account settings.</p>
<br>
<a href="<?php echo Yii::app()->createUrl('site/login',array('username'=>$model->username)); ?>" class="button" style="margin-bottom: 40px">Login</a>
<br>
<br>