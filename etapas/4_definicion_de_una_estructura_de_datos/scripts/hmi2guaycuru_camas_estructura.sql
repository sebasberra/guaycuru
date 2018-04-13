-- -----------------------------------------------------
-- Table localidades
-- -----------------------------------------------------
DROP TABLE IF EXISTS localidades ;

CREATE TABLE IF NOT EXISTS localidades (
  id_localidad INT UNSIGNED NOT NULL AUTO_INCREMENT,
  id_dpto INT UNSIGNED NULL DEFAULT NULL,
  nom_loc VARCHAR(50) NOT NULL,
  cod_loc CHAR(2) NOT NULL,
  cod_dpto CHAR(3) NOT NULL,
  cod_prov CHAR(2) NOT NULL,
  cod_pais CHAR(3) NOT NULL,
  cod_postal VARCHAR(4) NULL DEFAULT NULL,
  PRIMARY KEY (id_localidad),
  UNIQUE INDEX idx_unique_cod_loc_cod_dpto_cod_prov_cod_pais (cod_loc ASC, cod_dpto ASC, cod_prov ASC, cod_pais ASC),
  INDEX idx_fk_localidades_id_dpto (id_dpto ASC),
  INDEX idx_nom_loc (nom_loc ASC)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COMMENT = 'localidades, departamentos, provincias y paises codificados';


-- -----------------------------------------------------
-- Table efectores
-- -----------------------------------------------------
DROP TABLE IF EXISTS efectores ;

CREATE TABLE IF NOT EXISTS efectores (
  id_efector INT UNSIGNED NOT NULL,
  id_nodo SMALLINT UNSIGNED NOT NULL,
  id_subnodo SMALLINT UNSIGNED NOT NULL,
  id_localidad INT UNSIGNED NOT NULL,
  id_dependencia_adm TINYINT UNSIGNED NULL DEFAULT NULL,
  id_regimen_juridico TINYINT UNSIGNED NOT NULL,
  id_nivel_complejidad TINYINT UNSIGNED NOT NULL COMMENT 'Nivel de complejidad del ejector. Ver tabla niveles_complejidades',
  claveestd VARCHAR(8) NOT NULL,
  clavesisa CHAR(14) DEFAULT NULL COMMENT 'clave SISA (Sistema Integrado de Informacion Argentino)',
  tipo_efector CHAR(1) NULL DEFAULT NULL COMMENT 'tipo establecimiento para el informe de estadistica',
  nom_efector VARCHAR(255) NOT NULL,
  nom_red_efector VARCHAR(50) NOT NULL,
  nodo TINYINT(4) UNSIGNED NOT NULL,
  subnodo SMALLINT(6) UNSIGNED NOT NULL,
  internacion TINYINT(1) NOT NULL COMMENT 'Indica si el efector tiene internacion o no',
  baja TINYINT(1) NOT NULL COMMENT 'Indica si el efector esta activo o fue dado de baja',
  PRIMARY KEY (id_efector),
  UNIQUE INDEX idx_unique_claveestd (claveestd ASC),
  INDEX idx_fk_efectores_id_localidad (id_localidad ASC),
  INDEX idx_fk_efectores_id_dependencia_adm (id_dependencia_adm ASC),
  INDEX idx_fk_efectores_id_regimen_juridico (id_regimen_juridico ASC),
  INDEX idx_fk_efectores_id_nodo (id_nodo ASC),
  INDEX idx_fk_efectores_id_subnodo (id_subnodo ASC),
  INDEX idx_fk_efectores_id_nivel_complejidad (id_nivel_complejidad ASC),
  INDEX idx_clavesisa (clavesisa ASC),
  CONSTRAINT fk_efectores_id_localidad
    FOREIGN KEY (id_localidad)
    REFERENCES localidades (id_localidad)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COMMENT = 'efectores publicos y privados de la provincia de santa fe';


-- -----------------------------------------------------
-- Table servicios_estadistica
-- -----------------------------------------------------
DROP TABLE IF EXISTS servicios_estadistica ;

CREATE TABLE IF NOT EXISTS servicios_estadistica (
  id_servicio_estadistica INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id autoincremental',
  id_servicio INT UNSIGNED NOT NULL COMMENT 'id de tabla servicios',
  cod_servicio CHAR(3) NOT NULL COMMENT 'codigo nuclear de servicios de nacion vigente desde 2008',
  sector CHAR(1) NOT NULL COMMENT '1=varones; 2=mujeres; 3=mixto; 4=ecografía; 5=radiología; 8=talleres',
  subsector CHAR(1) NOT NULL COMMENT '4=internacion; 5=CE; 6=atencion domiciliaria',
  nom_servicio_estadistica VARCHAR(255) NOT NULL COMMENT 'descripcion del servicio obtenida del SIPES, tabla de servicios de 5 digitos',
  nom_red_servicio_estadistica VARCHAR(30) NOT NULL COMMENT 'idem anterios truncada con los primeros 30 caracteres',
  PRIMARY KEY (id_servicio_estadistica),
  UNIQUE INDEX idx_unique_cod_servicio_sector_subsector (cod_servicio ASC, sector ASC, subsector ASC),
  INDEX idx_fk_servicios_estadistica_id_servicio (id_servicio ASC)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COMMENT = 'servicios que maneja estadistica de la provincia de santa fe';

-- -----------------------------------------------------
-- Table efectores_servicios
-- -----------------------------------------------------
DROP TABLE IF EXISTS efectores_servicios ;

CREATE TABLE IF NOT EXISTS efectores_servicios (
  id_efector_servicio INT UNSIGNED NOT NULL COMMENT 'concatenacion del id_efector con el id_servicio_estadistica. los nuevos valores pueden obtenerse con la funcion get_id_efector_servicio',
  id_efector INT UNSIGNED NOT NULL COMMENT 'id del efector donde se ha habilitado el servicio de 5 digitos',
  id_servicio_estadistica INT UNSIGNED NOT NULL COMMENT 'id del servicio de 5 digitos de estadistica',
  claveestd CHAR(8) NOT NULL COMMENT 'codigo de establecimiento de 8 digitos obtenido del mod_sims',
  cod_servicio CHAR(3) NOT NULL COMMENT 'codigo nuclear de servicios de nacion vigente desde 2008',
  sector CHAR(1) NOT NULL COMMENT '1=varones; 2=mujeres; 3=mixto;; 4=ecografía; 5=radiología; 8=talleres',
  subsector CHAR(1) NOT NULL COMMENT '4=internacion; 5=CE; 6=atencion domiciliaria',
  nom_servicio_estadistica VARCHAR(255) NOT NULL COMMENT 'Nombre del servicio de estadistica. Este campo se agrego para facilitar los select y reportes en programacion',
  baja TINYINT NOT NULL COMMENT 'estado actual del servicio en el efector: 0=alta; 1=baja',
  fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'fecha de actualizacion del registro',
  PRIMARY KEY (id_efector_servicio),
  UNIQUE INDEX idx_unique_claveestd_cod_servicio_sector_subsector (claveestd ASC, cod_servicio ASC, sector ASC, subsector ASC)/*  COMMENT 'check que no se repita los codigos de estadistica en el efector'*/,
  INDEX idx_fk_efectores_servicios_id_efector (id_efector ASC),
  INDEX idx_fk_efectores_servicios_id_servicio_estadistica (id_servicio_estadistica ASC),
  UNIQUE INDEX idx_unique_id_efector_id_servicio_estadistica (id_efector ASC, id_servicio_estadistica ASC)/*  COMMENT 'check que no se repita el id del servicio de 5 digitos en el efector' */,
  CONSTRAINT fk_efectores_servicios_id_efector
    FOREIGN KEY (id_efector)
    REFERENCES efectores (id_efector)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_efectores_servicios_id_servicio_estadistica
    FOREIGN KEY (id_servicio_estadistica)
    REFERENCES servicios_estadistica (id_servicio_estadistica)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COMMENT = 'servicios habilitados por estadistica en el efector';


-- -----------------------------------------------------
-- Table salas
-- -----------------------------------------------------
DROP TABLE IF EXISTS salas ;

CREATE TABLE IF NOT EXISTS salas (
  id_sala INT UNSIGNED NOT NULL COMMENT 'concatenacion del id_efector y nro_sala',
  id_efector INT UNSIGNED NOT NULL COMMENT 'id del efector de donde pertenece la sala',
  nro_sala SMALLINT UNSIGNED NOT NULL COMMENT 'nro de sala dentro del efector, se implementa como incremental por efector',
  nombre VARCHAR(255) NOT NULL COMMENT 'nombre de la sala dentro del efector',
  cant_camas SMALLINT(5) UNSIGNED NOT NULL COMMENT 'cantidad total de camas de la sala',
  mover_camas TINYINT(1) NOT NULL COMMENT 'bandera para el sistema que indica si se permite mover camas entre las habitaciones de la misma sala. por ejemplo: las incubadoras ',
  area_id_efector_servicio INT UNSIGNED NULL COMMENT 'id del servicio del efector que es el referente de la sala (concepto de area del SIPES)',
  area_cod_servicio CHAR(3) NULL COMMENT 'codigo de 3 digitos del area SIPES',
  area_sector CHAR(1) NULL COMMENT 'campo sector correspondiente al area SIPES (1=varones; 2=mujeres; 3=mixto)',
  area_subsector CHAR(1) NULL COMMENT 'subsector correspondiente al area SIPES (4=internacion; 5=CE; 6=atencion domiciliaria; 4=ecografía; 5=radiología; 8=talleres)',
  baja TINYINT NOT NULL COMMENT 'marca si la sala esta actualmente cerrada',
  fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'fecha de modificacion del registro',
  PRIMARY KEY (id_sala),
  UNIQUE INDEX idx_unique_id_efector_nombre (id_efector ASC, nombre ASC),
  INDEX idx_fk_salas_area_id_efector_servicio (area_id_efector_servicio ASC),
  UNIQUE INDEX idx_unique_id_efector_area_id_efector_servicio (area_id_efector_servicio ASC),
  UNIQUE INDEX idx_unique_id_efector_cod_servicio_sector_subsector (id_efector ASC, area_cod_servicio ASC, area_sector ASC, area_subsector ASC),
  UNIQUE INDEX idx_unique_id_efector_nro_sala (id_efector ASC, nro_sala ASC),
  CONSTRAINT fk_salas_id_efector
    FOREIGN KEY (id_efector)
    REFERENCES efectores (id_efector)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_salas_ref_id_efector_servicio
    FOREIGN KEY (area_id_efector_servicio)
    REFERENCES efectores_servicios (id_efector_servicio)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COMMENT = 'sala logica o area en la config. edilicia del efector';


-- -----------------------------------------------------
-- Table habitaciones
-- -----------------------------------------------------
DROP TABLE IF EXISTS habitaciones ;

CREATE TABLE IF NOT EXISTS habitaciones (
  id_habitacion INT UNSIGNED NOT NULL AUTO_INCREMENT,
  id_sala INT UNSIGNED NOT NULL,
  nombre VARCHAR(50) NOT NULL,
  sexo TINYINT(3) UNSIGNED NOT NULL COMMENT '1=hombre; 2=mujer; 3=indeterminado',
  edad_desde TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
  edad_hasta TINYINT(3) UNSIGNED NOT NULL DEFAULT '255',
  tipo_edad CHAR(1) NOT NULL COMMENT '1=años; 2=meses; 3=días; 4=horas; 5=minutos; 6=ignora',
  cant_camas SMALLINT(5) UNSIGNED NOT NULL COMMENT 'cantidad de camas de la habitacion',
  baja TINYINT(1) NOT NULL DEFAULT FALSE COMMENT '0 = habilitada; 1 = baja',
  fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id_habitacion),
  UNIQUE INDEX idx_unique_nombre_id_sala (nombre ASC, id_sala ASC),
  INDEX idx_fk_habitaciones_id_sala (id_sala ASC),
  CONSTRAINT fk_habitaciones_id_sala
    FOREIGN KEY (id_sala)
    REFERENCES salas (id_sala)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COMMENT = 'habitaciones fisicas que se asocian a una sala';




-- -----------------------------------------------------
-- Table clasificaciones_camas
-- -----------------------------------------------------
DROP TABLE IF EXISTS clasificaciones_camas ;

CREATE TABLE IF NOT EXISTS clasificaciones_camas (
  id_clasificacion_cama TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  clasificacion_cama VARCHAR(50) NOT NULL COMMENT 'Descripcion de la clasificacion',
  abreviatura CHAR(5) NOT NULL COMMENT 'Abreviatura de la descripcion',
  definicion TEXT NULL COMMENT 'Informacion extra',
  tipo_cuidado_progresivo TINYINT NOT NULL COMMENT '0= cuidado moderado; 1= cuidado intermedio ; 2=cuidado critico',
  critica TINYINT(1) NOT NULL COMMENT '0= NO critica; 1= critica',
  categoria_edad CHAR(5) NOT NULL COMMENT 'ADU= adulto (>14 a); PED= pediatrica (>28 d y <14 a); NEO= neonatologica (<28 d)',
  oxigeno TINYINT(1) NOT NULL COMMENT '0 = sin oxigeno ; 1 = con oxigeno',
  respirador TINYINT(1) NOT NULL COMMENT '0= sin respirador; 1= con respirador',
  aislamiento TINYINT NOT NULL COMMENT '0= sin aislamiento; 1= con aislamiento (casos donde el paciente debe estar aislado de los otros por el tipo de efermedad)',
  fecha_expiracion DATE NULL COMMENT 'Fecha de baja de la clasificacion, NULL si la clasificacion esta activa',
  PRIMARY KEY (id_clasificacion_cama))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COMMENT = 'tipos de cama propuestos por Stettler y compatibles con sisa';



-- -----------------------------------------------------
-- Table camas
-- -----------------------------------------------------
DROP TABLE IF EXISTS camas ;

CREATE TABLE IF NOT EXISTS camas (
  id_cama INT UNSIGNED NOT NULL AUTO_INCREMENT,
  id_clasificacion_cama TINYINT UNSIGNED NOT NULL COMMENT 'clasificacion de cama',
  id_efector INT UNSIGNED NOT NULL COMMENT 'Se guarda el id del efector para cuando la cama no esta asignada a una habitacion',
  id_habitacion INT UNSIGNED NULL DEFAULT NULL COMMENT 'para camas rotativas esta permitido que la cama no este asignada a una habitacion en un momento dado',
  id_internacion INT UNSIGNED NULL DEFAULT NULL COMMENT 'Id de internacion de quien esta ocupando la cama. Si es NULL la cama esta vacia',
  nombre VARCHAR(50) NOT NULL,
  estado CHAR(1) NOT NULL COMMENT 'L=libre; O=ocupada; F=fuera de servicio; R=en reparacion; V=reservada',
  rotativa TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0=no es rotativa, 1=es rotativa; Las camas rotativas pueden cambiarse de habitacion o sala o no estar asignada a una habitacion en un momento dado',
  baja TINYINT(1) NOT NULL DEFAULT FALSE COMMENT '0 = habilitada; 1 = baja',
  fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id_cama),
  UNIQUE INDEX idx_unique_nombre_id_efector (nombre ASC, id_efector ASC),
  INDEX idx_fk_camas_id_habitacion (id_habitacion ASC),
  INDEX idx_fk_camas_id_efector (id_efector ASC),
  INDEX idx_fk_camas_id_clasificacion_cama (id_clasificacion_cama ASC),
  CONSTRAINT fk_camas_id_efector
    FOREIGN KEY (id_efector)
    REFERENCES efectores (id_efector)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_camas_id_habitacion
    FOREIGN KEY (id_habitacion)
    REFERENCES habitaciones (id_habitacion)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_camas_id_clasificacion_cama
    FOREIGN KEY (id_clasificacion_cama)
    REFERENCES clasificaciones_camas (id_clasificacion_cama)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COMMENT = 'camas comunes, camillas, incubadoras, etc';


-- -----------------------------------------------------
-- Table servicios_salas
-- -----------------------------------------------------
DROP TABLE IF EXISTS servicios_salas ;

CREATE TABLE IF NOT EXISTS servicios_salas (
  id_servicio_sala INT UNSIGNED NOT NULL COMMENT 'se genera como la concatenacion del id_sala + el id_servicio_estadistica',
  id_efector INT UNSIGNED NOT NULL COMMENT 'id_efector de donde es el servicio y la sala',
  id_efector_servicio INT UNSIGNED NOT NULL COMMENT 'id_efector_servicio del servicio del efector',
  id_sala INT UNSIGNED NOT NULL COMMENT 'id_sala de la sala del efector',
  agudo_cronico TINYINT NOT NULL COMMENT '1=agudo; 2=cronico',
  tipo_servicio_sala TINYINT NOT NULL COMMENT '0=comun; 1=hospital de dia; 2=atencion domiciliaria',
  baja TINYINT(1) NOT NULL COMMENT 'Se puede dar de baja a un servicio de una sala y mantener los pases de este',
  fecha_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'fecha de modificacion del registro',
  PRIMARY KEY (id_servicio_sala),
  UNIQUE INDEX idx_unique_id_efector_servicio_id_sala (id_efector_servicio ASC, id_sala ASC) /* COMMENT 'check que no se repita el servicio del efector en la sala, teniendo en cuenta que la generacion de id_sala es unica entre todos los efectores' */,
  INDEX idx_fk_servicios_salas_id_sala (id_sala ASC),
  INDEX fk_servicios_salas_id_efector_idx (id_efector ASC),
  UNIQUE INDEX idx_unique_id_efector_id_efector_servicio_id_sala (id_efector ASC, id_efector_servicio ASC, id_sala ASC) /* COMMENT 'check que no se repita el servicio del efector en la sala' */,
  CONSTRAINT fk_servicios_salas_id_efector_servicio
    FOREIGN KEY (id_efector_servicio)
    REFERENCES efectores_servicios (id_efector_servicio)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_servicios_salas_id_sala
    FOREIGN KEY (id_sala)
    REFERENCES salas (id_sala)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_servicios_salas_id_efector
    FOREIGN KEY (id_efector)
    REFERENCES efectores (id_efector)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COMMENT = 'servicios de 5 digitos habilitados en la sala';

-- -----------------------------------------------------
-- Table configuraciones_sistemas
-- -----------------------------------------------------
DROP TABLE IF EXISTS configuraciones_sistemas ;

CREATE TABLE IF NOT EXISTS configuraciones_sistemas (
  id_configuracion_sistema INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID autoincremental',
  id_efector INT UNSIGNED NOT NULL COMMENT 'Identificativo de efector correspondiente a mod_sims.d_establecimiento.id_establecimiento',
  activa TINYINT(1) NOT NULL COMMENT 'Efector activo o no en el sistema',
  tipo_registros TINYINT(1) NOT NULL COMMENT 'Define el tipo de registro que se cargan(ABM) o se actualizan por ws del efector. 0=abm; 1=ws;',
  fecha_hora_sincro DATETIME NULL DEFAULT NULL COMMENT 'NULL si el campo tipo_registros=0 o la fecha y hora de la ultima sincronizacion de los datos por ws si tipo_registros=1',
  observaciones VARCHAR(255) NULL DEFAULT NULL COMMENT 'Observaciones',
  PRIMARY KEY (id_configuracion_sistema),
  INDEX idx_fk_configuraciones_sistemas_id_efector (id_efector ASC),
  CONSTRAINT fk_configuraciones_sistemas_id_efector
    FOREIGN KEY (id_efector)
    REFERENCES efectores (id_efector)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = INNODB
DEFAULT CHARACTER SET = latin1
COMMENT = 'activa el efector donde se esta corriendo el hmi2';
