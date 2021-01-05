import toastr from 'toastr';

const successFlashMessage = document.querySelector('#successFlashMessage');
const errorFlashMessage = document.querySelector('#errorFlashMessage');

toastr.options = {
  "progressBar": true,
  "positionClass": "toast-bottom-right",
}

if (successFlashMessage) {
   toastr.success(successFlashMessage.textContent)
}

if (errorFlashMessage) {
  toastr.success(successFlashMessage.textContent)
}
