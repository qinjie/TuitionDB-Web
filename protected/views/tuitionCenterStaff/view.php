<?php
/* @var $this TuitionCenterStaffController */
/* @var $model TuitionCenterStaff */
$this->breadcrumbs = array(
    $model->tuitionCenter->name => $model->tuitionCenter->url,
    'Manage Staff' => array('myStaffs'),
    $model->id,
);
if (Yii::app()->user->user->id == $model->userId) {
    $this->breadcrumbs = array(
        'Profile'
    );
}
?>
<style>
    .info-table td.name {    
        width: 160px;
    }
</style>
<div class="inner-container">
    <div class="title" style="font-size: 32px;">View <span class="highlight">Staff Info</span></div>
    <?php if (!Yii::app()->user->user->isVerified && Yii::app()->user->id == $model->userId) {?>
        <p>You will be able to update your tuition center's info when your email is verified. 
        <?= CHtml::link('Resend verification email',array('user/sendVerificationMail?redirect='.Yii::app()->controller->route),array('class'=>'underline'))?>
        </p>
    <?php } ?>
    <div class="item-name"><?=$model->fullName?></div>
    <?php
    $this->widget('application.extensions.TuitionDbExtension.TDetailView', array(
        'data' => $model,
        'attributes' => array(
            array(
                'label' => 'Tuition Center',
                'value' => CHtml::link($model->tuitionCenter->name, Yii::app()->createUrl('tuitionCenter/' . $model->tuitionCenter->id), array('class'=>'underline')),
                'type' => 'raw',
            ),
            array(
                'label' => 'Username', 
                'value' => $model->user ? $model->user->username : $model->email,
            ),
            'fullName',
            'email',
            'mobilePhone',
        ),
    )); 
    if ($model->hasRights())
        echo CHtml::link('Update', array('/tuitionCenterStaff/update/'.$model->id), array(
            'class'=>'btn button',
            'style'=>'width: 100px; margin-bottom: 40px;',
        ));
    ?>
</div>