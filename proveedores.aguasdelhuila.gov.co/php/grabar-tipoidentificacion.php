<?php
	require_once("../funciones.php");
	include("../dbconnection/connections.php");
	validasesion();

$conU=$cnx_local->_query("select tipo_identificacion_codigo from tipo_identificacion where tipo_identificacion_codigo='".$_POST['codigo']."'",0,1);

if($conU->_nreg==0){//Nuevo
	$conUsuarios=$cnx_local->_execute("insert into tipo_identificacion(tipo_identificacion_codigo, tipo_identificacion_nombre) values('".$_POST['codigo']."','".htmlentities($_POST['nombre'], ENT_NOQUOTES, 'UTF-8')."')");

	if($conUsuarios->_nreg==0){
		echo "0";
	}else{
		echo "1";
	}
}else{
	$conUsuarios=$cnx_local->_execute("update tipo_identificacion set tipo_identificacion_nombre='".htmlentities($_POST['nombre'], ENT_NOQUOTES, 'UTF-8')."' where tipo_identificacion_codigo='".$_POST['codigo']."'");

	if($conUsuarios->_nreg==0){
		echo "0";
	}else{
		echo "2";
	}
}

?>
