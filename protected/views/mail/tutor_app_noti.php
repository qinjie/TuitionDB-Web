<?php
$tutorUrl = Yii::app()->createAbsoluteUrl('tutor/view',array('id'=>$tutor->id));
$assUrl = Yii::app()->createAbsoluteUrl('assignment/view',array('id'=>$assignment->id));
?>

<p><?=CHtml::link($tutor->fullName, $tutorUrl)?> has applied to you assignment <?= CHtml::link($assignment->title,$assUrl) ?></p>

TuitionDB Team
<?= CHtml::link("http://www.tuitiondb.com","http://www.tuitiondb.com"); ?></p>