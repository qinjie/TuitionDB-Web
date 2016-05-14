<?php
/* @var $data Tutor */
?>

<div class="list-item tutor-item tutor-item-small">
    <div class="tutor-photo thumbnail-frame">
        <?=CHtml::link(CHtml::image($data->photoUrl, $data->fullName), $data->url)?>
    </div>
    <div class="item-details">
        <?=CHtml::link($data->fullName, $data->url, array('class'=>'name'))?>
        <p style="font-style: italic;"><?=Lookup::item(Lookup::TYPE_GENDER, $data->genderCode)?>, <?=Lookup::item(Lookup::TYPE_RACE, $data->raceCode)?>, Age <?=$data->ageStr?></p>
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
</div>