<?php
/* @var $this AssignmentController */
/* @var $assignment Assignment */
/* @var $userRole int */

$this->breadcrumbs = array(
    'Assignments' => array('requestor/myassignment'),
    CHtml::encode($assignment->idStr),
);
?>

<div class="inner-container">
    <div class="title">[<?=$assignment->idStr?>] <span class="highlight"><?= $assignment->title?></span></div>
    <div class="pageview" style="text-align: right">Page view: <?=$assignment->pageView?></div>
    <?php
    $this->renderPartial('partial/_assignment_detail', array(
        'assignment'=>$assignment,
    ));
    echo CHtml::link('Update', array('update', 'id' => $assignment->id), array(
        'class' => 'button pull-left',
        'style' => 'width: 70px;'
    ));
    echo CHtml::link('Cancel', 'javascript:void(0)', array(
        'id' => 'btn-cancel-assignment',
        'class' => 'button pull-left',
        'style' => 'width: 70px; margin-left: 20px;'
    ));
    ?>
    <div class="fb-like"
         data-width="80"
         data-href="<?php $assignment->getUrl() ?>"
         data-layout="standard" data-action="like" data-show-faces="true" data-share="true"
         style="margin-left: 20px"></div>
    <div class="clear"></div>

    <?php
    $applications = AssignmentApplication::model()->findAll(array(
        'condition'=>'assignmentId = ' . $assignment->id . ' AND (statusCode = 5 OR statusCode = 6)',
    //    'order'=>'statusCode DESC'
    ));
    if (count($applications) > 0) {
    ?>
        <div class="item-name">Matched Tutor</div>
            <div class="list-view">
            <?php
                foreach ($applications as $application) {
                    $this->renderPartial('view/open/_tutor_app',array(
                        'application' => $application,
                        'ownerView' => true,
                    ));
                }
            ?>
            </div>
    <?php
    }
    $applications = AssignmentApplication::model()->findAll(array(
        'condition'=>'assignmentId = ' . $assignment->id . ' AND statusCode in (1,2,3,4)',
    //    'order'=>'statusCode DESC'
    ));
    if (count($applications) > 0) {
        ?>
        <div class="item-name">Tutor Applications</div>
            <div class="list-view">
            <?php
                foreach ($applications as $application) {
                    $this->renderPartial('view/open/_tutor_app',array(
                        'application' => $application,
                        'ownerView' => true,
                    ));
                }
            }?>
            </div>    
                
    <?php
    if (count($assignment->matchingTutors) - count($assignment->appliedtutors) > 0) {
    ?>
        <div class="item-name">Qualified Tutors</div>
    <?php
        $appliedIds = array_map(create_function('$o', 'return $o->id;'), $assignment->appliedtutors);
        foreach ($assignment->matchingTutors as $matchingTutor) {
            if(! in_array($assignment->id, $appliedIds)) {
                $this->renderPartial('view/open/ownerView/_matching_tutor',array(
                    'tutor'=>$matchingTutor,
                    'assignment' => $assignment,
                ));
            }
        }
    }
    ?>
        <div style="margin-bottom: 60px"></div>
</div>

<script>
$(document).ready(function(){
    $('#btn-cancel-assignment').click(function(){
        if (confirm("Do you want to cancel this assignment?")) {
            window.location = '<?=Yii::app()->createUrl('assignment/cancel',array('id'=>$assignment->id))?>';
        }
    });
});
</script>