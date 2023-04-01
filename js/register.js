//Email and User comprobacion

const usernameInp = document.getElementById('username')

$('#email').blur(()=>{
    email = $('#email').val();
    console.log(email)
    $.ajax({
        url: '../php_function/email-verify.php',
        type: 'POST',
        data : "email="+ email,
        success: function(data){
            console.log(data)
        }
    });

})


$('#username').blur(()=>{
    username = $('#username').val();
    console.log(username)
    $.ajax({
        url: '../php_function/username-verify.php',
        type: 'POST',
        data : "username="+ username,
        success: function(data){
            if(data = 'si'){
                $('#data').html('si'); 
            }else{

            }$('#data').html('no'); 
        }
    });

})




//Icons

const icono = document.getElementById('icon')
const iconos = document.querySelectorAll('#icons')

const modal = document.getElementById('icon-modal')

const select = document.getElementById('select')
const cancel = document.getElementById('cancel')

const input = document.getElementById('idicono')

var iconSrc = '../img/user-icon.jpg'

input.value = '1'

icono.addEventListener('click',()=>{
    modal.showModal()
})

cancel.addEventListener('click',(e)=>{
    e.preventDefault()
    modal.close()
})

select.addEventListener('click',(e)=>{
    e.preventDefault()
    icono.src = iconSrc
    modal.close()
})



iconos.forEach((icono,i)=>{
    iconos[i].addEventListener('click',()=>{
        
        iconSrc = iconos[i].src
        console.log(iconos[i].dataset.value)
        input.value = iconos[i].dataset.value


        iconos.forEach((icono,i)=>{
            iconos[i].classList.remove('selected')
        })

        iconos[i].classList.add('selected')
    })
})




