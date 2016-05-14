<?php
/* @var $this TuitionCenterController */
/* @var $model TuitionCenter */
?>

<div class="title">[<?=$model->idStr?>] <span class="highlight"><?=$model->name?></span></div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>

<div style="margin-bottom: 50px"></div>