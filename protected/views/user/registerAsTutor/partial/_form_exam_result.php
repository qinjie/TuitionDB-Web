<?php
/* @var $examCode int */
/* @var $form CActiveForm */
/* @var $tutorExamResults array */

switch ($examCode) {
    case 0: $categoryId = 5;
        break; // O level exam => Upper Secondary
    case 1: $categoryId = 6;
        break; // A level exam => Junior College
    case 2: $categoryId = 7;
        break; // IB Exam => International Baccalaureate
}
?>
<div class="result-form" id="result-form-<?= $examCode ?>">
    <table class="table table-condensed result-table" id="result-table-<?= $examCode ?>" style="width: auto">
        <tr>
            <th width="270">Subject</th>
            <th width="187">Grade</th>
            <td width="100"></td>
        </tr>
        <tr>
            <td>
                <?= CHtml::dropDownList(
                    'Result[' . $examCode . '][dictSubjectId]', 
                    null, 
                    array(0 => 'Select Subject') + DictSubject::getSubjectsByCategory($categoryId),
                    array('span' => 2,'class'=>'exam-subject', 'id'=>'exam-subject-'.$examCode, 'style'=>'width: 100%')
                );?>
            </td>
            <td>
                <input type="text" class="exam-grade span1" id="exam-grade-<?= $examCode ?>" name="Result[<?= $examCode ?>][grade]" 
                       autocomplete="off" style="width: 100%;" onchange="validateMaxLength(this,10)">
            </td>
            <td><a href="javascript:void(0);" class="btn button button-add-subject" 
                   id="button-add-subject-<?= $examCode ?>" style="width:100px; margin: 19px 0 0 40px;">Add subject</a>
            </td>
        </tr>
        <?php
        $rowNumber = 0;
        foreach ($tutorExamResults as $tutorExamResult) {
            $rowNumber++;
            if ($tutorExamResult->isNewRecord) {
                $tutorExamResult->id = 'newRow' . $rowNumber;
            }
            $this->renderPartial('//user/registerAsTutor/partial/_row_exam_result', 
                    array('form' => $form, 'examCode' => $examCode, 'tutorExamResult' => $tutorExamResult)
            );
        }
        ?>
    </table>
</div>


<script>
    $(document).ready(function() {
        $('#button-add-subject-<?= $examCode ?>').click(function() {
            if (validateMaxLength($('#exam-grade-<?= $examCode ?>'),10)) {
                var subjectId = $('#exam-subject-<?= $examCode ?>').val(),
                    grade = $('#exam-grade-<?= $examCode ?>').val();
                if (subjectId != 0 && grade.trim().length > 0) {
                    if ($('#subject-row-' + subjectId).length == 0) {
                        $('#result-table-<?= $examCode ?>').append(
                            '<tr class="item-row subject-row-<?= $examCode ?>" id="subject-row-' + subjectId + '">' + 
                                '<td>' + $('#exam-subject-<?= $examCode ?> option[value=' + subjectId + ']').html() + '</td>' +
                                '<td>' + grade + '</td>' + 
                                '<td><a href="javascript:void(0);" class="btn-remove" id="btn-remove-exam-grade-' + subjectId + '" onclick="removeExamResult(\'' + subjectId + '\')"><span class="icon-remove"></span>Remove</a></td>' +
                                '<input type="hidden" name="ExamResult[<?=$examCode?>][' + subjectId + '][grade]" value="' + grade + '">' + 
                                '<input type="hidden" name="ExamResult[<?=$examCode?>][' + subjectId + '][dictSubjectId]" value="' + subjectId + '">' + 
                            '</tr>'
                        );
                    }
                }
            }
        });
    });

</script>