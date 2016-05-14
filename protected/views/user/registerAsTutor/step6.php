<?php
/* @var $this SiteController */
/* @var $form TbActiveForm */
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/jquery.Jcrop.min.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jquery.Jcrop.min.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/photo_upload.js');
$this->renderPartial('registerAsTutor/partial/_register_caption');
?>
<style>
    #preview-pane {
        /*top: 40px;*/
        position: relative;
        margin-left: 200px;
        /*float: right;*/
    }
</style>

<div class="form-container">
    <?php if ($tutorStatus->hasErrors() || $confirmForm->hasErrors()):?>
        <div class="alert alert-error form-alert" style="width: 700px;">
            <?php echo CHtml::errorSummary(array($tutorStatus, $confirmForm)); ?>
        </div>
    <?php endif;?>
    
    <div class="form-block" style="width: 730px">
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'photo-upload-form',
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
                'style' => 'position: relative',
            )
        ));
        ?>

        <h4>Upload a photo (optional)</h4>
        <p class="hint">Parents and students tend to look out for photo when short-listing tutors.</p>
        <div id="preview-pane">
            <div class="preview-container">
                <img id="profile-photo" src="<?= Yii::app()->getBaseUrl() ?>/images/default_profile_pic.png" style="width:300px"/>
            </div>
            <div class="image-input">
                <input id="photo-upload" type="file" class="upload" name="TutorPhoto"/>
                <input id="crop-x" type="hidden" name="Crop[x]">
                <input id="crop-y" type="hidden" name="Crop[y]">
                <input id="crop-x2" type="hidden" name="Crop[x2]">
                <input id="crop-y2" type="hidden" name="Crop[y2]">
            </div>
        </div>
        <div class="clear"></div>
        <br>

        <h4>Public Profile Url</h4>
        <span>http://www.tuitiondb.com/tutor/public/</span>
        <?=$form->textField($tutorStatus, 'nick', array(
            'maxlength' => 20,
            'style' => 'width: 100px',
//            'onchange' => 'validateMaxLength(this,20),'
        ))?>
        <br><br>

        <h4>Terms and Conditions</h4>
        <p class="" style="line-height: 25px">By submitting this form,<br>
            1. I hereby declare that the above information provided are true and correct.<br>
            2. I also agree to other Terms and Conditions listed here.
        </p>

        <?php
        echo $form->checkBoxControlGroup($confirmForm, 'confirm', array('groupOptions'=>array('class'=>'confirm-group', 'style'=>'margin-top: 0px')));
        echo CHtml::submitButton('Submit my Application', array(
            'class'=>'green-btn submit-btn',
            'style'=>'margin: 30px 0 0 345px; width: 360px;'
        ));
        $this->endWidget();
        ?>
    </div>
</div>

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