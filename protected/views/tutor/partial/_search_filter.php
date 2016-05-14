<div class="caption-band form">
    <div class="inner-container">
        <a href="javascript:void(0);" id="btn-toggle-filter"><?= $showFilter?'Hide Search':'Show Search'?></a>
        <div class="filter-caption">Find Your <span class="highlight">Tutor</span></div>
        <form id="list-filter-form" class="form-horizontal <?= $showFilter ? '' : 'hide'?>" action="" method="post">
            <div class="filter-column">
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
                <div class="control-group">
                    <label class="control-label">Schedules</label>
                    <div class="controls">
                        <select id="time-slot-select" name="Schedule[]" multiple="">
                            <?php
                                $sheduleTree = DictSchedule::getScheduleTree();
                                foreach ($sheduleTree as $weekday => $slots) {
                                    echo "<optgroup label=\"$weekday\">";
                                    foreach ($slots as $id=>$name) {
                                        echo "<option value=\"$id\">$name</option>";
                                    }
                                    echo "</optgroup>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label for="Filter_gender" class="control-label">Tutor Gender</label>
                    <div class="controls">
                        <?= CHtml::dropDownList('Filter[gender]', $selectedGender, array(99=>'No Preference') + Lookup::items(Lookup::TYPE_GENDER), array('style'=>'height:36px')) ?>
                    </div>
                </div>
            </div>
            <div class="filter-column" style="margin-left: 90px;">
                <div class="control-group">
                    <label for="Filter_race" class="control-label">Tutor Race</label>
                    <div class="controls">
                        <?= CHtml::dropDownList('Filter[race]', $selectedRace, array(99=>'No Preference') + Lookup::items(Lookup::TYPE_RACE), array('style'=>'height:36px')) ?>
                    </div>
                </div>
                <div class="control-group">
                    <label for="Filter_qualification" class="control-label">Min Qualification</label>
                    <div class="controls">
                        <?= CHtml::dropDownList('Filter[qualification]', $selectedQualification, array('Choose Qualification') + DictTutorQualification::getAllTutorQualifications(), array('style'=>'height:36px'))?>
                    </div>
                </div>
                <div class="control-group">
                    <label for="Filter_credential" class="control-label">Teaching Credential</label>
                    <div class="controls">
                        <?= CHtml::dropDownList('Filter[credential]', $selectedCredential, array(0=>'No Preference', 1=>'Prefer either trainee, current or ex school teacher'), array('style'=>'height:36px'))?>
                    </div>
                </div>
                <button name="btn-filter" type="submit" id="btn-filter">Search</button>
            </div>
            <div class="clear"></div>
        </form>
    </div>
</div>


<script>
    $("#subject-select").val(<?=CJSON::encode($selectedSubjects)?>).trigger("change");
    $('#mrt-station-select').val(<?=CJSON::encode($selectedMrtStations)?>).trigger("change");
    $('#time-slot-select').val(<?=CJSON::encode($selectedSchedules)?>).trigger("change");
</script>