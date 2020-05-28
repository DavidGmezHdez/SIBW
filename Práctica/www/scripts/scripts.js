
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
    if(document.forms["formulario-registro"]["nick"].value == null || document.forms["formulario-registro"]["nick"].value == ""){
        alert("El nick es un campo obligatorio");
        return false;
    }

    //Comprobamos que el nombre no está vacio
    if(document.forms["formulario-registro"]["pass"].value == null || document.forms["formulario-registro"]["pass"].value == ""){
            alert("La contraseña es un campo obligatorio");
            return false;
    }

    //Comprobamos que el email no está vacío
    if(document.forms["formulario-registro"]["email"].value == null || document.forms["formulario-registro"]["email"].value == ""){
        alert("El email es un campo obligatorio");
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
    const CENSURA = '*'
    var censuradas = document.getElementById("censuradas").value.match(/[a-z'\-]+/gi)
    
    var frase = document.forms["formulario"]["coment"].value.match(/[a-z'\-]+/gi)
    var fraseAux = document.forms["formulario"]["coment"].value
    var frasefinal = fraseAux
    
    var arrayAux = []

    for(i = 0; i < frase.length; i++){
        arrayAux.push(String(frase[i]))
    }

    for(j = 0; j < censuradas.length; j++){
        var pos = arrayAux.indexOf(String(censuradas[j]))

        if(pos != -1){
            frasefinal = fraseAux.replace(arrayAux[pos], CENSURA.repeat(arrayAux[pos].length))
        }
    }

    document.forms["formulario"]["coment"].value = frasefinal
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


//Buscador

function buscar(titulo){  
    $.ajax({
        data: {titulo},
        url:'buscador.php',
        type: 'get',
        chache: 'false',
        success: function(busqueda){
            procesarBusqueda(busqueda);
        }
    });
}

function procesarBusqueda(busqueda){
    var res="";
    var busquedaDecoficada = $.parseJSON(busqueda);


    if(busqueda.length > 0){
        for(i = 0; i < busquedaDecoficada.length; ++i) {
            res += "<a class='headers' href=\"/evento.php?ev=" + busquedaDecoficada[i]['idEvento'] + "\">" + busquedaDecoficada[i]['titulo'] + "</a><br>";
        }
        $("#resultados").html(res);
        document.getElementById("resultados").style.border="1px solid #FF0000";
    }
    else{
        document.getElementById("resultaods").innerHTML="";
        document.getElementById("resultados").style.border="0px";
    }
}