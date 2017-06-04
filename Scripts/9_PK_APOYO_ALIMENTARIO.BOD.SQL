-- No debe existir ningún soporte en estado pendiente
CREATE OR REPLACE PACKAGE BODY PK_APOYO_ALIMENTARIO

AS
    PROCEDURE PR_ASIGNAR_BENEFICIO(pc_error OUT NUMBER, pm_error OUT VARCHAR2)
    AS
    BEGIN
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
    END PR_CALCULAR_PUNTAJES;

END PK_APOYO_ALIMENTARIO;
/
SHOW ERRORS;
