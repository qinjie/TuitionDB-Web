<?php
/* @var $this TuitionBranchController */
/* @var $model TuitionBranch */
$this->breadcrumbs = array(
    'Tuition Branches' => array('index'),
    'Create',
);
?>
<div class="item-name page-caption">Create Tuition Branch</div>

<?php $this->renderPartial('_form', array('model' => $model, 'mrtStation' => $mrtStation)); ?>