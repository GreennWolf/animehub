const slider = document.getElementById('slider');
let sliderSection = document.querySelectorAll('.slider__section');
let sliderSectionLast = sliderSection[sliderSection.length -1];

const btnLeft = document.getElementById('btn-left');
const btnRight = document.getElementById('btn-right');

slider.insertAdjacentElement('afterbegin',sliderSectionLast);

const interval = setInterval(()=>{
    Next();
},4000);


function Next(){
    let sliderSectionFirst = document.querySelectorAll('.slider__section')[0];
    slider.style.marginLeft = '-200%'
    slider.style.transition = 'all 0.5s'
    setTimeout(function(){
        slider.style.transition = 'none'
        slider.insertAdjacentElement('beforeend',sliderSectionFirst);
        slider.style.marginLeft = '-100%'
        btnRight.hidden = false
    },600)
}

function Prev(){
    let sliderSection = document.querySelectorAll('.slider__section');
    let sliderSectionLast = sliderSection[sliderSection.length -1];
    slider.style.marginLeft = '0'
    slider.style.transition = 'all 0.5s'
    setTimeout(function(){
        slider.style.transition = 'none'
        slider.insertAdjacentElement('afterbegin',sliderSectionLast);
        slider.style.marginLeft = '-100%'
        btnLeft.hidden = false
    },600)
}

btnRight.addEventListener('click',()=>{
    Next();
    btnRight.hidden = true
    clearInterval(interval)
})

btnLeft.addEventListener('click',()=>{
    Prev();
    clearInterval(interval)
    btnLeft.hidden = true
})




//SLIDER ANIME BETA
// const sliderAnime = document.getElementById('slider__anime');
// let sliderSectionAnime = document.querySelectorAll('.slider__section__anime');
// let sliderSectionAnimeLast = sliderSectionAnime[sliderSectionAnime.length -1];

// const btnAnimeLeft = document.getElementById('btn-anime-left');
// const btnAnimeRight = document.getElementById('btn-anime-right');

// sliderAnime.insertAdjacentElement('afterbegin',sliderSectionAnimeLast);

// function Next_Anime(){
//     let sliderSectionAnimeFirst = document.querySelectorAll('.slider__section__anime')[0];
//     sliderAnime.style.marginLeft = '-200%'
//     sliderAnime.style.transition = 'all 0.5s'
//     setTimeout(function(){
//         sliderAnime.style.transition = 'none'
//         sliderAnime.insertAdjacentElement('beforeend',sliderSectionAnimeFirst);
//         sliderAnime.style.marginLeft = '-100%'
//     },1000)
// }

// function Prev_Anime(){
//     let sliderSectionAnime = document.querySelectorAll('.slider__section__anime');
//     let sliderSectionAnimeLast = sliderSectionAnime[sliderSectionAnime.length -1];
//     sliderAnime.style.marginLeft = '0'
//     sliderAnime.style.transition = 'all 0.5s'
//     setTimeout(function(){
//         sliderAnime.style.transition = 'none'
//         sliderAnime.insertAdjacentElement('afterbegin',sliderSectionAnimeLast);
//         sliderAnime.style.marginLeft = '-100%'
//     },1000)
// }

// btnAnimeRight.addEventListener('click',()=>{
//     Next_Anime();
// })

// btnAnimeLeft.addEventListener('click',()=>{
//     Prev_Anime();
// })