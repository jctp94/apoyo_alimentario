CREATE OR REPLACE PACKAGE PK_APOYO_ALIMENTARIO
AS
	FUNCTION FU_INSERTAR_BENEFICIARIO_DIA(pk_idsol solicitud_dia.k_idsol%TYPE,
                                pk_id_benef beneficiario_dia.k_id_benef%TYPE,
                                pc_error OUT NUMBER,
                                pm_error OUT VARCHAR2) RETURN  BOOLEAN;
	FUNCTION FU_CANTIDAD_CUPOS(pi_tiposubcupos cuposconvocatoria.i_tiposubcupos%TYPE,
                                pc_error OUT NUMBER,
                                pm_error OUT VARCHAR2) RETURN  cuposconvocatoria.q_cantcuposconv%TYPE;
	PROCEDURE PR_ASIGNAR_BENEFICIO(pc_error OUT NUMBER, pm_error OUT VARCHAR2);
	PROCEDURE PR_CALCULAR_PUNTAJES(pc_error OUT NUMBER, pm_error OUT VARCHAR2);
END PK_APOYO_ALIMENTARIO;
/
SHOW ERRORS;
