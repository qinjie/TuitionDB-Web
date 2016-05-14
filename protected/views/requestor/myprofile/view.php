<?php
/* @var $requestor Requestor */
?>
<style>
    .info-table td.name {    
        width: 180px;
    }
</style>

<div class="inner-container">
    <div class="item-name page-caption">My Profile</div>
    <?php
    $this->widget('application.extensions.TuitionDbExtension.TDetailView',array(
        'data' => $requestor,
        'attributes' => array(
            array(
                'name' => 'emailAddress',
                'value' => $requestor->email . (Yii::app()->user->isVerified ? '':' (not verified yet. '.CHtml::link('Resend verification email',array('user/sendVerificationMail?redirect='.Yii::app()->controller->route),array('class'=>'underline')).' )'),
                'type' => 'raw'
            ),
            'fullName',
            'relation',
            'mobilePhone',
            'homeTel',
            'homeAddress',
            'homePostal',
            array(
                'name' => 'dictMrtStationId',
                'value' => DictMrtStation::getStationLabel($requestor->dictMrtStationId)
            )
        ),
    ));
    echo CHtml::link('Update',array('/requestor/updateProfile'),array(
        'class'=>'btn button pull-left',
        'style'=>'width: 90px;'
    ));
    echo CHtml::link('Change Password',array('/user/passwordChange'),array(
        'class'=>'btn button pull-left',
        'style'=>'width: 200px; margin-left: 20px'
    ));
    ?>
    <div class="clear"></div>

    <div class="item-name" style="margin-top:40px">My Assignments</div>
    <table class="info-table">
        <tr>
            <td class="name">Total Assignments</td>
            <td class="colon">:</td>
            <td class="value"><?=CHtml::link(Assignment::model()->countByAttributes(array('requestorId'=>$requestor->id)),array('requestor/myassignment'))?></td>
        </tr>
        <tr>
            <td class="name">Successful Assignments</td>
            <td class="colon">:</td>
            <td class="value"><?=CHtml::link($requestor->successfulAssignmentCount)?></td>
        </tr>
    </table>
    
    <div style="margin-bottom: 40px"></div>
</div>