import flatpickr from 'flatpickr';

const jam_array = [];
jam_array[0] = document.getElementById('jam-mulai') || document.getElementById('jam-mulai-filter');
jam_array[1] = document.getElementById('jam-selesai') || document.getElementById('jam-selesai-filter');

const flatpickr_option = {
    allowInput: true,
    enableTime: true,
    noCalendar: true,
    dateFormat: 'H:i',
    time_24hr: true,
}

jam_array.forEach((_jam_array) => {
    if (_jam_array) flatpickr(_jam_array, flatpickr_option);
})
