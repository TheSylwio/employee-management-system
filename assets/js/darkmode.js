const btn = document.querySelector(".btn-toggle");

btn.addEventListener("click", function () {
    console.log("dark");
    document.body.classList.toggle("dark-mode");
});