<?php
/* @var $this UserController */
/* @var $user User */
/* @var $tutor Tutor */
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/jquery.Jcrop.min.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jquery.Jcrop.min.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/photo_upload.js');
?>
<style>
    input {
        width: 346px;
    }
</style>

<div class="item-name page-caption">Update Personal Information</div>
<br>
<div style="position: relative; margin-bottom: 60px;">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'tutor-personal-form',
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        'enableAjaxValidation' => false,
        'htmlOptions'=>array(
            'enctype' => 'multipart/form-data',
        ),
    ));
    ?>
    
    <div id="preview-pane" class="profile-pic-holder">
        <div class="preview-container">
            <img id="profile-photo" src="<?php echo $tutor->getPhotoData() ?>" style="width:300px"/>
        </div>
        <div class="file-upload btn">
            <span>Change your photo</span>
            <input type="file" name="TutorPhoto" class="upload" id="photo-upload">
        </div>
        <div class="image-input">
            <input id="crop-x" type="hidden" name="Crop[x]">
            <input id="crop-y" type="hidden" name="Crop[y]">
            <input id="crop-x2" type="hidden" name="Crop[x2]">
            <input id="crop-y2" type="hidden" name="Crop[y2]">
        </div>
        <p style="color: #FF0000"><?=$tutor->getError('photo')?></p>
    </div>
    
    <?php 
    // User  
    echo $form->textFieldControlGroup($user, 'username', array('span' => 3, 'maxlength' => 254)); 
    // Tutor  
    echo $form->textFieldControlGroup($tutor, 'fullName', array('span' => 3, 'maxlength' => 255)); 
    echo $form->dropDownListControlGroup($tutor, 'genderCode', Lookup::items(Lookup::TYPE_GENDER), array('span' => 2)); 
    echo $form->textFieldControlGroup($tutor, 'yearOfBirth', array('span' => 2, 'maxlength' => 10)); 
    echo $form->dropDownListControlGroup($tutor, 'raceCode', Lookup::items(Lookup::TYPE_RACE), array('span' => 2)); 
    echo $form->textFieldControlGroup($tutor, 'nationality', array('span' => 3, 'maxlength' => 100)); 
    echo $form->textFieldControlGroup($tutor, 'passport', array('span' => 3, 'maxlength' => 20)); 
    echo $form->textFieldControlGroup($tutor, 'mobilePhone', array('span' => 2, 'maxlength' => 20)); 
    echo $form->textFieldControlGroup($tutor, 'homeTel', array('span' => 2, 'maxlength' => 20)); 
    echo $form->textFieldControlGroup($tutor, 'homeAddress', array('span' => 3, 'maxlength' => 255)); 
    echo $form->textFieldControlGroup($tutor, 'homePostal', array('span' => 2, 'maxlength' => 10));     
    echo TbHtml::submitButton('Save changes', array(
        'class' => 'button submit-btn',
        'style' => 'margin: 10px 0 0 180px',
    ));

    $this->endWidget(); 
    ?>
</div><!-- form -->

<!-- Image Crop Modal -->
<div id="crop-modal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <h3 id="myModalLabel">Crop photo</h3>
    </div>
    <div class="modal-body">
        <img id="photo-preview" src=""/>
    </div>
    <div class="modal-footer">
        <button class="btn btn-large" data-dismiss="modal" id="btn-crop-ok">OK</button>
    </div>
</div>

