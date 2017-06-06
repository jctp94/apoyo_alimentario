<?php
// insertSendinBlue("Camilo", "skamilo9406@gmail.com");
include_once ("Login.php");
include_once('../datos/manejoLoginDAO.php');
include_once('../datos/EstudianteDAO.php');
include_once('../datos/convocatoriaDAO.php');
include_once('../datos/RegistroDAO.php');
include_once("Solicitud.php");
include_once('../datos/SolicitudDAO.php');
include_once("Soporte.php");
include_once('../datos/SoporteDAO.php');
include_once('../datos/BeneficiarioDAO.php');
include_once("../presentacion/libs/class.upload.php");
include_once("Registro.php");
if($_POST){
 if( isset($_POST['login']) ){
	  login($_POST['login']);
	}elseif (isset($_POST['cargarDatosEst'])) {
		cargarDatos();
	}elseif( isset($_POST['convocatoria']) ){
	  crearConvocatoria($_POST['convocatoria']);
	}elseif (isset($_POST['solicitud'])){
		crearSolicitud();
	}elseif (isset($_POST['registrarse'])) {
		registrarse($_POST['registrarse']);
	}elseif (isset($_POST['log'])) {
        verlog();
	}elseif (isset($_POST['cargarDatosListadoInscritos'])) {
        cargarDatosListadoInscritos();
	}elseif (isset($_POST['cargarDatosverificarSoporte'])) {
        cargarDatosverificarSoporte($_POST['cargarDatosverificarSoporte']);
	}elseif (isset($_POST['verficarSoporte'])) {
        verificarSoporte($_POST['verficarSoporte']);
	}elseif (isset($_POST['cargarDatosConvocatoria'])) {
        cargarDatosConvocatoria();
	}elseif (isset($_POST['retirarApoyo'])) {
        retirarApoyo($_POST['retirarApoyo']);
	}elseif (isset($_POST['cargarListaCodigos'])) {
        cargarListaCodigos();
	}


	elseif (isset($_POST['salir'])) {
        session_start();
        session_destroy();
    }elseif( isset($_POST['dia']) ){
	  adjuntarDias($_POST['dia']);
	}
}
function adjuntarDias($dias)
{
    $sol=new SolicitudDAO();
	$rta=$sol->registrarDias($dias);
    echo $rta["mensaje"];
}
if($_FILES){
	$docs = array("doc11","doc12","doc13", "doc14", "doc21","doc22","doc23","doc24","doc31","doc32","doc33","doc34","doc41","doc42");
    $sol=new SolicitudDAO();
	$rta=$sol->registrarSolicitud($docs);
	echo $rta["mensaje"];

}

//bienvenidoSendinBlue("Nombre", "correo");
//ESTE ES PARA BIENVENIDO
function bienvenidoSendinBlue($nombre, $email){
    require('../datos/mailin.php');
    $mailin = new Mailin("https://api.sendinblue.com/v2.0","SYz3MEcnpqsN2hA8");
    $data = array( "email" => "".$email."",
        "attributes" => array(
            "NOMBRE"=>"".$nombre.""),
        "listid" => array(50)
    );
    echo json_encode($mailin->create_update_user($data));
}

//beneficiarioSendinBlue("Nombre", "correo");
//ESTE ES PARA BENEFICIARIOS
function beneficiarioSendinBlue($nombre, $email){
    require('../datos/mailin.php');
    $mailin = new Mailin("https://api.sendinblue.com/v2.0","SYz3MEcnpqsN2hA8");
    $data = array( "email" => "".$email."",
        "attributes" => array(
            "NOMBRE"=>"".$nombre.""),
        "listid" => array(51)
    );
    echo json_encode($mailin->create_update_user($data));
}

function verlog(){
  session_start();
  if (!$_SESSION['usuario']){
    echo "no";
  }else {
    echo "si";
  }
}
function registrarse($credenciales){
	$registro = new Registro($credenciales['codigo'],$credenciales['pswd'],"estudiante");
	$registroDAO = new registroDAO();
	$rta=$registroDAO->registrarse($registro);
	if ($rta["estado"]=="creado") {
		$reg=(array) $rta["registro"];
		echo json_encode($reg);
	}else {
		echo $rta["mensaje"];
	}
}

function cargarDatos(){
	$EstudianteDAO = new EstudianteDAO();
	$rta=$EstudianteDAO->consultarEstudiante();
	if ($rta["estado"]) {
		$array=(array) $rta["estudiante"];
		echo json_encode($array);
	}else {
		echo $rta["mensaje"];
	}
}

function cargarDatosListadoInscritos(){
	$EstudianteDAO = new EstudianteDAO();
	$rta=$EstudianteDAO->listarEstudiantesPendientes();
	if ($rta["estado"]) {
		$array=(array) $rta["estudiantes"];
		echo json_encode($array);			
	}else {
		echo $rta["mensaje"];
	}
	
}

function cargarDatosverificarSoporte($codigo){	
	$SoporteDAO = new SoporteDAO();
	$rta=$SoporteDAO->consultarSoportes($codigo);
	if ($rta["estado"]) {
		$prueba=(array) $rta["soporte"];
		echo json_encode($prueba);			
	}else {
		echo $rta["mensaje"];
	}
}

function verificarSoporte($datos){
	$SolicitudDAO = new SolicitudDAO();
	$rta=$SolicitudDAO->actualizarSolicitudRevisada($datos);
	if ($rta["mensaje"]=="bien") {
		//soportes actualizarlos
		$SoporteDAO = new SoporteDAO();
		$rta=$SoporteDAO->actualizarSoporteRevisado($datos);
		echo $rta["mensaje"];			
	}else{
		echo $rta["mensaje"];	
	}	
}

function cargarDatosConvocatoria(){	
	$ConvocatoriaDAO = new ConvocatoriaDAO();
	$rta=$ConvocatoriaDAO->consultarConvocatoriaActiva();
	if ($rta["estado"]) {
		$array=(array) $rta["convocatoria"];
		echo json_encode($array);			
	}else {
		echo $rta["mensaje"];
	}
}

function cargarListaCodigos(){	
	$EstudianteDAO = new EstudianteDAO();
	$rta=$EstudianteDAO->listarCodigos();
	if ($rta["estado"]) {
		$array=(array) $rta["codigos"];
		echo json_encode($array);			
	}else {
		echo $rta["mensaje"];
	}
}



function retirarApoyo($codigo){	
	//cambio de estado
	$BeneficiarioDAO = new BeneficiarioDAO();
	$rta=$BeneficiarioDAO->retirarApoyo($codigo);
	echo $rta["mensaje"];
	
}



function login($credenciales){
 /* parecido a recursos humanos*/
 		$log= new Login($credenciales["usuario"],$credenciales["pswd"]);
		$manejoLoginDAO= new manejoLoginDAO();
		$rta=$manejoLoginDAO->mostrarInterfaz($log);
		if ($rta["estado"]) {
			session_start();
       $_SESSION['usuario'] = $credenciales["usuario"];
			 $_SESSION['pswd']=$credenciales["pswd"];
			 $_SESSION['rol']=$rta["login"]->getRol();
			if ($rta["login"]->getRol()=="estudiante") {
				echo "estudiante";
			}elseif ($rta["login"]->getRol()=="adminapoyo") {
				echo "adminapoyo";
			}
			else {
				echo "aotro";
			}
		}else {
			echo $rta["mensaje"];
		}
}


function crearConvocatoria($convocatoria){
	$cupoTotal=$convocatoria["cuposTipoA"]+$convocatoria["cuposTipoB"]+$convocatoria["cuposTotal"];
	$convoca= new Convocatoria(
		$convocatoria["F_INICONV"],
		$convocatoria["F_FINCONV"],
		$convocatoria["V_COSTOALMUERZO"],
		$cupoTotal,
		"A",
		"00000008"
		);

	$convocatoriaDAO= new convocatoriaDAO();
	$rta=$convocatoriaDAO->insertarConvocatoria($convoca, $convocatoria["cuposTipoA"], $convocatoria["cuposTipoB"], $convocatoria["cuposTotal"]);
	echo $rta["mensaje"];
}
