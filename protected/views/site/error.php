<?php
/* @var $this SiteController */
/* @var $error array */
?>

<div class="inner-container">
<?php if (defined('YII_DEBUG')) { ?>
    <h2> . <?php echo $code; ?> . </h2>;
    <div class="error">
        <?php echo CHtml::encode($message); ?>
    </div>
<?php
} else {
    header('Location: ' . Yii::app()->baseUrl );
}
?>
</div>