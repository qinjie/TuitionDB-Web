<?php
$assUrl = Yii::app()->createAbsoluteUrl('assignment/view',array('id'=>$assignment->id));

?>
<p>You have been shortlisted to <?= CHtml::link($assignment->title,$assUrl) ?>.</p>

TuitionDB Team
<?= CHtml::link("http://www.tuitiondb.com","http://www.tuitiondb.com"); ?></p>