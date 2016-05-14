<?php
/* @var $this TuitionBranchController */
/* @var $model TuitionBranch */
/* @var $form TbActiveForm */

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'tuition-branch-form',
    'enableAjaxValidation' => false,
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
));

echo $form->errorSummary($model); 
echo $form->textFieldControlGroup($model, 'name', array('span' => 4, 'maxlength' => 200)); 
echo $form->textFieldControlGroup($model, 'address', array('span' => 4, 'maxlength' => 255)); 
echo $form->textFieldControlGroup($model, 'postal', array('span' => 2)); 
echo $form->textFieldControlGroup($model, 'phone', array('span' => 2, 'maxlength' => 20)); 
echo $form->textFieldControlGroup($model, 'fax', array('span' => 2, 'maxlength' => 20)); 
echo $form->textFieldControlGroup($model, 'email', array('span' => 3, 'maxlength' => 255)); 
echo $form->textFieldControlGroup($model, 'website', array('span' => 3, 'maxlength' => 200)); 
?>   
<div class="control-group <?= $model->hasErrors('dictMrtStationId') ? 'error' : '' ?>">
    <label for="mrt-line-select" class="control-label required <?= $model->hasErrors('dictMrtStationId') ? 'error' : '' ?>">Nearest MRT <span class="required">*</span></label>
    <div class="controls">
        <select id="mrt-line-select" name="mrt-line" style="width: 175px; margin-right: 6px;"
            <?= $model->hasErrors('dictMrtStationId') ? 'data-placement="right" data-original-title="' . $model->getError('dictMrtStationId') . '" data-toggle="tooltip"' : '' ?>>
            <option value="0">Choose MRT line</option>
        </select>
        <select id="mrt-station-select" name="TuitionBranch[dictMrtStationId]" disabled style="width: 175px;">
            <option value="0">Choose MRT station</option>
        </select>
    </div>
</div>
<?php
echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
    'class' => 'button submit-btn',
    'style' => 'margin: 0 0 40px 180px;'
));

$this->endWidget(); ?>

<script>
    $(document).ajaxComplete(function() {
        // For MRT select
        var selectedLine = null;
        var selectedStation = null;
        <?php if ($mrtStation){
            echo 'selectedLine = "'.$mrtStation->mrtLine->name.'";';
            echo 'selectedStation = "'.$mrtStation->id.'";';
        }?>
        
        $('#mrt-line-select').change(function() {
            $('#mrt-message').hide();
        });
        // Set dropdown lists to the values user has selected before
        if (selectedLine && selectedStation) {
            $('#mrt-line-select').val(selectedLine);
            $('#mrt-line-select').change();
            $('#mrt-station-select').val(selectedStation);
        }
    });
</script>