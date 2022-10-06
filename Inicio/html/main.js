const slider = document.querySelector("#slider");
let sliderSection = document.querySelectorAll(".slider-section");
let sliderSectionLast = sliderSection[sliderSection.length -1];

const btnI = document.querySelector("#btn-I");
const btnD = document.querySelector("#btn-D");



slider.insertAdjacentElement('afterBegin', sliderSectionLast);

function Next(){

    let sliderSectionFirst = document.querySelectorAll(".slider-section")[0];
    slider.style.marginLeft = "-200%";
    slider.style.transition = "all 0.5s";

    setTimeout(function(){
        slider.style.transition= "none";
        slider.insertAdjacentElement('beforeEnd', sliderSectionFirst);
        slider.style.marginLeft = "-100%";



    }, 500);


}
function Prev(){

    let sliderSection = document.querySelectorAll(".slider-section");
    let sliderSectionLast = sliderSection[sliderSection.length -1];
    slider.style.marginLeft = "0";
    slider.style.transition = "all 0.5s";

    setTimeout(function(){
        slider.style.transition= "none";
        slider.insertAdjacentElement('afterBegin', sliderSectionLast);
        slider.style.marginLeft = "-100%";



    }, 500);


}


btnD.addEventListener('click', function(){
Next();


})
btnI.addEventListener('click', function(){
Prev();


})


// Slide automatico
setInterval(function(){

    Next();

},5000);
