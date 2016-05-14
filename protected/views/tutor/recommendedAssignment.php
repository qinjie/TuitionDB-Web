<?php
?>
<div class="title">Recommended <span class="highlight">Assignments</span></div>

<?php
if ($recommendedAssProvider->itemCount == 0) {
    echo '<p>There is no assignment matches your profile</p>';
} else {
    echo '<p>Following are the assignments that match your profile. Please update your profile regularly for better matchings.</p>';
}

$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => TbHtml::GRID_TYPE_CONDENSED,
    'dataProvider' => $recommendedAssProvider,
    'columns' => array(
        array('value'=>'$data->idStr', 'name'=>'Assignment ID'),
        array('value'=>'$data->requestor->fullName', 'name'=>'Requestor'),
        array('value'=>'DictCategory::getCategoryLabel($data->dictCategoryId)', 'name'=>'Level to be tutored'),
        array('value'=>'$data->subjectStr', 'name'=>'Subjects'),
        array('value'=>'$data->lessonPerMonth', 'name'=>'Lessons per month'),
        array('value'=>'$data->hourPerLesson', 'name'=>'Hours per lession'),
        array(
            'class' => 'CLinkColumn',
            'label' => 'View',
            'urlExpression' => '$data->url',
            'htmlOptions' => array('width' => '50px')
        ),
    ),
    'template' => '{items}{pager}',
));
?>

<div style="margin-bottom: 40px"></div>