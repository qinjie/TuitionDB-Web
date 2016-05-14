<?php
/* @var $this UserController */
/* @var $subjects array */
/* @var $hrates array */
/* @var $error string */
$this->renderPartial('registerAsTutor/partial/_register_caption');
?>
<div class="form-container">
    
    <?php if ($error):?>
        <div class="alert alert-error form-alert" style="width: 570px">
            <?php echo $error; ?>
        </div>
    <?php endif;?>
    
    <div class="form-block" style="width: 600px">
        
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'subject-hourly-rate-form',
            'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
            'enableAjaxValidation' => false,
        ));
        ?>

        <h4>Choose subjects</h4>
        <p class="hint">Please choose the subjects you want to teach.</p>

        <table class="table table-condensed" id="subject-select-group" style="width:580px">
            <tr class="table-header">
                <th style="width: 250px;">Category</th>
                <th style="width: 300px;">Subject</th>
            </tr>
            <tr class="input-controls">
                <td>
                    <select id="category-select" name="subject-category" style="width: 100%;">
                        <option value="0">Choose category</option>
                    </select>
                </td>
                <td>
                    <select id="subject-select" name="subject" style="width: 100%;" disabled>
                        <option value="0">Choose subject</option>
                    </select>
                </td>
                <td></td>
            </tr>
            <?php
            foreach ($subjects as $subject) {
                $this->renderPartial('registerAsTutor/partial/_row_tutor_subject', array('subject' => $subject));
            }
            ?>
        </table>
        <br>
        <h4>Hourly rates</h4>
        <p class="hint">If you leave the hourly rate blank, it's negotiable.</p>
        <?php
        $categories = DictCategory::getCategories();
        ?>
        <table class="table table-condensed" id="table-hourly-rate" style="width:auto; margin-bottom: 10px;">
            <tr></tr>
            <tr>
                <th style="width: 250px">Category</th>
                <th style="width: 200px">Hourly rate</th>
            </tr>
            <?php
            foreach ($hourlyRates as $hrate) {
                $this->renderPartial('registerAsTutor/partial/_row_tutor_hrate', array('hrate' => $hrate, 'form' => $form));
            }?>
        </table>

        <?=CHtml::submitButton('Next', array(
            'class'=>'green-btn submit-btn',
            'style'=>'margin-left: 258px; width: 312px;'
        ));?>
        <?php $this->endWidget(); ?>
    </div>
</div>
