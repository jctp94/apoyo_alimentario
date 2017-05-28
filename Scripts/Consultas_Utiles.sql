select table_name from user_tables;
select table_name from all_tables where owner='ADMINISTRADOR_DB';


connec system/12345;
drop tablespace ts_apoyoalimentario_def including contents;
drop user ADMINISTRADOR_DB; --drop user ADMINISTRADOR_DB CASCADE
--borrar el archivo de la carpeta
@ /home/skamilo11/Dropbox/semestre12/BasesDeDatos2/Taller1_CasoDeEstudio_ApoyoAlimentario/Scripts/0_tablespace.sql
CREATE USER ADMINISTRADOR_DB IDENTIFIED BY ADMINISTRADOR_DB DEFAULT TABLESPACE ts_apoyoalimentario_def QUOTA 50M ON ts_apoyoalimentario_def;
GRANT CONNECT, ADMINISTRADOR_DBA TO ADMINISTRADOR_DB;
GRANT CREATE ANY SEQUENCE TO ADMINISTRADOR_DBA;
connect administrador_db/ADMINISTRADOR_DB
@ /home/skamilo11/Dropbox/semestre12/BasesDeDatos2/Taller1_CasoDeEstudio_ApoyoAlimentario/ModeloYScript/Script_ModeloApoyoCorregido.sql


C:/Users/skamilo11/Dropbox/semestre12/BasesDeDatos2/Taller1_CasoDeEstudio_ApoyoAlimentario/Scripts/0_tablespace.sql

--ROLES DE UN USUARIO
select username, granted_role
   from user_role_privs;

--Usuarios de la base de datos
SELECT USERNAME FROM DBA_USERS;
