<?php
/* @var $this TuitionCenterLogoController */
/* @var $model TuitionCenterLogo */
$center = $model->tuitionCenter;
$this->breadcrumbs = array(
    'Tuition Centre Logos' => array('index'),
    $model->id,
);
?>
<div class="title">Current Logo</div>
<div style="margin: 0 0 30px 180px">
    <?php
    if ($model->fileBinary)
        echo CHtml::image(Yii::app()->createUrl('tuitionCenter/logo', array('id' => $model->tuitionCenterId)), $model->caption, array('id' => 'current-logo'));
    ?>
</div>

<div class="title">Upload <span class="highlight">Logo</span></div>

<div class="form">
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'tuition-center-photo-form',
        'enableAjaxValidation' => false,
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
//    'focus' => array($model, 'caption'),
    )); ?>

    <?php echo $form->hiddenField($model, 'tuitionCenterId') ?>

    <div class="control-group">
        <div class="control-label">
            <?php echo TbHtml::label("Picture", "text"); ?>
        </div>
        <?php echo TbHtml::hiddenField("uploadfolder", "", array("readonly" => true, 'span' => 5)); ?>
        <?php echo TbHtml::hiddenField("uploadfile", "", array("readonly" => true, 'span' => 5)); ?>
        <div class="controls">
            <div id="photopreview" style="width:50%"><img id="photoimg" src="/images/imageholder.jpg"/></div>
            <br>
            <?php
            //            echo TbHtml::hiddenField("uploadfolder", "", array("readonly" => true, 'span' => 5));
            //            echo TbHtml::hiddenField("uploadfile", "", array("readonly" => true, 'span' => 5));
            $this->widget('ext.EFineUploader.EFineUploader', array(
                'id' => 'FineUploader',
                'config' => array(
                    'autoUpload' => true,
                    'request' => array(
                        'endpoint' => $this->createUrl('tuitionCenter/uploadFile'),
                        'params' => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken),
                    ),
                    'retry' => array('enableAuto' => false, 'preventRetryResponseProperty' => true),
                    'chunking' => array('enable' => true, 'partSize' => 100), //bytes
                    'callbacks' => array(
                        'onComplete' => "js:function(id, name, response){
                                $('#uploadfolder').val(response.folder);
                                $('#uploadfile').val(response.filename);
                                $('#TuitionCenterLogo-caption').val(response.filename);
                                $('#photopreview').html('<img src=\"/upload/temp/' + response.filename + '\">');
                            }",
//                        'onError' => "js:function(id, name, errorReason){
//                                alert(id + '/' + name + '/' + response.fail + '/' + response.folder + '/' + response.filename);
//                            }",
                        'onValidateBatch' => "js:function(fileOrBlobData) {}",
                    ),
                    'validation' => array(
                        'allowedExtensions' => array('jpg', 'jpeg', 'png'),
                        'sizeLimit' => 10 * 1024 * 1024, //maximum file size in bytes
                        'minSizeLimit' => 1 * 256, // minimum file size in bytes
                    ),
                )
            ));
            ?>
        </div>
    </div>
    <?php echo $form->textFieldControlGroup($model, 'caption', array('span' => 5)) ?>
    <?php
    echo CHtml::submitButton('Save', array(
        'class' => 'button submit-btn',
        'style' => 'margin-left: 180px; width: 100px'
    )); ?>
</div>

<?php $this->endWidget(); ?>
</div>

<div style="margin-bottom: 40px;"></div>
