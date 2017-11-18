
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

	@id_efector AS 'id_efector',
	
	s.nombre AS 'sala_nombre',
	s.cant_camas AS 'sala_cant_camas',
	s.mover_camas AS 'sala_mover_camas',
	
	'-1' AS 'habitacion_nombre',
	'-1' AS 'habitacion_sexo',
	'-1' AS 'habitacion_edad_desde',
	'-1' AS 'habitacion_edad_hasta',
	'-1' AS 'habitacion_tipo_edad',
	'-1' AS 'habitacion_cant_camas',
	'-1' AS 'habitacion_baja',
	
	'-1' AS 'cama_nombre',
	'-1' AS 'cama_id_clasificacion_cama',
	'-1' AS 'cama_estado',
	'-1' AS 'cama_rotativa',
	'-1' AS 'cama_baja'
	
FROM 
	salas s
WHERE 

	s.id_efector=@id_efector
	
UNION 

SELECT 

	@id_efector AS 'id_efector',
	
	s.nombre AS 'sala_nombre',
	s.cant_camas AS 'sala_cant_camas',
	s.mover_camas AS 'sala_mover_camas',
	
	h.nombre AS 'habitacion_nombre',
	h.sexo AS 'habitacion_sexo',
	h.edad_desde AS 'habitacion_edad_desde',
	h.edad_hasta AS 'habitacion_edad_hasta',
	h.tipo_edad AS 'habitacion_tipo_edad',
	h.cant_camas AS 'habitacion_cant_camas',
	h.baja AS 'habitacion_baja',
	
	'-1' AS 'cama_nombre',
	'-1' AS 'cama_id_clasificacion_cama',
	'-1' AS 'cama_estado',
	'-1' AS 'cama_rotativa',
	'-1' AS 'cama_baja' 
	
FROM 
	habitaciones h
INNER JOIN
	salas s
ON h.id_sala = s.id_sala	
WHERE 
	s.id_efector=@id_efector
	
UNION

SELECT 

	@id_efector AS 'id_efector',
	
	IFNULL(s.nombre,'-1') AS 'nombre_sala',
	IFNULL(s.cant_camas,'-1') AS 'sala_cant_camas',
	IFNULL(s.mover_camas,'-1') AS 'sala_mover_camas',
	
	IFNULL(h.nombre,'-1') AS 'nombre_habitacion',
	IFNULL(h.sexo,'-1') AS 'habitacion_sexo',
	IFNULL(h.edad_desde,'-1') AS 'habitacion_edad_desde',
	IFNULL(h.edad_hasta,'-1') AS 'habitacion_edad_hasta',
	IFNULL(h.tipo_edad,'-1') AS 'habitacion_tipo_edad',
	IFNULL(h.cant_camas,'-1') AS 'habitacion_cant_camas',
	IFNULL(h.baja,'-1') AS 'habitacion_baja',
	
	c.nombre AS 'cama_nombre',
	c.id_clasificacion_cama AS 'cama_id_clasificacion_cama',
	c.estado AS 'cama_estado',
	c.rotativa AS 'cama_rotativa',
	c.baja AS 'cama_baja'
	
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
	
	id_efector,
	
	sala_nombre,
	sala_cant_camas,
	sala_mover_camas,
	
	habitacion_nombre,
	habitacion_sexo,
	habitacion_edad_desde,
	habitacion_edad_hasta,
	habitacion_tipo_edad,
	habitacion_cant_camas,
	habitacion_baja,
	
	cama_nombre,
	cama_id_clasificacion_cama,
	cama_estado,
	cama_rotativa,
	cama_baja
	
FROM 

	informe_confedilicia_tmp 
	
ORDER BY 

	sala_nombre,
	habitacion_nombre,
	cama_nombre;

