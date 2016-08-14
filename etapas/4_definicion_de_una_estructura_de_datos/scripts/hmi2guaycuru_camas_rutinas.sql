/* Fecha de ultima actualizacion 22/06/2016 */

/* servicios get_id_efector_servicio */
DROP FUNCTION IF EXISTS servicios_get_id_efector_servicio;

/** 
*	Funcion para obtener el id_efector_servicio. La operacion de calculo es la 
*	siguiente: CONCAT(@id_efector,LPAD(@id_servicio_estadistica,3,'0'))
*
*	@param		id_efector					INTEGER			id del efector
*	@param		id_servicio_estadistica		INTEGER			id del servicio de estadistica
*	@return									INTEGER			id_efector_servicio o 
*															-1 = si id_efector no existe 
*															-2 = si id_servicio_estadistica no existe
*/

/* A procedure or function is considered deterministic if it always produces the same result for the 
	same input parameters, and not deterministic otherwise. If neither DETERMINISTIC nor NOT DETERMINISTIC 
	is given in the routine definition, the default is NOT DETERMINISTIC. */
	
DELIMITER $$

CREATE
    DEFINER = CURRENT_USER 
    FUNCTION servicios_get_id_efector_servicio (id_efector INTEGER, id_servicio_estadistica INTEGER)
    RETURNS INTEGER
    DETERMINISTIC
	COMMENT 'Calcula el id_efector_servicio'

BEGIN

	DECLARE aux_id INTEGER;
	
	/* check si id_efector existe */
	SET aux_id = 
		(SELECT 
			COUNT(*) 
		FROM 
			efectores e 
		WHERE 
			e.id_efector = id_efector);
	
	IF aux_id=0 THEN
		
		RETURN -1;
		
	END IF;
	
	
	/* check id_servicio_estadistica existe */
	SET aux_id = 
	
		(SELECT 
			COUNT(*) 
		FROM 
			servicios_estadistica se 
		WHERE 
			se.id_servicio_estadistica = id_servicio_estadistica);
	
	IF aux_id=0 THEN
		
		RETURN -2;
		
	END IF;
	
	/* si llego aqui genera el id a devolver */
	RETURN CONCAT(id_efector,LPAD(id_servicio_estadistica,3,'0'));

END$$

DELIMITER ;



/* servicios get_id_efector */

DROP FUNCTION IF EXISTS servicios_get_id_efector;

/** 
*	Devuelve el id_efector segun una clave de establecimiento SIMS
*
*	@param		claveestd					CHAR(8)			clave de establecimiento SIMS
*	@return									INTEGER			id_efector
*															-1 = si claveestd no existe 
*

/* A procedure or function is considered deterministic if it always produces the same result for the 
	same input parameters, and not deterministic otherwise. If neither DETERMINISTIC nor NOT DETERMINISTIC 
	is given in the routine definition, the default is NOT DETERMINISTIC. */
	
DELIMITER $$

CREATE
    DEFINER = CURRENT_USER 
    FUNCTION servicios_get_id_efector (claveestd CHAR(8))
    RETURNS INTEGER
    DETERMINISTIC
	COMMENT 'Retorna id_efector'

BEGIN

	DECLARE aux_id INTEGER;
	
	/* check claveestd existe */
	SET aux_id = 
		(SELECT 
			COUNT(*) 
		FROM 
			efectores e 
		WHERE 
			e.claveestd = claveestd);
	
	IF aux_id=0 THEN
		
		RETURN -1;
		
	END IF;
	
	
	/* get id_efector */
	SET aux_id = 
	
		(SELECT 
			id_efector 
		FROM 
			efectores e
		WHERE 
			e.claveestd = claveestd);
	
	IF aux_id=0 THEN
		
		RETURN -1;
		
	END IF;
	
	/* si llego aqui devuelve el id */
	RETURN aux_id;

END$$

DELIMITER ;


/* servicios get_id_servicio_estadistica */

DROP FUNCTION IF EXISTS servicios_get_id_servicio_estadistica;

/** 
*	Devuelve el id_efector segun una clave de establecimiento SIMS
*
*	@param		cod_servicio				CHAR(3)			cod 3 digitos de estadistica
*	@param		sector						CHAR(1)			sector
*	@param		subsector					CHAR(1)			subsector
*	@return									INTEGER			id_servicio_estadistica
*															-1 = si el codigo no existe 
*

/* A procedure or function is considered deterministic if it always produces the same result for the 
	same input parameters, and not deterministic otherwise. If neither DETERMINISTIC nor NOT DETERMINISTIC 
	is given in the routine definition, the default is NOT DETERMINISTIC. */
	
DELIMITER $$

CREATE
    DEFINER = CURRENT_USER 
    
    FUNCTION servicios_get_id_servicio_estadistica (
		cod_servicio CHAR(3),
		sector CHAR(1),
		subsector CHAR(1))
		
    RETURNS INTEGER
    DETERMINISTIC
	COMMENT 'Retorna id_servicio_estadistica'

BEGIN

	DECLARE aux_id INTEGER;
	
	/* check codigo de servicio estadistica existe */
	SET aux_id = 
		(SELECT 
			COUNT(*) 
		FROM 
			servicios_estadistica se 
		WHERE 
			se.cod_servicio = cod_servicio
		AND se.sector = sector
		AND se.subsector = subsector);
	
	IF aux_id=0 THEN
		
		RETURN -1;
		
	END IF;
	
	
	/* get id_servicio_estadistica */
	SET aux_id = 
	
		(SELECT 
			id_servicio_estadistica
		FROM 
			servicios_estadistica se 
		WHERE 
			se.cod_servicio = cod_servicio
		AND se.sector = sector
		AND se.subsector = subsector);
	
	IF aux_id=0 THEN
		
		RETURN -1;
		
	END IF;
	
	/* si llego aqui devuelve el id */
	RETURN aux_id;

END$$

DELIMITER ;



/* servicios_get_proximo_nro_sala */

DROP FUNCTION IF EXISTS servicios_get_proximo_nro_sala;

/** 
*	Funcion para obtener el proximo id_sala
*	La operacion de calculo es la 
*	siguiente: CONCAT(@id_efector,LPAD( MAX(nro_sala)+1 ,3,'0'))
*
*	@param		id_efector					INTEGER			id del efector
*	@return									INTEGER			nro_sala
*															-1 = si id_efector no existe 
*/

/* A procedure or function is considered deterministic if it always produces the same result for the 
	same input parameters, and not deterministic otherwise. If neither DETERMINISTIC nor NOT DETERMINISTIC 
	is given in the routine definition, the default is NOT DETERMINISTIC. */
	
DELIMITER $$

CREATE
    DEFINER = CURRENT_USER 
    FUNCTION servicios_get_proximo_nro_sala (id_efector INTEGER)
    RETURNS INTEGER
    DETERMINISTIC
	COMMENT 'Retorna el prox nro sala del efector'

BEGIN

	DECLARE aux_id INTEGER;
	DECLARE cantidad SMALLINT;
	DECLARE nro_sala SMALLINT;
	
	
	/* check si id_efector existe */
	SET aux_id = 
		(SELECT 
			COUNT(*) 
		FROM 
			efectores e 
		WHERE 
			e.id_efector = id_efector);
	
	IF aux_id=0 THEN
		
		RETURN -1;
		
	END IF;
	
	
	/* check al menos una sala del efector */
	SET cantidad =
		(SELECT
			COUNT(*) 
		FROM
			salas s
		WHERE 
			s.id_efector = id_efector);
			
	IF cantidad = 0 THEN
	
		SET nro_sala = 1;
		
	ELSE
	
		/* get proximo nro sala */
		SET nro_sala = 
		
			(SELECT 
				MAX(s.nro_sala)+1
			FROM 
				salas s
			WHERE 
				s.id_efector = id_efector);
	
	END IF;
	
	/* devuelve nro_sala */
	RETURN nro_sala;

END$$

DELIMITER ;


/* servicios_get_proximo_id_sala */

DROP FUNCTION IF EXISTS servicios_get_proximo_id_sala;

/** 
*	Funcion para obtener el proximo id_sala
*	La operacion de calculo es la 
*	siguiente: CONCAT(@id_efector,LPAD( MAX(nro_sala)+1 ,3,'0'))
*
*	@param		id_efector					INTEGER			id del efector
*	@return									INTEGER			id_sala
*															-1 = si id_efector no existe 
*/

/* A procedure or function is considered deterministic if it always produces the same result for the 
	same input parameters, and not deterministic otherwise. If neither DETERMINISTIC nor NOT DETERMINISTIC 
	is given in the routine definition, the default is NOT DETERMINISTIC. */
	
DELIMITER $$

CREATE
    DEFINER = CURRENT_USER 
    FUNCTION servicios_get_proximo_id_sala (id_efector INTEGER)
    RETURNS INTEGER
    DETERMINISTIC
	COMMENT 'Retorna el prox id_sala del efecto'

BEGIN

	DECLARE aux_id INTEGER;
	DECLARE cantidad SMALLINT;
	DECLARE nro_sala SMALLINT;
	
	
	SET nro_sala = servicios_get_proximo_nro_sala(id_efector);
	
	IF nro_sala = -1 THEN
	
		RETURN -1;
	
	END IF;
	
	/* si llego aqui genera el id a devolver */
	RETURN CONCAT(id_efector,LPAD(nro_sala,3,'0'));

END$$

DELIMITER ;


/* servicios_get_id_servicio_sala */

DROP FUNCTION IF EXISTS servicios_get_id_servicio_sala;

/** 
*	Funcion para obtener el id_servicio_sala formateado
*	La operacion de calculo es la 
*	siguiente: CONCAT(id_sala,LPAD( id_servicio_estadistica,3,'0'))
*
*	@param		id_sala						INTEGER			id de la sala
*	@param		id_servicio_estadistica		INTEGER			id servicio_estadistica
*	@return									INTEGER			id_servicio_sala
*															-1 = si id_sala no existe 
*															-2 = si id_servicio_estadistica no existe 
*/

/* A procedure or function is considered deterministic if it always produces the same result for the 
	same input parameters, and not deterministic otherwise. If neither DETERMINISTIC nor NOT DETERMINISTIC 
	is given in the routine definition, the default is NOT DETERMINISTIC. */
	
DELIMITER $$

CREATE
    DEFINER = CURRENT_USER 
    FUNCTION servicios_get_id_servicio_sala (id_sala INTEGER, id_servicio_estadistica INTEGER)
    RETURNS INTEGER
    DETERMINISTIC
	COMMENT 'Retorna el id_servicio_sala'

BEGIN

	DECLARE aux_id INTEGER;
	
	
	/* check si id_sala existe */
	SET aux_id = 
		(SELECT 
			COUNT(*) 
		FROM 
			salas s 
		WHERE 
			s.id_sala = id_sala);
	
	IF aux_id=0 THEN
		
		RETURN -1;
		
	END IF;
	
	/* check si id_servicio_estadistica existe */
	SET aux_id = 
		(SELECT 
			COUNT(*) 
		FROM 
			servicios_estadistica se 
		WHERE 
			se.id_servicio_estadistica = id_servicio_estadistica);
	
	IF aux_id=0 THEN
		
		RETURN -2;
		
	END IF;
	
	/* si llego aqui genera el id a devolver */
	RETURN CONCAT(id_sala,LPAD(id_servicio_estadistica,3,'0'));

END$$

DELIMITER ;



