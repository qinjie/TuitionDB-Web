<?php
/* @var $form TbActiveForm */
/* @var $examCode int */
/* @var $tutorExamResult TutorExamResult */

if (empty($tutorExamResult->id)) {
    $id = 'newRow0'; // This is for the javascript that add more rows to the table
} else {
    $id = $tutorExamResult->id;
}
?>

<tr class="item-row subject-row-<?=$examCode?>" id="subject-row-<?= $id ?>">
    <td><?=DictSubject::getSubjectLabel($tutorExamResult->dictSubjectId)?></td>
    <td><?=$tutorExamResult->grade?></td>
    <td><a href="javascript:void(0);" class="btn-remove" id="btn-remove-exam-grade-<?= $id ?>" onclick="removeExamResult('<?= $id ?>')"><span class="icon-remove"></span>Remove</a></td>
    <input type="hidden" name="ExamResult[<?=$examCode?>][<?= $id ?>][dictSubjectId]" value="<?=$tutorExamResult->dictSubjectId?>">
    <input type="hidden" name="ExamResult[<?=$examCode?>][<?= $id ?>][grade]" value="<?=$tutorExamResult->grade?>">
</tr>