/* Generacion automatica de TRIGGERS para Auditoria */ 

/* Fecha y hora: 09/11/2016 11:15:48 p.m. */
/* Servidor: 192.168.56.1  puerto: 3306

/* Base de datos de Auditoria: auditoria_iturraspe */

/* Version HMI2 0.9.998 */

/* Auditoria sobre: */
/* Base de datos hmi2guaycuru_camas  Tabla: salas */
DELIMITER ; 
USE hmi2guaycuru_camas ;
DROP TRIGGER IF EXISTS auditar_after_insert_salas ; 
DELIMITER $$ 
CREATE TRIGGER auditar_after_insert_salas 
AFTER INSERT ON salas FOR EACH ROW 
BEGIN 
DECLARE estado INTEGER; 
DECLARE msg VARCHAR(255); 
DECLARE campos TEXT; 
DECLARE valores TEXT; 
DECLARE guardar_modificaciones_nulas TINYINT(1);
SET campos = CONCAT_WS(';','id_sala','id_efector','nro_sala','nombre','cant_camas','mover_camas','area_id_efector_servicio','area_cod_servicio','area_sector','area_subsector','baja','fecha_modificacion');
SET valores = CONCAT_WS(';',IFNULL(NEW.id_sala,''),IFNULL(NEW.id_efector,''),IFNULL(NEW.nro_sala,''),IFNULL(NEW.nombre,''),IFNULL(NEW.cant_camas,''),IFNULL(NEW.mover_camas,''),IFNULL(NEW.area_id_efector_servicio,''),IFNULL(NEW.area_cod_servicio,''),IFNULL(NEW.area_sector,''),IFNULL(NEW.area_subsector,''),IFNULL(NEW.baja,''),IFNULL(NEW.fecha_modificacion,''));
CALL auditoria_iturraspe.auditar2 ( 
'hmi2guaycuru_camas', 
'salas', 
campos, 
valores, 
'I', 
estado, 
msg); 
END; 
$$ 


DELIMITER ; 
USE hmi2guaycuru_camas ;
DROP TRIGGER IF EXISTS auditar_before_update_salas ; 
DELIMITER $$ 
CREATE TRIGGER auditar_before_update_salas 
BEFORE UPDATE ON salas FOR EACH ROW 
BEGIN 
DECLARE estado INTEGER; 
DECLARE msg VARCHAR(255); 
DECLARE campos TEXT; 
DECLARE valores TEXT; 
DECLARE guardar_modificaciones_nulas TINYINT(1);
SET guardar_modificaciones_nulas = 
(SELECT sa.guardar_modificaciones_nulas FROM auditoria_iturraspe.sistemas_auditados sa WHERE sa.sistema_db = 'hmi2guaycuru_camas'); 
IF ( OLD.id_sala <> NEW.id_sala  OR 
OLD.id_efector <> NEW.id_efector  OR 
OLD.nro_sala <> NEW.nro_sala  OR 
OLD.nombre <> NEW.nombre  OR 
OLD.cant_camas <> NEW.cant_camas  OR 
OLD.mover_camas <> NEW.mover_camas  OR 
( ( ISNULL(OLD.area_id_efector_servicio) AND NOT ISNULL(NEW.area_id_efector_servicio) ) OR ( NOT ISNULL(OLD.area_id_efector_servicio) AND ISNULL(NEW.area_id_efector_servicio) ) OR ( NOT ISNULL(OLD.area_id_efector_servicio) AND NOT ISNULL(NEW.area_id_efector_servicio) AND OLD.area_id_efector_servicio <> NEW.area_id_efector_servicio) )  OR 
( ( ISNULL(OLD.area_cod_servicio) AND NOT ISNULL(NEW.area_cod_servicio) ) OR ( NOT ISNULL(OLD.area_cod_servicio) AND ISNULL(NEW.area_cod_servicio) ) OR ( NOT ISNULL(OLD.area_cod_servicio) AND NOT ISNULL(NEW.area_cod_servicio) AND OLD.area_cod_servicio <> NEW.area_cod_servicio) )  OR 
( ( ISNULL(OLD.area_sector) AND NOT ISNULL(NEW.area_sector) ) OR ( NOT ISNULL(OLD.area_sector) AND ISNULL(NEW.area_sector) ) OR ( NOT ISNULL(OLD.area_sector) AND NOT ISNULL(NEW.area_sector) AND OLD.area_sector <> NEW.area_sector) )  OR 
( ( ISNULL(OLD.area_subsector) AND NOT ISNULL(NEW.area_subsector) ) OR ( NOT ISNULL(OLD.area_subsector) AND ISNULL(NEW.area_subsector) ) OR ( NOT ISNULL(OLD.area_subsector) AND NOT ISNULL(NEW.area_subsector) AND OLD.area_subsector <> NEW.area_subsector) )  OR 
OLD.baja <> NEW.baja  OR 
OLD.fecha_modificacion <> NEW.fecha_modificacion  OR 
guardar_modificaciones_nulas = 1 ) THEN 
SET campos = CONCAT_WS(';','id_sala','id_efector','nro_sala','nombre','cant_camas','mover_camas','area_id_efector_servicio','area_cod_servicio','area_sector','area_subsector','baja','fecha_modificacion');
SET valores = CONCAT_WS(';',IFNULL(OLD.id_sala,''),IFNULL(OLD.id_efector,''),IFNULL(OLD.nro_sala,''),IFNULL(OLD.nombre,''),IFNULL(OLD.cant_camas,''),IFNULL(OLD.mover_camas,''),IFNULL(OLD.area_id_efector_servicio,''),IFNULL(OLD.area_cod_servicio,''),IFNULL(OLD.area_sector,''),IFNULL(OLD.area_subsector,''),IFNULL(OLD.baja,''),IFNULL(OLD.fecha_modificacion,''));
CALL auditoria_iturraspe.auditar2 ( 
'hmi2guaycuru_camas', 
'salas', 
campos, 
valores, 
'O', 
estado, 
msg); 
END IF; 
END; 
$$ 


DELIMITER ; 
USE hmi2guaycuru_camas ;
DROP TRIGGER IF EXISTS auditar_after_update_salas ; 
DELIMITER $$ 
CREATE TRIGGER auditar_after_update_salas 
AFTER UPDATE ON salas FOR EACH ROW 
BEGIN 
DECLARE estado INTEGER; 
DECLARE msg VARCHAR(255); 
DECLARE campos TEXT; 
DECLARE valores TEXT; 
DECLARE guardar_modificaciones_nulas TINYINT(1);
SET guardar_modificaciones_nulas = 
(SELECT sa.guardar_modificaciones_nulas FROM auditoria_iturraspe.sistemas_auditados sa WHERE sa.sistema_db = 'hmi2guaycuru_camas'); 
IF ( OLD.id_sala <> NEW.id_sala  OR 
OLD.id_efector <> NEW.id_efector  OR 
OLD.nro_sala <> NEW.nro_sala  OR 
OLD.nombre <> NEW.nombre  OR 
OLD.cant_camas <> NEW.cant_camas  OR 
OLD.mover_camas <> NEW.mover_camas  OR 
( ( ISNULL(OLD.area_id_efector_servicio) AND NOT ISNULL(NEW.area_id_efector_servicio) ) OR ( NOT ISNULL(OLD.area_id_efector_servicio) AND ISNULL(NEW.area_id_efector_servicio) ) OR ( NOT ISNULL(OLD.area_id_efector_servicio) AND NOT ISNULL(NEW.area_id_efector_servicio) AND OLD.area_id_efector_servicio <> NEW.area_id_efector_servicio) )  OR 
( ( ISNULL(OLD.area_cod_servicio) AND NOT ISNULL(NEW.area_cod_servicio) ) OR ( NOT ISNULL(OLD.area_cod_servicio) AND ISNULL(NEW.area_cod_servicio) ) OR ( NOT ISNULL(OLD.area_cod_servicio) AND NOT ISNULL(NEW.area_cod_servicio) AND OLD.area_cod_servicio <> NEW.area_cod_servicio) )  OR 
( ( ISNULL(OLD.area_sector) AND NOT ISNULL(NEW.area_sector) ) OR ( NOT ISNULL(OLD.area_sector) AND ISNULL(NEW.area_sector) ) OR ( NOT ISNULL(OLD.area_sector) AND NOT ISNULL(NEW.area_sector) AND OLD.area_sector <> NEW.area_sector) )  OR 
( ( ISNULL(OLD.area_subsector) AND NOT ISNULL(NEW.area_subsector) ) OR ( NOT ISNULL(OLD.area_subsector) AND ISNULL(NEW.area_subsector) ) OR ( NOT ISNULL(OLD.area_subsector) AND NOT ISNULL(NEW.area_subsector) AND OLD.area_subsector <> NEW.area_subsector) )  OR 
OLD.baja <> NEW.baja  OR 
OLD.fecha_modificacion <> NEW.fecha_modificacion  OR 
guardar_modificaciones_nulas = 1 ) THEN 
SET campos = CONCAT_WS(';','id_sala','id_efector','nro_sala','nombre','cant_camas','mover_camas','area_id_efector_servicio','area_cod_servicio','area_sector','area_subsector','baja','fecha_modificacion');
SET valores = CONCAT_WS(';',IFNULL(NEW.id_sala,''),IFNULL(NEW.id_efector,''),IFNULL(NEW.nro_sala,''),IFNULL(NEW.nombre,''),IFNULL(NEW.cant_camas,''),IFNULL(NEW.mover_camas,''),IFNULL(NEW.area_id_efector_servicio,''),IFNULL(NEW.area_cod_servicio,''),IFNULL(NEW.area_sector,''),IFNULL(NEW.area_subsector,''),IFNULL(NEW.baja,''),IFNULL(NEW.fecha_modificacion,''));
CALL auditoria_iturraspe.auditar2 ( 
'hmi2guaycuru_camas', 
'salas', 
campos, 
valores, 
'N', 
estado, 
msg); 
END IF; 
END; 
$$ 


DELIMITER ; 
USE hmi2guaycuru_camas ;
DROP TRIGGER IF EXISTS auditar_before_delete_salas ; 
DELIMITER $$ 
CREATE TRIGGER auditar_before_delete_salas 
BEFORE DELETE ON salas FOR EACH ROW 
BEGIN 
DECLARE estado INTEGER; 
DECLARE msg VARCHAR(255); 
DECLARE campos TEXT; 
DECLARE valores TEXT; 
DECLARE guardar_modificaciones_nulas TINYINT(1);
SET campos = CONCAT_WS(';','id_sala','id_efector','nro_sala','nombre','cant_camas','mover_camas','area_id_efector_servicio','area_cod_servicio','area_sector','area_subsector','baja','fecha_modificacion');
SET valores = CONCAT_WS(';',IFNULL(OLD.id_sala,''),IFNULL(OLD.id_efector,''),IFNULL(OLD.nro_sala,''),IFNULL(OLD.nombre,''),IFNULL(OLD.cant_camas,''),IFNULL(OLD.mover_camas,''),IFNULL(OLD.area_id_efector_servicio,''),IFNULL(OLD.area_cod_servicio,''),IFNULL(OLD.area_sector,''),IFNULL(OLD.area_subsector,''),IFNULL(OLD.baja,''),IFNULL(OLD.fecha_modificacion,''));
CALL auditoria_iturraspe.auditar2 ( 
'hmi2guaycuru_camas', 
'salas', 
campos, 
valores, 
'D', 
estado, 
msg); 
END; 
$$ 


