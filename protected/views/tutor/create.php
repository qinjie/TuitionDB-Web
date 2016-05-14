<?php
/* @var $this TutorController */
/* @var $model Tutor */
?>

<?php
$this->breadcrumbs = array(
    'Tutors' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List Tutor', 'url' => array('index')),
    array('label' => 'Manage Tutor', 'url' => array('admin')),
);
?>

<h1>Create Tutor</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>