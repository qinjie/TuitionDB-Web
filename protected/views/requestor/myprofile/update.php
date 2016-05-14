<?php
/* @var $this RequestorController */
/* @var $user User */
/* @var $requestor Requestor */
/* @var $mrtStation DictMrtStation */
?>

<div class="inner-container">
    <div class="item-name page-caption">Your Information</div>

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'requestor-info-form',
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        'enableAjaxValidation' => false,
    ));
    ?>
    <?php // User  ?>     
    <?php echo $form->textFieldControlGroup($user, 'username', array('span' => 3, 'maxlength' => 254)); ?>

    <?php // Requestor  ?>    
    <?php echo $form->textFieldControlGroup($requestor, 'fullName', array('span' => 3, 'maxlength' => 100)); ?> 
    <?php echo $form->dropdownListControlGroup($requestor, 'relation', array('Parent' => 'Parent', 'Student' => 'Student'), array('span' => 2)) ?>
    <?php echo $form->textFieldControlGroup($requestor, 'mobilePhone', array('span' => 2, 'maxlength' => 20)); ?>
    <?php echo $form->textFieldControlGroup($requestor, 'homeTel', array('span' => 2, 'maxlength' => 20)); ?>
    <?php echo $form->textFieldControlGroup($requestor, 'homeAddress', array('span' => 3, 'maxlength' => 100)); ?>
    <?php echo $form->textFieldControlGroup($requestor, 'homePostal', array('span' => 2, 'maxlength' => 20)); ?>   
    <div class="control-group <?= $requestor->hasErrors('dictMrtStationId') ? 'error' : '' ?>">
        <label for="mrt-line-select" class="control-label required <?= $requestor->hasErrors('dictMrtStationId') ? 'error' : '' ?>">Nearest MRT <span class="required">*</span></label>
        <div class="controls">
            <select id="mrt-line-select" name="mrt-line">
                <option value="0">Choose MRT line</option>
            </select>
            <select id="mrt-station-select" name="Requestor[dictMrtStationId]">
                <option value="0">Choose MRT station</option>
            </select>
            <p id="mrt-message" style="color:#B94A48"><?=$requestor->getError('dictMrtStationId')?></p>
        </div>
    </div>

    <?php
    echo TbHtml::submitButton('Save', array(
        'class'=>'submit-btn button',
        'style'=>'width: 140px; margin: 0 0 40px 180px;'
    ));
    ?>

    <?php $this->endWidget(); ?>

    <script>
        $(document).ready(function() {
            // For MRT select
            var selectedLine = null;
            var selectedStation = null;

            <?php if ($mrtStation){
                echo 'selectedLine = "'.$mrtStation->mrtLine->name.'";';
                echo 'selectedStation = "'.$mrtStation->id.'";';
            }?>

            // Set dropdown lists to the values user has selected before
            $(document).ajaxComplete(function(){
                if (selectedLine && selectedStation) {
                    $('#mrt-line-select').val(selectedLine);
                    $('#mrt-line-select').change();
                    $('#mrt-station-select').val(selectedStation);
                }
            });
        });
    </script>
</div>