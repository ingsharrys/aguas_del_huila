<?php
	require_once("../funciones.php");
	include("../dbconnection/connections.php");
	validasesion();

$con=$cnx_local->_query("select ciudad_codigo from ciudad where ciudad_codigo=".$_POST['codigo']."",0,1);

if($con->_nreg==1){//Nuevo
	$consulta=$cnx_local->_execute("delete from ciudad where ciudad_codigo=".$_POST['codigo']."");

	if($consulta->_nreg==1){
		echo "El registro ha sido eliminado";
	}else{
		echo "El registro no pudo ser eliminado";
	}
}else{
	echo "Registro no existe";
}

?>
