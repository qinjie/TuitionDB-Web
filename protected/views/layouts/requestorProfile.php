<?php 
/* @var $this Controller */
$this->beginContent('//layouts/main'); ?>
<div class="inner-container row-fluid">
    <div class="span3" style="margin-left:0">
        <div id="sidebar-left" class="sidebar well" style="padding: 8px 0; margin-top: 60px;">
            <?php
            $this->widget('bootstrap.widgets.TbMenu', array(
                'type'=>'list',
                'items'=>array(
                    array('label'=>'PROFILE'),
                    array('label'=>'View My Profile',
                        'icon'=>'list',
                        'url'=>Yii::app()->baseUrl.'/requestor/profile',
                        'active'=>Yii::app()->controller->action->getId() == 'profile',
                    ),
                    array('label'=>'Update Personal Information',
                        'icon'=>'list-alt',
                        'url'=>Yii::app()->baseUrl.'/requestor/updateProfile',
                        'active'=>Yii::app()->controller->action->getId() == 'updateProfile',
                    ),
                    array('label'=>'Change Password',
                        'icon'=>'list-alt',
                        'url'=>Yii::app()->baseUrl.'/user/passwordChange',
                        'active'=>Yii::app()->controller->action->getId() == 'passwordChange',
                    ),
                )
            ));
            ?>
        </div><!-- sidebar -->
    </div>
    <div class="span9 last">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
    <?php $this->endContent(); ?>
</div>