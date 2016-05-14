<?php

/* @var $tutor Tutor */
?>

<style>
    .profile-photo {
        width: 240px;
        position: absolute;
        top: 24px;
        right: 0;
        z-index: 10;
    }
    .section {
        margin: 30px 0 40px 0;
        position: relative;
    }
    .section .section-title {
        padding-left: 16px;
    }
    .button {
        margin: 12px 0 0 20px;
    }
    .info-table td.name {
        padding-left: 20px;
        width: 142px;
    }
    .info-table#personal-info-table td.value {
        width: 550px;
    }
    .info-table#qualification-table td.name {
        width: 200px;
    }
    .info-table.schedule-table td.name {
        padding-left: 0;
        width: 70px;
    }
    
</style>



<div class="item-name page-caption">My Profile [<?= $tutor->idStr ?>]</div>
<p>Number of parents/students add you as favorite tutor: <b><?= FavoriteTutor::model()->count('tutorId = '.$tutor->id)?></b></p>
<p>Your profile has been viewed <b><?= $tutor->pageview?></b> times.</p>
<?php if (!Yii::app()->user->isVerified):?>
<p>You have not verified your email yet. <?= CHtml::link('Resend verification email',array('user/sendVerificationMail?redirect='.Yii::app()->controller->route), array('class'=>'underline'))?>
<?php endif; ?>

<div class="section">
    <div class="section-title">
        <div class="text">Personal Information</div>
    </div>
    <div class="profile-photo">
        <a class="fancybox" href="<?= $tutor->photoUrl ?>">
            <img class="profile-photo" rel="group" src="<?= $tutor->photoUrl ?>"/>
        </a>
    </div>
    <?php
    $this->widget('application.extensions.TuitionDbExtension.TDetailView', array(
        'data' => $tutor,
        'attributes' => array(
            array(
                'name' => 'email',
                'value' => $tutor->email . (Yii::app()->user->isVerified ? '':' (not verified yet. '.CHtml::link('Resend verification email',array('user/sendVerificationMail?redirect='.Yii::app()->controller->route),array('class'=>'underline')).' )'),
                'type' => 'raw'
            ),
            'fullName',
            array(
                'name' => 'Gender',
                'value' => Lookup::item(Lookup::TYPE_GENDER, $tutor->genderCode),
            ),
            'yearOfBirth',
            array(
                'name' => 'Race',
                'value' => Lookup::item(Lookup::TYPE_RACE, $tutor->raceCode),
            ),
            'nationality',
            'passport',
            'mobilePhone',
            'homeTel',
            'homeAddress',
            'homePostal'
        ),
        'nullDisplay' => false,
        'htmlOptions' => array(
            'id' => 'personal-info-table'
        )
    ));
    echo CHtml::link('Update', array('/tutor/updatePersonal'), array(
        'class'=>'btn button',
        'style'=>'width: 80px;;'
    ));
    echo CHtml::link('Change password', array('/user/passwordChange'), array(
        'class'=>'btn button',
        'style'=>'width: 150px;'
    ));?>
</div>

<div class="section">
    <div class="section-title">
        <div class="text">Education Information</div>
    </div>
    <table class="detail-view info-table" id="education-info-table">
        <?php if (strlen($tutor->schoolsStr) > 0) {?>
        <tr class="odd">
            <td class="name">Schools</td>
            <td class="colon">:</td>
            <td class="value"><?= $tutor->schoolsStr ?></td>
        </tr>
        <?php
        }
        $examResultTree = $tutor->examResultTree;
        if (!empty($examResultTree)) {
            foreach ($examResultTree as $examCode=>$results) {
                $gradeStr = '';
                foreach ($results as $result) {
                    $gradeStr .= DictSubject::getSubjectLabel($result->dictSubjectId).' ('.$result->grade.'), ';
                }
                $gradeStr = substr($gradeStr, 0, strlen($gradeStr) - 2);
        ?>
        <tr class="odd">
            <td class="name"><?= Lookup::item(Lookup::TYPE_EXAM_TYPE, $examCode) ?></td>
            <td class="colon">:</td>
            <td class="value"><?= $gradeStr ?></td>
        </tr>
        <?php
            }
        }
        $otherSkillStr = $tutor->otherSkillStr;
        if (strlen($otherSkillStr) > 0) {
            $otherSkillStr = substr($otherSkillStr, 17, strlen($otherSkillStr) - 4);
        ?>
        <tr class="odd">
            <td class="name">Other Skills</td>
            <td class="colon">:</td>
            <td class="value"><?= $otherSkillStr ?></td>
        </tr>
        <?php
        } ?>
    </table>
    <?php
    echo CHtml::link('Update', array('/tutor/updateEducation'), array(
        'class'=>'btn button',
        'style'=>'width: 80px;'
    ));?>
</div>
<?php
$qualification = $tutor->tutorQualification;
?>
<div class="section">
    <div class="section-title">
        <div class="text">Qualification/Experience</div>
    </div>
    <?php
    $this->widget('application.extensions.TuitionDbExtension.TDetailView', array(
        'data' => $qualification,
        'attributes' => array(
            array(
                'name' => 'Tutoring Mode',
                'value' => Lookup::item(Lookup::TYPE_TUTORING_MODE, $qualification->tutoringMode),
            ),
            array(
                'name' => 'Qualification Level',
                'value' => DictTutorQualification::getQualificationLabel($qualification->dictTutorQualificationId),
            ),
            array(
                'name' => 'Teaching Credential',
                'value' => DictTutorCredential::getCredentialLabel($qualification->dictTutorCredentialId),
            ),
            array(
                'name' => 'Experience/Teaching Style',
                'value' => nl2br(CHtml::encode($qualification->experienceStyle)) ,
            ),
        ),
        'htmlOptions' => array(
            'id' => 'qualification-table'
        )
    ));
    echo CHtml::link('Update', array('/tutor/updateQualification'), array(
        'class'=>'btn button',
        'style'=>'width: 80px;'
    ));?>
</div>

<div class="section" style=" margin-bottom: 70px">
    <div class="section-title">
        <div class="text">Tutoring Information</div>
    </div>
    <?php
    $scheduleStr = '<table class="info-table schedule-table">';
    foreach ($tutor->scheduleStr as $slot => $weekdayStr) {
        $scheduleStr .= '<tr>
            <td class="name">'. $slot . '</td>
            <td class="colon">:</td>
            <td class="value">' . $weekdayStr . '</td>
        </tr>';
    }
    $scheduleStr .= '</table>';
    
    $this->widget('application.extensions.TuitionDbExtension.TDetailView', array(
        'data' => $tutor,
        'attributes' => array(
            array(
                'name' => 'Subjects',
                'value' => $tutor->levelSubjectTreeStr,
                'type' => 'raw'
            ),
            array(
                'name' => 'Hourly Rates',
                'value' => $tutor->hourlyRatesStr,
                'type' => 'raw'
            ),
            array(
                'name' => 'Tutoring Locations',
                'value' => $tutor->locationsStr,
            ),
            array(
                'name' => 'Available timeslots',
                'value' => $scheduleStr,
                'type' => 'raw'
            ),
        ),
        'htmlOptions' => array(
            'id' => 'tutoring-info-table'
        )
    ));
    echo CHtml::link('Update', array('/tutor/updateTutoring'), array(
        'class'=>'btn button',
        'style'=>'width: 80px;'
    ));?>
</div>