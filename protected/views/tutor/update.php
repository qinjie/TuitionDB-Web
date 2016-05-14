<?php
/* @var $this TutorController */
/* @var $model Tutor */
?>

<?php
$this->breadcrumbs = array(
    'Tutors' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List Tutor', 'url' => array('index')),
    array('label' => 'Create Tutor', 'url' => array('create')),
    array('label' => 'View Tutor', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage Tutor', 'url' => array('admin')),
);
?>

<h1>Update Tutor <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>