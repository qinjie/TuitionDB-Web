//Javascript for the input controls

$(document).ready(function(){
    
    $('input, select, textarea').tooltip();
    
    // Checkbox
    $('input[type=checkbox]').change(function(){
        $label = $(this).parent();
        if ($(this).is(':checked')) {
            $label.css('background-position','0 -17px');
        } else {
            $label.css('background-position','0 0');
        }
    });
    $('input[type=checkbox]').change();
    
    // Subjects add & remove page of TUTOR
    if ($('#category-select').length > 0) {
        
        var subjects;
        $.get('/TutorsHub/ajax/subjectTree',function(data){
            subjects = data;
            for (var category in subjects) {
                $('#category-select').append('<option value="' + category + '">' + category + '</option>');
            }
        });
        
        
        $('#category-select').change(function() {
            $('#subject-select').html('<option value="0">Choose Subject</option>');
            var category = $(this).val();
            if (category == 0) {
                $('#subject-select').prop('disabled',true);
            } else {
                $('#subject-select').prop('disabled',false);
            }
            for (var subjectId in subjects[category]) {
                if (subjectId != 'categoryId') {
                    $('#subject-select').append('<option value="' + subjectId + '">' + subjects[category][subjectId] + '</option>');
                }
            }
        });
        
        var lastSubject = 0;
        var lastHrate = 0;
        $('#subject-select').change(function() {
            var category = $('#category-select').val(); // get category name
            var subjectId = $(this).val();
            if (category && subjectId != 0) {
                // Check if this subject is already added
                if ($('#subject-row-' + subjectId).length == 0) {
                    $('table#subject-select-group .input-controls').after(
                            '<tr class="item-row subject-row" id="subject-row-' + subjectId + '" catId="' + subjects[category].categoryId + '">'
                            + '<td>' + category + '</td>'
                            + '<td>' + $('#subject-select option[value="' + subjectId + '"]').text() 
                            + '<a href="javascript:void(0);" class="btn-remove" onclick=removeSubject(' + subjectId + ')><span class="icon-remove"></span>Remove</a></td>'
                            + '<input type="hidden" name="Subject[newRow' + (++lastSubject) + ']" value="' + subjectId + '">'
                            + '</tr>');
                    // Add new row to hourly rate table if the added subject is the first of its category
                    var categoryId = subjects[category].categoryId;
                    if ($('#hourly-rate-row-' + categoryId).length == 0) {
                        $('#table-hourly-rate').append(
                            '<tr class="hourly-rate-row" id="hourly-rate-row-' + categoryId + '">'
                            + '<td style="vertical-align: middle;">' + category + '</td>'
                            + '<td><input type="text" class="hourly-rate-input" name="HRate[' + categoryId + ']" onfocusout="formatHourlyRate(this)" style="width: 100%"></td></tr>'
                        );
                        $('#hourly-rate-row-' + categoryId + ' .hourly-rate-input').focusout(function(){
                            formatHourlyRate($(this));
                        });
                    }
                }
                $('#subject-message').text('');
            }
        });
    }
    // Format hourly rate to 2 decimal digits
    $('.hourly-rate-input').focusout(function(){
        formatHourlyRate($(this));
    });
    
    if ($('#mrt-line-select').length > 0) {
        var stations;
        $.get('/TutorsHub/ajax/stationTree',function(data){
            stations = data;
            for (var mrtLine in stations) {
                $('#mrt-line-select').append('<option value="' + mrtLine + '">' + mrtLine + '</option>');
            }
            $('#mrt-line-select').change(function() {
                $('#mrt-station-select').html('<option value="0">Choose MRT station</option>');
                var mrtLine = $(this).val();
                if (mrtLine == 0) {
                    $('#mrt-station-select').prop('disabled',true);
                } else {
                    $('#mrt-station-select').prop('disabled',false);
                }
                for (var stationId in stations[mrtLine]) {
                    $('#mrt-station-select').append('<option value="' + stationId + '">' + stations[mrtLine][stationId] + '</option>');
                }
            });
            var lastStation = 0;
            $('#mrt-station-select').change(function() {
                var mrtLine = $('#mrt-line-select').val();
                var stationId = $(this).val();
                if (stationId > 0) {
                    // Check if this station is already added
                    if ($('#station-row-' + stationId).length == 0) {
                        $('table#location-select-group .input-controls').after(
                                '<tr class="item-row"  id="station-row-' + stationId + '">'
                                + '<td>' + mrtLine + '</td>'
                                + '<td>' + $('#mrt-station-select option[value="' + stationId + '"]').text() 
                                + '<a href="javascript:void(0);" class="btn-remove" onclick=removeMrtStation(' + stationId + ')><span class="icon-remove"></span>Remove</a></td>'
                                + '<input type="hidden" name="Station[newRow' + (++lastStation) + ']" value="' + stationId + '">'
                                + '</tr>');
                    }
                    $('#mrt-message').text('');
                }
            });
        });
    }
    
    // Time slot select
    if ($('#weekday-select').length > 0) {
        // For time slot select
        var slots;
        $.get('/TutorsHub/ajax/scheduleTree',function(data){
            slots = data;
            for (var weekday in slots) {
                $('#weekday-select').append('<option value="' + weekday + '">' + weekday + '</option>');
            }
        });
        var lastSlotIndex;
        $('#timeslot-select').change(function(){
            lastSlotIndex = $('#timeslot-select option:selected').index();
        });
        $('#weekday-select').change(function() {
            if ($(this).val() == 0) {
                $('#timeslot-select').prop('disabled',true);
            } else {
                $('#timeslot-select').prop('disabled',false);
            }
            $('#timeslot-select').html('');
            var weekday = $(this).val();
            var i = 0;
            var selectSlot;
            for (var slotId in slots[weekday]) {
                $('#timeslot-select').append('<option value="' + slotId + '">' + slots[weekday][slotId] + '</option>');
                if (i === lastSlotIndex) {
                    selectSlot = slotId;
                }
                i++;
            }
            setTimeout(function(){
                $('#timeslot-select').val(selectSlot);
            },50);
        });
        var lastTimeSlot = 0;
        $('#btn-add-slot').click(function() {
            var weekday = $('#weekday-select').val();
            var slotId = $('#timeslot-select').val();
            if (slotId > 0) {
                // Check if this slot is already added
                if ($('#timeslot-row-' + slotId).length == 0) {
                    $('table#timeslot-select-group').append(
                            '<tr class="timeslot-row"  id="timeslot-row-' + slotId + '">'
                            + '<td>' + weekday + '</td>'
                            + '<td>' + $('#timeslot-select option[value="' + slotId + '"]').text() + '</td>'
                            + '<td><a href="javascript:void(0);" class="btn-remove-timeslot" onclick=removeTimeSlot(' + slotId + ')>Remove</a></td>'
                            + '<input type="hidden" name="TimeSlot[]" value="' + slotId + '">'
                            + '</tr>');
                }
                $('#timeslot-message').text('');
            }
        });
    }
    
    // Time slot select, new style
    if ($('#weekday-select-new').length > 0) {
        var allSlots;
        $.get('/TutorsHub/ajax/scheduleTreeNew',function(data){
            allSlots = data;
        });
        $('#btn-add-slot-new').click(function(){
            var weekdays = $('#weekday-select-new').val();
            var slots = $('#timeslot-select-new').val();
            console.log(allSlots);
            console.log(weekdays,slots);
            for (var weekday in weekdays) {
                var weekdayLabel = weekdays[weekday];
                for (var slot in slots) {
                    var slotLabel = slots[slot];
                    var slotId = allSlots[weekdayLabel][slotLabel];
                    console.log(weekday,slot);
                    console.log(weekdayLabel,slotLabel,slotId);
                    // Check if this slot is already added
                    if ($('#timeslot-row-' + slotId).length == 0) {
                        $('table#timeslot-select-group').append(
                            '<tr class="item-row"  id="timeslot-row-' + slotId + '">'
                                + '<td>' + weekdayLabel + '</td>'
                                + '<td>' + slotLabel + '<a href="javascript:void(0);" class="btn-remove" onclick=removeTimeSlot(' + slotId + ')><span class="icon-remove"></span>Remove</a></td>'
                            + '<input type="hidden" name="TimeSlot[]" value="' + slotId + '">'
                            + '</tr>');
                    }
                    $('#timeslot-message').text('');
                }
            }
        });
    }
    
    if ($('#student-info-form').length > 0) {
        // Current School auto complete
        var schoolList;
        $.get('/TutorsHub/ajax/schoolList',function(data){
            schoolList = data;
            $('#Assignment_currentSchool').typeahead({'source':schoolList,'items':20, 'minLength':1});
        });
    }
    
    // Tutor education information page:
    // Input Tutor school
//        var schoolList;
//        $.get('/TutorsHub/ajax/schoolList',function(data){
//            schoolList = data;
//            $('.input-school').typeahead({'source':schoolList,'items':20, 'minLength':1});
//        });
    var lastSchool = $('.school-item').length;
    $('#btn-add-school').click(function(){
        if ($('#TutorSchool_school').val() && $('#TutorSchool_course').val()) {
            lastSchool++;
            $('#table-tutor-school').show().append(
                '<tr class="school-item" id="school-item-newRow' + lastSchool + '">' +
                    '<td>' + $('#TutorSchool_school').val() + '</td>' +
                    '<td>' + $('#TutorSchool_course').val() + '</td>' +
                    '<td>' + $('#TutorSchool_achievement').val() + '</td>' +
                    '<td><a href="javascript:void(0)" onclick="removeSchool(\'newRow' + lastSchool + '\')">Remove</a></td>' +
                    '<input type="hidden" name="School[newRow' + lastSchool + '][school]" value="' + $('#TutorSchool_school').val() + '">' + 
                    '<input type="hidden" name="School[newRow' + lastSchool + '][course]" value="' + $('#TutorSchool_course').val() + '">' + 
                    '<input type="hidden" name="School[newRow' + lastSchool + '][achievement]" value="' + $('#TutorSchool_achievement').val() + '">' + 
                '</td>'
            );
            $('#TutorSchool_school').val('');
            $('#TutorSchool_course').val('');
            $('#TutorSchool_achievement').val('');
            setTimeout(function(){
                $('.school-form  .error, .school-form  .success').removeClass('error success');
                $('.school-form .help-block').hide();
            },500);
        }
    });
//    var last
//    $('.button-add-subject').click(function(){
//        var examCode = $(this).attr('examCode'), 
//            subjectId = $('#exam-subject-' + examCode).val(),
//            grade = $('#exam-grade-' + examCode).val();
//        if (subjectId != 0 && trim(grade).length > 0) {
//            $('#result-table-' + examCode).append(
//                '<tr class="subject-row subject-row-' + examCode + '" id="subject-row-<?= $id ?>">' + 
//                    '<td><?=DictSubject::getSubjectLabel($tutorExamResult->dictSubjectId)?></td>' +
//                    '<td><?=$tutorExamResult->grade?></td>' + 
//                    '<td><a href="javascript:void(0);" class="btn-remove-exam-grade" id="btn-remove-exam-grade-<?= $id ?>" onclick="removeExamResult('<?= $id ?>')">Remove</a></td>' +
//                '</tr>'
//            );
//        }
//    });
    
    // Search Filter
    if ($('#list-filter-form').length > 0) {
        $('#class-level-select').select2({
            placeholder: 'Select class level',
        });
        $('#center-weekday-select').select2({
            placeholder: 'Select weekday',
        });
        $('#subject-select').select2({
            placeholder: 'Select subject',
        });
        $("#mrt-station-select").select2({
            placeholder: "Select MRT stations",
        });
        $('#time-slot-select').select2({
            placeholder: "Select time slots",
        });
    }
    
    // Student Level & Subjects select for ASSIGNMENT
    if ($('#student-info-form').length > 0) {
        $('#subject-select').select2({
            placeholder: 'Select subject',
        });
        var subjects;
        function populateLevelSelect() {
            for (var category in subjects) {
                $('#level-select').append('<option value="' + subjects[category].categoryId + '">' + category + '</option>');
            }
        }
        function populateSubjectSelect($catSelect) {
            var category = $catSelect.children('option:selected').text();
            $('#subject-select').html('');
            var subjectsHTML = '';
            for (var subjectId in subjects[category]) {
                if (subjectId !== 'categoryId') {
                    subjectsHTML += '<option value="' + subjectId + '">' + subjects[category][subjectId] + '</option>';
                }
            }
            $("#subject-select").html(subjectsHTML);
        }
        $.get('/TutorsHub/ajax/subjectTree',function(data){
            subjects = data;
            if ($('#level-select option').length == 1) populateLevelSelect();
            populateSubjectSelect($('#level-select'));
        });
        
        $('#level-select').change(function() {
            populateSubjectSelect($(this));
            $('#subject-select').select2('val','');
            if ($(this).val() == 0) {
                $('#subject-select').select2({
                    placeholder:'Select level first'
                });
                $('#subject-select').select2('disable');
            } else {
                $('#subject-select').select2({
                    placeholder:'Select subject',
                    sortResults: function(results,container,query) {
                        return results.sort(function(a,b){
                           if (a.text > b.text) {
                               return 1;
                           } else if (a.text < b.text) {
                               return -1;
                           } else {
                               return 0;
                           }
                        });
                    },
                });
                $('#subject-select').select2('enable');
            }
        });
//        $('#subject-select').change(function(){
//            var category = $('#level-select').children('option:selected').text(); // get category name
//            var subjectId = $(this).val();
//            if (subjectId != 0) {
//                // Check if this subject is already added
//                if ($('#subject-row-' + subjectId).length == 0) { 
//                    $('table#table-subjects').append(
//                            '<tr class="subject-row"  id="subject-row-' + subjectId + '" catId="' + subjects[category].categoryId +'">'
//                            + '<td>' + $('#subject-select option[value="' + subjectId + '"]').text() + '</td>'
//                            + '<td><a href="javascript:void(0);" class="btn-remove-subject" onclick=removeSubject(' + subjectId + ')>Remove</a></td>'
//                            + '<input type="hidden" name="Subject[]" value="' + subjectId + '">'
//                         + '</tr>');
//                }
//            }
//        });
    }
});

function formatHourlyRate($this) {
    var hrate = parseFloat($this.val());
    if (!isNaN(hrate)) {
        hrate = hrate.toFixed(2);
        $this.val(hrate);
    }
}

function removeMrtStation(stationID) {
    $('#station-row-' + stationID).detach();
}

function removeTimeSlot(slotId) {
    $('#timeslot-row-' + slotId).detach();
}

function removeSchool(id) {
    $('#school-item-' + id).detach();
    if ($('.school-item').length == 0) {
        $('#table-tutor-school').hide();
    }
}

function removeSubject(subjectId) {
    var categoryId = $('#subject-row-' + subjectId).attr('catId'); // get category id
    $('#subject-row-' + subjectId).detach();
    //Remove hourly rate row if there is no subject of current subject's category left
    if ($('.subject-row[catId=' + categoryId + ']').length == 0) {
        $('#hourly-rate-row-' + categoryId).detach();
    }
}

function removeExamResult(id) {
    $('#subject-row-' + id).detach();
}

function removeOtherSkill(id) {
    $('#other-skill-row-' + id).detach();
}