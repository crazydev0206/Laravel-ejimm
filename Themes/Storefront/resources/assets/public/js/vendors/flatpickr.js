require('flatpickr');

for (let el of $('.datetime-picker')) {
    $(el).flatpickr({
        mode: el.hasAttribute('data-range') ? 'range' : 'single',
        enableTime: el.hasAttribute('data-time'),
        noCalendar: el.hasAttribute('data-no-calender'),
        altInput: true,
    });
}
