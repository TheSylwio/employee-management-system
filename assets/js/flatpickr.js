import flatpickr from "flatpickr";

const picker = document.querySelectorAll(".picker");
const vacationPicker = document.querySelectorAll(".vacationPicker");
const birthPicker = document.querySelectorAll(".birthPicker");
const timePicker = document.querySelectorAll(".timePicker");

flatpickr(picker, {
    enableTime: true,
});

flatpickr(birthPicker);

flatpickr(vacationPicker, {
    enableTime: false,
});

flatpickr(timePicker, {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
});