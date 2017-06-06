/* Trigger que audita los procedimientos de inserción en la tabla solicitud*/
CREATE OR REPLACE TRIGGER TG_UPDATE_ESTADOSOL
BEFORE UPDATE OF I_ESTADOSOL ON SOLICITUD
FOR EACH ROW
BEGIN
    INSERT INTO auditoria VALUES (
    incremento_k_auditoria.nextval,
    'I',
    'Update en solicitud I_ESTADOSOL',
    (SELECT USER FROM DUAL),
    SYSDATE,
    :OLD.I_ESTADOSOL,
    :NEW.I_ESTADOSOL
    );
END TG_UPDATE_ESTADOSOL;
/
SHOW ERRORS;
