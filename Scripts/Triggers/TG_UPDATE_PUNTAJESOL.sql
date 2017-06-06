/* Trigger que audita los procedimientos de inserción en la tabla solicitud*/
CREATE OR REPLACE TRIGGER TG_UPDATE_PUNTAJESOL
BEFORE UPDATE OF I_ESTADOSOL ON SOLICITUD
FOR EACH ROW
BEGIN
    INSERT INTO auditoria VALUES (
    incremento_k_auditoria.nextval,
    'I',
    'Update en solicitud Q_TPUNTAJESOL',
    (SELECT USER FROM DUAL),
    SYSDATE,
    :OLD.Q_TPUNTAJESOL,
    :NEW.Q_TPUNTAJESOL
    );
END TG_UPDATE_PUNTAJESOL;
/
SHOW ERRORS;
