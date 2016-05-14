<?php
/* @var $this AssignmentController */
/* @var $assignment Assignment */
/* @var $userRole int */

$this->breadcrumbs = array(
    'Assignments' => array('assignment/list'),
    CHtml::encode($assignment->idStr),
);

$applied = false;
if (Yii::app()->user->isTutor) {
    foreach ($assignment->assignmentApplications as $application) {
        if ($application->tutorId == Yii::app()->user->user->tutor->id){
            $applied = true;
            break;
        }
    }
}

//FacebookHelper::postNewAssignment($assignment->id);

?>
<div class="inner-container">
    <div class="title">[<?=$assignment->idStr?>] <span class="highlight"><?= $assignment->getTitle() ?></span></div>
    <div class="pageview" style="text-align: right">Page view: <?=$assignment->pageView?></div>
    <?php
    $this->renderPartial('partial/_assignment_detail', array(
        'assignment'=>$assignment,
    ));
    if (!$applied && Yii::app()->user->isTutor && Yii::app()->user->isVerified)
        echo CHtml::link('Apply for this assignment', array('assignment/apply/', 'id' => $assignment->id), array(
            'class' => 'button',
            'style' => 'width: 220px;'
        ));
    ?>
    <br>
    <div class="fb-like"
         data-width="80"
         data-href="<?php $assignment->getUrl() ?>"
         data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>

    <div class="item-name">Tutor applications</div>
    <div class="list-view">
        <?php
        $applications = $assignment->assignmentApplications;
        if (count($applications) > 0) {
            foreach ($applications as $application) {
                $this->renderPartial('view/open/_tutor_app',array(
                    'application' => $application,
                    'ownerView' => false,
                ));
            }
        } else {
            echo 'There is no application yet';
        }?>
    </div>
    <div style="margin-bottom: 40px;"></div>
</div>