jQuery(document).ready(function ($) {
    $('body').prepend('<a href="#main-content" class="skip-to-content">Skip to main content</a>');

    $(document).on('keydown', function (e) {
        if (e.key === 'Tab') {
            $('.skip-to-content').show().focus();
        }
    });

    $('.skip-to-content').on('blur', function () {
        $(this).hide();
    });
});