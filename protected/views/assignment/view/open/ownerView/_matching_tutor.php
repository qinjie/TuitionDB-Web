<?php
/* @var $this Controller */
/* @var $tutor Tutor */
/* @var $assignment Assignment */
?>

<div class="box tutor-item">
    <a href="<?=$tutor->getUrl()?>">
        <img class="profile-photo" src="<?= $tutor->getPhotoData() ?>"/>
    </a>
    <div class="detail-box">
        <div class="detail-row">
            <a href="<?=$tutor->getUrl()?>">
                <b><?=CHtml::encode('['.$tutor->getIdStr().'] '.$tutor->fullName)?></b>
            </a>
        </div>
        <div class="detail-row">
            <?=Lookup::item(Lookup::TYPE_GENDER, $tutor->genderCode)?>, <?=Lookup::item(Lookup::TYPE_RACE, $tutor->raceCode)?>, Age <?=$tutor->ageStr?>
        </div>
        <div class="detail-row">
            <div class="row-title">Background</div>
            <div class="row-content">
                <?=$tutor->backgroundStr?>
            </div>
        </div>
    </div>
    <?php if (Yii::app()->user->isRequestor):?>
    <div class="btn-box">
        <?php if (Yii::app()->user->user->requestor->isFavorite($tutor->id)){
            echo 'FAVORITE';
        }?>
        <a class="btn-shortlist" href="<?=Yii::app()->baseUrl?>/assignment/shortlist?tutorId=<?=$tutor->id?>&assignmentId=<?=$assignment->id?>">Shortlist</a>
    </div>
    <?php endif;?>
</div>