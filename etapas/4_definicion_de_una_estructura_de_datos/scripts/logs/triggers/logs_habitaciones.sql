/* Generacion automatica de TRIGGERS para Logger */
/* Fecha y hora: 05/14/2017 00:21  */
/* Servidor: localhost Puerto:  */
/* Base de datos: hmi2guaycuru_camas */
/* Version aplicación: 0.0.1 */
/* Debug sobre tabla: habitaciones */

DELIMITER ;


/* ----------------------------------------- */
/* Trigger after insert - tabla habitaciones */
/* ----------------------------------------- */

DROP TRIGGER IF EXISTS logs_after_insert_habitaciones;

DELIMITER $$

CREATE TRIGGER

    logs_after_insert_habitaciones

AFTER INSERT 

ON habitaciones

FOR EACH ROW

BEGIN
        
    DECLARE estado INTEGER;
    DECLARE msg VARCHAR(255);
    DECLARE campos TEXT;
    DECLARE valores TEXT;
    
    
    SET campos = CONCAT_WS(';',
                'id_habitacion',
                'id_sala',
                'nombre',
                'sexo',
                'edad_desde',
                'edad_hasta',
                'tipo_edad',
                'cant_camas',
                'baja',
                'fecha_modificacion');
        
    SET valores = CONCAT_WS(';',
                IFNULL(NEW.id_habitacion,''),
                IFNULL(NEW.id_sala,''),
                IFNULL(NEW.nombre,''),
                IFNULL(NEW.sexo,''),
                IFNULL(NEW.edad_desde,''),
                IFNULL(NEW.edad_hasta,''),
                IFNULL(NEW.tipo_edad,''),
                IFNULL(NEW.cant_camas,''),
                IFNULL(NEW.baja,''),
                IFNULL(NEW.fecha_modificacion,''));
    
    
    CALL logs_debug
        ('habitaciones',
        campos,
        valores,
        'I',
        @estado,
        @msg);
        
END; 

$$


DELIMITER ;


/* ------------------------------------------ */
/* Trigger before update - tabla habitaciones */
/* ------------------------------------------ */

DROP TRIGGER IF EXISTS logs_before_update_habitaciones;

DELIMITER $$

CREATE TRIGGER

    logs_before_update_habitaciones

BEFORE UPDATE

ON habitaciones

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
                'id_habitacion',
                'id_sala',
                'nombre',
                'sexo',
                'edad_desde',
                'edad_hasta',
                'tipo_edad',
                'cant_camas',
                'baja',
                'fecha_modificacion');
        
    SET valores = CONCAT_WS(';',
                IFNULL(OLD.id_habitacion,''),
                IFNULL(OLD.id_sala,''),
                IFNULL(OLD.nombre,''),
                IFNULL(OLD.sexo,''),
                IFNULL(OLD.edad_desde,''),
                IFNULL(OLD.edad_hasta,''),
                IFNULL(OLD.tipo_edad,''),
                IFNULL(OLD.cant_camas,''),
                IFNULL(OLD.baja,''),
                IFNULL(OLD.fecha_modificacion,''));
    
    IF( OLD.id_habitacion <> NEW.id_habitacion
        OR OLD.id_sala <> NEW.id_sala
        OR OLD.nombre <> NEW.nombre
        OR OLD.sexo <> NEW.sexo
        OR OLD.edad_desde <> NEW.edad_desde
        OR OLD.edad_hasta <> NEW.edad_hasta
        OR OLD.tipo_edad <> NEW.tipo_edad
        OR OLD.cant_camas <> NEW.cant_camas
        OR OLD.baja <> NEW.baja
        OR OLD.fecha_modificacion <> NEW.fecha_modificacion
        OR guardar_modificaciones_nulas = 1 ) THEN 
       
        CALL logs_debug
            ('habitaciones',
            campos,
            valores,
            'O',
            @estado,
            @msg);
            
    END IF;
    
END; 

$$


DELIMITER ;


/* ----------------------------------------- */
/* Trigger after update - tabla habitaciones */
/* ----------------------------------------- */

DROP TRIGGER IF EXISTS logs_after_update_habitaciones;

DELIMITER $$

CREATE TRIGGER

    logs_after_update_habitaciones

AFTER UPDATE

ON habitaciones

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
                'id_habitacion',
                'id_sala',
                'nombre',
                'sexo',
                'edad_desde',
                'edad_hasta',
                'tipo_edad',
                'cant_camas',
                'baja',
                'fecha_modificacion');
        
    SET valores = CONCAT_WS(';',
                IFNULL(NEW.id_habitacion,''),
                IFNULL(NEW.id_sala,''),
                IFNULL(NEW.nombre,''),
                IFNULL(NEW.sexo,''),
                IFNULL(NEW.edad_desde,''),
                IFNULL(NEW.edad_hasta,''),
                IFNULL(NEW.tipo_edad,''),
                IFNULL(NEW.cant_camas,''),
                IFNULL(NEW.baja,''),
                IFNULL(NEW.fecha_modificacion,''));
    
    IF( OLD.id_habitacion <> NEW.id_habitacion
        OR OLD.id_sala <> NEW.id_sala
        OR OLD.nombre <> NEW.nombre
        OR OLD.sexo <> NEW.sexo
        OR OLD.edad_desde <> NEW.edad_desde
        OR OLD.edad_hasta <> NEW.edad_hasta
        OR OLD.tipo_edad <> NEW.tipo_edad
        OR OLD.cant_camas <> NEW.cant_camas
        OR OLD.baja <> NEW.baja
        OR OLD.fecha_modificacion <> NEW.fecha_modificacion
        OR guardar_modificaciones_nulas = 1 ) THEN 
       
        CALL logs_debug
            ('habitaciones',
            campos,
            valores,
            'N',
            @estado,
            @msg);
            
    END IF;
    
END; 

$$


DELIMITER ;


/* ------------------------------------------ */
/* Trigger before delete - tabla habitaciones */
/* ------------------------------------------ */

DROP TRIGGER IF EXISTS logs_before_delete_habitaciones;

DELIMITER $$

CREATE TRIGGER

    logs_before_delete_habitaciones

BEFORE DELETE 

ON habitaciones

FOR EACH ROW

BEGIN
        
    DECLARE estado INTEGER;
    DECLARE msg VARCHAR(255);
    DECLARE campos TEXT;
    DECLARE valores TEXT;
    
    
    SET campos = CONCAT_WS(';',
                'id_habitacion',
                'id_sala',
                'nombre',
                'sexo',
                'edad_desde',
                'edad_hasta',
                'tipo_edad',
                'cant_camas',
                'baja',
                'fecha_modificacion');
        
    SET valores = CONCAT_WS(';',
                IFNULL(OLD.id_habitacion,''),
                IFNULL(OLD.id_sala,''),
                IFNULL(OLD.nombre,''),
                IFNULL(OLD.sexo,''),
                IFNULL(OLD.edad_desde,''),
                IFNULL(OLD.edad_hasta,''),
                IFNULL(OLD.tipo_edad,''),
                IFNULL(OLD.cant_camas,''),
                IFNULL(OLD.baja,''),
                IFNULL(OLD.fecha_modificacion,''));
    
    
    CALL logs_debug
        ('habitaciones',
        campos,
        valores,
        'D',
        @estado,
        @msg);
        
END; 

$$
    