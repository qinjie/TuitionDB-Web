<?php
/* @var $hrate TutorHourlyRate */
/* @var $form TbActiveForm */
$catId = $hrate->dictCategoryId;
?>

<tr id="hourly-rate-row-<?= $catId ?>" class="hourly-rate-row">
    <td style="vertical-align: middle"><?= $hrate->dictCategory->label ?></td>
    <td>
        <input type="text" name="HRate[<?= $catId ?>]" class="hourly-rate-input <?= $hrate->hasErrors() ? 'error' : '' ?>"
               value="<?= $hrate->hourlyRate ?>" style="width: 100%">
        <p style="color:#CC0000; display: inline"><?= $hrate->getError('hourlyRate') ?></p>
    </td>
</tr>