<?php
/* @var $this AssignmentController */
/* @var $dataProvider CActiveDataProvider */
/* @var $tutorId int */
?>
<div class="inner-container">
    <div class="item-name page-caption">Choose Assignment</div>

    <?php 
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => TbHtml::GRID_TYPE_CONDENSED,
        'dataProvider' => $dataProvider,
        'columns' => array(
            array('header'=>'Select', 'type'=>'raw', 'value'=>"CHtml::radioButton('assignment',false,array('value'=>\$data->id, 'style'=>'margin-left: 16px'))", 
                'htmlOptions'=>array('style'=>'width: 50px')
            ),
            array('value'=>'$data->idStr', 'name'=>'ID'),
            array('value'=>'DictCategory::getCategoryLabel($data->dictCategoryId)', 'name'=>'Level'),
            array('value'=>'$data->subjectStr', 'name'=>'Subjects'),
            array('value'=>'$data->created', 'name'=>'Posted On'),
            array('value'=>'Lookup::item(Lookup::TYPE_ASSSIGNMENT_STATUS,$data->statusCode)', 'name'=>'Status'),
        ),
        'template' => '{items}{pager}',
        'enableSorting' => true,
    ));
    echo CHtml::link('Shortlist to this assignment', 'javascript:void(0)', array(
        'id' => 'btn-select-assignment',
        'class' => 'button submit-btn',
        'style' => 'width: 240px; margin: 10px 0 0'
    ));
    ?>
</div>
<div style="margin-bottom: 40px"></div>

<script>
    $('#btn-select-assignment').click(function(){
        if ($('input[name=assignment]:checked').length > 0)
            window.location = '<?=Yii::app()->createUrl('assignment/shortlist', array('tutorId'=>$tutorId))?>&assignmentId=' + $('input[name=assignment]:checked').val();
    });
</script>