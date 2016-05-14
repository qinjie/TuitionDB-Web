<?php
/* @var $this TuitionCenterStaffController */
/* @var $model TuitionCenterStaff */
$this->breadcrumbs = array(
    $model->tuitionCenter->name => $model->tuitionCenter->url,
    'Manage Staff' => array('myStaffs'),
    $model->id . ' ' => $model->url,
    'Update',
);
if (Yii::app()->user->user->id == $model->userId) {
    $this->breadcrumbs = array(
        'Profile' => array('tuitionCenterStaff/view'),
        'Update'
    );
}

?>
<div class="inner-container">
    <div class="title">Update <span class="highlight">Staff Info</span></div>
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>