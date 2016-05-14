<?php
/* @var $this TuitionCenterController */
/* @var $data TuitionCenter */
?>

<div class="list-item tcenter-item">
    <?php if (isset($data->logo)):?>
        <div class="center-logo thumbnail-frame">
            <?=CHtml::link(CHtml::image($data->logoUrl,$data->name), $data->url)?>
        </div>  
    <?php endif;?>
    <div class="center-info">
        <?=CHtml::link($data->name, $data->url, array('class'=>'center-name'))?>
        <table class="center-info-table">
            <tr>
                <td class="name">Location</td>
                <td class="colon">:</td>
                <td class="value"><?=$data->locationStr?></td>
            </tr>
            <tr>
                <td class="name">Contact No.</td>
                <td class="colon">:</td>
                <td class="value"><?=$data->phone?></td>
            </tr>
            <tr>
                <td class="name">Subjects</td>
                <td class="colon">:</td>
                <td class="value"><?=$data->subjectStr?></td>
            </tr>
            <tr>
                <td class="name">Average rating</td>
                <td class="colon">:</td>
                <td class="value"><?= Helper::renderRating(0, true, $data->id)?></td>
            </tr>
        </table>
        <div class="btn-box">
            <?php 
            echo CHtml::link('View Detail', $data->url,array('class'=>'button'));
            ?>
        </div>
    </div>
    <div class="clear"></div>
</div>