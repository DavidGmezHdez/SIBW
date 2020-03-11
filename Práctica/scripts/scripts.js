
function Comenta() {
    document.getElementById("formulario-comentarios").style.display = "block";


}


function Enviar(){
    var req = requisitos();
    var em = ValidarEmail(document.forms["formulario"]["email"].value);

    if(req == false || em == false){
        return false;
    }

    var name = document.forms["formulario"]["name"].value;
    var coment = document.forms["formulario"]["coment"].value;

    var date =  new Date();

    var year = new Intl.DateTimeFormat('es',{year: 'numeric'}).format(fecha);
    var month = new Intl.DateTimeFormat('es',{year: 'long'}).format(fecha);
    var monthCorrecto = month[0].toUpperCase + month.slice(1);
    var day = new Intl.DateTimeFormat('es',{day: '2-digit'}).format(fecha);
    var time = new Intl.DateTimeFormat('es',{hour: 'numeric',minute:'numeric'}).format(fecha);
    document.getElementById("caja").innerHTML += '<div class = "comentario"><p><em>' + name +'</em></p><p>' + time + ',' + day + ' de ' + monthCorrecto + ' de ' + year + '</p> <p> ' + coment + '</p></div>'

}


function requisitos(){
    var name = document.forms["formulario"]["name"].value;
    var email = document.forms["formulario"]["email"].value;
    var coment = document.forms["formulario"]["coment"].value;

    if(name == null || name == ""){
        alert("El nombre es un campo obligatorio");
        return false;
    }

    if(email == null || email == ""){
        alert("El email es un campo obligatorio");
        return false;
    }

    if(coment == null || coment == ""){
        alert("El comentario es un campo obligatorio");
        return false;
    }
}


function ValidarEmail(email){
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)){
        return true;
    }
    alert("La dirección de email no es correcta(Ejemplo: guillermo@mail.com)");
    return false;
}




function checkPalabras(){
    var comentario = document.forms["formulario"]["coment"].value;
    const PALABRAS=['hijo de puta','subnormal','carahuevo','negro'];
    var censurado = censurar(comentario.value,PALABRAS);
    document.forms["formulario"]["coment"].value = censurado;
}

function censurar(string, filters){
    var regex = new RegExp(filters.join("|"),"gi");
    return string.replace(regex, function (match) {
        // Reemplazamos cada letra con una estrella
        var estrella = '';
        for (var i = 0; i < match.length; i++) {
            estrella += '*';
        }
        return estrella;
    });

}