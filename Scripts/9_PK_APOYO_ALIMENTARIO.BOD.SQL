CREATE OR REPLACE PACKAGE BODY PK_APOYO_ALIMENTARIO
/*------------------------------------------------------------------------------
Funci�n para insertar registros en por cada dia seleccionado en la solicitud a
los seleccionados como beneficiarios del apoyo alimentario
Parametros de Entrada: pk_idsol           id de la solicitud para traer los dias ingresados
cuando se diligenció

Parametros de Salida: pc_error         0 si existe error
                      pm_error         Mensaje de error
Retorna : Booleano true en caso de que toda la función haya terminado exitosamente*/

AS
    FUNCTION FU_INSERTAR_BENEFICIARIO_DIA(pk_idsol solicitud_dia.k_idsol%TYPE,
                                pk_id_benef beneficiario_dia.k_id_benef%TYPE,
                                pc_error OUT NUMBER,
                                pm_error OUT VARCHAR2) RETURN  BOOLEAN
        AS
          CURSOR c_solicitud_dia IS
          SELECT *
          FROM Solicitud_Dia
          WHERE k_idsol=pk_idsol;
        BEGIN
            FOR r_solicitud_dia IN c_solicitud_dia LOOP
                INSERT INTO beneficiario_dia VALUES (incremento_k_idbenefdia.nextval,
                                                    pk_id_benef,r_solicitud_dia.k_iddia);
            END LOOP;
            RETURN TRUE;
        EXCEPTION
            WHEN INVALID_CURSOR THEN
                pm_error:='Cursor invalido: '||SQLCODE;
                pc_error:=0;
                RETURN FALSE;
            WHEN OTHERS THEN
                pm_error:='Otro: '||SQLCODE;
                pc_error:=0;
                RETURN FALSE;
    END FU_INSERTAR_BENEFICIARIO_DIA;
    /*------------------------------------------------------------------------------
    Funci�n para para traer la cantidad de cupos de un determinado tipo de subsido del apoyo alimentario
    Parametros de Entrada: pi_tiposubcupos        indice del tipo de subsidio: T:total, A:tipo A, B:Tipo b

    Parametros de Salida: pc_error         0 si existe error
                          pm_error         Mensaje de error
                         */

    FUNCTION FU_CANTIDAD_CUPOS(pi_tiposubcupos cuposconvocatoria.i_tiposubcupos%TYPE,
                                pc_error OUT NUMBER,
                                pm_error OUT VARCHAR2) RETURN  cuposconvocatoria.q_cantcuposconv%TYPE
        AS
            lq_cantcuposconv cuposconvocatoria.q_cantcuposconv%TYPE;
        BEGIN
            SELECT cc.q_cantcuposconv INTO lq_cantcuposconv
            FROM cuposconvocatoria cc, convocatoria c
            where i_tiposubcupos=pi_tiposubcupos AND c.k_idconv=cc.k_idconv AND c.i_estadoconv='A';
            RETURN lq_cantcuposconv;
        EXCEPTION
            WHEN NO_DATA_FOUND THEN
                pm_error:='Ninguna columna seleccionada: '||SQLCODE;
                pc_error:=0;
                RETURN NULL;
            WHEN OTHERS THEN
                pm_error:='Otro: '||SQLCODE;
                pc_error:=0;
                RETURN NULL;
    END FU_CANTIDAD_CUPOS;

    /*------------------------------------------------------------------------------
    Procedimiento basa para asginar de manera masiva beneficio de apoyo alimentario de
    acuerdo a la cantidad de cupos definidos en la convocatoria para el apo alimentario
    Precondiciones: Haber ejecutado el procedimiento PR_CALCULAR_PUNTAJES
    Parametros de Salida: pc_error        = 1 si no existe,
                                            0, en caso contrario
                          pm_error         Mensaje de error si hay error o null en caso contrario
                         */


    PROCEDURE PR_ASIGNAR_BENEFICIO(pc_error OUT NUMBER, pm_error OUT VARCHAR2)
    AS
        CURSOR c_solicitud IS
        SELECT *
        FROM solicitud ORDER BY q_tpuntajesol;

        CURSOR c_solicitud_dia(pk_idsol solicitud_dia.k_idsol%TYPE) IS
        SELECT k_iddia
        FROM Solicitud_Dia
        WHERE k_idsol=pk_idsol;
        errorCuposSubTot EXCEPTION;
        errorCuposSubA EXCEPTION;
        errorCuposSubB EXCEPTION;
        errorBeneficiarioDiaSubTot EXCEPTION;
        errorBeneficiarioDiaSubA EXCEPTION;
        errorBeneficiarioDiaSubB EXCEPTION;
        lk_iddia Solicitud_Dia.k_iddia%TYPE;
        lq_cuposT cuposconvocatoria.q_cantcuposconv%TYPE;
        lq_cuposA cuposconvocatoria.q_cantcuposconv%TYPE;
        lq_cuposB cuposconvocatoria.q_cantcuposconv%TYPE;
        i NUMBER(5):=1;
        lk_id_benef NUMBER(8):=0;
        li_inserbenfdia BOOLEAN:=FALSE;
    BEGIN
        pc_error:=1;
        pm_error:=NULL;
        lq_cuposT:=FU_CANTIDAD_CUPOS('T',pc_error,pm_error);
        IF pc_error!=1 THEN
            RAISE errorCuposSubTot;
        END IF;
        lq_cuposA:=FU_CANTIDAD_CUPOS('A',pc_error,pm_error);
        IF pc_error!=1 THEN
            RAISE errorCuposSubA;
        END IF;
        lq_cuposB:=FU_CANTIDAD_CUPOS('B',pc_error,pm_error);
        IF pc_error!=1 THEN
            RAISE errorCuposSubB;
        END IF;
        FOR r_solicitud IN c_solicitud LOOP
            SELECT incremento_k_id_benef.nextval INTO lk_id_benef FROM DUAL;
            IF i<=lq_cuposT THEN
                INSERT INTO beneficiario VALUES (lk_id_benef, r_solicitud.k_idsol, 'A',1);
                li_inserbenfdia:=FU_INSERTAR_BENEFICIARIO_DIA(r_solicitud.k_idsol,lk_id_benef,pc_error,pm_error);
                IF pc_error!=1 THEN
                    RAISE errorBeneficiarioDiaSubTot;
                END IF;
                UPDATE solicitud SET i_estadosol='A' WHERE k_idsol=r_solicitud.k_idsol;
                -- insertar en beneficiario_dia
                -- cambiar estado en solicitud
            ELSIF i<=lq_cuposA+lq_cuposT THEN
                INSERT INTO beneficiario VALUES (lk_id_benef, r_solicitud.k_idsol, 'A',2);
                li_inserbenfdia:=FU_INSERTAR_BENEFICIARIO_DIA(r_solicitud.k_idsol,lk_id_benef,pc_error,pm_error);
                IF pc_error!=1 THEN
                    RAISE errorBeneficiarioDiaSubA;
                END IF;
                UPDATE solicitud SET i_estadosol='A' WHERE k_idsol=r_solicitud.k_idsol;
            ELSIF i<=lq_cuposB+lq_cuposA+lq_cuposT THEN
                INSERT INTO beneficiario VALUES (lk_id_benef, r_solicitud.k_idsol, 'A',3);
                li_inserbenfdia:=FU_INSERTAR_BENEFICIARIO_DIA(r_solicitud.k_idsol,lk_id_benef,pc_error,pm_error);
                IF pc_error!=1 THEN
                    RAISE errorBeneficiarioDiaSubB;
                END IF;
                UPDATE solicitud SET i_estadosol='A' WHERE k_idsol=r_solicitud.k_idsol;
            ELSE
                UPDATE solicitud SET i_estadosol='R' WHERE k_idsol=r_solicitud.k_idsol;
                --solo actualizar estado a rechazada
            END IF;
        END LOOP;
        --commit;
    EXCEPTION
        WHEN errorBeneficiarioDiaSubTot THEN
            RAISE_APPLICATION_ERROR(-20004,'INSERTAR_BENEFICIARIO_DIA'||pm_error);
            rollback;
        WHEN errorBeneficiarioDiaSubA THEN
            RAISE_APPLICATION_ERROR(-20005,'INSERTAR_BENEFICIARIO_DIA'||pm_error);
            rollback;
        WHEN errorBeneficiarioDiaSubB THEN
            RAISE_APPLICATION_ERROR(-20005,'INSERTAR_BENEFICIARIO_DIA'||pm_error);
            rollback;
        WHEN errorCuposSubTot THEN
            RAISE_APPLICATION_ERROR(-20001,'CantidadcuposT'||pm_error);
            rollback;
        WHEN errorCuposSubA THEN
            RAISE_APPLICATION_ERROR(-20002,'CantidadcuposA'||pm_error);
            rollback;
        WHEN errorCuposSubB THEN
            RAISE_APPLICATION_ERROR(-20003,'CantidadcuposB'||pm_error);
            rollback;
        WHEN OTHERS THEN
            pc_error:=0;
            pm_error:=SQLERRM;
            rollback;
    END PR_ASIGNAR_BENEFICIO;
    /*------------------------------------------------------------------------------
    Procedimiento para calcular puntaje total de cada solicitud con base en el puntaje de cada soporte
    aprobado
    Precondiciones: No debe existir ningún soporte en estado pendiente
                    Las solicitudes deben estar en estado rechazada o aprobada sin beneficio
    Parametros de Salida: pc_error        = 1 si no existe,
                                            0, en caso contrario
                          pm_error         Mensaje de error si hay error o null en caso contrario
                         */
	PROCEDURE PR_CALCULAR_PUNTAJES(pc_error OUT NUMBER, pm_error OUT VARCHAR2)
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
        --COMMIT;
    EXCEPTION
        WHEN INVALID_CURSOR THEN
            pm_error:='Cursor invalido: '||SQLCODE;
            pc_error:=0;
            rollback;
        WHEN OTHERS THEN
            pm_error:='Otros: '||SQLCODE;
            pc_error:=0;
            ROLLBACK;
    END PR_CALCULAR_PUNTAJES;

END PK_APOYO_ALIMENTARIO;
/
SHOW ERRORS;
