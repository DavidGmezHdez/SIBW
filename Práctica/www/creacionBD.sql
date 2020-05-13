CREATE TABLE eventos(
    idEvento INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100),
    autor VARCHAR(100),
    fecha DATE,
    descripcion TEXT,
    portada VARCHAR(100),
    imagen1 VARCHAR(100),
    imagen2 VARCHAR(100)
);

INSERT INTO eventos (titulo, autor, fecha, descripcion, portada, imagen1, imagen2) VALUES ('Apertura tienda','Cecilio Campos','2018-07-19-','La apertura de la 
tienda se realizará el 19 de Marzo de 2020. En ella se realizará un descuento para los distintos helados. Cecilio en persona estará firmando autografos, 
tras una exhuberante carrera en la sección de MasterCocinero, Cecilio decidió irse a un pueblo a ayudar a la gente de allí con sus estupendos helados. 
El pueblo de Villadiego está muy contento con la llegada de semejante cocinero. Los precios nuevos son los siguientes:

    Calipos -> De 9.99€ a 19.99€
    Frigopie -> De 3.99€ a 14.99€
    Maxibon -> De 16.99€ a 29.99€
    Fantasmikos -> De 3.99€ a 0.99€
    Pirulo -> De 3.99€ a 4.99€
    Sandia -> De 8.99€ a 9.99€
    Oreo -> De 4.99€ a Demanda del McDonalds','img/eventos/evento1/portada-evento1.png','img/eventos/evento1/imagen-evento1-1.png','img/eventos/evento1/imagen-evento1-2.png'
);

INSERT INTO eventos (titulo, autor, fecha, descripcion, portada, imagen1, imagen2) VALUES ('Firma de autografos','Cecilio Campos','2020-03-24','Tras la gran acogida que
tuvo la apertura de la tienda, el famoso creador de espectaculares helados Cecilio repartirá autografos a la gente a modo de bendición. Despues salpicará con 
helado de vainilla a los asistentes. Será una gran fiesta donde el dulce del helado y lo salado del sudor se mezclará creando un aroma inigualable',
'img/eventos/evento2/portada-evento2.png','img/eventos/evento2/imagen-evento2-1.png','img/eventos/evento2/imagen-evento2-2.png');

INSERT INTO eventos (titulo, autor, fecha, descripcion, portada, imagen1, imagen2) VALUES ('Magia con Helados','Alberto Campos','2017-04-09','El hermano de Cecilio,
Alberto Campos, ns deleitará con un espectáculo mágico apto para los mas pequeños. En el Alberto hará desaparecer helados para hacerlos desaparecer detrás
de la oreja de los niños, dándoles un sabor inigualable. Sin embargo, también habrá espectaculos para adultos, en los cuales no se hará nada, como hacen los
adultos','img/eventos/evento3/portada-evento3.png','img/eventos/evento3/imagen-evento3-1.png','img/eventos/evento3/imagen-evento3-2.png');

INSERT INTO eventos (titulo, autor, fecha, descripcion, portada, imagen1, imagen2) VALUES ('Vista a la Playa','Cecilia Campos','2019-11-10','La hermana
de Cecilio, Cecilia, se encargará de organizar una excurisón de helados para la playa. ¿Qué mejor lugar que un sitio cálidom para disfrutar de un buen helado?
Además se harán distintas activiades por la playa, como correr por la arena manteniendo un helado en equilibrio o lanzarse bolas de helados. ¡Cuantos más asistan
mejor!', 'img/eventos/evento4/portada-evento4.png','img/eventos/evento4/imagen-evento4-1.png','img/eventos/evento4/imagen-evento4-2.png');

INSERT INTO eventos (titulo, autor, fecha, descripcion, portada, imagen1, imagen2) VALUES ('Exposición de cuadros','Marta Lagos','2016-05-20','La madre de
Cecilio, Marta Lagos, se encargará de mostrarnos su obras más recientes basadas en los helados de Cecilio. 
Cada cuadro se ha realizado en 24 horas consecutivas. Marta nos ha compartido que será un evento que nadie olvidará, ademas de rogarnos por darle más
café.','img/eventos/evento5/portada-evento5.png','img/eventos/evento5/imagen-evento5-1.png','img/eventos/evento5/imagen-evento5-2.png');

INSERT INTO eventos (titulo, autor, fecha, descripcion, portada, imagen1, imagen2) VALUES ('Rodaje del anuncio','Jose Hernández','2018-10-27','José Hernández,
el famoso director de cine que dirigió el spin-off de "Titanic: La venganza", se encargará de rodar un anuncio
en exclusiva para Cecilio, en el que el autor principal será...¡el mismo Cecilio! Este anuncio se mostrará compotiendo a nivel nacional con otros
anuncios de gran calibre. Cecilio ha declarado:"Estoy muy contento con como está quedando, creo que la gente le va a gustar mucho". '
,'img/eventos/evento6/portada-evento6.png','img/eventos/evento6/imagen-evento6-1.png','img/eventos/evento6/imagen-evento6-2.png');

INSERT INTO eventos (titulo, autor, fecha, descripcion, portada, imagen1, imagen2) VALUES ('Rodaje película','Jose Hernández','2020-04-01','Tras el lanzamiento del anuncio
de Helados Cecilio, este último ha ganado una gran fama, llegando a tener presupuesto para... ¡rodar una película! COntará con el mismo director y mismo protagonista,
además que el guión lo llevará a cabo Cristina Hierro, una guionista de alto prestigio en nuestro país. La familia de Cecilio está encntada de que su reputación
haya llegado a tan alto nivel, especialmente a la gran pantalla. EL rodaje comenzará el 8 de Noviembre de este año, pronto se irá añadiendo más información.'
,'img/eventos/evento7/portada-evento7.png','img/eventos/evento7/imagen-evento7-1.png','img/eventos/evento7/imagen-evento7-2.png');

INSERT INTO eventos (titulo, autor, fecha, descripcion, portada, imagen1, imagen2) VALUES ('Crisis: Denuncia de una madre que afirma que tiene mucho azucar',
'Madre anónima','2017-12-23','ALERTA Una madre furiosa ha cargado contra Cecilio y su familia afirmándoles que su hijo con diabetes ha fallecido a causa de tomarse
uno de los helados del propio Cecilio. La mujer le ha reprochado que venda los helados tan a la ligera, recriminandole que tiene que tener un control más
autoritario a la hora de vender helados a niños. Actualmente el juicio está parado debido a que la madre afirma que quiere que sea Dios quien lo juzgue,
no un juez del Tribunal Supremo.','img/eventos/evento8/portada-evento8.png','img/eventos/evento8/imagen-evento8-1.png','img/eventos/evento8/imagen-evento8-2.png');

INSERT INTO eventos (titulo, autor, fecha, descripcion, portada, imagen1, imagen2) VALUES ('50 Cosas sobre Cecilio: De ex-militar a cocinero profesional',
'Cecilio Campos','2019-05-25','Cecilio Campos nació el 14-02-1978. EL pobre perdió a casi toda su familia a una edad muy temprana y tuvo
que alistarse en el ejercito para encontrar una forma de sobrevivir. Llegó al rango de Teniente de infantería. Tras una pequeña escaramuza, 
perdió parcialmente parte de su sentido auditivo del oido derecho, por lo que tuvo que abandonar el ejercito. De ahí descubrió su verdadero oficio, la cocina.
Se presentó a Master Chef con platos basados en helados, consiguiendo gran reputación. Tras ganar Master Chef, se retiró a un pequeño pueblo de Castilla La Mancha.'
,'img/eventos/evento9/portada-evento9.png','img/eventos/evento9/imagen-evento9-1.png','img/eventos/evento9/imagen-evento9-2.png');




CREATE TABLE comentarios(
    idEvento INT NOT NULL REFERENCES eventos(idPelicula),
    idComentario INT NOT NULL,
    usuario VARCHAR(100),
    fecha DATE,
    comentario TEXT,
    moderado INT,
    PRIMARY KEY(idEvento,idComentario)
);

INSERT INTO comentarios VALUES ('1','1','Julio Jimenez','2018-07-05','¡Estaré allí!',0);
INSERT INTO comentarios VALUES ('1','2','Sara Huertas','2018-07-03','Espero que le firmes un autógrafo a mi hija',0);

INSERT INTO comentarios VALUES ('2','1','Alberto Lopez','2020-03-28','Aun tengo helado en el oido',0);
INSERT INTO comentarios VALUES ('2','2','Rocio Reloj','2020-03-29','Mi diabetes ha evolucionado',0);

INSERT INTO comentarios VALUES ('3','1','Clara Palomas','2019-11-30','Me encantó el truco en el que hizo desaparecer mi cartera',0);
INSERT INTO comentarios VALUES ('3','2','Clara Palomas','2019-11-30','Enserio devolvedmela por favor',0);

INSERT INTO comentarios VALUES ('4','1','Laura Velasco','2019-11-10','Me lo he pasado muy bien',0);
INSERT INTO comentarios VALUES ('4','2','Kike Jimenez','2019-11-11','Aun sigo en el hospital por culpa de la medusa',0);

INSERT INTO comentarios VALUES ('5','1','Abraham Strawlopsky','2016-05-21','I loved it',0);
INSERT INTO comentarios VALUES ('5','2','Oscar Campos','2016-05-23','Pues a mi no me ha gustado',0);

INSERT INTO comentarios VALUES ('6','1','Úrsula Fernández','2018-10-28','Espero verlo con muchas ansias en la TV',0);
INSERT INTO comentarios VALUES ('6','2','Úrsula Fernández','2018-11-15','En verdad es una mierda',0);

INSERT INTO comentarios VALUES ('7','1','Andrea Mandarinos','2020-04-01','HYPEEEE',0);
INSERT INTO comentarios VALUES ('7','2','Paloma Palomares','2020-04-02','Tengo muchas ganas de verla',0);

INSERT INTO comentarios VALUES ('8','1','Julian Jamones','2017-12-25','Oye un respeto con mi madre',0);
INSERT INTO comentarios VALUES ('8','2','Berta Salvador','2017-12-26','JULIAN TU NO TE METAS',0);

INSERT INTO comentarios VALUES ('9','1','Francisco Frenadol','2019-05-28','Era su capitan y puedo decir que era un buen soldado',0);
INSERT INTO comentarios VALUES ('9','2','Jordi Cruz','2019-05-30','El bastardo me robó mis cuchillos',0);


CREATE TABLE palabrascensuradas(
    idPalabra INT AUTO_INCREMENT PRIMARY KEY,
    palabra VARCHAR(30)
);


INSERT INTO palabrascensuradas (palabra) VALUES('subnormal');
INSERT INTO palabrascensuradas (palabra) VALUES('carahuevo');
INSERT INTO palabrascensuradas (palabra) VALUES('negro');
INSERT INTO palabrascensuradas (palabra) VALUES('Puta');
INSERT INTO palabrascensuradas (palabra) VALUES('puta');
INSERT INTO palabrascensuradas (palabra) VALUES('Mierda');
INSERT INTO palabrascensuradas (palabra) VALUES('mierda');


CREATE TABLE galeria(
    idImagen INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(30),
    imagen VARCHAR(100)
);

INSERT INTO galeria (titulo,imagen) VALUES ('Calipo Fresa','img/calipocola.png');
INSERT INTO galeria (titulo,imagen) VALUES ('Calipo Lima','img/calipolimon.png');
INSERT INTO galeria (titulo,imagen) VALUES ('Calipo Naranja','img/caliponaranja.png');
INSERT INTO galeria (titulo,imagen) VALUES ('Frigopie','img/frigopie.png');


CREATE TABLE usuarios(
    idUsuario INT AUTO_INCREMENT,
    nick VARCHAR(15) NOT NULL,
    email VARCHAR(30) NOT NULL,
    pass VARCHAR(100) NOT NULL,
    avatar VARCHAR(30),
    rol INT,
    PRIMARY KEY(idUsuario,email)
);

INSERT INTO usuarios VALUES ('Direk','direk@email.com','$2y$10$FY5V02emjCC1rfvCwPZFuuD4JDrAJ3yg85oPVRN.xCdyk7IvsL05S','img/avatares/boss.png',4);



CREATE TABLE etiquetas(
    idEtiqueta INT AUTO_INCREMENT NOT NULL,
    idEvento INT NOT NULL REFERENCES eventos(idEvento),
    etiqueta VARCHAR(50),
    PRIMARY KEY(idEtiqueta,idEvento)
);
