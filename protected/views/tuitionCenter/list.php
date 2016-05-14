<?php

?>
<div class="caption-band form">
    <div class="inner-container">
        <a href="javascript:void(0);" id="btn-toggle-filter"><?= $showFilter?'Hide Search':'Show Search'?></a>
        <div class="filter-caption">Find  <span class="highlight">Tuition Centre</span></div>
        <form id="list-filter-form" class="form-horizontal <?= $showFilter ? '' : 'hide'?>" action="" method="post">
            <div class="filter-column">
                <!-- Tuition Center Name  -->
                <div class="control-group">
                    <label for="center-name" class="control-label">Tuition Centre Name</label>
                    <div class="controls">
                        <input type="text" id="center-name" name="Filter[CenterName]" value="<?=$centerName?>" style="width: 318px; height: 24px; margin-bottom: 13px; padding: 5px">
                    </div>
                </div>
                <!-- Tuition Class Level  -->
                <div class="control-group">
                    <label class="control-label">Tuition Class Level</label>
                    <div class="controls">
                        <?=CHtml::dropDownList('ClassLevel', null, DictClassLevel::getClassLevels(),array('multiple'=>'multiple','id'=>'class-level-select'))?>
                    </div>
                </div>
                <!--  Subjects  -->
                <div class="control-group">
                    <label class="control-label">Subjects</label>
                    <div class="controls">
                        <select id="subject-select" name="Subject[]" multiple="">
                            <?php
                                $subjectTree = DictSubject::getSubjectTree();
                                foreach ($subjectTree as $catName => $subjects) {
                                    echo "<optgroup label=\"$catName\">";
                                    foreach ($subjects as $id=>$name) {
                                        if ($id != "categoryId")
                                            echo "<option value=\"$id\">$name</option>";
                                    }
                                    echo "</optgroup>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="filter-column" style="margin-left: 90px;">
                <!-- Weekday  -->
                <div class="control-group">
                    <label for="Filter_subjects" class="control-label">Weekday</label>
                    <div class="controls">
                        <?=CHtml::dropDownList('Weekday', null, Helper::getWeekdayArray(),array('multiple'=>'multiple','id'=>'center-weekday-select'))?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Nearest MRT Stations</label>
                    <div class="controls">
                        <select id="mrt-station-select" name="MrtStation[]" multiple="">
                            <?php
                                $stationTree = DictMrtStation::getStationTree();
                                foreach ($stationTree as $mrtLine => $stations) {
                                    echo "<optgroup label=\"$mrtLine\">";
                                    foreach ($stations as $id=>$name) {
                                        echo "<option value=\"$id\">$name</option>";
                                    }
                                    echo "</optgroup>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <button name="btn-filter" type="submit" id="btn-filter">Search</button>
            </div>
            <div class="clear"></div>
        </form>
    </div>
</div>


<script>
    $("#class-level-select").val(<?=CJSON::encode($selectedClassLevels)?>).trigger("change");
    $("#center-weekday-select").val(<?=CJSON::encode($selectedWeekdays)?>).trigger("change");
    $("#subject-select").val(<?=CJSON::encode($selectedSubjects)?>).trigger("change");
    $('#mrt-station-select').val(<?=CJSON::encode($selectedMrtStations)?>).trigger("change");
</script>

<div class="inner-container">
    <div class="title">Our <span class="highlight">Tuition</span> Centres</div>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'template' => '{items}{pager}',
        'ajaxUpdate' => false,
    'pager' => array(
        'class' => 'bootstrap.widgets.TbPager',
        'prevPageLabel' => 'Prev',
        'nextPageLabel' => 'Next',
        'hideFirstAndLast' => true,
        'htmlOptions' => array(
            'class' => 'list-pager'
        )
    )
));?>
</div>