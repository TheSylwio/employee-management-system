import flatpickr from "flatpickr";

const picker = document.querySelectorAll(".picker");
const datePicker = document.querySelectorAll(".datePicker");
const birthPicker = document.querySelectorAll(".birthPicker");
const timePicker = document.querySelectorAll(".timePicker");

flatpickr(picker, {
    enableTime: true,
});

flatpickr(birthPicker);

flatpickr(datePicker, {
    enableTime: false,
});
