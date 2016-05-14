
// Adjust thumbnails
$(window).load(function() {
    $('.thumbnail-frame img').each(adjustThumb);
});

$(document).ready(function(){
        
    
    // Init FancyBox
    $(".fancybox").fancybox({
        helpers: {
            thumbs: {
                width: 50,
                height: 50,
            }
        }
    });
    
    // List filter
    $('#btn-toggle-filter').click(function(){
        if ($('#list-filter-form').css('display') == 'none') {
            $('#list-filter-form').slideDown();
            $(this).text('Hide Search');
        } else {
            $('#list-filter-form').slideUp();
            $(this).text('Show Search');
        }
    });
    
    // Tutor education information page
    
    
    // Tutor Qualification page
    $('#ta-experience-style').keyup(function() {
        $('#character-count').html($(this).val().length);
    });
    
        
    // Requestor's own assignment view page
    $('.btn-reject-app').click(function(){
        if (confirm('Are you sure? This can\'t be undone.')) {
            var $this = $(this);
            var id = $this.attr('appId');
            $.post('/assignment/reject?id=' + id,null,function(data){
                if (data.status == 1) {
                    $this.parents('.tutor-app-item').find('.app-status').html(data.newState);
                    $this.parents('.tutor-assignment-item').find('.app-status').html(data.newState);
                    $this.parents('.btn-box').find('a.btn-reject-app, a.btn-accept-app').detach();
                } else if (data.message) {
                    alert(data.message);
                }
            });
        }
    });
    
    if ($('.assignment-list').length > 0) {
        adjustHeight();
        $(document).ajaxComplete(adjustHeight);
    }
});

// Adjust height of the items in assignment list
function adjustHeight() {
    $('.assignment-item:nth-child(2n)').each(function(){
        var leftItem = $(this).prev();
        var height = leftItem.height() > $(this).height() ? leftItem.height() : $(this).height();
        $(this).height(height);
        leftItem.height(height);
    });
}
    
// Add tutor to Favorite
function addFavorite(tutorId){
    $.post('/requestor/ajaxAddFavorite', {tutorId: tutorId}, function(data){
        if (data.status) {
            $("#tutor-item-" + tutorId + " .btn-box").append('<span class="button disabled favorite-btn pull-right">FAVORITE</span>');
            $("#tutor-item-" + tutorId + " .btn-box .btn-add-favorite").detach();
        }
    });
}

// Remove tutor from Favorite
function removeFavorite(tutorId){
    $.post('/requestor/ajaxRemoveFavorite', {tutorId: tutorId}, function(data){
        if (data.status) {
            $("#tutor-item-" + tutorId).detach();
        }
    });
}

function acceptApplication(appId) {
    console.log("btn-accept-app CLICKED");
    $.post('/assignment/accept?id=' + appId,null,function(data){
        if (data.status == 1) {
            window.location = data.redirect;
        } else {
            if (data.message) {
                alert(data.message);
            }
        }
    });
}