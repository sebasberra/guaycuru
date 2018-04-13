/* Generacion automatica de TRIGGERS para Logger */
/* Fecha y hora: 04/08/2018 05:42  */
/* Servidor: localhost Puerto:  */
/* Base de datos: hmi2guaycuru_camas */
/* Version aplicación: 0.0.1 */
/* Debug sobre tabla: configuraciones_sistemas */

DELIMITER ;


/* ----------------------------------------------------- */
/* Trigger after insert - tabla configuraciones_sistemas */
/* ----------------------------------------------------- */

DROP TRIGGER IF EXISTS logs_after_insert_configuraciones_sistemas;

DELIMITER $$

CREATE TRIGGER

    logs_after_insert_configuraciones_sistemas

AFTER INSERT 

ON configuraciones_sistemas

FOR EACH ROW

BEGIN
        
    DECLARE estado INTEGER;
    DECLARE msg VARCHAR(255);
    DECLARE campos TEXT;
    DECLARE valores TEXT;
    
    
    SET campos = CONCAT_WS('|;|',
                'id_configuracion_sistema',
                'id_efector',
                'activa',
                'tipo_registros',
                'fecha_hora_sincro',
                'observaciones');
        
    SET valores = CONCAT_WS('|;|',
                IFNULL(NEW.id_configuracion_sistema,''),
                IFNULL(NEW.id_efector,''),
                IFNULL(NEW.activa,''),
                IFNULL(NEW.tipo_registros,''),
                IFNULL(NEW.fecha_hora_sincro,''),
                IFNULL(NEW.observaciones,''));
    
    
    CALL logs_debug
        ('configuraciones_sistemas',
        campos,
        valores,
        'I',
        @estado,
        @msg);
        
END; 

$$


DELIMITER ;


/* ------------------------------------------------------ */
/* Trigger before update - tabla configuraciones_sistemas */
/* ------------------------------------------------------ */

DROP TRIGGER IF EXISTS logs_before_update_configuraciones_sistemas;

DELIMITER $$

CREATE TRIGGER

    logs_before_update_configuraciones_sistemas

BEFORE UPDATE

ON configuraciones_sistemas

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
                'id_configuracion_sistema',
                'id_efector',
                'activa',
                'tipo_registros',
                'fecha_hora_sincro',
                'observaciones');
        
    SET valores = CONCAT_WS('|;|',
                IFNULL(OLD.id_configuracion_sistema,''),
                IFNULL(OLD.id_efector,''),
                IFNULL(OLD.activa,''),
                IFNULL(OLD.tipo_registros,''),
                IFNULL(OLD.fecha_hora_sincro,''),
                IFNULL(OLD.observaciones,''));
    
    IF( OLD.id_configuracion_sistema <> NEW.id_configuracion_sistema
        OR OLD.id_efector <> NEW.id_efector
        OR OLD.activa <> NEW.activa
        OR OLD.tipo_registros <> NEW.tipo_registros
        OR (
            ( ISNULL(OLD.fecha_hora_sincro) AND NOT ISNULL(NEW.fecha_hora_sincro) ) OR 
            ( NOT ISNULL(OLD.fecha_hora_sincro) AND ISNULL(NEW.fecha_hora_sincro) ) OR
            ( NOT ISNULL(OLD.fecha_hora_sincro) 
                AND NOT ISNULL(NEW.fecha_hora_sincro) 
                AND OLD.fecha_hora_sincro <> NEW.fecha_hora_sincro)
           )
        OR (
            ( ISNULL(OLD.observaciones) AND NOT ISNULL(NEW.observaciones) ) OR 
            ( NOT ISNULL(OLD.observaciones) AND ISNULL(NEW.observaciones) ) OR
            ( NOT ISNULL(OLD.observaciones) 
                AND NOT ISNULL(NEW.observaciones) 
                AND OLD.observaciones <> NEW.observaciones)
           )
        OR guardar_modificaciones_nulas = 1 ) THEN 
       
        CALL logs_debug
            ('configuraciones_sistemas',
            campos,
            valores,
            'O',
            @estado,
            @msg);
            
    END IF;
    
END; 

$$


DELIMITER ;


/* ----------------------------------------------------- */
/* Trigger after update - tabla configuraciones_sistemas */
/* ----------------------------------------------------- */

DROP TRIGGER IF EXISTS logs_after_update_configuraciones_sistemas;

DELIMITER $$

CREATE TRIGGER

    logs_after_update_configuraciones_sistemas

AFTER UPDATE

ON configuraciones_sistemas

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
                'id_configuracion_sistema',
                'id_efector',
                'activa',
                'tipo_registros',
                'fecha_hora_sincro',
                'observaciones');
        
    SET valores = CONCAT_WS('|;|',
                IFNULL(NEW.id_configuracion_sistema,''),
                IFNULL(NEW.id_efector,''),
                IFNULL(NEW.activa,''),
                IFNULL(NEW.tipo_registros,''),
                IFNULL(NEW.fecha_hora_sincro,''),
                IFNULL(NEW.observaciones,''));
    
    IF( OLD.id_configuracion_sistema <> NEW.id_configuracion_sistema
        OR OLD.id_efector <> NEW.id_efector
        OR OLD.activa <> NEW.activa
        OR OLD.tipo_registros <> NEW.tipo_registros
        OR (
            ( ISNULL(OLD.fecha_hora_sincro) AND NOT ISNULL(NEW.fecha_hora_sincro) ) OR 
            ( NOT ISNULL(OLD.fecha_hora_sincro) AND ISNULL(NEW.fecha_hora_sincro) ) OR
            ( NOT ISNULL(OLD.fecha_hora_sincro) 
                AND NOT ISNULL(NEW.fecha_hora_sincro) 
                AND OLD.fecha_hora_sincro <> NEW.fecha_hora_sincro)
           )
        OR (
            ( ISNULL(OLD.observaciones) AND NOT ISNULL(NEW.observaciones) ) OR 
            ( NOT ISNULL(OLD.observaciones) AND ISNULL(NEW.observaciones) ) OR
            ( NOT ISNULL(OLD.observaciones) 
                AND NOT ISNULL(NEW.observaciones) 
                AND OLD.observaciones <> NEW.observaciones)
           )
        OR guardar_modificaciones_nulas = 1 ) THEN 
       
        CALL logs_debug
            ('configuraciones_sistemas',
            campos,
            valores,
            'N',
            @estado,
            @msg);
            
    END IF;
    
END; 

$$


DELIMITER ;


/* ------------------------------------------------------ */
/* Trigger before delete - tabla configuraciones_sistemas */
/* ------------------------------------------------------ */

DROP TRIGGER IF EXISTS logs_before_delete_configuraciones_sistemas;

DELIMITER $$

CREATE TRIGGER

    logs_before_delete_configuraciones_sistemas

BEFORE DELETE 

ON configuraciones_sistemas

FOR EACH ROW

BEGIN
        
    DECLARE estado INTEGER;
    DECLARE msg VARCHAR(255);
    DECLARE campos TEXT;
    DECLARE valores TEXT;
    
    
    SET campos = CONCAT_WS('|;|',
                'id_configuracion_sistema',
                'id_efector',
                'activa',
                'tipo_registros',
                'fecha_hora_sincro',
                'observaciones');
        
    SET valores = CONCAT_WS('|;|',
                IFNULL(OLD.id_configuracion_sistema,''),
                IFNULL(OLD.id_efector,''),
                IFNULL(OLD.activa,''),
                IFNULL(OLD.tipo_registros,''),
                IFNULL(OLD.fecha_hora_sincro,''),
                IFNULL(OLD.observaciones,''));
    
    
    CALL logs_debug
        ('configuraciones_sistemas',
        campos,
        valores,
        'D',
        @estado,
        @msg);
        
END; 

$$
    