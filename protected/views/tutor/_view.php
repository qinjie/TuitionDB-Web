<?php
/* @var $this TutorController */
/* @var $data Tutor */
?>

<div class="tutor-item list-item" id="tutor-item-<?=$data->id?>">
    <div class="tutor-photo thumbnail-frame">
        <?=CHtml::link(CHtml::image($data->photoUrl,$data->fullName), $data->url)?>
    </div>
    <div class="item-details">
        <?=CHtml::link($data->fullName, $data->url, array('class'=>'name'))?>
        <p class="tutor-desc"><?=Lookup::item(Lookup::TYPE_GENDER, $data->genderCode)?>, <?=Lookup::item(Lookup::TYPE_RACE, $data->raceCode)?>, Age <?=$data->ageStr?></p>
        <div class="clear"></div>
        <table class="info-table">
            <tr>
                <td class="name">Background</td>
                <td class="colon">:</td>
                <td class="value"><?=$data->backgroundStr?></td>
            </tr>
            <tr>
                <td class="name">Subjects</td>
                <td class="colon">:</td>
                <td class="value"><?=$data->subjectLevelsStr?></td>
            </tr>
            <tr>
                <td class="name">Locations</td>
                <td class="colon">:</td>
                <td class="value"><?=$data->locationsStr?></td>
            </tr>
            <tr>
                <td class="name">Average Rating</td>
                <td class="colon">:</td>
                <td class="value"><?= Helper::renderRating($data->averageRating, true, $data->id)?></td>
            </tr>
        </table>
    </div>
    <div class="btn-box">
        <?php 
        echo CHtml::link('Send mail','mailto:' . $data->email,array('class'=>'btn button'));
        echo CHtml::link('View Detail', $data->url,array('class'=>'btn button'));
        if (Yii::app()->user->isRequestor) {
            if (Yii::app()->user->user->requestor->isFavorite($data->id)){
                if (Yii::app()->controller->action->id == 'favoriteTutors') {
                    echo CHtml::link('Remove from Favorite','javascript:removeFavorite(' . $data->id . ')',array('class'=>'btn button'));
                } else {
                    echo '<span class="button disabled favorite-btn pull-right">FAVORITE</span>';
                }
            } else {
                echo CHtml::link('Add to Favorite','javascript:addFavorite(' . $data->id . ')',array('class'=>'btn button btn-add-favorite'));
            }
        }?>
    </div>
</div>


