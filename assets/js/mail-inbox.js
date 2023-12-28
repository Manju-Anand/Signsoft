// EMAIL INBOX
$(function () {
    'use strict'

    $(".clickable-row").on('click', function () {
        window.location = $(this).data("href");
    });
});
