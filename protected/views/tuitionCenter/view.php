<?php
/* @var $this TuitionCenterController */
/* @var $model TuitionCenter */
?>
<style>
    .info-table td.value {
        width: 500px;
    }
</style>
<div class="title">[<?=$model->idStr?>] <span class="highlight"><?=$model->name?></span></div>

<?php 
if (!$model->verified)
    echo '<p>Your center\'s profile will not be visible on the center list until your account is activated.</p>';
$this->widget('application.extensions.TuitionDbExtension.TDetailView', array(
    'data' => $model,
    'attributes' => array(
        'name',
        'phone',
        'fax',
        'email',
        'website',
        array('name'=>'info', 'value'=>nl2br(CHtml::encode($model->info)), 'type'=>'raw'),
    ),
    'htmlOptions' => array(
        'style' => 'margin-bottom: 50px',
    )
)); ?>
