-- BLOQUE ANÓNIMO
SET SERVEROUTPUT ON;
SET VERIFY OFF;
DECLARE
    CURSOR c_beneficiario IS
    SELECT *
    FROM beneficiario;
    lk_codest estudiante.k_codest%TYPE;
    ln_nomest estudiante.n_nomest%TYPE;
BEGIN
    as_pdf_mini.init;
    as_pdf_mini.write('
 ');
    as_pdf_mini.write('Codigo'||'          '||'Nombre');
    as_pdf_mini.write('
 ');
 as_pdf_mini.write('
 ');
    FOR r_beneficiario IN c_beneficiario LOOP
    SELECT S.K_CODEST, E.N_NOMEST INTO lk_codest,ln_nomest
    FROM SOLICITUD S,ESTUDIANTE E
    WHERE r_beneficiario.K_IDSOL=S.K_IDSOL AND S.K_CODEST=E.K_CODEST;
        as_pdf_mini.write(lk_codest||'          '||ln_nomest);
        as_pdf_mini.write('
 ');
    END LOOP;

    --P_DIR directorio donde se almacenara el archivos,P_FILENAME nombre del archivo
    as_pdf_mini.save_pdf(p_dir=>'PDF',p_filename=>'Ejemplo1PDF.pdf');

EXCEPTION
 	WHEN OTHERS THEN
			DBMS_OUTPUT.PUT_LINE(SQLCODE||'--------'||SQLERRM);
END;
/
