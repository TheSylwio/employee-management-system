import Swal from 'sweetalert2';

const buttons = document.querySelectorAll('.btn--delete');

const customSwal = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-danger mr-2',
    cancelButton: 'btn btn-secondary'
  },
  buttonsStyling: false
})

buttons.forEach(button => {
  button.addEventListener('click', function () {
    customSwal.fire({
      title: 'Usuwanie danych',
      text: 'Czy na pewno chcesz usunąć dane?',
      icon: 'error',
      showCancelButton: true,
      confirmButtonText: 'Tak, usuń',
      cancelButtonText: 'Nie, anuluj',
    }).then(({isConfirmed}) => {
      if (isConfirmed) {
        fetch(this.dataset.path, {method: 'POST'})
          .then(({status}) => {
            if (status === 200) {
              window.location.reload();
            }
          })
      }
    })
  });
});
