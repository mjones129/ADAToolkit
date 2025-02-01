jQuery(document).ready(function ($) {
    var darkModeToggle = $('<div class="dark-mode-toggle"><label class="switch"><input type="checkbox" id="dark-mode-toggle"><span class="slider round"></span></label><div>Enable Dark Mode</div></div>');
    $('body').append(darkModeToggle);

    $('#dark-mode-toggle').on('change', function () {
        if ($(this).is(':checked')) {
            $('body').addClass('dark-mode');
        } else {
            $('body').removeClass('dark-mode');
        }
    });

    if ($('body').hasClass('dark-mode')) {
        $('#dark-mode-toggle').prop('checked', true);
    }
});