<?php
/* @var $this TuitionCenterStaffController */
/* @var $dataProvider CActiveDataProvider */
$this->breadcrumbs = array(
    $center->name => $center->url,
    'Manage Staff',
);?>
<div class="inner-container" style="margin-bottom: 40px">
    <div class="title" style="font-size: 32px;">Manage <span class="highlight">Staff</span></div>
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'tuition-center-staff-grid',
        'dataProvider' => $dataProvider,
        'template' => '{items} {pager}',
        'columns' => array(
            'id',
    //        array('name' => 'tuitionCenterName', 'type' => 'raw',
    //            'value' => 'CHtml::link(CHtml::encode($data->tuitionCenter->name), array("tuitionCenter/view", "id" => $data->tuitionCenter->id))'),
    //		'tuitionCenterId',
            array('name' => 'username', 'type' => 'raw',
                'value' => 'CHtml::encode($data->user? $data->user->username: "")'),
            'fullName',
            'email',
            'mobilePhone',
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' =>'{view}{update}'
            ),
        ),
    ));

    echo CHtml::link('Invite Staff', array('/tuitionCenterStaff/invite'), array(
        'class'=>'btn button',
        'style'=>'width: 200px;'
    ));
    ?>
</div>