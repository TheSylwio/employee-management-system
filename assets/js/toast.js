import toastr from 'toastr';

const flashMessage = document.querySelector('#flashMessage');

if (flashMessage) {
  toastr.options = {
    "progressBar": true,
    "positionClass": "toast-bottom-right",
  }

  toastr.success(flashMessage.textContent)
}
