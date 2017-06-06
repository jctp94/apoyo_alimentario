/* Trigger que audita los procedimientos de inserción en la tabla solicitud*/
CREATE OR REPLACE TRIGGER TG_SOLICITUD_INSERT_AUDITORIA
BEFORE INSERT ON SOLICITUD
FOR EACH ROW
BEGIN
    INSERT INTO auditoria VALUES (
    incremento_k_auditoria.nextval,
    'I',
    'Inserción en solicitud',
    (SELECT USER FROM DUAL),
    SYSDATE,
    NULL,
    :NEW.I_ESTADOSOL
    );
END TG_SOLICITUD_INSERT_AUDITORIA;
/
SHOW ERRORS;
