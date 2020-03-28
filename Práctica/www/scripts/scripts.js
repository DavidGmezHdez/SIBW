
function Comenta() {
    document.getElementById("formulario-comentarios").style.display = "block";
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
    const texto = document.getElementById("coment");
    let palabras=/subnormal|carahuevo|negro/gi;
    let comentario = texto.value;
    let comentarioLimpio = comentario.replace(palabras,'******');
    document.getElementById("coment").value = comentarioLimpio;
    
}