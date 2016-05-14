<?php
/* @var $this TutorController */
/* @var $tutor Tutor */
$this->breadcrumbs = array(
    'Tutors' => array('list'),
    CHtml::encode($tutor->idStr),
);
//if (Yii::app()->user->isRequestor) {
//    $this->menu = array(
//        array('label' => 'Shortlist this Tutor for your Assignment', 'url' => array('assignment/shortlist', 'tutorId' => $tutor->id)),
//        array('label' => 'Add to Favorite', 'url' => array('requestor/addFavorite', 'tutorId' => $tutor->id)),
//    );
//}
?>
<style type=”text/css”>
    .centered {
        position: absolute;
        left: 50%;
        margin-left: -100px;
    }
</style>

<div class="inner-container" id="tutor-view">

    <div class="column-left">

        <div class="tutor-photo thumbnail-frame">
            <?= CHtml::link(CHtml::image($tutor->photoUrl, $tutor->fullName), $tutor->photoUrl, array('class' => 'fancybox', 'title' => $tutor->fullName)) ?>
        </div>
        <div class="item-name"><?= $tutor->fullName ?></div>
        <p class="tutor-desc"><?= Lookup::item(Lookup::TYPE_GENDER, $tutor->genderCode) ?>
            , <?= Lookup::item(Lookup::TYPE_RACE, $tutor->raceCode) ?>, Age <?= $tutor->ageStr ?></p>
        <?= CHtml::link('Send mail', 'mailto:' . $tutor->email, array('class' => 'btn button')) ?>
        <?= Yii::app()->user->isRequestor ? CHtml::link('Shortlist', array('assignment/shortlist', 'tutorId' => $tutor->id), array('class' => 'btn button')) : '' ?>
        <br>

        <div class="fb-like centered"
             data-width="80"
             data-href="<?php $tutor->getPublicUrl() ?>"
             data-layout="standard" data-action="like" data-show-faces="true" data-share="true"
             style="width: 210px">
        </div>
    </div>

    <div class="column-right">

        <div class="item-name"><?= $tutor->fullName ?></div>
        <div class="section">
            <table class="info-table">
                <tr>
                    <td class="name">Background</td>
                    <td class="colon">:</td>
                    <td class="value"><?= $tutor->backgroundStr ?></td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title" id="qualification">
                <i></i>

                <div class="text">Qualifications</div>
            </div>
            <?php foreach ($tutor->tutorSchools as $tutorSchool): ?>
                <table class="info-table">
                    <tr>
                        <td class="name">School</td>
                        <td class="colon">:</td>
                        <td class="value"><?= $tutorSchool->school ?></td>
                    </tr>
                    <tr>
                        <td class="name">Course/Achievement</td>
                        <td class="colon">:</td>
                        <td class="value"><?php
                            echo $tutorSchool->course;
                            if (strlen(trim($tutorSchool->achievement)))
                                echo ', ' . $tutorSchool->achievement;
                            ?></td>
                    </tr>
                </table>
            <?php endforeach; ?>
        </div>

        <div class="section">
            <div class="section-title" id="subjects">
                <i></i>

                <div class="text">Teaching Subjects</div>
            </div>
            <table class="info-table">
                <?php foreach ($tutor->levelSubjectTree as $catId => $subjects): ?>
                    <tr>
                        <td class="name"><?= DictCategory::getCategoryLabel($catId) ?></td>
                        <td class="colon">:</td>
                        <td class="value">
                            <?php
                            $str = '';
                            foreach ($subjects as $subject) {
                                $str .= $subject->subject . ', ';
                            }
                            echo substr($str, 0, strlen($str) - 2);
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div class="section">
            <div class="section-title" id="hourly-rate">
                <i></i>

                <div class="text">Tuition Hourly Rates</div>
            </div>
            <table class="info-table">
                <?php foreach ($tutor->tutorHourlyRates as $tutorHourlyRate): ?>
                    <tr>
                        <td class="name"><?= $tutorHourlyRate->dictCategory->label ?></td>
                        <td class="colon">:</td>
                        <td class="value"><?php
                            if ($tutorHourlyRate->hourlyRate == 0) {
                                echo "negotiable";
                            } else {
                                echo '$' . round($tutorHourlyRate->hourlyRate,0);
                            } ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div class="section">
            <div class="section-title" id="schedule">
                <i></i>

                <div class="text">Schedule</div>
            </div>
            <table class="info-table">
                <?php foreach ($tutor->scheduleStr as $slot => $weekdayStr): ?>
                    <tr>
                        <td class="name"><?= $slot ?></td>
                        <td class="colon">:</td>
                        <td class="value"><?= $weekdayStr ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div class="section">
            <div class="section-title" id="experience">
                <i></i>

                <div class="text">Experience</div>
            </div>
            <div
                style="margin: 15px 15px 30px; font-weight: 300;"><?php echo nl2br($tutor->tutorQualification->experienceStyle) ?></div>
        </div>

        <div class="section">
            <div class="section-title" id="assignments">
                <i></i>

                <div class="text">Assignments taken before</div>
            </div>
            <?php
            $this->widget('bootstrap.widgets.TbGridView', array(
                'type' => TbHtml::GRID_TYPE_CONDENSED,
                'dataProvider' => $assignProvider,
                'htmlOptions' => array(
                    'class' => 'grid-view table-striped',
                ),
                'columns' => array(
                    array('value' => '$data->startDate', 'name' => 'Date'),
                    array('value' => 'is_null($data->assignment)?"":$data->assignment->dictCategory->label', 'name' => 'Level'),
                    array('value' => 'is_null($data->assignment)?"":$data->assignment->subjectStr', 'name' => 'Subjects'),
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
            ?>
        </div>

    </div>

    <div class="clear"></div>

    <?php
    if (Yii::app()->user->isAdmin) {
        ?>
        <h4>Tutor's Contact Information</h4>
        <?php
        $this->widget('zii.widgets.CDetailView', array(
            'data' => $tutor,
            'cssFile' => false,
            'attributes' => array(
                'email',
                'mobilePhone',
                'homeTel',
                'homeAddress',
                'homePostal'
            ),
            'htmlOptions' => array(
                'style' => 'margin-top:0;',
                'class' => 'detail-view'
            )
        ));
    }
    ?>
</div>

<script>
    $('#tutor-view .column-left').height($('#tutor-view').height());
</script>