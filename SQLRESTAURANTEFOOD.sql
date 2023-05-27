CREATE DATABASE MESASABORES;
USE MESASABORES;


drop table menu;
CREATE TABLE MENU(
id int not null auto_increment primary key,
nombre varchar(60) not null,
url varchar(300) not null
);

CREATE TABLE RESERVACION(
ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
EMAIL VARCHAR(100) NOT NULL,
NUMEROPERSONA INT NOT NULL,
HORA CHAR(5) NOT NULL,
DIA  CHAR(10) NOT NULL
);

select * from RESERVACION;

CREATE TABLE OFERTACOMIDA(
ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
NOMBRE VARCHAR(50) NOT NULL,
DESCRIPCION VARCHAR(200) NOT NULL,
PRECIO	VARCHAR(10) NOT NULL,
URL VARCHAR(300) NOT NULL
);


CREATE TABLE USUARIOS(
ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
NOMBRE VARCHAR(50) NOT NULL,
APELLIDOM VARCHAR(50) NOT NULL,
APELLIDOP VARCHAR(50) NOT NULL,
CONTRASENIA VARCHAR(256) NOT NULL,
TELEFONO CHAR(10) NOT NULL,
DIRECCION VARCHAR(100) NOT NULL,
CODIGOPOSTAL CHAR(5) NOT NULL,
CORREO VARCHAR(100) NOT NULL
);

select * from usuarios;


/*------------------------------- DATOS FICTICIOS PARA TABLAS-------------------*/

INSERT INTO MENU (nombre, url) VALUES
('Tacos al Pastor', 'https://www.comedera.com/wp-content/uploads/2017/08/tacos-al-pastor-receta.jpg'),
('Chiles Rellenos', 'https://i.pinimg.com/originals/d2/bc/26/d2bc260efda31c07533d1d76a51534ee.jpg'),
('Enchiladas Verdes', 'https://i.pinimg.com/originals/d2/bc/26/d2bc260efda31c07533d1d76a51534ee.jpg'),
('Mole Poblano', 'https://www.seriouseats.com/thmb/TOQrlZhSHX6NwXXOT7vAIY7pMLY=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/__opt__aboutcom__coeus__resources__content_migration__serious_eats__seriouseats.com__recipes__images__2012__10__20121024-227412-mole-poblano-8aa343f2cb384508834ed888a4b65df2.jpg'),
('Tamales Oaxaqueños', 'https://assets.tmecosys.com/image/upload/t_web767x639/img/recipe/ras/Assets/68D64DAE-9605-42AC-BDCF-328A509EC776/Derivates/7AC0E9FD-F0DA-410B-9D78-19D3C3BEA1F3.jpg'),
('Pozole', 'https://editorialtelevisa.brightspotcdn.com/dims4/default/6c34d26/2147483647/strip/true/crop/440x440+63+0/resize/1000x1000!/format/webp/quality/90/?url=https%3A%2F%2Fk2-prod-editorial-televisa.s3.amazonaws.com%2Fbrightspot%2Fwp-content%2Fuploads%2F2018%2F03%2FSTPozole-rojo-de-cerdo.jpg'),
('Chiles en Nogada', 'https://media.istockphoto.com/id/491811072/es/foto/chiles-en-nogada-comida-mexicana.jpg?s=612x612&w=is&k=20&c=wFRoQmLkubqojygfRmCkyBiAxaegn_5Jn7zi2FXP3Xg='),
('Cochinita Pibil', 'https://i2.wp.com/portandfin.com/wp-content/uploads/2015/01/CochinitaPibil7.jpg'),
('Tacos de Carnitas', 'https://okdiario.com/img/2022/04/30/tacos.jpg'),
('Quesadillas', 'https://www.cocinista.es/download/bancorecursos/recetas/receta-quesadilla.jpg'),
('Tortas Ahogadas', 'https://dorastable.com/wp-content/uploads/2017/04/torta-ahogada-3-1030x682.jpg'),
('Tostadas de Tinga', 'https://www.mylatinatable.com/wp-content/uploads/2014/02/foto-h-750x500.jpg.webp'),
('Sopes', 'https://th.bing.com/th/id/OIP.nIyzeNF1iZjzl0qA74i3EgHaE7?pid=ImgDet&rs=1'),
('Chilaquiles', 'https://images.pexels.com/photos/10305696/pexels-photo-10305696.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),
('Flautas', 'https://www.maricruzavalos.com/wp-content/uploads/2019/09/chicken-flautas-recipe-1024x1024.jpg');


select * from menu;