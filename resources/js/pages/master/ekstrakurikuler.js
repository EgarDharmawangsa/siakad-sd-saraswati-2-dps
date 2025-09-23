import flatpickr from 'flatpickr';

document.addEventListener('DOMContentLoaded', function () {
    flatpickr('#jam-mulai', {
        enableTime: true,
        noCalendar: true,
        dateFormat: 'H:i',
        time_24hr: true,
    });

    flatpickr('#jam-selesai', {
        enableTime: true,
        noCalendar: true,
        dateFormat: 'H:i',
        time_24hr: true,
    });
});
