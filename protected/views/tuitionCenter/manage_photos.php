<?php
/* @var $this TuitionCenterPhotoController */
/* @var $model TuitionCenterPhoto */

$this->breadcrumbs = array(
    'Tuition Centre Photos',
); ?>
<style>
    .fancybox img {
        height: 100px;
    }
</style>

<div class="title">Manage <span class="highlight">Photos</span>(<?=$photoProvider->totalItemCount?>)</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'tuition-center-photo-grid',
    'dataProvider' => $photoProvider,
    'columns' => array(
//        'id',
        'caption',
        array(
            'name' => 'image',
            'value' => "CHtml::link(CHtml::image(\$data->url,\$data->caption, array('width'=>'auto','height'=>'25px', 'title' => \$data->caption,)),
                        \$data->url, array(
                            'class' => 'fancybox',
                            'title' => \$data->caption,
                            'rel' => 'group',
                            'data-fancybox-group' => 'galery',
                        ))",
            'type' => 'raw'
        ),
        'fileName',
//        'fileType',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl(\'tuitionCenter/deletePhoto\',array(\'id\'=>$data->id))',
        ),
    ),
));
?>
<br>
<div class="item-name page-caption">Upload Photo</div>
<div class="form">
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'tuition-center-photo-form',
        'enableAjaxValidation' => false,
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        'focus' => array($model, 'caption'),
    )); ?>

    <div class="control-group">
        <div class="control-label">
            <?php echo TbHtml::label("Photo", "text"); ?>
        </div>
        <div class="controls">
            <?php echo TbHtml::hiddenField("uploadfolder", "", array("readonly" => true, 'span' => 5)); ?>
            <?php echo TbHtml::hiddenField("uploadfile", "", array("readonly" => true, 'span' => 5)); ?>
            <div id="photopreview" style="width:50%"><img id="photoimg" src="/images/imageholder.jpg"/></div>
            <br>
            <?php
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
        <?php echo $form->hiddenField($model, 'tuitionCenterId') ?>
        <?php echo $form->textFieldControlGroup($model, 'caption', array('span' => 5, 'maxlength' => 254)) ?>

        <?php echo TbHtml::submitButton('Save', array(
            'class' => 'button submit-btn',
            'style' => 'margin-left: 180px; width: 100px'
        )); ?>
    </div>
    <br>

    <?php $this->endWidget(); ?>

</div>
