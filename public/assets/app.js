$(function() {
    "use strict";

    function showHelpMessageIfNecessary() {
        if( $('.no-results').is(':visible') ) {
            $('.tap-target').tapTarget('open');
        }
    }

    showHelpMessageIfNecessary();
});