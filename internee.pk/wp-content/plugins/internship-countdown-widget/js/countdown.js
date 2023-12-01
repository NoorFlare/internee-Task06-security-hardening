jQuery(document).ready(function ($) {
    $('.internship-countdown-widget').each(function () {
        var widget = $(this);
        var deadline = widget.data('deadline');

        function updateCountdown() {
            var now = new Date().getTime();
            var timeRemaining = Date.parse(deadline) - now;

            var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
            var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

            var countdownText = '<b>Open Now:</b><br/>' + days + 'd ' + hours + 'h ' + minutes + 'm ' + seconds + 's ' + 'lefts';

            widget.html(countdownText);

            if (timeRemaining < 0) {
                widget.html('Application Closed');
                widget.addClass('application-closed'); // Add the application-closed class
            } else {
                widget.removeClass('application-closed'); // Remove the application-closed class
            }
        }

        // Initial call
        updateCountdown();

        // Update every second
        setInterval(updateCountdown, 1000);
    });
});
