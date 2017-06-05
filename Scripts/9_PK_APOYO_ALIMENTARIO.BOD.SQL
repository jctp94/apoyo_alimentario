-- No debe existir ningún soporte en estado pendiente
CREATE OR REPLACE PACKAGE BODY PK_APOYO_ALIMENTARIO

AS
    PROCEDURE PR_ASIGNAR_BENEFICIO(pc_error OUT NUMBER, pm_error OUT VARCHAR2)
    AS
        CURSOR c_solicitud IS
        SELECT *
        FROM solicitud ORDER BY q_tpuntajesol;
        lq_cuposT cuposconvocatoria.q_cantidadcuposconv%TYPE;
        lq_cuposA cuposconvocatoria.q_cantidadcuposconv%TYPE;
        lq_cuposB cuposconvocatoria.q_cantidadcuposconv%TYPE;
        i NUMBER(5):=1;
    BEGIN
        /**
         TODO hacer función
         */
        SELECT q_cantidadcuposconv INTO lq_cuposT
        FROM cuposconvocatoria
        where i_tiposubcupos='T';
        SELECT q_cantidadcuposconv INTO lq_cuposA
        FROM cuposconvocatoria
        where i_tiposubcupos='A';
        SELECT q_cantidadcuposconv INTO lq_cuposB
        FROM cuposconvocatoria
        where i_tiposubcupos='B';

        FOR r_solicitud IN c_solicitud LOOP
            IF i<=lq_cuposT THEN

            END IF;
        END LOOP;
    END PR_ASIGNAR_BENEFICIO;

	PROCEDURE PR_CALCULAR_PUNTAJES(pc_error OUT NUMBER, pm_error OUT VARCHAR2);
    AS
        CURSOR c_solicitud IS
		SELECT *
		FROM solicitud;
    BEGIN
        FOR r_solicitud IN c_solicitud LOOP
            UPDATE solicitud
            SET q_tpuntajesol=(SELECT SUM(q_puntajesop)
                               FROM soporte
                               WHERE k_idsol=r_solicitud.k_idsol AND i_estadosop='A')
            WHERE k_idsol=r_solicitud.k_idsol;
        END LOOP;
        COMMIT;
    EXCEPTION
        WHEN OTHERS THEN
            ROLLBACK;
        -- TODO
    END PR_CALCULAR_PUNTAJES;

END PK_APOYO_ALIMENTARIO;
/
SHOW ERRORS;
