<?php
	require_once("../funciones.php");
	include("../dbconnection/connections.php");
	validasesion();

$conU=$cnx_local->_query("select ocupacion_codigo from ocupacion where ocupacion_codigo='".$_POST['codigo']."'",0,1);

if($conU->_nreg==0){//Nuevo
	$conUsuarios=$cnx_local->_execute("insert into ocupacion(ocupacion_codigo, ocupacion_nombre) values('".$_POST['codigo']."','".htmlentities($_POST['nombre'], ENT_NOQUOTES, 'UTF-8')."')");

	if($conUsuarios->_nreg==0){
		echo "0";
	}else{
		echo "1";
	}
}else{
	$conUsuarios=$cnx_local->_execute("update ocupacion set ocupacion_nombre='".htmlentities($_POST['nombre'], ENT_NOQUOTES, 'UTF-8')."' where ocupacion_codigo='".$_POST['codigo']."'");

	if($conUsuarios->_nreg==0){
		echo "0";
	}else{
		echo "2";
	}
}

?>
