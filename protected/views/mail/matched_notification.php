<?php
$assUrl = Yii::app()->createAbsoluteUrl('assignment/view',array('id'=>$assignment->id));
?>

<p>This assignment <?= CHtml::link($assignment->title,$assUrl) ?> matches your profile.</p>

TuitionDB Team
<?= CHtml::link("http://www.tuitiondb.com","http://www.tuitiondb.com"); ?></p>