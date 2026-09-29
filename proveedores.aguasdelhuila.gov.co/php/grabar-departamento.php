<?php
	require_once("../funciones.php");
	include("../dbconnection/connections.php");
	validasesion();

$conU=$cnx_local->_query("select departamento_codigo from departamento where departamento_codigo='".$_POST['codigo']."'",0,1);

if($conU->_nreg==0){//Nuevo
	$conUsuarios=$cnx_local->_execute("insert into departamento(departamento_codigo, departamento_nombre) values('".$_POST['codigo']."','".htmlentities($_POST['nombre'], ENT_NOQUOTES, 'UTF-8')."')");

	if($conUsuarios->_nreg==0){
		echo "0";
	}else{
		echo "1";
	}
}else{
	$conUsuarios=$cnx_local->_execute("update departamento set departamento_nombre='".htmlentities($_POST['nombre'], ENT_NOQUOTES, 'UTF-8')."' where departamento_codigo='".$_POST['codigo']."'");

	if($conUsuarios->_nreg==0){
		echo "0";
	}else{
		echo "2";
	}
}

?>
