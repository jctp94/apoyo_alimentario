Connect administrador_db/ADMINISTRADOR_DB
begin
	EXECUTE IMMEDIATE 'DROP TABLE Auditoria CASCADE CONSTRAINTS';
	EXCEPTION WHEN OTHERS THEN NULL;
end;
/
CREATE TABLE Auditoria
(
	K_AUDITORIA VARCHAR2(11) NOT NULL,     -- Llave primaria
    I_ACCIONAUDI CHAR(1) NOT NULL,         -- Acción realizada que puede ser: I (insert), U (update), D (delete)
	N_DESCAUDI VARCHAR2(50) NOT NULL,      -- Descripción de la acción realizada
	N_RESPAUDI VARCHAR2(50) NOT NULL,      -- Responsable de la acción realizada
    F_AUDI DATE NOT NULL,                  -- Fecha del sistema en el momento en el que se realizó la acción
    N_VALORANTERIOR VARCHAR2(50), -- Valor antes de modificar
    N_VALORNUEVO VARCHAR2(50) NOT NULL     -- Valor modificado
)
;

COMMENT ON TABLE Auditoria IS 'Esta tabla corresponde al control sobre el cambio en la informacion de la Base de Datos.'
;

ALTER TABLE Auditoria
 ADD CONSTRAINT PK_AUDITORIA
	PRIMARY KEY (K_AUDITORIA)
 USING INDEX
;

ALTER TABLE  Auditoria
 ADD CONSTRAINT CK_I_ACCIONAUDI CHECK (I_ACCIONAUDI in ('I', 'U', 'D'))
;
