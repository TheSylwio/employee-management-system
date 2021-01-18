const btn = document.querySelector("#btn-toggle");
const logo = document.querySelector('#dark-logo');
const currentTheme = localStorage.getItem("mode");

if (currentTheme === "dark") {
  document.body.classList.add("dark-mode");
}

btn.addEventListener("click", () => {
  document.body.classList.toggle("dark-mode");
  
  const theme = document.body.classList.contains("dark-mode") ? "dark" : "light";
  localStorage.setItem("mode", theme);
});
