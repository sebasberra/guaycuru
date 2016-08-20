/* ------------------------------------------------------------ */
/* script de migracion de datos de la base de datos del sistema	*/
/* Diagnose a la base de datos de gestion de camas criticas		*/
/* ------------------------------------------------------------ */

SET @hmi2 = 'hmi2_iturraspe';
SET @hmi2guaycuru_camas = 'hmi2guaycuru_camas'; /* cambiar en el USE mas adelante */

/* check variable global innodb_autoinc_lock_mode = 0 (modo tradicional) */
/* porque si no genera numeraciones de autoincrement con lagunas en el medio */
SET @check_autoincrement = (SELECT @@innodb_autoinc_lock_mode);

SET @query = 
	IF(
		@check_autoincrement <> 0,
		"SELECT 
			'Debe setear la variable global innodb_autoinc_lock_mode = 0' AS estado;",
		"DO SLEEP(0);"
	);
		
PREPARE stmt FROM @query;
EXECUTE stmt;

SET @query = 
	IF(
		@check_autoincrement <> 0,
		"error forzado",
		"DO SLEEP(0);"
	);
		
PREPARE stmt FROM @query;
EXECUTE stmt;


/* crea hmi2guaycuru_camas */
SET @query = CONCAT(
'DROP DATABASE IF EXISTS ', @hmi2guaycuru_camas
);
PREPARE stmt FROM @query;
EXECUTE stmt;

SET @query = CONCAT(
'CREATE DATABASE ', @hmi2guaycuru_camas
);
PREPARE stmt FROM @query;
EXECUTE stmt;
USE hmi2guaycuru_camas

/* estructura hmi2guaycuru_camas */
source hmi2guaycuru_camas_estructura.sql;

/* rutinas hmi2guaycuru_camas */
source hmi2guaycuru_camas_rutinas.sql


/* localidades, efectores y efectores_servicios */
source localidades_efectores_servicios.sql

/* migra los datos del efector a la estructura hmi2guaycuru_camas */

/* iturraspe */
source migra_hmi2_v0_9_996_a_hmi2guaycuru_camas_datos_iturraspe.sql

/* cullen */
source migra_hmi2_v0_9_996_a_hmi2guaycuru_camas_datos_cullen.sql
