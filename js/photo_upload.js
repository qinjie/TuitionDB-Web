const ratio = 400/514;
var jcrop_api;
    
$().ready(function(){
    // Profile photo upload
    var firstTime = true;
    $('#photo-upload').change(function() {
        
        var id = $(this).attr('id');
        var file = $(this)[0].files[0];
        var imageRegex = /image.*/;
        if (!file.type.match(imageRegex)) {
            alert('File type invalid. You must upload an image file.');
            return;
        }
//        if (file.size > 512000) {
//            alert('File too large. File size must be less than 500KB.');
//            return;
//        }
        var $pimg, orinX, orinY, holderX, holderY, previewY = $('#preview-pane .preview-container').height();
        var picture = document.getElementById('profile-photo');
        $(picture).removeAttr('style');
        picture.onload = function() {
            $pimg = $(this);
            setTimeout(function(){
                orinX = $pimg.width();
                orinY = $pimg.height();
                console.log(orinX, orinY);
            },50);
        };
        
        // Display the selected photo
        var url = window.URL.createObjectURL(file);
        picture.src = url;
        
        // Crop photo
        var cropImage = document.getElementById('photo-preview');
        cropImage.onload = function() {
            destroyJcrop();
            $this = $(this);
            setTimeout(function(){
                $this.Jcrop({
                    aspectRatio: ratio,
                    boxHeight: 380,
                    boxWidth: 600,
                    bgOpacity: 0.5,
                    bgColor: 'white',
                    addClass: 'jcrop-light',
                    bgFade: true,
                    onChange: updatePreview,
                    onSelect: updateInputs,
                    allowSelect: false,
                    trueSize: [orinX,orinY],
                }, function(){
                    jcrop_api = this;
                    holderX = $('.jcrop-holder img').width();
                    holderY = $('.jcrop-holder img').height();
                    jcrop_api.ui.selection.addClass('jcrop-selection');
                    // Set initial select
                    var x,y,x2,y2;
                    if (orinX / orinY > ratio) {
                        y  = 0;
                        y2 = orinY;
                        x  = (orinX - orinY*ratio)/2;
                        x2 = orinY*ratio;
                    } else {
                        x = 0;
                        x2 = orinX;
                        y = (orinY - orinX/ratio)/2;
                        y2 = orinX/ratio;
                    }
                    jcrop_api.setSelect([x,y,x2,y2]);
                    updatePreview(jcrop_api.tellSelect());
                });
            },100);
        };
        $('#crop-modal').modal({
            show: true,
            backdrop: 'static'
        });
        cropImage.src = url;
        if (firstTime) {
            cropImage.src = url;
            firstTime = false;
        }
        
        function updatePreview(c) {
            if (parseInt(c.h) > 0) {
                var r = previewY / c.h;
                console.log('orinX: ' + orinX + ' holderX: ' + holderX + ' holderY: ' + holderY + ' previewY: ' + previewY + ' c.w: ' + c.w);
                console.log(c.x, c.y);
                $pimg.css({
                    width : Math.round(r * orinX) + 'px',
                    height: Math.round(r * orinY) + 'px',
                    marginLeft: '-' + Math.round(c.x * r) + 'px',
                    marginTop : '-' + Math.round(c.y * r) + 'px'
                });
            }
        };
        
        function updateInputs(c) {
            $('#crop-x').val(Math.round(c.x));
            $('#crop-y').val(Math.round(c.y));
            $('#crop-x2').val(Math.round(c.x2));
            $('#crop-y2').val(Math.round(c.y2));
        }
        
        function destroyJcrop() {
            if (jcrop_api){
                jcrop_api.destroy();
            }
            $('#photo-preview, #profile-photo').removeAttr('style');
        }
    });
    
});
    