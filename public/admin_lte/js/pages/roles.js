/**
 * Created by amitav on 3/14/16.
 */
var Roles = (function () {
    /**
     * Initialising the role application
     */
    var init = function () {
        $('#role-listing .fa-trash').on('click', function () {
            var confirmation = confirm('Are you sure you want to delete this?');

            if (confirmation === true) {
                return true;
            }

            return false;
        });
    };

    return {
        init: init
    }
})();
