//tabs
const options = document.querySelectorAll('.options')
const tabs = document.querySelectorAll('.tabs')

console.log(options,tabs)

options.forEach((cadaoption,i)=>{
    options[i].addEventListener('click',()=>{
        
        options.forEach((cadaoption,i)=>{
            options[i].classList.remove('active')
            tabs[i].classList.remove('active')
        })

        options[i].classList.add('active')
        tabs[i].classList.add('active')
    })
})


//Backgrounds

const background = document.getElementById('background')
const backgrounds = document.querySelectorAll('#backgrounds')
const bgPreview = document.getElementById('bg-preview')

const editBtn = document.getElementById('edit-bg');
const bgModal = document.getElementById('bg-modal');
const cancel = document.getElementById('cancel')
const select = document.getElementById('select')
const formBg = document.getElementById('formBg')


const idbgInput = document.getElementById('idbg')
const idcuentaInput = document.getElementById('idcuenta')

var bgSrc = '../img/background.jpg'
bgPreview.src = background.src

editBtn.addEventListener('click',()=>{
    bgModal.showModal()
    bgPreview.src = background.src
})

cancel.addEventListener('click',(e)=>{
    e.preventDefault()
    bgModal.close()
    backgrounds.forEach((background,i)=>{
        backgrounds[i].classList.remove('selected')
    })
})

select.addEventListener('click',(e)=>{
    e.preventDefault()
    background.src = bgSrc
    var idbg = idbgInput.value
    var idcuenta = idcuentaInput.value

    datos ={
        idbg,
        idcuenta
    }
    $.ajax({
        url: '../php_function/bg-load.php',
        type: 'POST',
        data: datos,
    })

    bgModal.close()
})

backgrounds.forEach((background,i)=>{
    backgrounds[i].addEventListener('click',()=>{
        
        bgSrc = backgrounds[i].src
        idbgInput.value = backgrounds[i].dataset.value
        bgPreview.src = backgrounds[i].src


        backgrounds.forEach((background,i)=>{
            backgrounds[i].classList.remove('selected')
        })

        backgrounds[i].classList.add('selected')
    })
})

//Icons
const icon = document.getElementById('icon')
const iconUser = document.getElementById('icon-user')
const icons = document.querySelectorAll('#icons')
const iconPreview = document.getElementById('icon-preview')

const editIconBtn = document.getElementById('edit-icon');
const iconModal = document.getElementById('icon-modal');
const cancelIcon = document.getElementById('cancelIcon')
const selectIcon = document.getElementById('selectIcon')
const formIcon = document.getElementById('form-icon')


const idIconInput = document.getElementById('idicono')

var iconSrc;
iconPreview.src = icon.src

editIconBtn.addEventListener('click',()=>{
    iconModal.showModal()
    iconPreview.src = icon.src
})

cancelIcon.addEventListener('click',(e)=>{
    e.preventDefault()
    iconModal.close()
    icons.forEach((icon,i)=>{
        icons[i].classList.remove('selected')
    })
})

selectIcon.addEventListener('click',(e)=>{
    e.preventDefault()
    icon.src = iconSrc
    iconUser.src = iconSrc
    var idicono = idIconInput.value
    var idcuenta = idcuentaInput.value

    datos ={
        idicono,
        idcuenta
    }
    $.ajax({
        url: '../php_function/icon-load.php',
        type: 'POST',
        data: datos,
    })

    iconModal.close()
})

icons.forEach((icon,i)=>{
    icons[i].addEventListener('click',()=>{
        
        iconSrc = icons[i].src
        idIconInput.value = icons[i].dataset.value
        iconPreview.src = icons[i].src


        icons.forEach((icon,i)=>{
            icons[i].classList.remove('selected')
        })

        icons[i].classList.add('selected')
    })
})