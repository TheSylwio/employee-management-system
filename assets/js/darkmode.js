const btn = document.querySelector("#btn-toggle");
let switched = false;

btn.addEventListener("click", () => {
  const logo = document.querySelector('#dark-logo');

  logo.src = switched ? 'https://127.0.0.1:8000/images/logo.svg' : 'https://127.0.0.1:8000/images/logo_white.svg';
  switched = !switched;

  document.body.classList.toggle("dark-mode");
});