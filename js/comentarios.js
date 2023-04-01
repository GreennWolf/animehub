//Comentarios
const comentForm = document.getElementById('coment-form');



comentForm.addEventListener('submit',(e)=>{
    e.preventDefault();
    const comentario = document.getElementById('comentario').value;
    const actualcap = tomarCap(comentForm)
    comentData = {
        comentario,
        actualcap,
    };
    $.ajax({
        url: '../php_function/comentarios.php',
        type: 'POST',
        data: comentData,
        success:(comentCard)=>{
            if(comentCard == 'Debes iniciar sesion para comentar'){
            }else{
                document.getElementById('new').innerHTML = comentCard
            }
        }
    })

    comentForm.reset()
})



//Likes
const likesButton = document.querySelectorAll('.likeBtn');
const comentarios = document.querySelectorAll('.coment-card')
const actLikes = document.querySelectorAll('.likes-num')

function tomarId(element) {
    var id = element.id;
    return id;
}

function tomarValor(element) {
    var value = element.dataset.value;
    return value;
}

function tomarCap(element) {
    var value = element.dataset.cap;
    return value;
}


actLikes.forEach(like =>{
    

    likesButton.forEach(likeBtn => {
        likeBtn.addEventListener('click', () => {
            const idcomentario = tomarId(likeBtn);
            const actuallikes = tomarValor(likeBtn)
            const actualcap = tomarCap(likeBtn)

            datos ={
                idcomentario,
                actuallikes,
                actualcap,
            }

            $.ajax({
                url: '../php_function/likes.php',
                type: 'POST',
                data: datos,
                success:(newLike)=>{
                    if(newLike == 'Debes iniciar sesion para dar like'){
                        document.getElementById('error').innerHTML = newLike
                    }else{
                        like.innerHTML = newLike
                    }
                }
            })
        })
    })
})

//Report

const reportButton = document.querySelectorAll('.reportBtn');

reportButton.forEach(reportBtn => {
    reportBtn.addEventListener('click', () => {
        const idcomentario = tomarId(reportBtn);
        const actualReports = tomarValor(reportBtn)
        const actualcap = tomarCap(likeBtn)

        datos ={
            idcomentario,
            actualReports,
            actualcap,
            
        }

        $.ajax({
            url: '../php_function/report.php',
            type: 'POST',
            data: datos,
            success:(report)=>{
                if(report == 'Debes iniciar sesion para Reportar'){
                    document.getElementById('error').innerHTML = report
                }else{
                    document.getElementById('enviado').innerHTML = report
                }
            }
        })
    })
})
