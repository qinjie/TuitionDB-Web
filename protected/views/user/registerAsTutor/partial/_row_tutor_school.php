<?php
/* @var $school TutorSchool */
?>

<tr class="school-item item-row" id="school-item-<?=$school->id?>">
    <td><?=$school->school?></td>
    <td><?=$school->course?></td>
    <td><?=$school->achievement?></td>
    <td><a href="javascript:void(0)" class="btn-remove" onclick=removeSchool(<?=$school->id?>)><span class="icon-remove"></span>Remove</a></td>
    <input type="hidden" name="School[<?=$school->id?>][school]" value="<?=$school->school?>">
    <input type="hidden" name="School[<?=$school->id?>][course]" value="<?=$school->course?>">
    <input type="hidden" name="School[<?=$school->id?>][achievement]" value="<?=$school->achievement?>">
</tr>
