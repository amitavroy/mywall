/**
 * Created by amitav on 2/13/16.
 */
/**
 * This is the functionality of cropping image
 * using the jQuery plugin croppie.
 * Code sample taken from url:
 * http://stackoverflow.com/questions/34237020/jquery-plugin-croppie-to-crop-image-error
 * @type {{init}}
 */
var cropAdImage = (function() {
    var uploadCrop = {};
    var cSettings;

    var init = function(settings) {
        cSettings = settings;

        initCroppie();
        registerUploadChange();
        registerUploadImage();
    };

    /*initialize croppie*/
    var initCroppie = function() {
        uploadCrop = $(cSettings.container).croppie({
            viewport: {
                width: (cSettings.width) ? cSettings.width : 200,
                height: (cSettings.height) ? cSettings.height : 200,
                type: (cSettings.type) ? cSettings.type : 'circle',
            },
            boundary: {
                width: (cSettings.width) ? cSettings.width + 100 : 300,
                height: (cSettings.height) ? cSettings.height + 100 : 300
            }
        });
    };

    /*register the upload change*/
    var registerUploadChange = function() {
        $(cSettings.inputField).on('change', function() {
            readFile(this);
        });
    };

    /*register the on click of upload and close*/
    var registerUploadImage = function() {
        $(cSettings.button).on('click', function(ev) {
            uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'original'
            }).then(function(resp) {
                $(cSettings.hiddenInputField).val(resp);
                var image = new Image();
                image.src = resp;
                $(cSettings.resultContainer).html(image);
            });
        });
    }

    /*Read file*/
    var readFile = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                uploadCrop.croppie('bind', {
                    url: e.target.result
                });
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    /*Exposing the public api for this feature*/
    return {
        init: init
    }

})();
