<?php
/* @var $this SiteController */
/* @var $user User */
/* @var $requestor Requestor */
/* @var $mrtStation DictMrtStation */
?>
<div class="caption-band">
    <div class="inner-container">
        <div class="page-caption">Register as <span class="highlight">Parent/Student</span></div>
        <p>As a registered parent/student, you can create assignments and find<br> suitable tutors.</p>
    </div>
</div>

<div class="form-container">
    
    <?php if ($user->hasErrors() || $requestor->hasErrors() || $confirmForm->hasErrors()):?>
        <div class="alert alert-error form-alert">
            <?php echo CHtml::errorSummary(array($user,$requestor,$confirmForm)); ?>
        </div>
    <?php endif;?>
    
    <div class="form-block" style="width: 760px">
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'register-as-requestor-form',
            'enableAjaxValidation' => false,
        ));
        
         echo $form->textFieldControlGroup($user, 'username', array('maxlength' => 254, 'placeholder' => 'Must be a valid email', 'groupOptions' => array('class' => 'mgr20'))); 
         echo $form->textFieldControlGroup($requestor, 'fullName', array('maxlength' => 100, 'placeholder' => 'Full name'));  
         echo $form->passwordFieldControlGroup($user, 'password', array('maxlength' => 40, 'groupOptions' => array('class' => 'mgr20'))); 
         echo $form->passwordFieldControlGroup($user, 'repeat_password', array('maxlength' => 40)); 
         echo $form->dropdownListControlGroup($requestor, 'relation', array('Parent' => 'Parent', 'Student' => 'Student'), array('groupOptions' => array('class' => 'mgr20')));
         echo $form->textFieldControlGroup($requestor, 'mobilePhone', array('maxlength' => 20, 'placeholder' => 'Mobile Phone')); 
         echo $form->textFieldControlGroup($requestor, 'homeTel', array('maxlength' => 20, 'placeholder' => 'Home Tel', 'groupOptions' => array('class' => 'mgr20'))); 
         echo $form->textFieldControlGroup($requestor, 'homeAddress', array('maxlength' => 100, 'placeholder' => 'Home Address')); 
         echo $form->textFieldControlGroup($requestor, 'homePostal', array('maxlength' => 20, 'placeholder' => 'Postal Code', 'groupOptions' => array('class' => 'mgr20'))); 
        ?>   
        <div class="control-group <?= $requestor->hasErrors('dictMrtStationId') ? 'error' : '' ?>">
            <label for="mrt-line-select" class="control-label required <?= $requestor->hasErrors('dictMrtStationId') ? 'error' : '' ?>">Nearest MRT <span class="required">*</span></label>
            <div class="controls">
                <select id="mrt-line-select" name="mrt-line" style="width: 175px; margin-right: 6px;"
                    <?= $requestor->hasErrors('dictMrtStationId') ? 'data-placement="right" data-original-title="' . $requestor->getError('dictMrtStationId') . '" data-toggle="tooltip"' : '' ?>>
                    <option value="99">Choose MRT line</option>
                </select>
                <select id="mrt-station-select" name="Requestor[dictMrtStationId]" disabled style="width: 175px;">
                    <option value="99">Choose MRT station</option>
                </select>
            </div>
        </div>
        <?php
        echo $form->checkBoxControlGroup($confirmForm, 'confirm', array(
            'groupOptions' => array('class' => 'confirm-group mgr20'),
        ));
        echo CHtml::submitButton('Create my Profile', array(
            'class' => 'green-btn submit-btn',
        ));?>
        
        <div class="clear"></div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->
</div>

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
