<?php
/* @var $this TutorController */
/* @var $tutor Tutor */
?>

<?php
$this->breadcrumbs = array(
    'Tutors' => array('list'),
    CHtml::encode($tutor->fullName),
);
if ($_SESSION['User']->accountType) {
    $this->menu = array(
        array('label' => 'Shortlist this Tutor for your Assignment', 'url' => array('assignment/shortlist','tutorId'=>$tutor->id)),
        array('label' => 'Add to Favorite', 'url'=>array('requestor/addFavorite','tutorId'=>$tutor->id)),
    );
}
?>
<style>
    #page {
        position: relative;
    }
    .profile-photo {
        position: absolute;
        top: 300px;
        right: 30px;
        max-height: 450px;
    }
</style>

<h1><?=CHtml::encode($tutor->fullName)?></h1>

<img class="profile-photo" src="<?= Yii::app()->getBaseUrl() ?>/tutor/photo?tutorId=<?=$tutor->id?>"/>

<h3>Tutor Information</h3>
<?php
$this->widget('zii.widgets.CDetailView', array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
        'style' => 'width: 70%',
    ),
    'data' => $tutor,
    'attributes' => array(
        'fullName',
        array(
            'name'=>'genderCode',
            'value'=>Lookup::item(Lookup::TYPE_GENDER, $tutor->genderCode),
        ),
        'yearOfBirth',
        array(
            'name'=>'raceCode',
            'value'=>Lookup::item(Lookup::TYPE_RACE, $tutor->raceCode),
        ),
        'nationality',
        'passport',
        'email',
        'mobilePhone',
        'homeTel',
        'homeAddress',
        'homePostal',
    ),
));
?>

<h3>Tutoring Subjects</h3>
<?php 
$subjects = $tutor->subjects;
?>
<table id="table-tutoring-subjects" class="table table-condensed table-hover" style="width: 70%">
    <tr>
        <th width="150">Category</th>
        <th>Hourly Rate</th>
        <th>Subjects</th>
    </tr>
    <?php
    $hrates = $tutor->tutorHourlyRates;
    foreach ($hrates as $hrate) {
        $category = $hrate->dictCategory;
        $subjectList = array();
        foreach ($subjects as $subject) {
            if ($subject->dictCategoryId === $category->id) {
                array_push($subjectList, $subject);
            }
        }
    ?>
        <tr>
            <td rowspan="<?=count($subjectList)+1?>"><?=$category->label?></td>
            <td rowspan="<?=count($subjectList)+1?>"><?=$hrate->hourlyRate?></td>
        </tr>
    <?php
        foreach ($subjectList as $subject) {
            echo '<tr><td>'.$subject->subject.'</td></tr>';
        }
    }?>
</table>

<h3>Other Tutoring information</h3>

<table id="table-tutoring-info" class="table table-condensed table-hover" style="width: 70%">
    <?php
    $locations = $tutor->locations;
    ?>
    <tr><th width="150" rowspan="<?=count($locations)+1?>">Preferred Tutoring Locations</th></tr>
    <?php
    foreach ($locations as $location) {
        echo '<tr><td>'.$location->fullLabel.'</td></tr>';
    }
    ?>
    <tr>
        <th width="150">Available Timeslots</th>
        <td><?=$tutor->scheduleStr?></td>
    </tr>
</table>

<h3>Past and Current Education Information</h3>

<h4>Schools</h4>
<table id="table-schools" class="table table-condensed table-hover" style="width: 70%">
    <tr>
        <th>School</th>
        <th>Course</th>
        <th>Result/Achievements</th>
    </tr>
    <?php
    $schools = $tutor->tutorSchools;
    foreach ($schools as $school):
    ?>
    <tr>
        <td><?=CHtml::encode($school->school)?></td>
        <td><?=CHtml::encode($school->course)?></td>
        <td><?=CHtml::encode($school->achievement)?></td>
    </tr>
    <?php endforeach;?>
</table>

<h4>Exam results</h4>
<?php
$exams = array();
foreach ($tutor->tutorExamResults as $examResult) {
    if (!isset($exams[$examResult->examCode])) {
        $exams[$examResult->examCode] = array();
    }
    array_push($exams[$examResult->examCode],$examResult);
}

?>
<table id="table-exam-result" class="table table-condensed table-hover" style="width: 70%">
    <tr>
        <th>Exam</th>
        <th>Subject</th>
        <th>Grade</th>
    </tr>
    <?php 
    foreach ($exams as $examId=>$exam) {
        echo '<tr><td width="150" rowspan="' . (count($exam)+1) .'">' . Lookup::item(Lookup::TYPE_EXAM_TYPE, $examId) . '</td></tr>';
        foreach ($exam as $examResult) {
    ?>
    <tr>
        <td><?=$examResult->subjectLabel?></td>
        <td><?=$examResult->grade?></td>
    </tr>
    <?php }
    }?>
</table>

<h4>Other Skills</h4>
<?php
$otherSkills = $tutor->tutorOtherSkills;
?>
<table id="table-other-skill" class="table table-condensed table-hover" style="width: 70%">
    <tr>
        <th width="150">Skill</th>
        <th>Achievement</th>
    </tr>
    <?php foreach ($otherSkills as $otherSkill):?>
    <tr>
        <td><?=CHtml::encode($otherSkill->skill)?></td>
        <td><?=CHtml::encode($otherSkill->achievement)?></td>
    </tr>
    <?php endforeach;?>
</table>

<h3>Tutor Qualification</h3>
<?php
$qualification = $tutor->tutorQualification;
if (!is_null($qualification)) {
?>
<table id="table-tutor-qualification" class="table table-condensed table-hover" style="width: 70%">
    <tr>
        <th width="150">Tutoring status</th>
        <td><?= is_null($mode = $qualification->tutoringMode) ? '' : Lookup::item(Lookup::TYPE_TUTORING_MODE, $mode)?></td>
    </tr>
    <tr>
        <th>Qualification Level</th>
        <td><?= is_null($a = $qualification->dictTutorQualification) ? '' : $a->qualification?></td>
    </tr>
    <tr>
        <th>Teaching Credential</th>
        <td><?= is_null($a = $qualification->dictTutorCredential) ? '' : $a->credential?></td>
    </tr>
    <tr>
        <th>Experience / Teaching Style</th>
        <td><?=CHtml::encode($qualification->experienceStyle)?></td>
    </tr>
</table>
<?php
}?>
