var bgContenedor = document.getElementById('contenedor');
var bgTargeta = document.getElementById('tarjeta');

var background = ['url(../img/bg/login.jpg)','url(../img/bg/login1.jpg)','url(../img/bg/login2.jpg)','url(../img/bg/login3.jpg)','url(../img/bg/login4.jpg)','url(../img/bg/login5.jpg)','url(../img/bg/login6.jpg)','url(../img/bg/login7.png)','url(../img/bg/login8.png)'];
var random = Math.random()*background.length | 0;
var backgroundR = background[random];



bgTargeta.style.backgroundImage = backgroundR;
bgContenedor.style.backgroundImage = backgroundR;
console.log(backgroundR)