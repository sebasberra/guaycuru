/* Generacion automatica de TRIGGERS para Logger */
/* Fecha y hora: 05/18/2017 23:40  */
/* Servidor: localhost Puerto:  */
/* Base de datos: hmi2guaycuru_camas */
/* Version aplicación: 0.0.1 */
/* Debug sobre tabla: camas */

DELIMITER ;


/* ---------------------------------- */
/* Trigger after insert - tabla camas */
/* ---------------------------------- */

DROP TRIGGER IF EXISTS logs_after_insert_camas;

DELIMITER $$

CREATE TRIGGER

    logs_after_insert_camas

AFTER INSERT 

ON camas

FOR EACH ROW

BEGIN
        
    DECLARE estado INTEGER;
    DECLARE msg VARCHAR(255);
    DECLARE campos TEXT;
    DECLARE valores TEXT;
    
    
    SET campos = CONCAT_WS('|;|',
                'id_cama',
                'id_clasificacion_cama',
                'id_efector',
                'id_habitacion',
                'id_internacion',
                'nombre',
                'estado',
                'rotativa',
                'baja',
                'fecha_modificacion');
        
    SET valores = CONCAT_WS('|;|',
                IFNULL(NEW.id_cama,''),
                IFNULL(NEW.id_clasificacion_cama,''),
                IFNULL(NEW.id_efector,''),
                IFNULL(NEW.id_habitacion,''),
                IFNULL(NEW.id_internacion,''),
                IFNULL(NEW.nombre,''),
                IFNULL(NEW.estado,''),
                IFNULL(NEW.rotativa,''),
                IFNULL(NEW.baja,''),
                IFNULL(NEW.fecha_modificacion,''));
    
    
    CALL logs_debug
        ('camas',
        campos,
        valores,
        'I',
        @estado,
        @msg);
        
END; 

$$


DELIMITER ;


/* ----------------------------------- */
/* Trigger before update - tabla camas */
/* ----------------------------------- */

DROP TRIGGER IF EXISTS logs_before_update_camas;

DELIMITER $$

CREATE TRIGGER

    logs_before_update_camas

BEFORE UPDATE

ON camas

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
    
    SET campos = CONCAT_WS('|;|',
                'id_cama',
                'id_clasificacion_cama',
                'id_efector',
                'id_habitacion',
                'id_internacion',
                'nombre',
                'estado',
                'rotativa',
                'baja',
                'fecha_modificacion');
        
    SET valores = CONCAT_WS('|;|',
                IFNULL(OLD.id_cama,''),
                IFNULL(OLD.id_clasificacion_cama,''),
                IFNULL(OLD.id_efector,''),
                IFNULL(OLD.id_habitacion,''),
                IFNULL(OLD.id_internacion,''),
                IFNULL(OLD.nombre,''),
                IFNULL(OLD.estado,''),
                IFNULL(OLD.rotativa,''),
                IFNULL(OLD.baja,''),
                IFNULL(OLD.fecha_modificacion,''));
    
    IF( OLD.id_cama <> NEW.id_cama
        OR OLD.id_clasificacion_cama <> NEW.id_clasificacion_cama
        OR OLD.id_efector <> NEW.id_efector
        OR (
            ( ISNULL(OLD.id_habitacion) AND NOT ISNULL(NEW.id_habitacion) ) OR 
            ( NOT ISNULL(OLD.id_habitacion) AND ISNULL(NEW.id_habitacion) ) OR
            ( NOT ISNULL(OLD.id_habitacion) 
                AND NOT ISNULL(NEW.id_habitacion) 
                AND OLD.id_habitacion <> NEW.id_habitacion)
           )
        OR (
            ( ISNULL(OLD.id_internacion) AND NOT ISNULL(NEW.id_internacion) ) OR 
            ( NOT ISNULL(OLD.id_internacion) AND ISNULL(NEW.id_internacion) ) OR
            ( NOT ISNULL(OLD.id_internacion) 
                AND NOT ISNULL(NEW.id_internacion) 
                AND OLD.id_internacion <> NEW.id_internacion)
           )
        OR OLD.nombre <> NEW.nombre
        OR OLD.estado <> NEW.estado
        OR OLD.rotativa <> NEW.rotativa
        OR OLD.baja <> NEW.baja
        OR OLD.fecha_modificacion <> NEW.fecha_modificacion
        OR guardar_modificaciones_nulas = 1 ) THEN 
       
        CALL logs_debug
            ('camas',
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
/* Trigger after update - tabla camas */
/* ---------------------------------- */

DROP TRIGGER IF EXISTS logs_after_update_camas;

DELIMITER $$

CREATE TRIGGER

    logs_after_update_camas

AFTER UPDATE

ON camas

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
    
    SET campos = CONCAT_WS('|;|',
                'id_cama',
                'id_clasificacion_cama',
                'id_efector',
                'id_habitacion',
                'id_internacion',
                'nombre',
                'estado',
                'rotativa',
                'baja',
                'fecha_modificacion');
        
    SET valores = CONCAT_WS('|;|',
                IFNULL(NEW.id_cama,''),
                IFNULL(NEW.id_clasificacion_cama,''),
                IFNULL(NEW.id_efector,''),
                IFNULL(NEW.id_habitacion,''),
                IFNULL(NEW.id_internacion,''),
                IFNULL(NEW.nombre,''),
                IFNULL(NEW.estado,''),
                IFNULL(NEW.rotativa,''),
                IFNULL(NEW.baja,''),
                IFNULL(NEW.fecha_modificacion,''));
    
    IF( OLD.id_cama <> NEW.id_cama
        OR OLD.id_clasificacion_cama <> NEW.id_clasificacion_cama
        OR OLD.id_efector <> NEW.id_efector
        OR (
            ( ISNULL(OLD.id_habitacion) AND NOT ISNULL(NEW.id_habitacion) ) OR 
            ( NOT ISNULL(OLD.id_habitacion) AND ISNULL(NEW.id_habitacion) ) OR
            ( NOT ISNULL(OLD.id_habitacion) 
                AND NOT ISNULL(NEW.id_habitacion) 
                AND OLD.id_habitacion <> NEW.id_habitacion)
           )
        OR (
            ( ISNULL(OLD.id_internacion) AND NOT ISNULL(NEW.id_internacion) ) OR 
            ( NOT ISNULL(OLD.id_internacion) AND ISNULL(NEW.id_internacion) ) OR
            ( NOT ISNULL(OLD.id_internacion) 
                AND NOT ISNULL(NEW.id_internacion) 
                AND OLD.id_internacion <> NEW.id_internacion)
           )
        OR OLD.nombre <> NEW.nombre
        OR OLD.estado <> NEW.estado
        OR OLD.rotativa <> NEW.rotativa
        OR OLD.baja <> NEW.baja
        OR OLD.fecha_modificacion <> NEW.fecha_modificacion
        OR guardar_modificaciones_nulas = 1 ) THEN 
       
        CALL logs_debug
            ('camas',
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
/* Trigger before delete - tabla camas */
/* ----------------------------------- */

DROP TRIGGER IF EXISTS logs_before_delete_camas;

DELIMITER $$

CREATE TRIGGER

    logs_before_delete_camas

BEFORE DELETE 

ON camas

FOR EACH ROW

BEGIN
        
    DECLARE estado INTEGER;
    DECLARE msg VARCHAR(255);
    DECLARE campos TEXT;
    DECLARE valores TEXT;
    
    
    SET campos = CONCAT_WS('|;|',
                'id_cama',
                'id_clasificacion_cama',
                'id_efector',
                'id_habitacion',
                'id_internacion',
                'nombre',
                'estado',
                'rotativa',
                'baja',
                'fecha_modificacion');
        
    SET valores = CONCAT_WS('|;|',
                IFNULL(OLD.id_cama,''),
                IFNULL(OLD.id_clasificacion_cama,''),
                IFNULL(OLD.id_efector,''),
                IFNULL(OLD.id_habitacion,''),
                IFNULL(OLD.id_internacion,''),
                IFNULL(OLD.nombre,''),
                IFNULL(OLD.estado,''),
                IFNULL(OLD.rotativa,''),
                IFNULL(OLD.baja,''),
                IFNULL(OLD.fecha_modificacion,''));
    
    
    CALL logs_debug
        ('camas',
        campos,
        valores,
        'D',
        @estado,
        @msg);
        
END; 

$$
    