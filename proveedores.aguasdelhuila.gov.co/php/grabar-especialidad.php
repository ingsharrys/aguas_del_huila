<?php
	require_once("../funciones.php");
	include("../dbconnection/connections.php");
	validasesion();

$conU=$cnx_local->_query("select especialidad_codigo from especialidad where especialidad_codigo='".$_POST['codigo']."'",0,1);

if($conU->_nreg==0){//Nuevo
	$conUsuarios=$cnx_local->_execute("insert into especialidad(especialidad_codigo, especialidad_nombre) values('".$_POST['codigo']."','".htmlentities($_POST['nombre'], ENT_NOQUOTES, 'UTF-8')."')");

	if($conUsuarios->_nreg==0){
		echo "0";
	}else{
		echo "1";
	}
}else{
	$conUsuarios=$cnx_local->_execute("update especialidad set especialidad_nombre='".htmlentities($_POST['nombre'], ENT_NOQUOTES, 'UTF-8')."' where especialidad_codigo='".$_POST['codigo']."'");

	if($conUsuarios->_nreg==0){
		echo "0";
	}else{
		echo "2";
	}
}

?>
