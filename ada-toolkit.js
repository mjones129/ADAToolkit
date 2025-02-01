jQuery(document).ready(function ($) {
    // Create the skip link
    var skipLink = $('<a>', {
        href: '#main-content',
        text: 'Skip to main content',
        class: 'skip-link',
        style: 'position:absolute;top:-40px;left:0;background:#000;color:#fff;padding:8px;z-index:1000;'
    });

    // Append the skip link to the body
    $('body').prepend(skipLink);

    // Show the skip link when the Tab key is pressed
    $(document).on('keydown', function (e) {
        if (e.key === 'Tab') {
            skipLink.css('top', '0');
        }
    });

    // Hide the skip link when it loses focus
    skipLink.on('blur', function () {
        skipLink.css('top', '-40px');
    });
});