<?php
/* @var $form CActiveForm */
/* @var $otherSkills array */
?>

<div id="other-skill-form">
    <table class="table table-condensed" id="other-skill-table" style="width: auto">
        <tr>
            <th width="185">Type of Skill</th>
            <th width="270">Achievements</th>
            <td width="158"></td>
        </tr>
        <tr>
            <td><textarea type="text" class="" name="Skill[skill]" id="other-skill-type" style="width: 170px" onchange="validateMaxLength(this,100)"></textarea></td>
            <td><textarea type="text" class="" name="Skill[achievement]" id="other-skill-achievement" style="width: 100%" onchange="validateMaxLength(this,200)"></textarea></td>
            <td style="position: relative"><a href="javascript:void(0);" class="btn button" id="button-add-skill" style="position: absolute; bottom: 6px; right: 0; width: 100px">Add Skill</a></td>
        </tr>
        <?php
        $rowNumber = 0;
        foreach ($otherSkills as $otherSkill) {
            $rowNumber++;
            if ($otherSkill->isNewRecord) {
                $otherSkill->id = 'newRow' . $rowNumber;
            }
            $this->renderPartial('//user/registerAsTutor/partial/_row_other_skill', 
                array('form' => $form, 'otherSkill' => $otherSkill)
            );
        }
        ?>
    </table>
</div>


<script>
    $(document).ready(function() {
        var rowCount = <?= count($otherSkills) ?>;
        $('#button-add-skill').click(function() {
            if (validateMaxLength($('#other-skill-type'),100) && validateMaxLength($('#other-skill-achievement'),200)) {
                rowCount++;
                var skill = $('#other-skill-type').val().trim(),
                    achievement = $('#other-skill-achievement').val().trim();
                if (skill && achievement) {
                    $('#other-skill-table').append(
                        '<tr class="item-row" id="other-skill-row-newRow' + rowCount + '">' +
                            '<td>' + skill + '</td>' +
                            '<td>' + achievement + '</td>' +
                            '<td><a href="javascript:void(0);" class="btn-remove" id="btn-remove-skill-newRow' + rowCount + '" onclick="removeOtherSkill(\'newRow' + rowCount + '\')"><span class="icon-remove"></span>Remove</a></td>' +
                            '<input type="hidden" name="OtherSkill[newRow' + rowCount + '][skill]" value="' + skill + '">' +
                            '<input type="hidden" name="OtherSkill[newRow' + rowCount + '][achievement]" value="' + achievement + '">' +
                        '</tr>'
                    );
                    $('#other-skill-type').val('');
                    $('#other-skill-achievement').val('');
                }
            }
        });

    });

</script>

