<?php
/* @var $this CController */
/* @var $successfulAssignment SuccessfulAssignment */
/* @var $tutor Tutor */
$tutor = $successfulAssignment->tutor;
?>
<div class="tutor-item list-item tutor-app-item" id="tutor-item-<?=$tutor->id?>">
    <div class="tutor-photo thumbnail-frame">
        <?=CHtml::link(CHtml::image($tutor->photoUrl,$tutor->fullName), $tutor->url)?>
    </div>
    <div class="item-details">
        <?=CHtml::link($tutor->fullName, $tutor->url, array('class'=>'name'))?>
        <p class="tutor-desc"><?=Lookup::item(Lookup::TYPE_GENDER, $tutor->genderCode)?>, <?=Lookup::item(Lookup::TYPE_RACE, $tutor->raceCode)?>, Age <?=$tutor->ageStr?></p>
        <div class="clear"></div>
        <table class="info-table">
            <tr>
                <td class="name">Average Rating</td>
                <td class="colon">:</td>
                <td class="value"><?= Helper::renderRating($tutor->averageRating, true, $tutor->id)?></td>
            </tr>
            <?php
            $review = AssignmentReview::model()->findByAttributes(array(
                'assignmentId'=>$successfulAssignment->assignmentId,
                'tutorId'=>$successfulAssignment->tutorId,
            ));
            if (empty($review)) {
                $reviewStr = 'Not reviewed ';
                if ($ownerView) 
                    $reviewStr .= CHtml::link('Review this tutor',array('assignment/review',
                        'assId'=>$successfulAssignment->assignmentId,
                        'tutorId'=>$successfulAssignment->tutorId,
                    ),array(
                        'class'=>'underline',
                    ));
            } else {
                $reviewStr = $review->tutorRating.($review->comment ? ' - '.$review->comment : '');
            }
            ?>
            <tr>
                <td class="name">Review</td>
                <td class="colon">:</td>
                <td class="value"><?=$reviewStr?></td>
            </tr>
            <tr>
                <td class="name">Payment Status</td>
                <td class="colon">:</td>
                <td class="value"><?=$successfulAssignment->paid ? 'Paid':'Not Paid'?></td>
            </tr>
        </div>
        </table>
    </div>
    <div class="btn-box">
    <?php if (Yii::app()->user->isAdmin) {?>
        <a class="btn-update-payment button" href="<?=Yii::app()->createUrl('assignment/updatePayment',array('id'=>$successfulAssignment->id))?>">Update Payment</a>
    <?php }?>
    </div>
</div>
