const firstButton = document.querySelector("#today");
const secondButton = document.querySelector("#sevenDays");
const thirdButton=document.querySelector("#all");
const today = document.getElementsByName("today");
const others = document.getElementsByName("others");
const sevenDays = document.getElementsByName("sevenDays");
const elements = document.getElementsByClassName("eventRow");
if (firstButton) {
    firstButton.addEventListener("click", () => {
        for (let i = 0; i < today.length; i++) {
            today[i].style.visibility = 'visible';
        }
        for (let i = 0; i < sevenDays.length; i++) {
            sevenDays[i].style.visibility = 'collapse';
        }
        for (let i = 0; i < others.length; i++) {
            others[i].style.visibility = 'collapse';
        }
    })
}
if (secondButton) {
   secondButton.addEventListener("click", () => {
       for (let i = 0; i < today.length; i++) {
           today[i].style.visibility = 'visible';
       }
       for (let i = 0; i < sevenDays.length; i++) {
           sevenDays[i].style.visibility = 'visible';
       }
       for (let i = 0; i < others.length; i++) {
           others[i].style.visibility = 'collapse';
       }
    })
}

if (thirdButton) {
    thirdButton.addEventListener("click", () => {
        for (let i = 0; i < elements.length; i++) {
            elements[i].style.visibility = 'visible';
        }
    })
}
