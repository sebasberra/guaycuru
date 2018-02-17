## Enviar informe completo

Librería de Web Services para ABM de la Configuración Edilicia Hospitalaria Prov. de Santa Fe

### Inicialización y resincronización de datos centralizados

```endpoint
POST /sync.format
```
La llamada POST debe tener definido en el **HEADER:** *Content-Type: text/plain* y como **BODY** el texto en formato .csv de la configuración edilicia del efector.

Variable | Descripción
---|---
`format` | JSON o XML

La inicialización y/o resincronización de la Configuración Edilicia de un efector se lleva a cabo de la siguiente manera.


**Generar los datos del efector:** El servicio web de sincronización espera los datos con determinado formato de registro. Esto quiere decir que cada fila tiene campos definidos para cada posición de las columnas. Además, los registros esperan que estén en el siguiente orden: primero las salas, segundo las habitaciones y por último las camas.  [ver ejemplo con SQL].

col 1| col 2| col 3 | col 4 
---|---|---|---
id_efector | sala_nombre | sala_cant_camas | sala_mover_camas

col 5 | col 6 | col 7 | col 8
---|---|---|---
habitacion_nombre | habitacion_sexo | habitacion_edad_desde | habitacion_edad_hasta

col 9 | col 10 | col 11 | col 12
---|---|---|---
habitacion_tipo_edad | habitacion_cant_camas | habitacion_baja | cama_nombre

col 13 | col 14 | col 15 | col 16
---|---|---|---
cama_id_clasificacion_cama | cama_estado | cama_rotativa | cama_baja

**Generar archivo csv:** La información debe pasarse al web services en formato csv con los datos de campos separados por comillas dobles (") y usando como caracter de sepador de campos la coma (,). Si el volcado de la consulta SQL del ejemplo de "generar los datos del efector" está en el archivo "confedilicia.dump" entonces se puede convertir facilmente a .csv con la utilidad "sed" [ver ejemplo con bash].

**Enviar informe al web services sync:** La llamada al web services se realiza enviando como texto plano el archivo .csv en el cuerpo del Request. [ver ejemplo con cUrl]


#### Ejemplo de generar datos del efector [MySql] (Configuración Edilicia Diagnose) [solo SQL]

```sql

/* archivo: informe_confedilicia.sql */

DROP  TEMPORARY TABLE IF EXISTS informe_confedilicia_tmp;

SET @id_efector =
	(SELECT
		cs.id_efector
	FROM
		configuraciones_sistemas cs
	WHERE
		cs.activa = 1);
	
CREATE TEMPORARY TABLE informe_confedilicia_tmp

SELECT 

	@id_efector AS 'id_efector',
	
	s.nombre AS 'sala_nombre',
	s.cant_camas AS 'sala_cant_camas',
	s.mover_camas AS 'sala_mover_camas',
	
	'-1' AS 'habitacion_nombre',
	'-1' AS 'habitacion_sexo',
	'-1' AS 'habitacion_edad_desde',
	'-1' AS 'habitacion_edad_hasta',
	'-1' AS 'habitacion_tipo_edad',
	'-1' AS 'habitacion_cant_camas',
	'-1' AS 'habitacion_baja',
	
	'-1' AS 'cama_nombre',
	'-1' AS 'cama_id_clasificacion_cama',
	'-1' AS 'cama_estado',
	'-1' AS 'cama_rotativa',
	'-1' AS 'cama_baja'
	
FROM 
	salas s
WHERE 

	s.id_efector=@id_efector
	
UNION 

SELECT 

	@id_efector AS 'id_efector',
	
	s.nombre AS 'sala_nombre',
	s.cant_camas AS 'sala_cant_camas',
	s.mover_camas AS 'sala_mover_camas',
	
	h.nombre AS 'habitacion_nombre',
	h.sexo AS 'habitacion_sexo',
	h.edad_desde AS 'habitacion_edad_desde',
	h.edad_hasta AS 'habitacion_edad_hasta',
	h.tipo_edad AS 'habitacion_tipo_edad',
	h.cant_camas AS 'habitacion_cant_camas',
	h.baja AS 'habitacion_baja',
	
	'-1' AS 'cama_nombre',
	'-1' AS 'cama_id_clasificacion_cama',
	'-1' AS 'cama_estado',
	'-1' AS 'cama_rotativa',
	'-1' AS 'cama_baja' 
	
FROM 
	habitaciones h
INNER JOIN
	salas s
ON h.id_sala = s.id_sala	
WHERE 
	s.id_efector=@id_efector
	
UNION

SELECT 

	@id_efector AS 'id_efector',
	
	IFNULL(s.nombre,'-1') AS 'nombre_sala',
	IFNULL(s.cant_camas,'-1') AS 'sala_cant_camas',
	IFNULL(s.mover_camas,'-1') AS 'sala_mover_camas',
	
	IFNULL(h.nombre,'-1') AS 'nombre_habitacion',
	IFNULL(h.sexo,'-1') AS 'habitacion_sexo',
	IFNULL(h.edad_desde,'-1') AS 'habitacion_edad_desde',
	IFNULL(h.edad_hasta,'-1') AS 'habitacion_edad_hasta',
	IFNULL(h.tipo_edad,'-1') AS 'habitacion_tipo_edad',
	IFNULL(h.cant_camas,'-1') AS 'habitacion_cant_camas',
	IFNULL(h.baja,'-1') AS 'habitacion_baja',
	
	c.nombre AS 'cama_nombre',
	c.id_clasificacion_cama AS 'cama_id_clasificacion_cama',
	c.estado AS 'cama_estado',
	c.rotativa AS 'cama_rotativa',
	c.baja AS 'cama_baja'
	
FROM
	camas c

LEFT JOIN
	habitaciones h

ON c.id_habitacion = h.id_habitacion

LEFT JOIN
	salas s
ON h.id_sala = s.id_sala

WHERE 
	c.id_efector=@id_efector;
	
	
SELECT 
	
	id_efector,
	
	sala_nombre,
	sala_cant_camas,
	sala_mover_camas,
	
	habitacion_nombre,
	habitacion_sexo,
	habitacion_edad_desde,
	habitacion_edad_hasta,
	habitacion_tipo_edad,
	habitacion_cant_camas,
	habitacion_baja,
	
	cama_nombre,
	cama_id_clasificacion_cama,
	cama_estado,
	cama_rotativa,
	cama_baja
	
FROM 

	informe_confedilicia_tmp 
	
ORDER BY 

	sala_nombre,
	habitacion_nombre,
	cama_nombre;
```
```curl
# ver ejemplo sql
```
```bash
# ver ejemplo sql
```
```vb6
'Ver ejemplo sql
```
```php
/* Ver ejemplo sql */
```
#### Ejemplo convertir resultado de consulta MySQL a archivo .csv con "sed" [solo bash]

```bash
$ sed "s/'/\'/;s/\t/\",\"/g;s/^/\"/;s/$/\"/" confedilicia.dump >confedilicia.csv
```
```curl
# ver ejemplo bash
```
```sql
/* ver ejemplo bash */
```
```vb6
'Ver ejemplo bash
```
```php
/* Ver ejemplo bash */
```
#### Ejemplo Request (inicialización/resincronización)
```curl
$ curl --data-binary @confedilicia.csv -H 'Content-type:text/plain; charset=utf-8' http://localhost:8000/sync.json
```
```bash
# ver ejemplo cUrl
```
```sql
/* ver ejemplo cUrl */
```
```vb6
'Ver ejemplo cUrl
```
```php
/* Ver ejemplo cUrl */
```
#### Ejemplo Response (inicialización/resincronización)

```json
{
"La configuración edilicia del efector: HOSP EVA PERON fue inicializada/sincronizada"
}
```

#### Ejemplo completo [solo bash]
```bash
# 1) Genera la consulta Informe Configuracion Edilicia
#
#		mysql -uroot alassia_hmi2_20161111 <informe_confedilicia.sql
#
# 2) La salida la transforma a archivo "csv" con el comando "sed"
#
#	Comando "sed":
#		2.1) escapa los '
#				s/'/\'/
#		2.2) reemplaza los "tab" por: ","
#				s/\t/\",\"/g
#		2.3) reemplaza el comienzo de linea por: "
#				s/^/\"/
#		2.4) reemplaza el fin de linea por: "
#				s/$/\"/
#
# 3) Genera el archivo "confedilicia.csv"
#
#		>confedilicia.csv
mysql -uroot evaperon_hmi2_20170912 <informe_confedilicia.sql | sed "s/'/\'/;s/\t/\",\"/g;s/^/\"/;s/$/\"/" >confedilicia.csv

# Genera una peticion(Request) POST con el archivo "confedilicia.csv" como "BODY"
curl --data-binary @confedilicia.csv -H 'Content-type:text/plain; charset=utf-8' http://localhost:8000/sync.json 
```
```curl
# ver ejemplo bash
```
```sql
/* ver ejemplo bash */
```
```vb6
'Ver ejemplo bash
```
```php
/* Ver ejemplo bash */
```
