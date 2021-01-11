import flatpickr from "flatpickr";

const picker = document.querySelectorAll(".picker");
const vacationPicker = document.querySelectorAll(".vacationPicker");
const birthPicker = document.querySelectorAll(".birthPicker");

flatpickr(picker, {
  enableTime: true,
});

flatpickr(birthPicker);

flatpickr(vacationPicker, {
  enableTime: false,
});