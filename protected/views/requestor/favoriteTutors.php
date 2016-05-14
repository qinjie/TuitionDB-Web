<?php
/* @var $this RequestorController */
/* @var $tutors Tutor[] */
/* @var $dataProvider CActiveDataProvider */
?>

<div class="inner-container">
    <div class="title">My <span class="highlight">Tutors</span></div>
    <p class="">Tutors who have matched/taken up your assignments.</p>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$myTutorProvider,
        'itemView'=>'/tutor/_view',
        'ajaxUpdate' => false,
        'template'=>'{items}{pager}',
        'htmlOptions' => array(
            'class' => 'list-view tutor-list'
        ),
    ));
    ?>
    <div class="item-name">Favorite Tutors</div>
    <p>When you post a new assignment, your favorite tutors who match your assignment criteria, will receive an invitation to apply.</p>
    <p>They will be given priority in matching to your assignments too.</p>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$favoriteProvider,
        'itemView'=>'/tutor/_view',
        'template'=>'{items}{pager}',
        'ajaxUpdate' => false,
        'htmlOptions' => array(
            'class' => 'list-view tutor-list'
        ),
    ));
    ?>
</div>