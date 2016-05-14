<?php
/* @var $this RequestorController */
/* @var $newAssProvider CActiveDataProvider */
?>

<div class="inner-container">
    <div class="title">My <span class="highlight">Assignments</span></div>

    <?php 
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => TbHtml::GRID_TYPE_CONDENSED,
        'dataProvider' => $newAssProvider,
        'columns' => array(
            array('value'=>'$data->idStr', 'name'=>'ID'),
            array('value'=>'DictCategory::getCategoryLabel($data->dictCategoryId)', 'name'=>'Level'),
            array('value'=>'$data->subjectStr', 'name'=>'Subjects'),
    //        array('value'=>'DictMrtStation::getStationLabel($data->requestor->dictMrtStationId)', 'name'=>'Location'),
            array('value'=>'$data->created', 'name'=>'Posted On'),
            array('value'=>'Lookup::item(Lookup::TYPE_ASSSIGNMENT_STATUS,$data->statusCode)', 'name'=>'Status'),
            array(
                'class'=>'CLinkColumn',
                'label'=>'View',
                'urlExpression'=>'Yii::app()->createUrl("assignment/".$data->id)',
            ),
        ),
        'template' => '{items}{pager}',
        'enableSorting' => true,
    ));
    echo "<br>";
    if (Yii::app()->user->user->isVerified) {
        echo CHtml::link('Create Assignment', array('/assignment/create'), array(
            'class'=>'btn button',
            'style'=>'width: 200px;'
        ));
    } else {
        echo '<p>You need to activate your account before you can create a new assignment. ' . 
            CHtml::link('Resend verification email',array('user/sendVerificationMail?redirect='.Yii::app()->controller->route),array('class'=>'underline')) . '</p>';
    }
?>
    <div style="margin-bottom: 40px"></div>
</div>




















