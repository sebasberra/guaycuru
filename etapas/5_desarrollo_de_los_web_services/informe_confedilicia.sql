
DROP  TEMPORARY TABLE IF EXISTS informe_confedilicia_tmp;

SET @id_efector =
	(SELECT
		cs.id_efector
	FROM
		configuraciones_sistemas cs
	WHERE
		cs.activa = 1);
	
CREATE TEMPORARY TABLE informe_confedilicia_tmp

SELECT 
	s.nombre AS 'nombre_sala',
	'-1' AS 'nombre_habitacion',
	'-1' AS 'nombre_cama' 
	
FROM 
	salas s
WHERE 

	s.id_efector=@id_efector
	
UNION 

SELECT 
	s.nombre AS 'nombre_sala',
	h.nombre AS 'nombre_habitacion',
	'-1' AS 'nombre_cama' 
	
FROM 
	habitaciones h
INNER JOIN
	salas s
ON h.id_sala = s.id_sala	
WHERE 
	s.id_efector=@id_efector
	
UNION

SELECT 
	IFNULL(s.nombre,'-1') AS 'nombre_sala',
	IFNULL(h.nombre,'-1') AS 'nombre_habitacion',
	c.nombre AS 'nombre_cama' 
	
FROM
	camas c

LEFT JOIN
	habitaciones h

ON c.id_habitacion = h.id_habitacion

LEFT JOIN
	salas s
ON h.id_sala = s.id_sala

WHERE 
	c.id_efector=@id_efector;
	
SELECT 
	nombre_sala,
	nombre_habitacion,
	nombre_cama
FROM 
	informe_confedilicia_tmp 
ORDER BY 
	nombre_sala,
	nombre_habitacion,
	nombre_cama;
