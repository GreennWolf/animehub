const temporadasBtn = document.querySelectorAll('.temporada')
const capitulos = document.querySelectorAll('.capitulo')

console.log(capitulos)

// for(i = 0,temporadasBtn.length > i ; i++;){
//     temporadasBtn[i].addEventListener('click',()=>{
//         // capitulos[i].classList.remove('inactive')
//         console.log('hola')
//     })
// }

temporadasBtn.forEach((cadaoption,i)=>{
    temporadasBtn[i].addEventListener('click',()=>{
        console.log('alo')
        temporadasBtn.forEach((cadaoption,i)=>{
            temporadasBtn[i].classList.remove('inactive')
            capitulos.forEach(capitulo =>{
                capitulo.classList.toggle('inactive')
            })
        })

        // temporadasBtn[i].classList.add('inactive')
        // capitulos[i].classList.add('inactive')
    })
})