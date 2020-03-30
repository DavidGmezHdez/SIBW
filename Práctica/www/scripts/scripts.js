
function Comenta() {

    if(document.getElementById("formulario-comentarios").style.display == "none")
        document.getElementById("formulario-comentarios").style.display = "block";
    else
        sdocument.getElementById("formulario-comentarios").style.display = "none";
}


function Enviar(){
    var req = requisitos();
    var em = ValidarEmail(document.forms["formulario"]["email"].value);

    //Comprovamos que los campos esten rellenos y el email sea correcto
    if(req == false || em == false){
        return false;
    }

    //Creamos las variables para añadirlas al HTML siguiendo el mismo patron que los comentarios anteriores
    var name = document.forms["formulario"]["name"].value;
    var coment = document.forms["formulario"]["coment"].value;

    var date =  new Date();

    var year = new Intl.DateTimeFormat('es',{year: 'numeric'}).format(date);
    var month = new Intl.DateTimeFormat('es',{month: 'long'}).format(date);
    var monthCorrecto = month[0].toUpperCase() + month.slice(1);
    var day = new Intl.DateTimeFormat('es',{day: '2-digit'}).format(date);
    var time = new Intl.DateTimeFormat('es',{hour: 'numeric',minute:'numeric'}).format(date);
    
    //Agregamos el nuevo comentario
    document.getElementById("caja").innerHTML += '<div class = "comentario"><p><em>' + name +'</em></p><p>' + time + ', ' + day + ' de ' + monthCorrecto + ' de ' + year + '</p> <p> ' + coment + '</p></div>'
    
    //Borramos todos los datos de los inputs y volvemos a poner la caja en invisible
    document.forms["formulario"]["name"].value = "";
    document.forms["formulario"]["email"].value = "";
    document.forms["formulario"]["coment"].value = "";
    document.getElementById("formulario-comentarios").style.display = "none";

}


function requisitos(){

    //Comprobamos que el nombre no está vacio
    if(document.forms["formulario"]["name"].value == null || document.forms["formulario"]["name"].value == ""){
        alert("El nombre es un campo obligatorio");
        return false;
    }

    //Comprobamos que el email no está vacío
    if(document.forms["formulario"]["email"].value == null || document.forms["formulario"]["email"].value == ""){
        alert("El email es un campo obligatorio");
        return false;
    }

    //Comprobamos que el comentario no está vacío
    if(document.forms["formulario"]["coment"].value == null || document.forms["formulario"]["coment"].value == ""){
        alert("El comentario es un campo obligatorio");
        return false;
    }
}


function ValidarEmail(email){

    //Validamos el email
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
        return true;
    }
    alert("La dirección de email no es correcta(Ejemplo: guillermo@mail.com)");
    return false;
}




function checkPalabras(){
    //Comprobamos que las palabras malsonantes sean sustituidas por asteriscos
    const censura = '*'
    var palabras= document.getElementById("censuradas").value.match(/[a-z'\-]+/gi)
    console.log(palabras)
    
    var fraseAux = document.forms["formulario"]["coment"].value
    var frase = document.forms["formulario"]["coment"].value.match(/[a-z'\-]+/gi)
    var resultado = fraseAux
    var palabra = []

    for(i=0;i<frase.length;i++){
        palabra.push(String(frase[i]))
    }

    for(j=0;j<palabras.length;j++){
        var indice = palabra.indexOf(String(palabra[j]))

        if(indice!=-1){
            resultado = fraseAux.replace(palabra[indice], censura.repeat(palabra[indice].length))
        }
    }

    document.forms["formulario"]["coment"].value = resultado
}



// Funcion para abrir el modal
function abrirModal() {
    document.getElementById("mymodal").style.display = "block";
  }
  
// Cerramos el modal
function cerrarModal() {
    document.getElementById("mymodal").style.display = "none";
}
 
var slideIndex = 1;
showSlides(slideIndex);
  
// Controles
function plusSlides(n) {
    showSlides(slideIndex += n);
}
  
// Controles de la imagen
function currentSlide(n) {
    showSlides(slideIndex = n);
}
  
function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("demo");
    var captionText = document.getElementById("caption");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    captionText.innerHTML = dots[slideIndex-1].alt;
}