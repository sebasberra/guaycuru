/* ---------------------------------------------------------------- */
/* 																	*/
/* hmi2 Guaycuru Camas 												*/
/* 																	*/
/* Scripts de migracion para efectores								*/
/* 																	*/
/* Renombra nombres de camas. 										*/
/* PROBLEMA: Para poder identificar las camas en la base 			*/
/* centralizada no se puede utilizar el id_cama que poseen en la 	*/
/* base de datos del efector										*/
/* SOLUCION: Se crea un indice unico en la base centralizada y en	*/
/* las locales (efectores) para la combinacion de campos:			*/
/* (nombre de cama, id_efector). Esto implica que se renombren las	*/
/* camas en cada efector para evitar que se repitan los nombres		*/
/* ---------------------------------------------------------------- */

/* actualizacion de nombre de camas para desarrollo */
UPDATE
	hmi2_cullen.camas c
SET
	c.nombre = 
		CONCAT(
			hmi2_cullen.hmi2_str_prefijo_cama(c.id_habitacion),
			'-',
			c.nombre);
