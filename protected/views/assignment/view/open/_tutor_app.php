<?php
/* @var $this CController */
/* @var $application AssignmentApplication */
/* @var $tutor Tutor */
$tutor = $application->tutor;
$id = $application->id;
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
            <tr>
                <td class="name">Status</td>
                <td class="colon">:</td>
                <td class="value app-status"><?=Lookup::item(Lookup::TYPE_APPLICATION_STATUS, $application->statusCode)?></td>
            </tr>
        </table>
    </div>
    
    <div class="btn-box">
    <?php 
    if (Yii::app()->user->isRequestor) {
        if ($ownerView && $application->isPending) {
            if ($application->statusCode == AssignmentApplication::STATUS_SELFREC_BY_TUTOR) {
                echo "<a class=\"btn-accept-app button\" href=\"javascript:void(0);\" onclick=acceptApplication($application->id)>Accept</a>";
            } 
            echo "<a class=\"btn-reject-app button\" href=\"javascript:void(0);\" appId=\"$id\">Reject</a>";
        }
        if (Yii::app()->user->user->requestor->isFavorite($tutor->id)){
            echo '<span class="button disabled favorite-btn pull-right">FAVORITE</span>';
        } else {
            echo "<a href=\"javascript:void(0)\" class=\"btn-add-favorite button\" onclick=addFavorite($tutor->id)>Add to Favorite</a>";
        }
    }
    
    if (Yii::app()->user->isTutor && Yii::app()->user->user->tutor->id == $tutor->id && $application->isPending){
        echo "<a class=\"btn-reject-app button\" href=\"javascript:void(0);\" appId=\"$id\">Cancel application</a>";
        if ($application->statusCode == AssignmentApplication::STATUS_SHORTLISTED_BY_PARENT) {
            echo "<a class=\"btn-accept-app button\" href=\"javascript:void(0);\" onclick=acceptApplication($application->id)>Accept</a>";
        }
    }
        
    if (Yii::app()->user->isAdmin && $application->isAccepted) {
        echo "<a class=\"btn-confirm-app button\" href=\"". Yii::app()->createUrl('assignment/confirm',array('appId'=>$id))."\">Confirm application</a>";
    }
    ?>
    </div>
</div>

    