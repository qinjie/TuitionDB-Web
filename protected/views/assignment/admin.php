<?php
/* @var $this AssignmentController */
/* @var $model Assignment */

$this->breadcrumbs=array(
    'Manage Assignments',
);
?>
<style>
    .inner-container .title {
        font-size: 32px;
    }
</style>

<div class="inner-container">
    <div class="item-name">Matched Assignments</div>

    <?php 
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => TbHtml::GRID_TYPE_CONDENSED,
        'dataProvider' => $matchedProvider,
        'columns' => array(
            array('value'=>'$data->idStr', 'name'=>'ID'),
            array('value'=>'DictCategory::getCategoryLabel($data->dictCategoryId)', 'name'=>'Level'),
            array('value'=>'$data->subjectStr', 'name'=>'Subjects'),
            array('value'=>'$data->created', 'name'=>'Posted On'),
            array(
                'class'=>'CLinkColumn',
                'label'=>'View',
                'urlExpression'=>'$data->getUrl()',
            ),
        ),
        'template' => '{items}{pager}',
        'enableSorting' => true,
    ));
    ?>

    <div class="item-name">Outstanding Fees</div>

    <?php 
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => TbHtml::GRID_TYPE_CONDENSED,
        'dataProvider' => $unpaidProvider,
        'columns' => array(
            array('value'=>'$data->idStr', 'name'=>'ID'),
            array('value'=>'DictCategory::getCategoryLabel($data->dictCategoryId)', 'name'=>'Level'),
            array('value'=>'$data->subjectStr', 'name'=>'Subjects'),
            array('value'=>'$data->created', 'name'=>'Posted On'),
            array('value'=>'$data->paid ? "No":"Yes"', 'name'=>'Outstanding Fee'),
            array(
                'class'=>'CLinkColumn',
                'label'=>'View',
                'urlExpression'=>'$data->getUrl()',
            ),
        ),
        'template' => '{items}{pager}',
        'enableSorting' => true,
    ));
    ?>

    <div class="item-name">Confirmed Assignments</div>

    <?php 
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => TbHtml::GRID_TYPE_CONDENSED,
        'dataProvider' => $confirmedProvider,
        'columns' => array(
            array('value'=>'$data->idStr', 'name'=>'ID'),
            array('value'=>'DictCategory::getCategoryLabel($data->dictCategoryId)', 'name'=>'Level'),
            array('value'=>'$data->subjectStr', 'name'=>'Subjects'),
            array('value'=>'$data->created', 'name'=>'Posted On'),
            array('value'=>'$data->paid ? "No":"Yes"', 'name'=>'Outstanding Fee'),
            array(
                'class'=>'CLinkColumn',
                'label'=>'View',
                'urlExpression'=>'$data->getUrl()',
            ),
        ),
        'template' => '{items}{pager}',
        'enableSorting' => true,
    ));
    ?>
    
    <div style="margin-bottom: 50px"></div>
</div>

