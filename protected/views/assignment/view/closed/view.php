<?php
/* @var $this AssignmentController */
/* @var $assignment Assignment */

?>

<div class="inner-container">
    <div class="title">[<?=$assignment->idStr?>] <span class="highlight"><?= $assignment->title?></span></div>
    <div class="pageview" style="text-align: right">Page view: <?=$assignment->pageView?></div>
    <?php
    $this->renderPartial('partial/_assignment_detail', array(
        'assignment'=>$assignment,
    ));

    $acceptedTutorIds = array();
    if ($assignment->statusCode == Assignment::STATUS_CONFIRMED) {
    ?>

    <div class="fb-like"
         data-width="80"
         data-href="<?php $assignment->getUrl() ?>"
         data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
    <br>

    <div class="item-name">Accepted Tutors</div>
    <div class="list-view tutor-list">
        <?php
            foreach ($assignment->successfulAssignments as $successfulAssignment) {
                array_push($acceptedTutorIds, $successfulAssignment->tutorId);
                $this->renderPartial('view/closed/_accepted_tutor',array(
                    'successfulAssignment'=>$successfulAssignment,
                    'ownerView'=>$ownerView,
                ));
            }
        ?>
    </div>

    <?php        
        if (Yii::app()->user->isTutor) {
            $mySuccessfulAssignment = SuccessfulAssignment::model()->findByAttributes(array(
                'tutorId'=>Yii::app()->user->user->tutor->id,
                'assignmentId'=>$assignment->id,
            ));
            if ($mySuccessfulAssignment) {
    ?>
    <div class="item-name">Your Application was Successful</div>
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $mySuccessfulAssignment,
        'cssFile' => false,
        'attributes' => array(
            'matchedDate',
            'startDate',
            'feePayable',
            'feePaid',
            'paymentDate',
        )
    ));
    ?>
    <div class="item-name">Review by Parent/Student</div>
    <?php
    $assignmentReview = AssignmentReview::model()->findByAttributes(array(
        'tutorId'=>Yii::app()->user->user->tutor->id,
        'assignmentId'=>$assignment->id,
    ));
    if ($assignmentReview) {
        $this->widget('zii.widgets.CDetailView', array(
            'data' => $assignmentReview,
            'cssFile' => false,
            'attributes' => array(
                array(
                    'name'=>'rating',
                    'value'=>$assignmentReview->ratingStr,
                ),
                'comment'
            )
        ));
    } else {
        echo '<p>No review on this assignment yet</p>';
    }
    ?>
    <?php 
            }
        } 
    }?>

    <?php
    $criteria = new CDbCriteria(array(
        'condition'=>'assignmentId = '.$assignment->id,
        'order'=>'statusCode DESC'
    ));
    $criteria->addNotInCondition('tutorId', $acceptedTutorIds);
    $applications = AssignmentApplication::model()->findAll($criteria);
    if (count($applications) > 0) {
        echo '<div class="item-name">Tutor applications</div>
                <div class="list-view">';
        foreach ($applications as $application) {
            $this->renderPartial('view/closed/_tutor_app',array(
                'application' => $application,
            ));
        }
        echo '</div';
    }?>
</div>
<div style="margin-bottom: 60px"></div>