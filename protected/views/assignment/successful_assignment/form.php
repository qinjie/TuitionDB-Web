<?php

?>
<div class="inner-container">
    <div class="item-name">Payment of <?=CHtml::link($tutor->fullName,array('tutor/view','id'=>$tutor->id),array('class'=>'underline'))?> 
        for <?=CHtml::link($assignment->title,array('assignment/view','id'=>$assignment->id),array('class'=>'underline'))?></div>

    <div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'successful-assignment-form',
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        'enableAjaxValidation' => false,
    ));
    ?>
        <div class="control-group">
            <label for="SuccessfulAssignment_startDate" class="control-label">Start Date</label>
            <div class="controls">
                <?php
                $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
                    'name' => 'SuccessfulAssignment[startDate]',
                    'value'=>$successfulAssign->startDate,
                    'pluginOptions' => array(
                        'format' => 'yyyy-mm-dd'
                    )
                ));?>
            </div>
        </div>
    <?php
    echo $form->textFieldControlGroup($successfulAssign,'feePayable');
    echo $form->textFieldControlGroup($successfulAssign,'feePaid');
    ?>
        <div class="control-group">
            <label for="SuccessfulAssignment_paymentDate" class="control-label">Payment Date</label>
            <div class="controls">
                <?php
                $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
                    'name' => 'SuccessfulAssignment[paymentDate]',
                    'value'=>$successfulAssign->paymentDate,
                    'pluginOptions' => array(
                        'format' => 'yyyy-mm-dd'
                    )
                ));?>
            </div>
        </div>
    <?= $form->dropdownListControlGroup($successfulAssign,'paymentModeCode',Lookup::items(Lookup::TYPE_PAYMENT_MODE))?>
    <?php
    echo TbHtml::submitButton('Submit', array(
        'color' => TbHtml::BUTTON_COLOR_PRIMARY,
        'class' => 'button submit-btn',
        'style' => 'margin-left: 180px'
    ));
    ?>
    <?php
    $this->endWidget();
    ?>
    </div>
</div>



