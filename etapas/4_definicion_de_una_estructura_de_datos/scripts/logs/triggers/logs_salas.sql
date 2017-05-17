/* Generacion automatica de TRIGGERS para Logger */
/* Fecha y hora: 05/14/2017 00:22  */
/* Servidor: localhost Puerto:  */
/* Base de datos: hmi2guaycuru_camas */
/* Version aplicación: 0.0.1 */
/* Debug sobre tabla: salas */

DELIMITER ;


/* ---------------------------------- */
/* Trigger after insert - tabla salas */
/* ---------------------------------- */

DROP TRIGGER IF EXISTS logs_after_insert_salas;

DELIMITER $$

CREATE TRIGGER

    logs_after_insert_salas

AFTER INSERT 

ON salas

FOR EACH ROW

BEGIN
        
    DECLARE estado INTEGER;
    DECLARE msg VARCHAR(255);
    DECLARE campos TEXT;
    DECLARE valores TEXT;
    
    
    SET campos = CONCAT_WS(';',
                'id_sala',
                'id_efector',
                'nro_sala',
                'nombre',
                'cant_camas',
                'mover_camas',
                'area_id_efector_servicio',
                'area_cod_servicio',
                'area_sector',
                'area_subsector',
                'baja',
                'fecha_modificacion');
        
    SET valores = CONCAT_WS(';',
                IFNULL(NEW.id_sala,''),
                IFNULL(NEW.id_efector,''),
                IFNULL(NEW.nro_sala,''),
                IFNULL(NEW.nombre,''),
                IFNULL(NEW.cant_camas,''),
                IFNULL(NEW.mover_camas,''),
                IFNULL(NEW.area_id_efector_servicio,''),
                IFNULL(NEW.area_cod_servicio,''),
                IFNULL(NEW.area_sector,''),
                IFNULL(NEW.area_subsector,''),
                IFNULL(NEW.baja,''),
                IFNULL(NEW.fecha_modificacion,''));
    
    
    CALL logs_debug
        ('salas',
        campos,
        valores,
        'I',
        @estado,
        @msg);
        
END; 

$$


DELIMITER ;


/* ----------------------------------- */
/* Trigger before update - tabla salas */
/* ----------------------------------- */

DROP TRIGGER IF EXISTS logs_before_update_salas;

DELIMITER $$

CREATE TRIGGER

    logs_before_update_salas

BEFORE UPDATE

ON salas

FOR EACH ROW

BEGIN
        
    DECLARE estado INTEGER;
    DECLARE msg VARCHAR(255);
    DECLARE campos TEXT;
    DECLARE valores TEXT;
    DECLARE guardar_modificaciones_nulas TINYINT(1);
    
    /* flag guardar modificaciones nulas */
    SET guardar_modificaciones_nulas = 
        (SELECT 
            la.guardar_modificaciones_nulas
        FROM
            logs_auditados la
        LIMIT 0,1);
    
    SET campos = CONCAT_WS(';',
                'id_sala',
                'id_efector',
                'nro_sala',
                'nombre',
                'cant_camas',
                'mover_camas',
                'area_id_efector_servicio',
                'area_cod_servicio',
                'area_sector',
                'area_subsector',
                'baja',
                'fecha_modificacion');
        
    SET valores = CONCAT_WS(';',
                IFNULL(OLD.id_sala,''),
                IFNULL(OLD.id_efector,''),
                IFNULL(OLD.nro_sala,''),
                IFNULL(OLD.nombre,''),
                IFNULL(OLD.cant_camas,''),
                IFNULL(OLD.mover_camas,''),
                IFNULL(OLD.area_id_efector_servicio,''),
                IFNULL(OLD.area_cod_servicio,''),
                IFNULL(OLD.area_sector,''),
                IFNULL(OLD.area_subsector,''),
                IFNULL(OLD.baja,''),
                IFNULL(OLD.fecha_modificacion,''));
    
    IF( OLD.id_sala <> NEW.id_sala
        OR OLD.id_efector <> NEW.id_efector
        OR OLD.nro_sala <> NEW.nro_sala
        OR OLD.nombre <> NEW.nombre
        OR OLD.cant_camas <> NEW.cant_camas
        OR OLD.mover_camas <> NEW.mover_camas
        OR (
            ( ISNULL(OLD.area_id_efector_servicio) AND NOT ISNULL(NEW.area_id_efector_servicio) ) OR 
            ( NOT ISNULL(OLD.area_id_efector_servicio) AND ISNULL(NEW.area_id_efector_servicio) ) OR
            ( NOT ISNULL(OLD.area_id_efector_servicio) 
                AND NOT ISNULL(NEW.area_id_efector_servicio) 
                AND OLD.area_id_efector_servicio <> NEW.area_id_efector_servicio)
           )
        OR (
            ( ISNULL(OLD.area_cod_servicio) AND NOT ISNULL(NEW.area_cod_servicio) ) OR 
            ( NOT ISNULL(OLD.area_cod_servicio) AND ISNULL(NEW.area_cod_servicio) ) OR
            ( NOT ISNULL(OLD.area_cod_servicio) 
                AND NOT ISNULL(NEW.area_cod_servicio) 
                AND OLD.area_cod_servicio <> NEW.area_cod_servicio)
           )
        OR (
            ( ISNULL(OLD.area_sector) AND NOT ISNULL(NEW.area_sector) ) OR 
            ( NOT ISNULL(OLD.area_sector) AND ISNULL(NEW.area_sector) ) OR
            ( NOT ISNULL(OLD.area_sector) 
                AND NOT ISNULL(NEW.area_sector) 
                AND OLD.area_sector <> NEW.area_sector)
           )
        OR (
            ( ISNULL(OLD.area_subsector) AND NOT ISNULL(NEW.area_subsector) ) OR 
            ( NOT ISNULL(OLD.area_subsector) AND ISNULL(NEW.area_subsector) ) OR
            ( NOT ISNULL(OLD.area_subsector) 
                AND NOT ISNULL(NEW.area_subsector) 
                AND OLD.area_subsector <> NEW.area_subsector)
           )
        OR OLD.baja <> NEW.baja
        OR OLD.fecha_modificacion <> NEW.fecha_modificacion
        OR guardar_modificaciones_nulas = 1 ) THEN 
       
        CALL logs_debug
            ('salas',
            campos,
            valores,
            'O',
            @estado,
            @msg);
            
    END IF;
    
END; 

$$


DELIMITER ;


/* ---------------------------------- */
/* Trigger after update - tabla salas */
/* ---------------------------------- */

DROP TRIGGER IF EXISTS logs_after_update_salas;

DELIMITER $$

CREATE TRIGGER

    logs_after_update_salas

AFTER UPDATE

ON salas

FOR EACH ROW

BEGIN
        
    DECLARE estado INTEGER;
    DECLARE msg VARCHAR(255);
    DECLARE campos TEXT;
    DECLARE valores TEXT;
    DECLARE guardar_modificaciones_nulas TINYINT(1);
    
    /* flag guardar modificaciones nulas */
    SET guardar_modificaciones_nulas = 
        (SELECT 
            la.guardar_modificaciones_nulas
        FROM
            logs_auditados la
        LIMIT 0,1);
    
    SET campos = CONCAT_WS(';',
                'id_sala',
                'id_efector',
                'nro_sala',
                'nombre',
                'cant_camas',
                'mover_camas',
                'area_id_efector_servicio',
                'area_cod_servicio',
                'area_sector',
                'area_subsector',
                'baja',
                'fecha_modificacion');
        
    SET valores = CONCAT_WS(';',
                IFNULL(NEW.id_sala,''),
                IFNULL(NEW.id_efector,''),
                IFNULL(NEW.nro_sala,''),
                IFNULL(NEW.nombre,''),
                IFNULL(NEW.cant_camas,''),
                IFNULL(NEW.mover_camas,''),
                IFNULL(NEW.area_id_efector_servicio,''),
                IFNULL(NEW.area_cod_servicio,''),
                IFNULL(NEW.area_sector,''),
                IFNULL(NEW.area_subsector,''),
                IFNULL(NEW.baja,''),
                IFNULL(NEW.fecha_modificacion,''));
    
    IF( OLD.id_sala <> NEW.id_sala
        OR OLD.id_efector <> NEW.id_efector
        OR OLD.nro_sala <> NEW.nro_sala
        OR OLD.nombre <> NEW.nombre
        OR OLD.cant_camas <> NEW.cant_camas
        OR OLD.mover_camas <> NEW.mover_camas
        OR (
            ( ISNULL(OLD.area_id_efector_servicio) AND NOT ISNULL(NEW.area_id_efector_servicio) ) OR 
            ( NOT ISNULL(OLD.area_id_efector_servicio) AND ISNULL(NEW.area_id_efector_servicio) ) OR
            ( NOT ISNULL(OLD.area_id_efector_servicio) 
                AND NOT ISNULL(NEW.area_id_efector_servicio) 
                AND OLD.area_id_efector_servicio <> NEW.area_id_efector_servicio)
           )
        OR (
            ( ISNULL(OLD.area_cod_servicio) AND NOT ISNULL(NEW.area_cod_servicio) ) OR 
            ( NOT ISNULL(OLD.area_cod_servicio) AND ISNULL(NEW.area_cod_servicio) ) OR
            ( NOT ISNULL(OLD.area_cod_servicio) 
                AND NOT ISNULL(NEW.area_cod_servicio) 
                AND OLD.area_cod_servicio <> NEW.area_cod_servicio)
           )
        OR (
            ( ISNULL(OLD.area_sector) AND NOT ISNULL(NEW.area_sector) ) OR 
            ( NOT ISNULL(OLD.area_sector) AND ISNULL(NEW.area_sector) ) OR
            ( NOT ISNULL(OLD.area_sector) 
                AND NOT ISNULL(NEW.area_sector) 
                AND OLD.area_sector <> NEW.area_sector)
           )
        OR (
            ( ISNULL(OLD.area_subsector) AND NOT ISNULL(NEW.area_subsector) ) OR 
            ( NOT ISNULL(OLD.area_subsector) AND ISNULL(NEW.area_subsector) ) OR
            ( NOT ISNULL(OLD.area_subsector) 
                AND NOT ISNULL(NEW.area_subsector) 
                AND OLD.area_subsector <> NEW.area_subsector)
           )
        OR OLD.baja <> NEW.baja
        OR OLD.fecha_modificacion <> NEW.fecha_modificacion
        OR guardar_modificaciones_nulas = 1 ) THEN 
       
        CALL logs_debug
            ('salas',
            campos,
            valores,
            'N',
            @estado,
            @msg);
            
    END IF;
    
END; 

$$


DELIMITER ;


/* ----------------------------------- */
/* Trigger before delete - tabla salas */
/* ----------------------------------- */

DROP TRIGGER IF EXISTS logs_before_delete_salas;

DELIMITER $$

CREATE TRIGGER

    logs_before_delete_salas

BEFORE DELETE 

ON salas

FOR EACH ROW

BEGIN
        
    DECLARE estado INTEGER;
    DECLARE msg VARCHAR(255);
    DECLARE campos TEXT;
    DECLARE valores TEXT;
    
    
    SET campos = CONCAT_WS(';',
                'id_sala',
                'id_efector',
                'nro_sala',
                'nombre',
                'cant_camas',
                'mover_camas',
                'area_id_efector_servicio',
                'area_cod_servicio',
                'area_sector',
                'area_subsector',
                'baja',
                'fecha_modificacion');
        
    SET valores = CONCAT_WS(';',
                IFNULL(OLD.id_sala,''),
                IFNULL(OLD.id_efector,''),
                IFNULL(OLD.nro_sala,''),
                IFNULL(OLD.nombre,''),
                IFNULL(OLD.cant_camas,''),
                IFNULL(OLD.mover_camas,''),
                IFNULL(OLD.area_id_efector_servicio,''),
                IFNULL(OLD.area_cod_servicio,''),
                IFNULL(OLD.area_sector,''),
                IFNULL(OLD.area_subsector,''),
                IFNULL(OLD.baja,''),
                IFNULL(OLD.fecha_modificacion,''));
    
    
    CALL logs_debug
        ('salas',
        campos,
        valores,
        'D',
        @estado,
        @msg);
        
END; 

$$
    