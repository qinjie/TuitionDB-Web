// Fix the thumbnail image to fix in a square frame, regardless of image's ratio
function adjustThumb(eventObject) {
//    var $this = $(eventObject.target
    var $this = $(this),
        theFrame = $this.parents('.thumbnail-frame').first();
    var frameWidth = theFrame.width(),
        frameHeight = theFrame.height();
    var frameRatio = frameWidth / frameHeight,
        imageRatio = $this.width() / $this.height();
    console.log('Adjust thumb ');
    if (imageRatio > frameRatio) {
        $this.css({
            width: frameWidth*imageRatio,
            height: frameHeight,
            left: -frameWidth*(imageRatio-1)/2,
            top: 0
        });
    } else {
        $this.css({
            width: frameWidth,
            height: frameHeight/imageRatio,
            top: -(frameHeight/imageRatio-frameHeight)/2,
            left: 0
        });
    }
}

// Compare the length of the input's value to a specified number. The input must be text or textarea
function validateMaxLength($input, maxLength) {
    try {
        if (!($input instanceof jQuery)) {
            $input = $($input);
        }
        if ($input.is('input') || $input.is('textarea')) {
            if ($input.val().length > maxLength) {
                $input.addClass('error');
                $input.attr({
                    "data-placement":"right",
                    "data-original-title":"Too long. Maximum is " + maxLength + " characters",
                    "data-toggle":"tooltip",
                });
                return false;
            } else {
                $input.removeClass('error');
                $input.attr({
                    "data-placement":null,
                    "data-original-title":null,
                    "data-toggle":null,
                });
                return true;
            }
        }
    } catch (err) {
        console.log(err.message, $input);
        return false;
    }
}



