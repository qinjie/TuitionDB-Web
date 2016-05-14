<?php
/* @var $this AssignmentController */
/* @var $dataProvider CActiveDataProvider */

$this->renderPartial('/assignment/partial/_search_filter', $filterParams);
?>

<div class="inner-container">
    <div class="title">Our <span class="highlight">Assignments</span></div>

    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'partial/_view',
        'template' => '{items}{pager}',
        'ajaxUpdate' => false,
        'htmlOptions' => array(
            'class' => 'list-view assignment-list',
        )
    ));
    ?>
</div>
