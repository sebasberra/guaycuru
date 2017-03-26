DELIMITER ;

DROP FUNCTION IF EXISTS hmi2_str_limpiar_espacios;

DELIMITER $$

CREATE DEFINER=CURRENT_USER 
FUNCTION hmi2_str_limpiar_espacios
	(texto VARCHAR(255)) 
RETURNS 
	VARCHAR(255) CHARSET latin1
NO SQL
    DETERMINISTIC
    COMMENT 'Elimina espacios extras de un string'
BEGIN
	WHILE INSTR(texto, '  ') > 0 DO
	
		SET texto = REPLACE(texto, '  ', ' ');
		
	END WHILE;
	
	RETURN TRIM(texto);
	
END$$

DELIMITER ;

DROP FUNCTION IF EXISTS hmi2_str_split;

DELIMITER $$

CREATE DEFINER=CURRENT_USER 
FUNCTION hmi2_str_split(
			texto VARCHAR(255),
			delim VARCHAR(12),
			pos INT) 
RETURNS 
	VARCHAR(255) CHARSET latin1
			
    NO SQL
    DETERMINISTIC
    COMMENT 'Devuelve string segun delimitador y posicion'
BEGIN
        
    RETURN 
        REPLACE(
            SUBSTRING(
                SUBSTRING_INDEX(
                            texto, 
                            delim, 
                            pos),
                LENGTH(
                    SUBSTRING_INDEX(
                                texto, 
                                delim, 
                                pos -1)
                        ) + 1
                    ),
            delim, 
            '');
END$$

DELIMITER ;

DROP FUNCTION IF EXISTS hmi2_str_prefijo_cama;

DELIMITER $$

CREATE DEFINER=CURRENT_USER 
FUNCTION hmi2_str_prefijo_cama(
			id_habitacion INT) 
RETURNS 
	VARCHAR(255) CHARSET latin1
			
    NO SQL
    DETERMINISTIC
    COMMENT 'Devuelve primeras letras de sala-habitacion'
BEGIN
    
    DECLARE nombre_sala VARCHAR(255);
    DECLARE nombre_habitacion VARCHAR(255);
    DECLARE ns VARCHAR(255);
    DECLARE nh VARCHAR(255);
    
    DECLARE prefijo VARCHAR(255);
    
    DECLARE pos INTEGER;
    
    /* nombre sala */		
    SET nombre_sala =
		(SELECT 
			hmi2_str_limpiar_espacios(s.nombre)
		FROM
			salas s
		INNER JOIN
			habitaciones h
		ON
			h.id_sala = s.id_sala
		WHERE
			h.id_habitacion = id_habitacion);
			
	SET prefijo = '';
	
	SET pos=1;    
    SET ns = 
		(SELECT 
			hmi2_str_split(nombre_sala,' ',pos)
			);
			
	WHILE ns<>'' DO
		
		SET prefijo=CONCAT(prefijo,LEFT(ns,1));
		
		SET pos=pos+1;    
		SET ns = 
			(SELECT 
				hmi2_str_split(nombre_sala,' ',pos)
				);
				
	END WHILE;
	
	SET prefijo=CONCAT(prefijo,'-');
	
	
	/* nombre habitacion */
	SET nombre_habitacion =
		(SELECT
			hmi2_str_limpiar_espacios(h.nombre)
		FROM
			habitaciones h
		WHERE
			h.id_habitacion = id_habitacion);
			
	SET pos=1;    
    SET nh = 
		(SELECT 
			hmi2_str_split(nombre_habitacion,' ',pos)
			);
			
	WHILE nh<>'' DO
		
		SET prefijo=CONCAT(prefijo,LEFT(nh,1));
		
		SET pos=pos+1;    
		SET nh = 
			(SELECT 
				hmi2_str_split(nombre_habitacion,' ',pos)
				);
				
	END WHILE;
				
    RETURN 
        prefijo;
        
END $$
