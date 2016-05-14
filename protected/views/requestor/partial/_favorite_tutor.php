<?php
/* @var $this RequestorController */
/* @var $tutor Tutor */
?>

<div class="box view">
    <img class="profile-photo" src="<?php echo $tutor->getPhotoData() ?>"/>
    <table>
        <tr>
            <th width="150">Name</th>
            <th>
                <a href="<?=$this->createAbsoluteUrl('tutor/view', array('id'=>$tutor->id))?>">
                    <?=CHtml::encode($tutor->fullName)?>
                </a>
            </th>
        </tr>
        <tr>
            <th>Age</th>
            <td><?=$tutor->ageStr?></td>
        </tr>
        <tr>
            <th>Background</th>
            <td><?=$tutor->backgroundStr?></td>
        </tr>
    </table>
</div>
