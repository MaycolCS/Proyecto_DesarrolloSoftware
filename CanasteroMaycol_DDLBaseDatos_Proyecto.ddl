-- Generado por Oracle SQL Developer Data Modeler 20.2.0.167.1538
--   en:        2020-11-24 17:00:26 COT
--   sitio:      Oracle Database 11g
--   tipo:      Oracle Database 11g



DROP TABLE empresa CASCADE CONSTRAINTS;

DROP TABLE recorrido CASCADE CONSTRAINTS;

DROP TABLE tanqueada CASCADE CONSTRAINTS;

DROP TABLE usuario CASCADE CONSTRAINTS;

DROP TABLE vehiculo CASCADE CONSTRAINTS;

DROP TABLE viaje CASCADE CONSTRAINTS;

-- predefined type, no DDL - MDSYS.SDO_GEOMETRY

-- predefined type, no DDL - XMLTYPE

CREATE TABLE empresa (
    nit_empresa     NUMBER(15, 2) NOT NULL,
    nombre_empresa  VARCHAR2(200) NOT NULL,
    ciudad_empresa  VARCHAR2(200) NOT NULL
);

ALTER TABLE empresa ADD CONSTRAINT empresa_pk PRIMARY KEY ( nit_empresa );


CREATE TABLE empresa_JN
 (JN_OPERATION CHAR(3) NOT NULL
 ,JN_ORACLE_USER VARCHAR2(30) NOT NULL
 ,JN_DATETIME DATE NOT NULL
 ,JN_NOTES VARCHAR2(240)
 ,JN_APPLN VARCHAR2(35)
 ,JN_SESSION NUMBER(38)
 ,nit_empresa NUMBER (15,2) NOT NULL
 ,nombre_empresa VARCHAR2 (200) NOT NULL
 ,ciudad_empresa VARCHAR2 (200) NOT NULL
 );

CREATE OR REPLACE TRIGGER empresa_JNtrg
  AFTER 
  INSERT OR 
  UPDATE OR 
  DELETE ON empresa for each row 
 Declare 
  rec empresa_JN%ROWTYPE; 
  blank empresa_JN%ROWTYPE; 
  BEGIN 
    rec := blank; 
    IF INSERTING OR UPDATING THEN 
      rec.nit_empresa := :NEW.nit_empresa; 
      rec.nombre_empresa := :NEW.nombre_empresa; 
      rec.ciudad_empresa := :NEW.ciudad_empresa; 
      rec.JN_DATETIME := SYSDATE; 
      rec.JN_ORACLE_USER := SYS_CONTEXT ('USERENV', 'SESSION_USER'); 
      rec.JN_APPLN := SYS_CONTEXT ('USERENV', 'MODULE'); 
      rec.JN_SESSION := SYS_CONTEXT ('USERENV', 'SESSIONID'); 
      IF INSERTING THEN 
        rec.JN_OPERATION := 'INS'; 
      ELSIF UPDATING THEN 
        rec.JN_OPERATION := 'UPD'; 
      END IF; 
    ELSIF DELETING THEN 
      rec.nit_empresa := :OLD.nit_empresa; 
      rec.nombre_empresa := :OLD.nombre_empresa; 
      rec.ciudad_empresa := :OLD.ciudad_empresa; 
      rec.JN_DATETIME := SYSDATE; 
      rec.JN_ORACLE_USER := SYS_CONTEXT ('USERENV', 'SESSION_USER'); 
      rec.JN_APPLN := SYS_CONTEXT ('USERENV', 'MODULE'); 
      rec.JN_SESSION := SYS_CONTEXT ('USERENV', 'SESSIONID'); 
      rec.JN_OPERATION := 'DEL'; 
    END IF; 
    INSERT into empresa_JN VALUES rec; 
  END; 
  /CREATE TABLE recorrido (
    id_recorrido         NUMBER(12, 2) NOT NULL,
    origen_recorrido     VARCHAR2(200) NOT NULL,
    destino_recorrido    VARCHAR2(200) NOT NULL,
    paraderos_recorrido  VARCHAR2(500) NOT NULL,
    empresa_nit_empresa  NUMBER(15, 2)
);

ALTER TABLE recorrido ADD CONSTRAINT recorrido_pk PRIMARY KEY ( id_recorrido );


CREATE TABLE recorrido_JN
 (JN_OPERATION CHAR(3) NOT NULL
 ,JN_ORACLE_USER VARCHAR2(30) NOT NULL
 ,JN_DATETIME DATE NOT NULL
 ,JN_NOTES VARCHAR2(240)
 ,JN_APPLN VARCHAR2(35)
 ,JN_SESSION NUMBER(38)
 ,id_recorrido NUMBER (12,2) NOT NULL
 ,origen_recorrido VARCHAR2 (200) NOT NULL
 ,destino_recorrido VARCHAR2 (200) NOT NULL
 ,paraderos_recorrido VARCHAR2 (500) NOT NULL
 ,empresa_nit_empresa NUMBER (15,2)
 );

CREATE OR REPLACE TRIGGER recorrido_JNtrg
  AFTER 
  INSERT OR 
  UPDATE OR 
  DELETE ON recorrido for each row 
 Declare 
  rec recorrido_JN%ROWTYPE; 
  blank recorrido_JN%ROWTYPE; 
  BEGIN 
    rec := blank; 
    IF INSERTING OR UPDATING THEN 
      rec.id_recorrido := :NEW.id_recorrido; 
      rec.origen_recorrido := :NEW.origen_recorrido; 
      rec.destino_recorrido := :NEW.destino_recorrido; 
      rec.paraderos_recorrido := :NEW.paraderos_recorrido; 
      rec.empresa_nit_empresa := :NEW.empresa_nit_empresa; 
      rec.JN_DATETIME := SYSDATE; 
      rec.JN_ORACLE_USER := SYS_CONTEXT ('USERENV', 'SESSION_USER'); 
      rec.JN_APPLN := SYS_CONTEXT ('USERENV', 'MODULE'); 
      rec.JN_SESSION := SYS_CONTEXT ('USERENV', 'SESSIONID'); 
      IF INSERTING THEN 
        rec.JN_OPERATION := 'INS'; 
      ELSIF UPDATING THEN 
        rec.JN_OPERATION := 'UPD'; 
      END IF; 
    ELSIF DELETING THEN 
      rec.id_recorrido := :OLD.id_recorrido; 
      rec.origen_recorrido := :OLD.origen_recorrido; 
      rec.destino_recorrido := :OLD.destino_recorrido; 
      rec.paraderos_recorrido := :OLD.paraderos_recorrido; 
      rec.empresa_nit_empresa := :OLD.empresa_nit_empresa; 
      rec.JN_DATETIME := SYSDATE; 
      rec.JN_ORACLE_USER := SYS_CONTEXT ('USERENV', 'SESSION_USER'); 
      rec.JN_APPLN := SYS_CONTEXT ('USERENV', 'MODULE'); 
      rec.JN_SESSION := SYS_CONTEXT ('USERENV', 'SESSIONID'); 
      rec.JN_OPERATION := 'DEL'; 
    END IF; 
    INSERT into recorrido_JN VALUES rec; 
  END; 
  /CREATE TABLE tanqueada (
    id_tanqueada             NUMBER(11, 2) NOT NULL,
    vehiculo_placa_vehiculo  VARCHAR2(6) NOT NULL,
    recibo_tanqueada         NUMBER(11) NOT NULL,
    fecha_tanqueada          DATE NOT NULL,
    valor_tanqueada          NUMBER(11) NOT NULL,
    galones_tanqueada        NUMBER(11) NOT NULL,
    nota_tanqueada           VARCHAR2(500) NOT NULL
);

ALTER TABLE tanqueada ADD CONSTRAINT tanqueada_pk PRIMARY KEY ( id_tanqueada,
                                                                vehiculo_placa_vehiculo );


CREATE TABLE tanqueada_JN
 (JN_OPERATION CHAR(3) NOT NULL
 ,JN_ORACLE_USER VARCHAR2(30) NOT NULL
 ,JN_DATETIME DATE NOT NULL
 ,JN_NOTES VARCHAR2(240)
 ,JN_APPLN VARCHAR2(35)
 ,JN_SESSION NUMBER(38)
 ,id_tanqueada NUMBER (11,2) NOT NULL
 ,vehiculo_placa_vehiculo VARCHAR2 (6) NOT NULL
 ,recibo_tanqueada NUMBER (11) NOT NULL
 ,fecha_tanqueada DATE NOT NULL
 ,valor_tanqueada NUMBER (11) NOT NULL
 ,galones_tanqueada NUMBER (11) NOT NULL
 ,nota_tanqueada VARCHAR2 (500) NOT NULL
 );

CREATE OR REPLACE TRIGGER tanqueada_JNtrg
  AFTER 
  INSERT OR 
  UPDATE OR 
  DELETE ON tanqueada for each row 
 Declare 
  rec tanqueada_JN%ROWTYPE; 
  blank tanqueada_JN%ROWTYPE; 
  BEGIN 
    rec := blank; 
    IF INSERTING OR UPDATING THEN 
      rec.id_tanqueada := :NEW.id_tanqueada; 
      rec.vehiculo_placa_vehiculo := :NEW.vehiculo_placa_vehiculo; 
      rec.recibo_tanqueada := :NEW.recibo_tanqueada; 
      rec.fecha_tanqueada := :NEW.fecha_tanqueada; 
      rec.valor_tanqueada := :NEW.valor_tanqueada; 
      rec.galones_tanqueada := :NEW.galones_tanqueada; 
      rec.nota_tanqueada := :NEW.nota_tanqueada; 
      rec.JN_DATETIME := SYSDATE; 
      rec.JN_ORACLE_USER := SYS_CONTEXT ('USERENV', 'SESSION_USER'); 
      rec.JN_APPLN := SYS_CONTEXT ('USERENV', 'MODULE'); 
      rec.JN_SESSION := SYS_CONTEXT ('USERENV', 'SESSIONID'); 
      IF INSERTING THEN 
        rec.JN_OPERATION := 'INS'; 
      ELSIF UPDATING THEN 
        rec.JN_OPERATION := 'UPD'; 
      END IF; 
    ELSIF DELETING THEN 
      rec.id_tanqueada := :OLD.id_tanqueada; 
      rec.vehiculo_placa_vehiculo := :OLD.vehiculo_placa_vehiculo; 
      rec.recibo_tanqueada := :OLD.recibo_tanqueada; 
      rec.fecha_tanqueada := :OLD.fecha_tanqueada; 
      rec.valor_tanqueada := :OLD.valor_tanqueada; 
      rec.galones_tanqueada := :OLD.galones_tanqueada; 
      rec.nota_tanqueada := :OLD.nota_tanqueada; 
      rec.JN_DATETIME := SYSDATE; 
      rec.JN_ORACLE_USER := SYS_CONTEXT ('USERENV', 'SESSION_USER'); 
      rec.JN_APPLN := SYS_CONTEXT ('USERENV', 'MODULE'); 
      rec.JN_SESSION := SYS_CONTEXT ('USERENV', 'SESSIONID'); 
      rec.JN_OPERATION := 'DEL'; 
    END IF; 
    INSERT into tanqueada_JN VALUES rec; 
  END; 
  /CREATE TABLE usuario (
    cedula_usuario      NUMBER(12, 2) NOT NULL,
    nombre_usuario      VARCHAR2(200) NOT NULL,
    apellido_usuario    VARCHAR2(200) NOT NULL,
    celular_usuario     NUMBER(10, 2) NOT NULL,
    correo_usuario      VARCHAR2(200) NOT NULL,
    sesion_usuario      CHAR(1) NOT NULL,
    rol_usuario         VARCHAR2(200 CHAR) NOT NULL,
    contraseña_usuario  VARCHAR2(200) NOT NULL,
    rc_usuario          NUMBER
);

ALTER TABLE usuario
    ADD CHECK ( rol_usuario IN ( 'Administrador', 'Conductor', 'Oficina' ) );

ALTER TABLE usuario ADD CONSTRAINT usuario_pk PRIMARY KEY ( cedula_usuario );


CREATE TABLE usuario_JN
 (JN_OPERATION CHAR(3) NOT NULL
 ,JN_ORACLE_USER VARCHAR2(30) NOT NULL
 ,JN_DATETIME DATE NOT NULL
 ,JN_NOTES VARCHAR2(240)
 ,JN_APPLN VARCHAR2(35)
 ,JN_SESSION NUMBER(38)
 ,cedula_usuario NUMBER (12,2) NOT NULL
 ,nombre_usuario VARCHAR2 (200) NOT NULL
 ,apellido_usuario VARCHAR2 (200) NOT NULL
 ,celular_usuario NUMBER (10,2) NOT NULL
 ,correo_usuario VARCHAR2 (200) NOT NULL
 ,sesion_usuario CHAR (1) NOT NULL
 ,rol_usuario VARCHAR2 (200 CHAR) NOT NULL
 ,contraseña_usuario VARCHAR2 (200) NOT NULL
 ,rc_usuario NUMBER
 );

CREATE OR REPLACE TRIGGER usuario_JNtrg
  AFTER 
  INSERT OR 
  UPDATE OR 
  DELETE ON usuario for each row 
 Declare 
  rec usuario_JN%ROWTYPE; 
  blank usuario_JN%ROWTYPE; 
  BEGIN 
    rec := blank; 
    IF INSERTING OR UPDATING THEN 
      rec.cedula_usuario := :NEW.cedula_usuario; 
      rec.nombre_usuario := :NEW.nombre_usuario; 
      rec.apellido_usuario := :NEW.apellido_usuario; 
      rec.celular_usuario := :NEW.celular_usuario; 
      rec.correo_usuario := :NEW.correo_usuario; 
      rec.sesion_usuario := :NEW.sesion_usuario; 
      rec.rol_usuario := :NEW.rol_usuario; 
      rec.contraseña_usuario := :NEW.contraseña_usuario; 
      rec.rc_usuario := :NEW.rc_usuario; 
      rec.JN_DATETIME := SYSDATE; 
      rec.JN_ORACLE_USER := SYS_CONTEXT ('USERENV', 'SESSION_USER'); 
      rec.JN_APPLN := SYS_CONTEXT ('USERENV', 'MODULE'); 
      rec.JN_SESSION := SYS_CONTEXT ('USERENV', 'SESSIONID'); 
      IF INSERTING THEN 
        rec.JN_OPERATION := 'INS'; 
      ELSIF UPDATING THEN 
        rec.JN_OPERATION := 'UPD'; 
      END IF; 
    ELSIF DELETING THEN 
      rec.cedula_usuario := :OLD.cedula_usuario; 
      rec.nombre_usuario := :OLD.nombre_usuario; 
      rec.apellido_usuario := :OLD.apellido_usuario; 
      rec.celular_usuario := :OLD.celular_usuario; 
      rec.correo_usuario := :OLD.correo_usuario; 
      rec.sesion_usuario := :OLD.sesion_usuario; 
      rec.rol_usuario := :OLD.rol_usuario; 
      rec.contraseña_usuario := :OLD.contraseña_usuario; 
      rec.rc_usuario := :OLD.rc_usuario; 
      rec.JN_DATETIME := SYSDATE; 
      rec.JN_ORACLE_USER := SYS_CONTEXT ('USERENV', 'SESSION_USER'); 
      rec.JN_APPLN := SYS_CONTEXT ('USERENV', 'MODULE'); 
      rec.JN_SESSION := SYS_CONTEXT ('USERENV', 'SESSIONID'); 
      rec.JN_OPERATION := 'DEL'; 
    END IF; 
    INSERT into usuario_JN VALUES rec; 
  END; 
  /CREATE TABLE vehiculo (
    placa_vehiculo          VARCHAR2(6) NOT NULL,
    numinterno_vehiculo     NUMBER NOT NULL,
    usuario_cedula_usuario  NUMBER(12, 2) NOT NULL,
    soat_vehiculo           DATE NOT NULL,
    tecno_vehiculo          DATE NOT NULL,
    actual_vehiculo         DATE NOT NULL,
    contractual_vehiculo    DATE NOT NULL
);

ALTER TABLE vehiculo ADD CHECK ( numinterno_vehiculo BETWEEN 300 AND 700 );

CREATE UNIQUE INDEX vehiculo__idx ON
    vehiculo (
        usuario_cedula_usuario
    ASC );

ALTER TABLE vehiculo ADD CONSTRAINT vehiculo_pk PRIMARY KEY ( placa_vehiculo );


CREATE TABLE vehiculo_JN
 (JN_OPERATION CHAR(3) NOT NULL
 ,JN_ORACLE_USER VARCHAR2(30) NOT NULL
 ,JN_DATETIME DATE NOT NULL
 ,JN_NOTES VARCHAR2(240)
 ,JN_APPLN VARCHAR2(35)
 ,JN_SESSION NUMBER(38)
 ,placa_vehiculo VARCHAR2 (6) NOT NULL
 ,numInterno_vehiculo NUMBER NOT NULL
 ,usuario_cedula_usuario NUMBER (12,2) NOT NULL
 ,soat_vehiculo DATE NOT NULL
 ,tecno_vehiculo DATE NOT NULL
 ,actual_vehiculo DATE NOT NULL
 ,contractual_vehiculo DATE NOT NULL
 );

CREATE OR REPLACE TRIGGER vehiculo_JNtrg
  AFTER 
  INSERT OR 
  UPDATE OR 
  DELETE ON vehiculo for each row 
 Declare 
  rec vehiculo_JN%ROWTYPE; 
  blank vehiculo_JN%ROWTYPE; 
  BEGIN 
    rec := blank; 
    IF INSERTING OR UPDATING THEN 
      rec.placa_vehiculo := :NEW.placa_vehiculo; 
      rec.numInterno_vehiculo := :NEW.numInterno_vehiculo; 
      rec.usuario_cedula_usuario := :NEW.usuario_cedula_usuario; 
      rec.soat_vehiculo := :NEW.soat_vehiculo; 
      rec.tecno_vehiculo := :NEW.tecno_vehiculo; 
      rec.actual_vehiculo := :NEW.actual_vehiculo; 
      rec.contractual_vehiculo := :NEW.contractual_vehiculo; 
      rec.JN_DATETIME := SYSDATE; 
      rec.JN_ORACLE_USER := SYS_CONTEXT ('USERENV', 'SESSION_USER'); 
      rec.JN_APPLN := SYS_CONTEXT ('USERENV', 'MODULE'); 
      rec.JN_SESSION := SYS_CONTEXT ('USERENV', 'SESSIONID'); 
      IF INSERTING THEN 
        rec.JN_OPERATION := 'INS'; 
      ELSIF UPDATING THEN 
        rec.JN_OPERATION := 'UPD'; 
      END IF; 
    ELSIF DELETING THEN 
      rec.placa_vehiculo := :OLD.placa_vehiculo; 
      rec.numInterno_vehiculo := :OLD.numInterno_vehiculo; 
      rec.usuario_cedula_usuario := :OLD.usuario_cedula_usuario; 
      rec.soat_vehiculo := :OLD.soat_vehiculo; 
      rec.tecno_vehiculo := :OLD.tecno_vehiculo; 
      rec.actual_vehiculo := :OLD.actual_vehiculo; 
      rec.contractual_vehiculo := :OLD.contractual_vehiculo; 
      rec.JN_DATETIME := SYSDATE; 
      rec.JN_ORACLE_USER := SYS_CONTEXT ('USERENV', 'SESSION_USER'); 
      rec.JN_APPLN := SYS_CONTEXT ('USERENV', 'MODULE'); 
      rec.JN_SESSION := SYS_CONTEXT ('USERENV', 'SESSIONID'); 
      rec.JN_OPERATION := 'DEL'; 
    END IF; 
    INSERT into vehiculo_JN VALUES rec; 
  END; 
  /CREATE TABLE viaje (
    id_viaje                 NUMBER(12, 2) NOT NULL,
    fecha_viaje              DATE NOT NULL,
    recorrido_id_recorrido   NUMBER(12, 2) NOT NULL,
    vehiculo_placa_vehiculo  VARCHAR2(6) NOT NULL,
    nota_viaje               VARCHAR2(500) NOT NULL,
    jornada_viaje            VARCHAR2(200 CHAR) NOT NULL
);

ALTER TABLE viaje
    ADD CHECK ( jornada_viaje IN ( 'Mañana', 'Tarde' ) );

ALTER TABLE viaje ADD CONSTRAINT viaje_pk PRIMARY KEY ( id_viaje );


CREATE TABLE viaje_JN
 (JN_OPERATION CHAR(3) NOT NULL
 ,JN_ORACLE_USER VARCHAR2(30) NOT NULL
 ,JN_DATETIME DATE NOT NULL
 ,JN_NOTES VARCHAR2(240)
 ,JN_APPLN VARCHAR2(35)
 ,JN_SESSION NUMBER(38)
 ,id_viaje NUMBER (12,2) NOT NULL
 ,fecha_viaje DATE NOT NULL
 ,recorrido_id_recorrido NUMBER (12,2) NOT NULL
 ,vehiculo_placa_vehiculo VARCHAR2 (6) NOT NULL
 ,nota_viaje VARCHAR2 (500) NOT NULL
 ,jornada_viaje VARCHAR2 (200 CHAR) NOT NULL
 );

CREATE OR REPLACE TRIGGER viaje_JNtrg
  AFTER 
  INSERT OR 
  UPDATE OR 
  DELETE ON viaje for each row 
 Declare 
  rec viaje_JN%ROWTYPE; 
  blank viaje_JN%ROWTYPE; 
  BEGIN 
    rec := blank; 
    IF INSERTING OR UPDATING THEN 
      rec.id_viaje := :NEW.id_viaje; 
      rec.fecha_viaje := :NEW.fecha_viaje; 
      rec.recorrido_id_recorrido := :NEW.recorrido_id_recorrido; 
      rec.vehiculo_placa_vehiculo := :NEW.vehiculo_placa_vehiculo; 
      rec.nota_viaje := :NEW.nota_viaje; 
      rec.jornada_viaje := :NEW.jornada_viaje; 
      rec.JN_DATETIME := SYSDATE; 
      rec.JN_ORACLE_USER := SYS_CONTEXT ('USERENV', 'SESSION_USER'); 
      rec.JN_APPLN := SYS_CONTEXT ('USERENV', 'MODULE'); 
      rec.JN_SESSION := SYS_CONTEXT ('USERENV', 'SESSIONID'); 
      IF INSERTING THEN 
        rec.JN_OPERATION := 'INS'; 
      ELSIF UPDATING THEN 
        rec.JN_OPERATION := 'UPD'; 
      END IF; 
    ELSIF DELETING THEN 
      rec.id_viaje := :OLD.id_viaje; 
      rec.fecha_viaje := :OLD.fecha_viaje; 
      rec.recorrido_id_recorrido := :OLD.recorrido_id_recorrido; 
      rec.vehiculo_placa_vehiculo := :OLD.vehiculo_placa_vehiculo; 
      rec.nota_viaje := :OLD.nota_viaje; 
      rec.jornada_viaje := :OLD.jornada_viaje; 
      rec.JN_DATETIME := SYSDATE; 
      rec.JN_ORACLE_USER := SYS_CONTEXT ('USERENV', 'SESSION_USER'); 
      rec.JN_APPLN := SYS_CONTEXT ('USERENV', 'MODULE'); 
      rec.JN_SESSION := SYS_CONTEXT ('USERENV', 'SESSIONID'); 
      rec.JN_OPERATION := 'DEL'; 
    END IF; 
    INSERT into viaje_JN VALUES rec; 
  END; 
  /ALTER TABLE recorrido
    ADD CONSTRAINT recorrido_empresa_fk FOREIGN KEY ( empresa_nit_empresa )
        REFERENCES empresa ( nit_empresa );

ALTER TABLE tanqueada
    ADD CONSTRAINT tanqueada_vehiculo_fk FOREIGN KEY ( vehiculo_placa_vehiculo )
        REFERENCES vehiculo ( placa_vehiculo );

ALTER TABLE vehiculo
    ADD CONSTRAINT vehiculo_usuario_fk FOREIGN KEY ( usuario_cedula_usuario )
        REFERENCES usuario ( cedula_usuario );

ALTER TABLE viaje
    ADD CONSTRAINT viaje_recorrido_fk FOREIGN KEY ( recorrido_id_recorrido )
        REFERENCES recorrido ( id_recorrido );

ALTER TABLE viaje
    ADD CONSTRAINT viaje_vehiculo_fk FOREIGN KEY ( vehiculo_placa_vehiculo )
        REFERENCES vehiculo ( placa_vehiculo );



-- Informe de Resumen de Oracle SQL Developer Data Modeler: 
-- 
-- CREATE TABLE                             6
-- CREATE INDEX                             1
-- ALTER TABLE                             14
-- CREATE VIEW                              0
-- ALTER VIEW                               0
-- CREATE PACKAGE                           0
-- CREATE PACKAGE BODY                      0
-- CREATE PROCEDURE                         0
-- CREATE FUNCTION                          0
-- CREATE TRIGGER                           0
-- ALTER TRIGGER                            0
-- CREATE COLLECTION TYPE                   0
-- CREATE STRUCTURED TYPE                   0
-- CREATE STRUCTURED TYPE BODY              0
-- CREATE CLUSTER                           0
-- CREATE CONTEXT                           0
-- CREATE DATABASE                          0
-- CREATE DIMENSION                         0
-- CREATE DIRECTORY                         0
-- CREATE DISK GROUP                        0
-- CREATE ROLE                              0
-- CREATE ROLLBACK SEGMENT                  0
-- CREATE SEQUENCE                          0
-- CREATE MATERIALIZED VIEW                 0
-- CREATE MATERIALIZED VIEW LOG             0
-- CREATE SYNONYM                           0
-- CREATE TABLESPACE                        0
-- CREATE USER                              0
-- 
-- DROP TABLESPACE                          0
-- DROP DATABASE                            0
-- 
-- REDACTION POLICY                         0
-- 
-- ORDS DROP SCHEMA                         0
-- ORDS ENABLE SCHEMA                       0
-- ORDS ENABLE OBJECT                       0
-- 
-- ERRORS                                   0
-- WARNINGS                                 0
