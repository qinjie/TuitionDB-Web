<?php
/* @var $this TutorController */
/* @var $dataProvider CActiveDataProvider */
/* @var $showFilter boolean */

$this->renderPartial('partial/_search_filter', $filterParams);
?>

<div class="inner-container">
    <div class="title">Your Expert <span class="highlight">Tutors</span></div>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_view',
        'template' => '{items}{pager}',
        'ajaxUpdate' => false,
        'htmlOptions' => array(
            'class' => 'list-view tutor-list'
        ),
        'pager' => array(
            'class'=>'bootstrap.widgets.TbPager',
            'prevPageLabel' => 'Prev',
            'nextPageLabel' => 'Next',
            'hideFirstAndLast' => true,
            'htmlOptions' => array(
                'class' => 'list-pager'
            )
        )
    ));
    ?>
</div>
