CREATE DATABASE MESASABORES;
USE MESASABORES;


drop table menu;
CREATE TABLE MENU(
ID int not null auto_increment primary key,
NOMBRE varchar(60) not null,
DESCRIPCION TEXT NOT NULL,
PRECIO VARCHAR(5) NOT NULL,
URL varchar(300) not null
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
DIA ENUM('LUNES','MARTES','MIERCOLES','JUEVES','VIERNES','SABADO','DOMINGO'),
TIPO ENUM('COMIDA','JUGO'),
URL VARCHAR(300) NOT NULL
);

drop table USUARIOS;

CREATE TABLE USUARIOS (
    ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NOMBRE VARCHAR(50) NOT NULL,
    APELLIDOM VARCHAR(50) NOT NULL,
    APELLIDOP VARCHAR(50) NOT NULL,
    CONTRASENIA VARCHAR(256) NOT NULL,
    TELEFONO CHAR(10) NOT NULL,
    CORREO VARCHAR(100) NOT NULL,
    OCUPACION VARCHAR(100) NOT NULL
);
CREATE TABLE RESENIAS (
    ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NOMBRE VARCHAR(50) NOT NULL,
    OCUPACION VARCHAR(50) NOT NULL,
    RESENA TEXT NOT NULL,
    CORREO VARCHAR(100) NOT NULL,
    FECHA DATE NOT NULL
);

drop table resenias;

CREATE TABLE CUPONES(
ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
CODIGO VARCHAR(30) NOT NULL,
DESCUENTO VARCHAR(5) NOT NULL,
USOS INT NOT NULL
);



select * from usuarios where contrasenia = '$2y$10$RMuYrtEvvofPMFPb5rKoEuQfW9kIjA7GwY715g7LrokqWdb4WDfKy' and correo = 'leclet.jl@gmail.com';
select * from usuarios;

SELECT nombre, apellidom, apellidop, ocupacion FROM USUARIOS WHERE correo = 'leclet.jl@gmail.com';
select * from rol;
describe usuarios;
drop table  rol;

select * from RESENIAS;
SELECT * FROM RESENIAS ORDER BY FECHA DESC;



/*------------------------------- DATOS FICTICIOS PARA TABLAS-------------------*/
INSERT INTO USUARIOS (NOMBRE, APELLIDOM, APELLIDOP, CONTRASENIA, TELEFONO, OCUPACION, CORREO)
        VALUES ('Jaime', 'Angeles', 'Leon', 'dasdasd', '1234567891', 'Ing. Software', 'lecs');
INSERT INTO OFERTACOMIDA (NOMBRE, DESCRIPCION, PRECIO, DIA, TIPO, URL)
VALUES
    ('Hamburguesa clásica', 'Deliciosa hamburguesa con carne de res, queso, lechuga y tomate', '99.00', 'LUNES', 'COMIDA', 'https://images.unsplash.com/photo-1591336277697-cdae7e42dead?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1077&q=80'),
    ('Hot dog especial', 'Sabroso hot dog con salchicha, cebolla caramelizada y salsa de mostaza', '55.00', 'LUNES', 'COMIDA', 'https://images.unsplash.com/photo-1638368593249-7cadb261e8b3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=391&q=80'),
    ('Pizza margarita', 'Deliciosa pizza con salsa de tomate, queso mozzarella y albahaca fresca', '129.00', 'LUNES', 'COMIDA', 'https://images.unsplash.com/photo-1627626775846-122b778965ae?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=387&q=80'),
    ('Jugo de naranja', 'Refrescante jugo de naranja natural recién exprimido', '29.00', 'LUNES', 'JUGO', 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=387&q=80'),
    ('Batido de fresa', 'Delicioso batido de fresa hecho con helado y frutas frescas', '39.00', 'LUNES', 'JUGO', 'https://images.unsplash.com/photo-1579954115545-a95591f28bfc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80'),
    ('Smoothie tropical', 'Refrescante smoothie tropical con piña, mango y coco', '39.00', 'LUNES', 'JUGO', 'https://images.unsplash.com/photo-1666181767084-91e0cd358adf?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=387&q=80'),
    ('Pollo frito crujiente', 'Crujientes piezas de pollo frito con papas fritas y salsa BBQ', '89.00', 'MARTES', 'COMIDA', 'https://images.unsplash.com/photo-1626645738196-c2a7c87a8f58?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80'),
    ('Tacos al pastor', 'Sabrosos tacos de cerdo marinado con cebolla, cilantro y salsa picante', '69.00', 'MARTES', 'COMIDA', 'https://images.unsplash.com/photo-1551504734-5ee1c4a1479b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8dGFjb3MlMjBhbHBhc3RvcnxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60'),
    ('Wrap de pollo', 'Delicioso wrap de pollo a la parrilla con lechuga, tomate y aderezo ranch', '79.00', 'MARTES', 'COMIDA', 'https://images.unsplash.com/photo-1626700051175-6818013e1d4f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=464&q=80'),
    ('Jugo de manzana', 'Refrescante jugo de manzana natural sin azúcar añadida', '29.00', 'MARTES', 'JUGO', 'https://images.unsplash.com/photo-1605199910378-edb0c0709ab4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8anVnbyUyMGRlJTIwbWFuemFuYXxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60'),
    ('Jugo de zanahoria y naranja', 'Nutritivo jugo de zanahoria y naranja recién exprimidos', '44.00', 'MARTES', 'JUGO', 'https://images.unsplash.com/photo-1617218607489-4d28d612bd07?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80'),
    ('Limonada de fresa', 'Refrescante limonada casera con jugo de fresa y limón', '39.00', 'MARTES', 'JUGO', 'https://images.unsplash.com/photo-1560351520-48e05f3d7d16?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=374&q=80');
select * from menu;
    
    SELECT * FROM OFERTACOMIDA WHERE TIPO = 'jugo' AND DIA = 'lunes' LIMIT 3;

    
    INSERT INTO MENU (NOMBRE, DESCRIPCION, PRECIO, URL) VALUES
('Tacos al Pastor', 'Deliciosos tacos tradicionales de pastor marinado con especias y adobo, servidos en tortillas de maíz.', 10.99, 'https://www.comedera.com/wp-content/uploads/2017/08/tacos-al-pastor-receta.jpg'),
('Chiles Rellenos', 'Chiles poblanos rellenos de una mezcla de carne y/o queso, cubiertos con salsa de tomate y gratinados con queso.', 12.99, 'https://i.pinimg.com/originals/d2/bc/26/d2bc260efda31c07533d1d76a51534ee.jpg'),
('Enchiladas Verdes', 'Tortillas de maíz rellenas de pollo deshebrado, bañadas en salsa verde y adornadas con crema y queso.', 9.99, 'https://i.pinimg.com/originals/d2/bc/26/d2bc260efda31c07533d1d76a51534ee.jpg'),
('Mole Poblano', 'Platillo tradicional mexicano hecho a base de chiles, especias y chocolate, servido con pollo y acompañado de arroz y tortillas.', 14.99, 'https://www.seriouseats.com/thmb/TOQrlZhSHX6NwXXOT7vAIY7pMLY=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/__opt__aboutcom__coeus__resources__content_migration__serious_eats__seriouseats.com__recipes__images__2012__10__20121024-227412-mole-poblano-8aa343f2cb384508834ed888a4b65df2.jpg'),
('Tamales Oaxaqueños', 'Deliciosos tamales hechos con masa de maíz, rellenos de pollo o cerdo y envueltos en hojas de plátano.', 8.99, 'https://assets.tmecosys.com/image/upload/t_web767x639/img/recipe/ras/Assets/68D64DAE-9605-42AC-BDCF-328A509EC776/Derivates/7AC0E9FD-F0DA-410B-9D78-19D3C3BEA1F3.jpg'),
('Pozole', 'Sopa tradicional mexicana hecha a base de maíz cacahuazintle, carne de cerdo, chile y condimentos, acompañada de lechuga, rábano y cebolla.', 11.99, 'https://editorialtelevisa.brightspotcdn.com/dims4/default/6c34d26/2147483647/strip/true/crop/440x440+63+0/resize/1000x1000!/format/webp/quality/90/?url=https%3A%2F%2Fk2-prod-editorial-televisa.s3.amazonaws.com%2Fbrightspot%2Fwp-content%2Fuploads%2F2018%2F03%2FSTPozole-rojo-de-cerdo.jpg'),
('Chiles en Nogada', 'Platillo típico mexicano compuesto por chiles poblanos rellenos de picadillo y cubiertos con una salsa de nuez y granada.', 15.99, 'https://media.istockphoto.com/id/491811072/es/foto/chiles-en-nogada-comida-mexicana.jpg?s=612x612&w=is&k=20&c=wFRoQmLkubqojygfRmCkyBiAxaegn_5Jn7zi2FXP3Xg='),
('Cochinita Pibil', 'Platillo de la cocina yucateca hecho con carne de cerdo adobada en achiote y cocida a fuego lento, acompañada de cebolla encurtida y tortillas.', 13.99, 'https://i2.wp.com/portandfin.com/wp-content/uploads/2015/01/CochinitaPibil7.jpg'),
('Tacos de Carnitas', 'Tacos de carne de cerdo cocida lentamente en su propia grasa hasta quedar dorada y crujiente, servidos con cebolla y cilantro.', 10.99, 'https://okdiario.com/img/2022/04/30/tacos.jpg'),
('Quesadillas', 'Tortillas de maíz rellenas de queso derretido y acompañadas de salsa y guacamole.', 7.99, 'https://www.cocinista.es/download/bancorecursos/recetas/receta-quesadilla.jpg'),
('Tortas Ahogadas', 'Torta de birote rellena de carnitas de cerdo y bañada en una salsa de chile de árbol, acompañada de cebolla y limón.', 9.99, 'https://dorastable.com/wp-content/uploads/2017/04/torta-ahogada-3-1030x682.jpg'),
('Tostadas de Tinga', 'Tostadas de tortilla crujiente cubiertas con pollo deshebrado en salsa de chipotle, acompañadas de crema, queso y lechuga.', 8.99, 'https://www.mylatinatable.com/wp-content/uploads/2014/02/foto-h-750x500.jpg.webp'),
('Sopes', 'Tortillas de maíz con los bordes levantados, cubiertas con frijoles, carne, queso, crema y salsa.', 9.99, 'https://th.bing.com/th/id/OIP.nIyzeNF1iZjzl0qA74i3EgHaE7?pid=ImgDet&rs=1'),
('Chilaquiles', 'Tortillas de maíz cortadas y fritas, bañadas en salsa verde o roja, acompañadas de crema, queso y cebolla.', 8.99, 'https://images.pexels.com/photos/10305696/pexels-photo-10305696.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),
('Flautas', 'Tortillas de maíz enrolladas y rellenas de carne de pollo o res, fritas hasta quedar crujientes, acompañadas de crema y guacamole.', 9.99, 'https://www.maricruzavalos.com/wp-content/uploads/2019/09/chicken-flautas-recipe-1024x1024.jpg');


INSERT INTO CUPONES (CODIGO, DESCUENTO, USOS) VALUES
('CYBER2023', '10%', 5),
('HALLOW2023', '15%', 4),
('CODEXMAS23', '20%', 2),
('GEEKNYE23', '25%', 9),
('SPRINGBYTE', '30%', 10),
('SUMMERBUGS', '35%', 5),
('DATAWEEN23', '40%', 3),
('TECHPATRIOT', '45%', 2),
('THANKSDATA', '50%', 2),
('COMPHOLI23', '55%', 1);

INSERT INTO OFERTACOMIDA (NOMBRE, DESCRIPCION, PRECIO, DIA, URL)
VALUES
    ('Sandwich de pollo', 'Delicioso sandwich de pollo a la parrilla con lechuga, tomate y mayonesa', '6.99', 'MIERCOLES', 'https://ejemplo.com/sandwich-pollo'),
    ('Papas fritas con queso', 'Crujientes papas fritas cubiertas con queso cheddar derretido', '4.49', 'MIERCOLES', 'https://ejemplo.com/papas-queso'),
    ('Ensalada César', 'Fresca ensalada César con pollo a la parrilla, crutones y aderezo cremoso', '7.99', 'MIERCOLES', 'https://ejemplo.com/ensalada-cesar'),
    ('Jugo de mango', 'Refrescante jugo de mango natural sin azúcar añadida', '3.49', 'MIERCOLES', 'https://ejemplo.com/jugo-mango'),
    ('Limonada de coco', 'Deliciosa limonada con un toque tropical de coco y limón', '3.99', 'MIERCOLES', 'https://ejemplo.com/limonada-coco'),
    ('Batido de plátano', 'Cremoso batido de plátano con leche y un toque de canela', '4.99', 'MIERCOLES', 'https://ejemplo.com/batido-platano'),
    ('Burrito de carne', 'Sabroso burrito relleno de carne de res, frijoles, arroz y salsa picante', '8.99', 'JUEVES', 'https://ejemplo.com/burrito-carne'),
    ('Tostadas mexicanas', 'Deliciosas tostadas con frijoles, carne de cerdo deshebrada, lechuga y salsa', '6.99', 'JUEVES', 'https://ejemplo.com/tostadas-mexicanas'),
    ('Quesadillas de pollo', 'Quesadillas de pollo a la parrilla con queso derretido y guacamole', '7.99', 'JUEVES', 'https://ejemplo.com/quesadillas-pollo'),
    ('Jugo de piña', 'Refrescante jugo de piña natural sin azúcar añadida', '3.49', 'JUEVES', 'https://ejemplo.com/jugo-pina'),
    ('Batido de frutos rojos', 'Delicioso batido de frutos rojos con yogur y miel', '4.99', 'JUEVES', 'https://ejemplo.com/batido-frutos-rojos'),
    ('Agua de sandía', 'Refrescante agua de sandía natural sin azúcar añadida', '2.99', 'JUEVES', 'https://ejemplo.com/agua-sandia'),
    ('Sushi variado', 'Selección de sushi variado con diferentes tipos de pescado y vegetales', '15.99', 'VIERNES', 'https://ejemplo.com/sushi-variado'),
    ('Donas surtidas', 'Sabrosas donas surtidas con diferentes coberturas y rellenos', '5.99', 'VIERNES', 'https://ejemplo.com/donas-surtidas'),
    ('Wrap vegetariano', 'Delicioso wrap vegetariano con hummus, vegetales frescos y aceitunas', '6.99', 'VIERNES', 'https://ejemplo.com/wrap-vegetariano'),
    ('Jugo de sandía', 'Refrescante jugo de sandía natural sin azúcar añadida', '3.49', 'VIERNES', 'https://ejemplo.com/jugo-sandia'),
    ('Smoothie de plátano y espinaca', 'Nutritivo smoothie de plátano, espinaca y leche de almendras', '4.99', 'VIERNES', 'https://ejemplo.com/smoothie-platano-espinaca'),
    ('Café helado', 'Refrescante café helado con hielo, leche y sirope de vainilla', '3.99', 'VIERNES', 'https://ejemplo.com/cafe-helado');

INSERT INTO OFERTACOMIDA (NOMBRE, DESCRIPCION, PRECIO, DIA, URL)
VALUES
    ('Pollo a la parrilla', 'Jugosas piezas de pollo a la parrilla con papas asadas y ensalada', '9.99', 'SABADO', 'https://ejemplo.com/pollo-parrilla'),
    ('Sándwich de atún', 'Delicioso sándwich de atún con mayonesa, lechuga y tomate', '6.99', 'SABADO', 'https://ejemplo.com/sandwich-atun'),
    ('Tacos de pescado', 'Sabrosos tacos de pescado frito con repollo rallado y salsa de chipotle', '7.99', 'SABADO', 'https://ejemplo.com/tacos-pescado'),
    ('Jugo de uva', 'Refrescante jugo de uva natural sin azúcar añadida', '3.49', 'SABADO', 'https://ejemplo.com/jugo-uva'),
    ('Licuado de mango y coco', 'Delicioso licuado de mango y coco con leche de coco y trozos de mango', '4.99', 'SABADO', 'https://ejemplo.com/licuado-mango-coco'),
    ('Café con leche', 'Aromático café con leche caliente y espuma de leche', '3.99', 'SABADO', 'https://ejemplo.com/cafe-leche'),
    ('Pasta Alfredo', 'Deliciosa pasta con salsa Alfredo cremosa y trozos de pollo', '10.99', 'DOMINGO', 'https://ejemplo.com/pasta-alfredo'),
    ('Enchiladas suizas', 'Sabrosas enchiladas suizas rellenas de pollo, cubiertas con salsa verde y queso gratinado', '8.99', 'DOMINGO', 'https://ejemplo.com/enchiladas-suizas'),
    ('Hamburguesa vegetariana', 'Sabrosa hamburguesa vegetariana con hamburguesa de garbanzos, lechuga y tomate', '7.99', 'DOMINGO', 'https://ejemplo.com/hamburguesa-vegetariana'),
    ('Jugo de frutos rojos', 'Refrescante jugo de frutos rojos con fresas, frambuesas y arándanos', '4.49', 'DOMINGO', 'https://ejemplo.com/jugo-frutos-rojos'),
    ('Smoothie de mango y piña', 'Refrescante smoothie de mango y piña con yogur y miel', '4.99', 'DOMINGO', 'https://ejemplo.com/smoothie-mango-pina'),
    ('Té helado', 'Refrescante té helado con limón y hojas de menta', '2.99', 'DOMINGO', 'https://ejemplo.com/te-helado');
    
    
INSERT INTO RESENIAS (NOMBRE, OCUPACION, RESENA, CORREO, FECHA) VALUES
('John Doe', 'Ingeniero', '¡Excelente servicio y comida deliciosa! La Mesa de los Sabores es mi lugar favorito para disfrutar de una cena especial.', 'johndoe@example.com', '2023-01-01'),
('Jane Smith', 'Estudiante', 'El ambiente acogedor y la atención amable hacen que La Mesa de los Sabores sea perfecto para reuniones con amigos.', 'janesmith@example.com', '2023-01-15'),
('Michael Johnson', 'Abogado', 'Recomiendo probar el plato estrella de La Mesa de los Sabores: el salmón a la parrilla con salsa de cítricos. ¡Una delicia!', 'michaeljohnson@example.com', '2023-02-01'),
('Sarah Thompson', 'Diseñadora', 'La presentación de los platos en La Mesa de los Sabores es impecable. Cada bocado es una experiencia visual y gustativa.', 'sarahthompson@example.com', '2023-02-15'),
('David Wilson', 'Empresario', 'La atención al detalle en La Mesa de los Sabores es impresionante. Desde la decoración hasta los sabores, todo es excepcional.', 'davidwilson@example.com', '2023-03-01'),
('Emily Davis', 'Médico', 'Si buscas opciones vegetarianas, La Mesa de los Sabores tiene una amplia variedad de platos deliciosos para elegir.', 'emilydavis@example.com', '2023-03-15'),
('Daniel Martinez', 'Estudiante', 'La Mesa de los Sabores ofrece una experiencia gastronómica única. Cada plato es una explosión de sabores y creatividad.', 'danielmartinez@example.com', '2023-04-01'),
('Olivia Anderson', 'Contadora', 'Los postres en La Mesa de los Sabores son exquisitos. No te pierdas el pastel de chocolate con salsa de frutos rojos.', 'oliviaanderson@example.com', '2023-04-15'),
('Christopher Taylor', 'Ingeniero', 'El servicio en La Mesa de los Sabores es impecable. El personal es atento y siempre están dispuestos a hacer recomendaciones.', 'christophertaylor@example.com', '2023-05-01'),
('Sophia Thomas', 'Escritora', 'La carta de vinos en La Mesa de los Sabores es impresionante. Hay opciones para todos los gustos y precios.', 'sophiathomas@example.com', '2023-05-15'),
('Matthew Roberts', 'Estudiante', 'La Mesa de los Sabores ofrece un menú degustación que es una experiencia culinaria extraordinaria. ¡No te lo pierdas!', 'matthewroberts@example.com', '2023-05-30');


