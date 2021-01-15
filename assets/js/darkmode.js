const btn = document.querySelector("#btn-toggle");
const logo = document.querySelector('#dark-logo');
const currentTheme = localStorage.getItem("mode");

if (currentTheme === "dark") {
  document.body.classList.add("dark-mode");
  logo.src = 'https://127.0.0.1:8000/images/logo_white.svg';
}

btn.addEventListener("click", () => {
  logo.src = (currentTheme === 'dark') ? 'https://127.0.0.1:8000/images/logo.svg' : 'https://127.0.0.1:8000/images/logo_white.svg';

  document.body.classList.toggle("dark-mode");
  
  const theme = document.body.classList.contains("dark-mode") ? "dark" : "light";
  localStorage.setItem("mode", theme);
});
