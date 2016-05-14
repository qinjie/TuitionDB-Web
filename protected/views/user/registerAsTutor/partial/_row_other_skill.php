<?php
/* @var $form CActiveForm */
/* @var $id int */
/* @var $otherSkill  TutorOtherSkill*/

if (empty($otherSkill->id)) {
    $id = 'newRow0'; // This is for the javascript that add more rows to the table
} else {
    $id = $otherSkill->id;
}
?>
<tr class="item-row" id="other-skill-row-<?= $id ?>">
    <td><?=$otherSkill->skill?></td>
    <td><?=$otherSkill->achievement?></td>
    <td><a href="javascript:void(0);" class="btn-remove" id="btn-remove-skill-<?= $id ?>" onclick="removeOtherSkill('<?= $id ?>')"><span class="icon-remove"></span>Remove</a></td>
    <input type="hidden" maxlength="100" name="OtherSkill[<?= $id ?>][skill]" value="<?=$otherSkill->skill?>">
    <input type="hidden" maxlength="200" name="OtherSkill[<?= $id ?>][achievement]" value="<?=$otherSkill->achievement?>">
</tr>
