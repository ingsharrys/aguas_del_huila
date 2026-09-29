<?php
	require_once("../funciones.php");
	include("../dbconnection/connections.php");
	validasesion();

$conU=$cnx_local->_query("select ciudad_codigo from ciudad where ciudad_codigo=".$_POST['codigo']."",0,1);

if($conU->_nreg==0){//Nuevo
	$conUsuarios=$cnx_local->_execute("insert into ciudad(ciudad_codigo, ciudad_nombre, departamento_codigo) values(".$_POST['codigo'].",'".htmlentities($_POST['nombre'], ENT_NOQUOTES, 'UTF-8')."',".$_POST['departamento'].")");

	if($conUsuarios->_nreg==0){
		echo "0";
	}else{
		echo "1";
	}
}else{
	$conUsuarios=$cnx_local->_execute("update ciudad set ciudad_nombre='".htmlentities($_POST['nombre'], ENT_NOQUOTES, 'UTF-8')."', departamento_codigo=".$_POST['departamento']." where ciudad_codigo=".$_POST['codigo']."");

	if($conUsuarios->_nreg==0){
		echo "0";
	}else{
		echo "2";
	}
}

?>
