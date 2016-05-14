<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app()->name . ' | Tuition Database (Singapore)';
?>
<style>
    a#admin-email {
        color: #00676c;
        text-decoration: underline;
    }
    .inner-container .title {
        margin: 0 0 50px;
    }
</style>

<div class="main-banner" style="margin: 20px 0 0 0;">
    <?= CHtml::image(Yii::app()->createUrl('images/banner.jpg'),'Logo',array(
        'style'=>'margin: 0 auto; display:block;',
    ))?>
</div>

<div class="inner-container">
    <div class="registration-links">
        <div class="register-block">
            <?= CHtml::link(CHtml::image(Yii::app()->createUrl('images/register-as-tutor.jpg'),'Register as Tutor'), Yii::app()->createUrl('user/registerAsTutor'), array('class'=>'image-url'))?>
            <div class="content">
                <?= CHtml::link('Register as Tutor', array('user/registerAsTutor'))?>
                <div class="seperator"></div>
                <div class="description">
                    As a registered tutor, we will filter suitable assignments for you. You will receive notifications on available assignments.
                </div>
            </div>
        </div>
        <div class="register-block">
            <?= CHtml::link(CHtml::image(Yii::app()->createUrl('images/register-as-center.jpg'),'Register as Centre'), Yii::app()->createUrl('tuitionCenter/registerAccount'), array('class'=>'image-url'))?>
            <div class="content">
                <?= CHtml::link('Register as Tuition Centre', array('tuitionCenter/registerAccount'))?>
                <div class="seperator"></div>
                <div class="description">
                    As a registered tuition centre, you will get your own page where you can update your classes at any time.
                </div>
            </div>
        </div>
        <div class="register-block">
            <?= CHtml::link(CHtml::image(Yii::app()->createUrl('images/register-as-parent.jpg'),'Register as Parent/Student'), Yii::app()->createUrl('user/registerAsRequestor'), array('class'=>'image-url'))?>
            <div class="content">
                <?= CHtml::link('Register as Parent/Student', array('user/registerAsRequestor'))?>
                <div class="seperator"></div>
                <div class="description">
                    As a registered parent/student, you can create assignments and find suitable tutors.
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="advertisement">
        <div class="title">Advertisement Service</div>
        <div class="content">Advertise with us? Please email to <?=CHtml::link('admin@tuitiondb.com','mailto:admin@tuitiondb.com',array('id'=>'admin-email'))?> for more details.</div>
    </div>
</div>

<div class="home-page-block gray-block" id="latest-assignment">
    <div class="inner-container">
        <div class="title">
            Latest <span class="highlight">Assignment</span>
        </div>
        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'type' => TbHtml::GRID_TYPE_CONDENSED,
            'dataProvider' => $assignProvider,
            'htmlOptions' => array(
                'class' => 'grid-view table-striped',
            ),
            'columns' => array(
                array('value' => '$data->date', 'name' => 'Date'),
                array('value' => '$data->categoryLabel', 'name' => 'Level'),
                array('value' => '$data->subjectStr', 'name' => 'Subjects'),
                array('value' => '$data->scheduleStrOLD', 'name' => 'Available'),
                array('value' => '$data->location', 'name' => 'Location', 'htmlOptions' => array('width' => '10%')),
                array(
                    'class' => 'CLinkColumn',
                    'label' => 'View',
                    'urlExpression' => '$data->url',
                ),
            ),
            'template' => '{items}',
            'enableSorting' => false,
            'selectableRows' => 0,
        ));
        echo CHtml::link('View More', array('assignment/list'),array('class'=>'btn-view-more'));
        ?>
    </div>
</div>

<style>
    .inner-container .list-view, .inner-container .list-view .items {
        margin: 0;
    }
</style>
<div class="home-page-block green-block" id="expert-tutor">
    <div class="inner-container">
        <div class="title" style="margin: 4px 0 10px">
            Expert <span class="highlight">Tutors</span>
        </div>
        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $tutorProvider,
            'itemView' => '_small_tutor_item',
            'template' => '{items}',
        ));?>
        <div class="clear" style="margin-bottom: 35px;"></div>
        <?=CHtml::link('View More', array('tutor/list'),array('class'=>'btn-view-more'));?>
    </div>
</div>

<div class="home-page-block gray-block" id="latest-assignment" style="padding-bottom: 50px;">
    <div class="inner-container">
        <div class="title">
            Our Featured <span class="highlight">Tuition Classes</span>
        </div>
        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'type' => TbHtml::GRID_TYPE_CONDENSED,
            'dataProvider' => $classProvider,
            'htmlOptions' => array(
                'class' => 'grid-view table-striped',
            ),
            'columns' => array(
                array('value' => 'Chtml::link($data->tuitionBranch->center->name, $data->tuitionBranch->center->url)', 'name' => 'Tuition Center', 'type' => 'raw', 'htmlOptions' => array('width' => '14%')),
                array('value' => '$data->dictClassLevel->label', 'name' => 'Level', 'htmlOptions' => array('width' => '15%')),
                array('value' => '$data->dictSubject->subject', 'name' => 'Subject', 'htmlOptions' => array('width' => '15%')),
                array('value' => 'Helper::getWeekdayName($data->weekday)', 'name' => 'Available'),
                array('value' => '$data->classSize', 'name' => 'Class Size', 'htmlOptions' => array('width' => '10%')),
                array(
                    'class' => 'CLinkColumn',
                    'label' => 'View',
                    'urlExpression' => '$data->url',
                ),
            ),
            'template' => '{items}',
            'enableSorting' => false,
            'selectableRows' => 0,
        ));
        echo CHtml::link('View More', array('tuitionCenter/list'),array('class'=>'btn-view-more'));
        ?>
    </div>
</div>


