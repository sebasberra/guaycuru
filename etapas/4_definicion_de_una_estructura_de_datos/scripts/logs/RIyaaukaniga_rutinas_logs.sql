
DROP FUNCTION IF EXISTS  logs_set_conexion;

DELIMITER $$

CREATE 
	DEFINER = CURRENT_USER 
	
	FUNCTION logs_set_conexion()
	RETURNS INTEGER
	MODIFIES SQL DATA
    COMMENT 'agrega conexion para logs'
    
BEGIN
	
	DECLARE estado INT(11);
	
	/* exit handler para falla de sql */
	DECLARE EXIT HANDLER FOR SQLEXCEPTION, SQLWARNING
	BEGIN
		
		RETURN -1;
	END;
	
    INSERT INTO
    
		logs_conexiones
    
    VALUES(
    
		/* id_log_conexion */
		0,
		
		/* connection_id */
		CONNECTION_ID(),
		
		/* user_db */
		SUBSTRING_INDEX(SESSION_USER(),'@',1),
		
		/* host_db */
		SUBSTRING_INDEX(SESSION_USER(),'@',-1),
		
		/* descripcion */
		'log automatico',
		
		/* fecha_hora */
		NOW()
		
		);
	
	RETURN 0;
	
END $$
DELIMITER ;


DROP FUNCTION IF EXISTS logs_get_id_conexion;
DELIMITER $$

CREATE FUNCTION logs_get_id_conexion() 
    RETURNS INT(11)
    READS SQL DATA
    COMMENT '0=no logeado o id_log_conexion'
BEGIN

	DECLARE id_log_conexion_aux INTEGER;
	
	/* exit handler para falla de sql */
	DECLARE EXIT HANDLER FOR SQLEXCEPTION, SQLWARNING
	BEGIN
		
		RETURN -1;
	END;
	
	/* busca id_conexion_aux segun parametro */
	SET id_log_conexion_aux =
		(SELECT 
			lg.id_log_conexion
		FROM
			logs_conexiones lg
		WHERE
			lg.my_connection_id = CONNECTION_ID()
		ORDER BY
			lg.fecha_hora DESC
		LIMIT 0,1);
	
	/* check si encontro al usuario */
	IF id_log_conexion_aux IS NOT NULL THEN
	
		RETURN id_log_conexion_aux;
		
	END IF;
	
	RETURN 0;
	
	
END $$
DELIMITER ;



DROP PROCEDURE IF EXISTS logs_debug;

DELIMITER $$

CREATE PROCEDURE logs_debug(
				IN nombre_tabla VARCHAR(64), 
				IN campos TEXT,
				IN valores TEXT,
				IN tipo_sql CHAR(1),
				OUT estado INTEGER,
				OUT msg VARCHAR(255))
	MODIFIES SQL DATA
	COMMENT 'Registra logs;-1:Elog;-2:Egral;-3:Ecom;-4:Estx;-5-6-7:Eset'
BEGIN
	
	/* var auxiliares */
	DECLARE id_log_conexion_aux			INTEGER;
	DECLARE connection_id_aux			BIGINT(4);
		
	/* sqlstates */
	DECLARE tabla_no_existe CONDITION 		FOR SQLSTATE '42S02';
	DECLARE sintaxis_acceso_error CONDITION FOR SQLSTATE '42000';
	DECLARE fallo_comunicacion CONDITION 	FOR SQLSTATE '08S01';
	DECLARE error_general CONDITION 		FOR SQLSTATE 'HY000';
	
	
	/* variables */
	DECLARE eof 				BOOLEAN;
	DECLARE cant_aux			INTEGER;
	DECLARE flag_set_conexion	INTEGER;	
		
	
	/* flag fetch cursors */
	DECLARE CONTINUE HANDLER 
		FOR 
			NOT FOUND 
		BEGIN
			SET eof = TRUE;
		END;
	/* handler para errores */
	DECLARE EXIT HANDLER 
		FOR 
			sintaxis_acceso_error
		BEGIN 
			/* return error */
			SET estado=-4;
			/* mensaje */
			SET msg='Error de sintaxis o error de acceso';
		END;
	DECLARE EXIT HANDLER 
		FOR 
			fallo_comunicacion
		BEGIN 
		
			/* return error */
			SET estado=-3;
			/* mensaje */
			SET msg='Error de comunicacion';
		END;
	DECLARE EXIT HANDLER 
		FOR 
			error_general
		BEGIN 
		
			/* return error */
			SET estado=-2;
			/* mensaje */
			SET msg='Error general';
		END;
	
	/* exit handler para falla de sql */
	DECLARE EXIT HANDLER FOR SQLEXCEPTION, SQLWARNING
	BEGIN
		
		/* return error */
		SET estado = -1;
		
		/* mensaje */
		SET msg='Error logs_debug';
		
	END;
		
	/* setea a OK */
	SET estado=0;
	
	/* check si esta habilitada la audicion de la base */
	(SELECT	
		COUNT(*) AS cant
	INTO
		cant_aux
	FROM 			
		logs_auditados la 		
	WHERE 
		la.estado = 1);
	
	IF cant_aux=0 THEN
	
	
		/* return warning */
		SET estado=2;
		
		/* no se audita la base */
		SET msg='Base no auditable';
		
		
	ELSE
	
	
		/* ------ */
		/* logger */
		/* ------ */
		
		
		/* check si login de conexion */
		SELECT
			logs_get_id_conexion()
		INTO
			id_log_conexion_aux;
		
		/* check error */
		IF id_log_conexion_aux<0 THEN 
		
			/* return warning */
			SET estado = -7;
			
			/* mensaje */
			SET msg = 'No se pudo capturar el id_log_conexion';
			
		END IF;
		
		IF id_log_conexion_aux=0 THEN
			
			/* set login */
			SET flag_set_conexion =
				(SELECT logs_set_conexion());

			/* check set login OK */
			IF flag_set_conexion = 0 THEN
			
				/* get id_log_conexion */
				SELECT
					logs_get_id_conexion()
				INTO
					id_log_conexion_aux;
				
				/* check error */
				IF id_log_conexion_aux<0 THEN 
				
					/* return warning */
					SET estado = -7;
					
					/* mensaje */
					SET msg = 'No se pudo capturar el id_log_conexion';
					
				END IF;	
				
				/* check seteo de conexion */
				IF id_log_conexion_aux=0 THEN
				
					/* return warning */
					SET estado = -5;
					
					/* mensaje */
					SET msg = 'No se pudo setear el login';
					
				END IF;
			
			ELSE
			
				/* fallo funcion losg_set_conexion */
				SET estado = -6;
				
				SET msg = 'Error al llamar la funcion logs_set_conexion';
				
			END IF;
			
		END IF;
		
	END IF;
	
	IF estado=0 THEN
			
		/* prepara el sql para ingresar el registro de datos */
		INSERT INTO 
		
			logs_datos 
			
		VALUES 
		
			(
						
			/* id_log_dato */
			NULL,
			
			/* id_log_conexion */
			id_log_conexion_aux,
				
			/* tabla */
			nombre_tabla,
				
			/* campos */
			campos,
			
			/* valores */
			valores,
			
			/* tipo_sql */
			tipo_sql,
				
			/* fecha_hora */
			NOW() );
		
	END IF;
			
END $$
DELIMITER ;


DROP FUNCTION IF EXISTS logs_set_descripcion;
DELIMITER $$

CREATE FUNCTION logs_set_descripcion( pDescripcion VARCHAR(255) ) 
    RETURNS INT(11)
    MODIFIES SQL DATA
    COMMENT 'Setea la descripcion: 0=OK; -1:error'
BEGIN
	
	DECLARE id_log_conexion_aux			INTEGER;
	DECLARE flag_set_conexion			INTEGER;
	
	/* exit handler para falla de sql */
	DECLARE EXIT HANDLER FOR SQLEXCEPTION, SQLWARNING
	BEGIN
		
		RETURN -1;
	END;
	
	/* get id_log_conexion */
	SET id_log_conexion_aux =
		(SELECT
			logs_get_id_conexion()
			);
	
	/* check error */
	IF id_log_conexion_aux<0 THEN 
	
		RETURN -1;
		
	END IF;
	
	/* check existe id_log_conexion */		
	IF id_log_conexion_aux=0 THEN
	
		/* set id_log_conexion */
		SET flag_set_conexion =
			(SELECT logs_set_conexion());
	
		IF flag_set_conexion<0 THEN
		
			RETURN -1;
			
		END IF;
		
		/* get id_log_conexion */
		SET id_log_conexion_aux =
			(SELECT
				logs_get_id_conexion()
				);
				
		/* check error */
		IF id_log_conexion_aux<0 THEN 
		
			RETURN -1;
			
		END IF;
	
	END IF;
	
	/* set descripcion */
	UPDATE
		logs_conexiones
	SET
		descripcion = TRIM(pDescripcion)
	WHERE
		id_log_conexion = id_log_conexion_aux;
	
	
	RETURN 0;
		
END$$

DELIMITER ;


DROP PROCEDURE IF EXISTS logs_debug_manual;

DELIMITER $$

CREATE PROCEDURE logs_debug_manual(
				IN descripcion VARCHAR(255), 
				IN info TEXT,
				OUT estado INTEGER,
				OUT msg VARCHAR(255))
	MODIFIES SQL DATA
	COMMENT 'Registra logs;-1:Elog;-2:Egral;-3:Ecom;-4:Estx;-5-6-7:Eset'

BEGIN
	
	DECLARE id_log_conexion_aux			INTEGER;
	DECLARE flag_set_conexion			INTEGER;
	DECLARE autocommit_old 				INTEGER;
	
	/* exit handler para falla de sql */
	DECLARE EXIT HANDLER FOR SQLEXCEPTION, SQLWARNING
	BEGIN
		
		ROLLBACK;
		SET autocommit=autocommit_old;
		SET estado = -2;
		SET msg = 'Error sqlexception o sqlwarning';
		
	END;
	
	
	/* inicializa estado */
	SET estado=0;
			
	/* get id_log_conexion */
	SET id_log_conexion_aux =
		(SELECT
			logs_get_id_conexion()
			);
	
	/* check error */
	IF id_log_conexion_aux<0 THEN 
	
		SET estado = -1;
		
		SET msg = 'Error al capturar id_log_conexion';
		
	ELSE
	
		/* check existe id_log_conexion */		
		IF id_log_conexion_aux=0 THEN
		
			/* set id_log_conexion */
			SET flag_set_conexion =
				(SELECT logs_set_conexion());
		
			IF flag_set_conexion<0 THEN
			
				/* fallo funcion losg_set_conexion */
				SET estado = -6;
				
				SET msg = 'Error al llamar la funcion logs_set_conexion';
				
			ELSE
			
				/* get id_log_conexion */
				SET id_log_conexion_aux =
					(SELECT
						logs_get_id_conexion()
						);
						
				/* check error */
				IF id_log_conexion_aux<0 THEN 
				
					SET estado = -1;
		
					SET msg = 'Error al capturar id_log_conexion';
					
				END IF;
		
			END IF;
	
		END IF;
	
	END IF;
	
	
	/* check OK */
	IF estado=0 THEN
	
		/* guarda el valor de autocommit antes de iniciar una transaccion */
		SET autocommit_old=(SELECT @@autocommit);
			
		/* transaccion */
		SET autocommit = 0;
		START TRANSACTION;
		
		
		/* set descripcion */
		UPDATE
			logs_conexiones
		SET
			descripcion = TRIM(descripcion)
		WHERE
			id_log_conexion = id_log_conexion_aux;
		
		/* logs datos */
		INSERT INTO 
			
			logs_datos 
			
		VALUES 
		
			(
						
			/* id_log_dato */
			NULL,
			
			/* id_log_conexion */
			id_log_conexion_aux,
				
			/* tabla */
			'logs_datos',
				
			/* campos */
			'Info',
			
			/* valores */
			info,
			
			/* tipo_sql */
			'L',
				
			/* fecha_hora */
			NOW() );
			
			
		/* commit */
		COMMIT;
		
		SET autocommit=autocommit_old;
				
		SET msg = 'Se guardo el debug manual';

	END IF;
		
END$$

DELIMITER ;
