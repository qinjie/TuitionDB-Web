<?php
/* @var $this UserController */
/* @var $user User */
/* @var $tutor Tutor */
$this->renderPartial('registerAsTutor/partial/_register_caption');
?>

<div class="form-container">
    
    <?php if ($user->hasErrors() || $tutor->hasErrors()):?>
        <div class="alert alert-error form-alert">
            <?php echo CHtml::errorSummary(array($user,$tutor)); ?>
        </div>
    <?php endif;?>
    
    <div class="form-block" style="width: 760px">

        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'register-as-tutor-form',
            'enableAjaxValidation' => false,
            'enableClientValidation' => false,
        ));
        
        echo $form->textFieldControlGroup($user, 'username', array('maxlength' => 254, 'placeholder'=>'Must be a valid email', 'groupOptions' => array('class' => 'mgr20'))); 
        echo $form->textFieldControlGroup($tutor, 'fullName', array('span' => 3, 'maxlength' => 255, 'placeholder'=>'Full name')); 
        echo $form->passwordFieldControlGroup($user, 'password', array('maxlength' => 40, 'groupOptions' => array('class' => 'mgr20'))); 
        echo $form->passwordFieldControlGroup($user, 'repeat_password', array('maxlength' => 40)); 
        echo $form->dropDownListControlGroup($tutor, 'genderCode', Lookup::items(Lookup::TYPE_GENDER), array('empty' => array(99=>'Select'), 'style'=>'width: 155px;', 'groupOptions' => array('class' => 'mgr20'))); 
        echo $form->textFieldControlGroup($tutor, 'yearOfBirth', array('maxlength' => 10, 'style'=>'width: 171px;', 'placeholder'=>'eg. 1990', 'groupOptions' => array('class' => 'mgr20'))); 
        echo $form->dropDownListControlGroup($tutor, 'raceCode', Lookup::items(Lookup::TYPE_RACE), array('empty' =>  array(99=>'Select'))); 
        echo $form->textFieldControlGroup($tutor, 'nationality', array('maxlength' => 100, 'placeholder'=>'Nationality', 'groupOptions' => array('class' => 'mgr20'))); 
        echo $form->textFieldControlGroup($tutor, 'passport', array('maxlength' => 20, 'placeholder'=>'NRIC/FIN/Passport')); 
        echo $form->textFieldControlGroup($tutor, 'mobilePhone', array('maxlength' => 20, 'placeholder'=>'Mobile Phone', 'groupOptions' => array('class' => 'mgr20'))); 
        echo $form->textFieldControlGroup($tutor, 'homeTel', array('maxlength' => 20, 'placeholder'=>'Home Tel')); 
        echo $form->textFieldControlGroup($tutor, 'homeAddress', array('maxlength' => 255, 'placeholder'=>'Home Address', 'groupOptions' => array('class' => 'mgr20'))); 
        echo $form->textFieldControlGroup($tutor, 'homePostal', array('maxlength' => 10, 'placeholder'=>'Postal Code')); 
        echo CHtml::submitButton('Next', array(
            'class' => 'green-btn submit-btn',
            'style' => 'margin-left: 380px',
        ));
        ?>

        <?php $this->endWidget(); ?>

    </div><!-- form -->
</div>
