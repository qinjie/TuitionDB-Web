<?php echo $form->dropdownListControlGroup($assignment, 'lessonPerMonth', array('2'=>2,'4'=>4,'8'=>8,'12'=>12,'16'=>16,'20'=>20), array('span' => 1))?>
<?php echo $form->dropdownListControlGroup($assignment, 'hourPerLesson', array('1'=>1,'1.5'=>1.5,'2'=>2,'2.5'=>2.5,'3'=>3,'4'=>4), array('span' => 1))?>
<?php echo $form->textFieldControlGroup($assignment, 'budgetRate', array('span' => 1, 'maxlength' => 10)); ?> 
<?php echo $form->textAreaControlGroup($assignment, 'remark', array('span' => 5, 'maxlength' => 500)); ?> 
    