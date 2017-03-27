/* migracion de datos del efector que tiene instalado Diagnose	*/
/* a la estructura de datos de gestion de camas criticas		*/

/* id_efector */
SET @id_efector = 183;
		
		
/* salas */
INSERT INTO hmi2guaycuru_camas.salas
	
SELECT

	/* id_sala */
	hmi2guaycuru_camas.servicios_get_proximo_id_sala(
		@id_efector
	),
		
	/* id_efector */
	@id_efector,
	
	/* nro_sala */
	hmi2guaycuru_camas.servicios_get_proximo_nro_sala(
		@id_efector
	),
		
	/* nombre */
	s.nombre,
	
	/* cant_camas */
	s.cant_camas,
	
	/* mover_camas */
	s.mover_camas,
	
	/* area_id_efector_servicio */
	NULL,
	
	/* area_cod_servicio */
	NULL,
	
	/* area_sector */
	NULL,
	
	/* area_subsector */
	NULL,
	
	/* baja */
	FALSE,
	
	/* fecha_modificacion */
	NULL
	
FROM

	hpc_hmi2_20161027.salas s
	
WHERE

	s.id_efector = @id_efector;
	
	
	

	
	
	
/* habitaciones */
INSERT INTO
	
	hmi2guaycuru_camas.habitaciones
	
SELECT

	/* id_habitacion */
	0,
	
	/* id_sala */
	(SELECT
		s1.id_sala
	FROM
		hmi2guaycuru_camas.salas s1
	WHERE
		s1.id_efector = @id_efector
	AND s1.nombre = (
		SELECT
			s0.nombre
		FROM
			hpc_hmi2_20161027.salas s0
		WHERE
			s0.id_sala = h0.id_sala
		)
	),
				
	/* nombre */
	h0.nombre,
	
	/* sexo */
	h0.sexo,
	
	/* edad_desde */
	h0.edad_desde,
	
	/* edad_hasta */
	h0.edad_hasta,
	
	/* tipo_edad */
	h0.tipo_edad,
	
	/* cant_camas */
	h0.cant_camas,
	
	/* baja */
	h0.baja,
	
	/* fecha_modificacion */
	NULL
	
FROM

	hpc_hmi2_20161027.habitaciones h0;
	
		
		
/* camas */
INSERT INTO
	
	hmi2guaycuru_camas.camas 
	
SELECT

	/* id_cama */
	0,
	
	/* id_clasificacion_cama */
	c.id_clasificacion_cama,
  
	/* id_efector */
	c.id_efector,
	
	/* id_habitacion */
	(SELECT
		h1.id_habitacion
	FROM
		hmi2guaycuru_camas.habitaciones h1
	WHERE
		h1.nombre = (
			SELECT
				h0.nombre
			FROM
				hpc_hmi2_20161027.camas c0
			INNER JOIN
				hpc_hmi2_20161027.habitaciones h0
			ON
				c0.id_habitacion = h0.id_habitacion
			WHERE
				c0.id_cama = c.id_cama
			)
				
	AND h1.id_sala =	
		(SELECT
			s1.id_sala
		FROM
			hmi2guaycuru_camas.salas s1
		WHERE
			s1.id_efector = @id_efector
		AND s1.nombre = (
			SELECT
				s0.nombre
			FROM
				hpc_hmi2_20161027.salas s0
			WHERE
				s0.id_sala = (
					SELECT
						h0.id_sala
					FROM
						hpc_hmi2_20161027.camas c0
					INNER JOIN
						hpc_hmi2_20161027.habitaciones h0
					ON
						c0.id_habitacion = h0.id_habitacion
					WHERE
						c0.id_cama = c.id_cama
					)
			)
		)
	),
	
	/* id_internacion */
	IF(c.estado='O',1,0),
	
	/* nombre */
	c.nombre,
	
	/* estado */
	c.estado,
	
	/* rotativa */
	c.rotativa,
	
	/* baja */
	c.baja,
	
	/* fecha_modificacion */
	NULL
	
FROM

	hpc_hmi2_20161027.camas c;
	
  
	
/* servicios_salas */
INSERT INTO

	hmi2guaycuru_camas.servicios_salas

SELECT

	/* id_servicio_sala */
	hmi2guaycuru_camas.servicios_get_id_servicio_sala(
		
		/* id_sala */
		(SELECT
			s1.id_sala
		FROM
			hmi2guaycuru_camas.salas s1
		WHERE
			s1.id_efector = @id_efector
		AND s1.nombre = (
			SELECT
				s0.nombre
			FROM
				hpc_hmi2_20161027.salas s0
			WHERE
				s0.id_sala = ss.id_sala
			)
		),
		
		/* id_servicio_estadistica */
		hmi2guaycuru_camas.servicios_get_id_servicio_estadistica(
		
			(SELECT
				es0.cod_servicio
			FROM
				hpc_hmi2_20161027.efectores_servicios es0
			WHERE
				es0.id_efector_servicio = ss.id_efector_servicio
			),
			
			(SELECT
				es0.sector
			FROM
				hpc_hmi2_20161027.efectores_servicios es0
			WHERE
				es0.id_efector_servicio = ss.id_efector_servicio
			),
			
			(SELECT
				es0.subsector
			FROM
				hpc_hmi2_20161027.efectores_servicios es0
			WHERE
				es0.id_efector_servicio = ss.id_efector_servicio
			)
		)
		
	),
				
	/* id_efector */
	@id_efector,
	
	/* id_efector_servicio */
	hmi2guaycuru_camas.servicios_get_id_efector_servicio(
	
		/* id_efector */
		@id_efector,
		
		/* id_servicio_estadistica */
		hmi2guaycuru_camas.servicios_get_id_servicio_estadistica(
		
			(SELECT
				es0.cod_servicio
			FROM
				hpc_hmi2_20161027.efectores_servicios es0
			WHERE
				es0.id_efector_servicio = ss.id_efector_servicio
			),
			
			(SELECT
				es0.sector
			FROM
				hpc_hmi2_20161027.efectores_servicios es0
			WHERE
				es0.id_efector_servicio = ss.id_efector_servicio
			),
			
			(SELECT
				es0.subsector
			FROM
				hpc_hmi2_20161027.efectores_servicios es0
			WHERE
				es0.id_efector_servicio = ss.id_efector_servicio
			)
		)
		
	),
		
	/* id_sala */
	(SELECT
		s1.id_sala
	FROM
		hmi2guaycuru_camas.salas s1
	WHERE
		s1.id_efector = @id_efector
	AND s1.nombre = (
		SELECT
			s0.nombre
		FROM
			hpc_hmi2_20161027.salas s0
		WHERE
			s0.id_sala = ss.id_sala
		)
	),
	
	/* agudo_cronico */
	0,
				
	/* tipo_servicio_sala */
	0,
	
	/* baja */
	ss.baja,
	
	/* fecha_modificacion */
	NULL
	
FROM

	hpc_hmi2_20161027.servicios_salas ss
	
INNER JOIN

	hpc_hmi2_20161027.salas s
	
ON

	s.id_sala = ss.id_sala
	
WHERE

	s.id_efector = @id_efector
AND	ss.baja = FALSE;
	
	
