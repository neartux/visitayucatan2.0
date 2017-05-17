SELECT usuario.id, usuario.username, usuario.password,
  datos_personales.id AS iddatospersonales, datos_personales.nombres, datos_personales.apellidos,
  datos_ubicacion.direccion,datos_ubicacion.telefono,datos_ubicacion.celular,datos_ubicacion.email
FROM usuario
  INNER JOIN datos_personales ON datos_personales.id = usuario.id_datospersonales
  INNER JOIN datos_ubicacion ON datos_ubicacion.id = usuario.id_datosubicacion
WHERE usuario.id_estatus = 1;

SELECT usuario.id
FROM usuario
WHERE usuario.id != 3
      AND usuario.username = 'rdzul';

SELECT *
FROM tour;

SELECT * FROM tour_imagen;

UPDATE usuario SET password = md5('demo');

SELECT *
FROM datos_ubicacion;

SELECT *
FROM datos_personales;

SELECT *
FROM tour_imagen;

SELECT hotel.id, hotel.descripcion, hotel.estrellas, hotel.promovido,
  destino.descripcion AS destino, datos_ubicacion.direccion, datos_ubicacion.telefono
FROM hotel
  INNER JOIN datos_ubicacion ON datos_ubicacion.id = hotel.id_datosubicacion
  INNER JOIN destino ON destino.id = hotel.id_destino AND destino.id_estatus = 1
WHERE hotel.id_estatus = 1;

SELECT datos_personales.nombres, datos_personales.apellidos, datos_ubicacion.email
FROM hotel_contacto
  INNER JOIN datos_personales ON datos_personales.id = hotel_contacto.id_datospersonales
  INNER JOIN datos_ubicacion ON datos_ubicacion.id = hotel_contacto.id_datosubicacion
WHERE hotel_contacto.id_hotel = 1
      AND hotel_contacto.id_estatus = 1;

drop TABLE tour;
USE visitayucatandb;
UPDATE usuario SET password = md5('rdzul') WHERE usuario.id = 4;

SELECT tour.id, tour.descripcion AS nombre,tour_idioma.circuito,tour_idioma.descripcion,
                (tour_origen.tarifaadulto/moneda.tipo_cambio) AS tarifaadulto,(tour_origen.tarifamenor/moneda.tipo_cambio) AS tarifamenor,
                tour_imagen.path AS imagen,moneda.simbolo AS simbolomoneda
FROM tour
  INNER JOIN tour_idioma ON tour.id = tour_idioma.id_tour AND tour_idioma.id_idioma = 1 AND tour_idioma.id_estatus = 1
  INNER JOIN tour_origen ON tour.id = tour_origen.id_tour AND tour_origen.id_origen = 1 AND tour_origen.id_estatus = 1
  INNER JOIN idioma ON idioma.id = tour_idioma.id_idioma AND idioma.id = 1
  INNER JOIN moneda ON moneda.id = 2
  LEFT JOIN tour_imagen ON tour.id = tour_imagen.id_tour AND tour_imagen.id_estatus = 1 AND tour_imagen.principal = TRUE
WHERE tour.id_estatus = 1
ORDER BY tour_origen.tarifaadulto, tour.descripcion LIMIT 20 OFFSET 0;

SELECT * FROM tour_idioma WHERE id_tour = 5;

DROP TABLE hotel_habitacion;


SELECT hotel_tarifa.*
FROM hotel_tarifa
WHERE hotel_tarifa.id_hotel_habitacion =  1
      AND hotel_tarifa.id_hotel_contrato = 1
      AND hotel_tarifa.id_hotel = 1
      AND hotel_tarifa.id_estatus = 1
      AND hotel_tarifa.fecha = '2016-03-01';

DELETE FROM hotel_tarifa WHERE hotel_tarifa.id_hotel_contrato = 1 AND hotel_tarifa.id_hotel_habitacion = 1 AND hotel_tarifa.id_hotel = 1
                               AND hotel_tarifa.fecha BETWEEN '2016-02-01' AND '2016-03-31';

INSERT INTO hotel_tarifa (id, id_hotel, id_hotel_contrato, id_hotel_habitacion, id_estatus, fecha, sencillo, doble, triple, cuadruple) VALUES (null, 1, 1, 1, 1, '2016-03-16', 10, 20, 30, 40);

SELECT *
FROM hotel_tarifa;


#-- Detalle de tour --
SELECT tour.id, tour.descripcion AS nombre,tour_idioma.circuito,tour_idioma.descripcion,tour_idioma.soloadultos,tour.minimopersonas,
                (tour_origen.tarifaadulto/moneda.tipo_cambio) AS tarifaadulto,(tour_origen.tarifamenor/moneda.tipo_cambio) AS tarifamenor,
                tour_imagen.path AS imagen,moneda.simbolo AS simbolomoneda,origen.descripcion AS origen
FROM tour
  INNER JOIN tour_idioma ON tour.id = tour_idioma.id_tour AND tour_idioma.id_idioma = 1 AND tour_idioma.id_estatus = 1
  INNER JOIN tour_origen ON tour.id = tour_origen.id_tour AND tour_origen.id_origen = 1 AND tour_origen.id_estatus = 1
  INNER JOIN idioma ON idioma.id = tour_idioma.id_idioma AND idioma.id = 1
  INNER JOIN moneda ON moneda.id = 2
  LEFT JOIN tour_imagen ON tour.id = tour_imagen.id_tour AND tour_imagen.id_estatus = 1 AND tour_imagen.principal = TRUE,origen
WHERE tour.id = 1
      AND tour.id_estatus = 1
      AND origen.id = tour_origen.id_origen;

#hoteles web
select ht.*, (min(ht.doble)/$tcambio) as tarifamin, h.hotel, h.stars, hd.descripcion, hi.imagen, m.simbolo
from hoteles_tarifas ht
  left join hoteles h on h.idhotel = ht.idhotel
  left join hoteles_descripciones hd on hd.idhotel = ht.idhotel and hd.ididioma = '$idioma'
  left join moneda m on m.idmoneda = $moneda
  left join hoteles_imagenes hi on hi.idhotel = ht.idhotel
where ht.fecha = curdate() and h.idestatus = 1 and h.iddestino = '$iddestino'
group by idhotel order by tarifa asc;



SELECT hotel.id,hotel.estrellas,hotel_idioma.nombrehotel,hotel_idioma.descripcion,hotel_imagen.path AS imagen,moneda.simbolo,hotel_tarifa.doble
  ,(min(hotel_tarifa.doble)/moneda.tipo_cambio) AS tarifa
FROM hotel
  INNER JOIN hotel_tarifa ON hotel.id = hotel_tarifa.id_hotel AND hotel_tarifa.fecha = curdate() AND hotel_tarifa.id_estatus = 1
  INNER JOIN hotel_idioma ON hotel.id = hotel_idioma.id_hotel AND hotel_idioma.id_idioma = 1 AND hotel_idioma.id_estatus = 1
  INNER JOIN idioma ON idioma.id = hotel_idioma.id_idioma AND idioma.id = 1 AND idioma.id_estatus = 1
  INNER JOIN destino ON destino.id = hotel.id_destino AND destino.id = 1 AND destino.id_estatus = 1
  INNER JOIN moneda ON moneda.id = 1 AND moneda.id_estatus = 1
  LEFT JOIN hotel_imagen ON hotel.id = hotel_imagen.id_hotel AND hotel_imagen.principal = TRUE  AND hotel_imagen.id_estatus = 1
WHERE hotel.id_estatus = 1
      AND hotel.promovido = TRUE
GROUP BY hotel_tarifa.id_hotel ORDER BY hotel_tarifa.doble ASC
;

SELECT *
FROM hotel;

SELECT *
FROM hotel_tarifa;


#-- SQL para articulos de paginas

SELECT articulo_idioma.nombre,articulo_idioma.descripcion
FROM articulo
  INNER JOIN articulo_idioma ON articulo.id = articulo_idioma.id_articulo
  INNER JOIN idioma ON idioma.id = articulo_idioma.id_idioma AND idioma.id = 1 AND idioma.id_estatus = 1
WHERE articulo.tipoarticulo = 'pagina'
      AND articulo.seccionarticulo = 'tour'
      AND articulo.id_estatus = 1
;

#-- SQL para paquetes

SELECT p.id, pd.descripcion as nombre, pd.incluye,  p.circuito, pf.nombreoriginal as archivo,
             (select min(costosencillo) from paquete_combinacion_hotel where id_paquete = p.id) as sencilla, m.simbolo as simbolmoneda
from paquete p
  left join paquete_idioma pd on pd.id_paquete = p.id
  left join paquete_imagen pf on pf.id_paquete = p.id and pf.principal = 1
  left join moneda m on m.id = 1
where p.id_estatus = 1 and pd.id_idioma = 1 order by sencilla
;

SELECT paquete.id,paquete_idioma.descripcioncorta,paquete_idioma.descripcionlarga,paquete_idioma.incluye,paquete_idioma.descripcion AS nombrepaquete,
                                                                                                         paquete_imagen.path AS imagen,moneda.simbolo,
                                                                                                         (select min(paquete_combinacion_hotel.costosencillo)/moneda.tipo_cambio from paquete_combinacion_hotel where paquete_combinacion_hotel.id_paquete = paquete.id) as sencilla
FROM paquete
  INNER JOIN paquete_idioma ON paquete.id = paquete_idioma.id_paquete AND paquete_idioma.id_estatus = 1
  INNER JOIN idioma ON idioma.id = paquete_idioma.id_idioma AND idioma.id = 1 AND idioma.id_estatus = 1
  INNER JOIN moneda ON moneda.id = 1 AND moneda.id_estatus = 1
  LEFT JOIN paquete_imagen ON paquete.id = paquete_imagen.id_paquete AND paquete_imagen.id_estatus = 1
WHERE paquete.id_estatus = 1
      AND paquete.promovido = TRUE
ORDER BY sencilla
;

SELECT *
FROM paquete;


SELECT *
FROM hotel_idioma;


SELECT articulo.id AS idarticulo,articulo_idioma.id AS idarticuloidioma,articulo_idioma.nombre,articulo_idioma.descripcion,articulo_idioma.descripcion_corta
FROM articulo
  INNER JOIN articulo_idioma ON articulo.id = articulo_idioma.id_articulo
  INNER JOIN idioma ON idioma.id = articulo_idioma.id_idioma AND idioma.id = 1 AND idioma.id_estatus = 1
WHERE articulo.id = 1
      AND articulo.tipoarticulo = 'peninsula';

SELECT *
FROM articulo;

SELECT hotel.id,hotel.estrellas,hotel_idioma.nombrehotel,hotel_idioma.descripcion,hotel_imagen.path AS imagen,moneda.simbolo,hotel_tarifa.doble
  ,(min(hotel_tarifa.doble)/moneda.tipo_cambio) AS tarifa
FROM hotel
  INNER JOIN hotel_tarifa ON hotel.id = hotel_tarifa.id_hotel AND hotel_tarifa.fecha = curdate() AND hotel_tarifa.id_estatus = 1
  INNER JOIN hotel_idioma ON hotel.id = hotel_idioma.id_hotel AND hotel_idioma.id_idioma = 1 AND hotel_idioma.id_estatus = 1
  INNER JOIN idioma ON idioma.id = hotel_idioma.id_idioma AND idioma.id = 1 AND idioma.id_estatus = 1
  INNER JOIN moneda ON moneda.id = 1 AND moneda.id_estatus = 1
  LEFT JOIN hotel_imagen ON hotel.id = hotel_imagen.id_hotel AND hotel_imagen.principal = TRUE  AND hotel_imagen.id_estatus = 1
WHERE hotel.id = 2
      AND hotel.id_estatus = 1
      AND hotel.promovido = TRUE
GROUP BY hotel_tarifa.id_hotel LIMIT 1;


SELECT *
FROM articulo;

#-- TODO esta es la consulta para traer las tarifas de hotel
SELECT hotel_habitacion.id AS idhabitacion,hotel_habitacion.allotment,hotel_habitacion.capacidadmaxima,hotel_habitacion.nombre,
  hotel_habitacion_idioma.descripcion,moneda.id AS moneda,moneda.simbolo AS simbolomoneda,moneda.tipo_cambio AS tipocambiomoneda,
  hotel_tarifa.fecha,hotel_tarifa.sencillo AS costosencillo,hotel_tarifa.doble AS costodoble,hotel_tarifa.triple AS costotriple,hotel_tarifa.cuadruple AS costocuadruple,
  hotel_contrato.id AS idcontrato,hotel_contrato.aplicaimpuesto,hotel_contrato.iva,hotel_contrato.ish,hotel_contrato.markup,hotel_contrato.fee
FROM hotel_habitacion
  INNER JOIN hotel_contrato ON hotel_contrato.id_hotel = hotel_habitacion.id_hotel AND hotel_contrato.id_estatus = 1
  INNER JOIN hotel_tarifa ON hotel_habitacion.id = hotel_tarifa.id_hotel_habitacion AND hotel_tarifa.id_hotel = 2 AND hotel_tarifa.id_estatus = 1
  INNER JOIN hotel_habitacion_idioma ON hotel_habitacion.id = hotel_habitacion_idioma.id_hotel_habitacion AND hotel_habitacion.id_estatus = 1
  INNER JOIN idioma ON idioma.id = hotel_habitacion_idioma.id_idioma AND idioma.id = 1 AND idioma.id_estatus = 1
  INNER JOIN moneda ON moneda.id = 1 AND moneda.id_estatus = 1
WHERE hotel_habitacion.id_hotel = 2 AND hotel_habitacion.id_estatus = 1
      AND hotel_habitacion.allotment > 0
      AND hotel_tarifa.fecha BETWEEN '2016-04-18' AND '2016-04-22'
ORDER BY hotel_habitacion.id, hotel_tarifa.fecha ASC;

# TODO consulta para obtener las fechas cierres de un hotel
SELECT hotel_fecha_cierre.id, hotel_fecha_cierre.fechainicio, hotel_fecha_cierre.fechafin
FROM hotel_fecha_cierre
  INNER JOIN hotel_contrato ON hotel_contrato.id = 4 AND hotel_contrato.id_hotel = 2
WHERE hotel_fecha_cierre.id_hotel = 2
      AND hotel_fecha_cierre.id_estatus = 1;

#-- Detalle de hotel
SELECT hotel.id,hotel.estrellas,hotel_idioma.nombrehotel,hotel_idioma.descripcion,hotel_imagen.path
FROM hotel
  INNER JOIN hotel_idioma ON hotel.id = hotel_idioma.id_hotel AND hotel_idioma.id_idioma = 1 AND hotel_idioma.id_estatus = 1
  LEFT JOIN hotel_imagen ON hotel.id = hotel_imagen.id_hotel AND hotel_imagen.principal = TRUE AND hotel_imagen.id_estatus = 1
WHERE hotel.id = 2
      AND hotel.id_estatus = 1
      AND hotel.promovido = TRUE;

SELECT *
FROM hotel_idioma
WHERE hotel_idioma.id_hotel = 2 ;








--TODO no ejecutado
INSERT INTO datos_ubicacion(direccion, codigopostal, telefono, celular) VALUES ('Acanceh', '97380', '9993599516', '9993599516');
INSERT INTO datos_personales(nombres, apellidos) VALUES ('Ricardo', 'Dzul');
INSERT INTO usuario(id_estatus, id_datospersonales, id_datosubicacion, username, password) VALUES (1, 249,272,'superuser', md5('superuser'));