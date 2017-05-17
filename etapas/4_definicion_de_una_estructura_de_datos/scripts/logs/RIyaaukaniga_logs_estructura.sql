DROP TABLE IF EXISTS logs_auditados;

DROP TABLE IF EXISTS logs_datos;

DROP TABLE IF EXISTS logs_conexiones;

CREATE TABLE IF NOT EXISTS logs_auditados (
  id_log_auditado INT NOT NULL AUTO_INCREMENT,
  descripcion VARCHAR(255) NOT NULL COMMENT 'Nombre descriptivo del sistema donde se aplicara el logger',
  estado TINYINT(1) NOT NULL COMMENT '0=desactivada o 1=activada la gestion de logs',
  guardar_modificaciones_nulas TINYINT(1) NOT NULL COMMENT 'flag para activar o desactivar auditar modificaciones donde no ha cambiado ningun valor',
  PRIMARY KEY (id_log_auditado))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'Flags para el sistema de logs';


CREATE TABLE IF NOT EXISTS logs_conexiones (
  id_log_conexion INT NOT NULL AUTO_INCREMENT COMMENT 'id de la conexion',
  my_connection_id BIGINT NOT NULL COMMENT 'Valor devuelto por la funcion CONNECTION_ID de mysql',
  user_db VARCHAR(64) NOT NULL COMMENT 'Usuario de la base de datos',
  host_db VARCHAR(64) NOT NULL COMMENT 'Host de la conexion',
  descripcion VARCHAR(255) NOT NULL,
  fecha_hora DATETIME NOT NULL COMMENT 'Fecha y hora de conexion',
  PRIMARY KEY (id_log_conexion),
  INDEX idx_user_db (user_db ASC),
  INDEX idx_host_db (host_db ASC),
  INDEX idx_descripcion (descripcion ASC),
  INDEX idx_fecha_hora (fecha_hora ASC),
  INDEX idx_my_connection_id (my_connection_id ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'registra los id de conexiones';


CREATE TABLE IF NOT EXISTS logs_datos (
  id_log_dato INT NOT NULL AUTO_INCREMENT COMMENT 'id del registro de movimiento de datos',
  id_log_conexion INT NOT NULL,
  tabla VARCHAR(255) NOT NULL COMMENT 'Nombre literal de la tabla donde se efectuo el movimiento de registros',
  campos TEXT NOT NULL COMMENT 'Nombres de campos separados por ;',
  valores TEXT NOT NULL COMMENT 'Valores de los campos separados por ;',
  tipo_sql CHAR(1) NOT NULL COMMENT 'I=insert;N=update new; O=update old; D=delete;',
  fecha_hora DATETIME NOT NULL COMMENT 'Fecha y hora de registro del dato',
  PRIMARY KEY (id_log_dato),
  INDEX idx_tabla (tabla ASC),
  INDEX idx_campos (campos(20) ASC),
  INDEX idx_valores (valores(20) ASC),
  INDEX idx_tipo_sql (tipo_sql ASC),
  INDEX idx_fecha_hora (fecha_hora ASC),
  INDEX fk_logs_datos_id_log_conexion (id_log_conexion ASC),
  CONSTRAINT fk_logs_datos_id_log_conexion
    FOREIGN KEY (id_log_conexion)
    REFERENCES logs_conexiones (id_log_conexion)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'Tabla de registro de logs';
