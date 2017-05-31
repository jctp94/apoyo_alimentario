-- Inserciones en Convocatoria
-- Cambiar columna
-- *subconsulta para hacer el autonumérico
-- *subconsulta para insertar el usuario qu está en la sesión
INSERT INTO CONVOCATORIA VALUES (incremento_id_convocatoria.nextval, TO_DATE('2017-07-02','YYYY-MM-DD'), TO_DATE(SYSDATE,'YYYY-MM-DD'), TO_DATE(SYSDATE,'YYYY-MM-DD'), 2500, 1500, 'A', (SELECT LTRIM(USER, 'U') FROM DUAL), 00000016, 00000008);


--Inserciones en CuposConvocatoria
INSERT INTO CUPOSCONVOCATORIA VALUES (incremento_id_cuposconv.nextval, 'A', 300, 1);
INSERT INTO CUPOSCONVOCATORIA VALUES (incremento_id_cuposconv.nextval, 'B', 200, 1);
INSERT INTO CUPOSCONVOCATORIA VALUES (incremento_id_cuposconv.nextval, 'T', 800, 2);
INSERT INTO CUPOSCONVOCATORIA VALUES (incremento_id_cuposconv.nextval, 'A', 400, 2);
INSERT INTO CUPOSCONVOCATORIA VALUES (incremento_id_cuposconv.nextval, 'B', 300, 2);


-- Inserciones en solicitud
-- Cambiar columna
-- Genérico (con el usuario logueado):
INSERT INTO SOLICITUD VALUES (incremento_id_solicitud.nextval, 'P', NULL, NULL, (SELECT LTRIM(USER, 'U') FROM DUAL), 2);
-- EspEcífico:
INSERT INTO SOLICITUD VALUES (incremento_id_solicitud.nextval, 'R', 5, 'El estudiante tiene documentacion incompleta', (SELECT LTRIM(USER, 'U') FROM DUAL), 1);
INSERT INTO SOLICITUD VALUES (incremento_id_solicitud.nextval, 'A', 85, NULL, 20112020018, 1);
INSERT INTO SOLICITUD VALUES (incremento_id_solicitud.nextval, 'P', NULL, NULL, 20121020099, 2);
INSERT INTO SOLICITUD VALUES (incremento_id_solicitud.nextval, 'P', NULL, NULL, 20112020048, 2);
INSERT INTO SOLICITUD VALUES (incremento_id_solicitud.nextval, 'P', NULL, NULL, 20112020018, 2);


-- Inserciones en soporte
-- Campo en NULL: Dirección en disco del documento soporte
-- Porque hay algunas condiciones que no requieren documento soporte, como las condiciones familiares
-- Entonces modificar esa columna para que permita valores nulos así:

-- Luego sí las inserciones
INSERT INTO SOPORTE VALUES (incremento_id_soporte.nextval, NULL, 'Sostiene el hogar en el que vive', 'A', 10, 1, 21);
INSERT INTO SOPORTE VALUES (incremento_id_soporte.nextval, NULL, 'Vive en casa del empleador', 'A', 5, 1, 31);
INSERT INTO SOPORTE VALUES (incremento_id_soporte.nextval, NULL, 'Se encuentra en condición de desplazamiento forzado', 'A', 5, 1, 32);
INSERT INTO SOPORTE VALUES (incremento_id_soporte.nextval, NULL, 'Presenta algun tipo de discapacidad fisica o mental', 'A', 5, 1, 41);
INSERT INTO SOPORTE VALUES (incremento_id_soporte.nextval, NULL, '820857', 'P', 0, 4, NULL);
INSERT INTO SOPORTE VALUES (incremento_id_soporte.nextval, NULL, 'N/A', 'P', 0, 4, NULL);
INSERT INTO SOPORTE VALUES (incremento_id_soporte.nextval, NULL, 'N/A', 'P', 0, 4, NULL);
INSERT INTO SOPORTE VALUES (incremento_id_soporte.nextval, NULL, 'N/A', 'P', 0, 4, NULL);


-- Consulta para traer toda la información de las tablas
SELECT * FROM ESTUDIANTE WHERE K_CODEST=20121020099;
-- Dejé esta consulta por si no necesita seleccionar todos lo campos.
SELECT K_CODEST CODIGO, N_NOMEST NOMBRE, N_PROYECTOEST PROYECTO, N_DIREST DIRECCION, N_CORREOEST CORREO, N_FACEST FACULTAD, I_ESTADOEST ESTADO, V_PROMEST PROMEDIO, Q_ASIGPERDEST ASIGNATURAS_PERDIDAS  FROM ESTUDIANTE WHERE K_CODEST=20121020099;


-- Desde administrador_db crear un sinónimo a la tabla admistrador_db.estudiante
-- Sinónimo: estudiante
-- Si no se puede crear desde administrador_db, entonces desde system
