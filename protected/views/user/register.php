<?php
?>
</style>
<div id="register-page">
    <a class="register-block" id="register-block-tutor" href="<?=Yii::app()->createUrl('user/registerAsTutor')?>">
        <div class="register-title">Register as Tutor</div>
        <div class="register-description">As a registered tutor, we will filter suitable assignments for you. You will receive notifications on available
        assignments.</div>
    </a>
    <a class="register-block" id="register-block-user" href="<?=Yii::app()->createUrl('user/registerAsRequestor')?>">
        <div class="register-title">Register as Parent/Student</div>
        <div class="register-description">As a registered parent/student, you can create assignments and find suitable tutors.</div>
    </a>
    <a class="register-block" id="register-block-center" href="<?=Yii::app()->createUrl('tuitionCenter/registerAccount')?>">
        <div class="register-title">Register as Tuition Centre</div>
        <div class="register-description">Register with us and you can promote your tutorial classes.</div>
    </a>
    <div class="clearfix"></div>
</div>