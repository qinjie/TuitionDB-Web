<?php
/* @var $subject TutorSubject */
$subjectId = $subject->dictSubjectId;
$dictSubject = DictSubject::model()->findByPk($subjectId);
?>
<tr catid="<?=$dictSubject->dictCategoryId?>" id="subject-row-<?= $subjectId ?>" class="item-row subject-row">
    <td><?= $dictSubject->category->label ?></td>
    <td><?= $dictSubject->subject ?><a href="javascript:void(0);" class="btn-remove" aria-hidden="true" onclick=removeSubject(<?= $subjectId ?>)><span class="icon-remove"></span>Remove</a></td>
    <input type="hidden" value="<?= $subjectId ?>" name="Subject[]">
</tr>