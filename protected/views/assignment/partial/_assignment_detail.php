<?php
/* @var $this AssignmentController */
/* @var $assignment Assignment */
?>
<style>
    .info-table td.name {
        width: 160px;
    }
</style>

<div class="view-column pull-left">
<?php
$this->widget('application.extensions.TuitionDbExtension.TDetailView', array(
    'data' => $assignment,
    'attributes' => array(
        array(
            'name'=>'genderCode',
            'value'=>Lookup::item(Lookup::TYPE_GENDER, $assignment->genderCode),
        ),
        array(
            'name'=>'raceCode',
            'value'=>Lookup::item(Lookup::TYPE_RACE, $assignment->raceCode),
        ),
        'yearOfBirth',
        'currentSchool',
        array(
            'name'=>'dictCategoryId',
            'value'=> DictCategory::getCategoryLabel($assignment->dictCategoryId),
        ),
        array(
            'name'=>'subjects',
            'value'=>$assignment->subjectStr.' ', // The space is to prevent call_user_func()
        ),
        array(
            'name'=>'schedule',
            'value'=>$assignment->scheduleStr,
            'type'=>'raw'
        ),
        array(
            'label'=>'Location',
            'value'=>DictMrtStation::getStationLabel($assignment->requestor->dictMrtStationId)
        ),
        'lessonPerMonth',
        'hourPerLesson',
        array(
            'name'=>'tutorGenderCode',
            'value'=> ($gender = Lookup::item(Lookup::TYPE_GENDER, $assignment->tutorGenderCode)) ? $gender : 'No Preference',
        ),
        array(
            'name'=>'tutorRaceCode',
            'value'=>($race = Lookup::item(Lookup::TYPE_RACE, $assignment->tutorRaceCode)) ? $race : 'No Preference',
        ),
        array(
            'name'=>'budgetRate',
            'value'=>$assignment->priceStr,
        ),
        array(
            'name'=>'minQualificationId',
            'value'=>  ($str = DictTutorQualification::getQualificationLabel($assignment->minQualificationId)) ? $str : 'No Preference',
        ),
        array(
            'name'=>'teachingCredential',
            'value'=>$assignment->teachingCredentialStr,
        ),
        'remark',
        array(
            'name'=>'created',
            'value'=>$assignment->postedTime,
        ),
        array(
            'name'=>'statusCode',
            'value'=>Lookup::item(Lookup::TYPE_ASSSIGNMENT_STATUS, $assignment->statusCode),
        ),
    ),
    'htmlOptions' => array(
//        'style' => 'margin: 0 0 20px 0'
    )
));
?>
</div>
<?php if (Yii::app()->user->isAdmin) {?>
<div class="" style="width: 400px; position: absolute; right: 0;">
    <div class="item-name">Requestor's Information</div>
    <?php
    $this->widget('application.extensions.TuitionDbExtension.TDetailView', array(
        'data' => $assignment->requestor,
        'attributes' => array(
            'email',
            'mobilePhone',
            'homeTel',
            'homeAddress',
            'homePostal'
        )
    ));
    ?>
</div>
<?php } ?>
<div class="clear"></div>