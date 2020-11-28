import flatpickr from "flatpickr";

const picker = document.querySelectorAll(".picker");
const birthPicker = document.querySelectorAll(".birthPicker");

flatpickr(picker, {
  enableTime: true,
});

flatpickr(birthPicker);
