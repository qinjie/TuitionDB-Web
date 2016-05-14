<?php echo $form->dropdownListControlGroup($assignment, 'tutorGenderCode', array(99=>'No Preference') + Lookup::items('gender'), array('span' => 2))?>
<?php echo $form->dropdownListControlGroup($assignment, 'tutorRaceCode', array(99=>'No Preference') + Lookup::items('race'), array('span' => 2))?>
<?php echo $form->dropdownListControlGroup($assignment, 'minQualificationId', array(99=>'No Preference') + DictTutorQualification::getAllTutorQualifications(), array('span' => 2))?>
<?php echo $form->dropdownListControlGroup($assignment, 'teachingCredential', array(99=>'No Preference',1=>'Prefer either trainee, current or ex school teacher'), array('span' => 2))?>
    