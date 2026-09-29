<?php
require_once("../funciones.php");
include("../dbconnection/connections.php");
validasesion();

$conU=$cnx_local->_query("select proceso_codigo from proceso where proceso_codigo=".$_POST['codigoproceso']."",0,1);

if($conU->_nreg==0){//Nuevo
	$nuevoID=nextID('proceso');
	$sql="insert into proceso(proceso_codigo, proceso_objeto, proceso_link_secop, proceso_valor, 
                proceso_fecha, tipo_proceso_codigo, estado_contrato_codigo, tipo_contrato_codigo) 
			values('".htmlentities($_POST['codigoproceso'], ENT_NOQUOTES, 'UTF-8')."','".htmlentities($_POST['objetoproceso'], ENT_NOQUOTES, 'UTF-8')."',
			'".htmlentities($_POST['linksecop'], ENT_NOQUOTES, 'UTF-8')."',
			'".htmlentities($_POST['valorcontrato'], ENT_NOQUOTES, 'UTF-8')."',
			'".htmlentities($_POST['fechaproceso'], ENT_NOQUOTES, 'UTF-8')."',
			'".htmlentities($_POST['tipoproceso'], ENT_NOQUOTES, 'UTF-8')."',
			'".htmlentities($_POST['estadocontrato'], ENT_NOQUOTES, 'UTF-8')."',
			'".htmlentities($_POST['tipocontrato'], ENT_NOQUOTES, 'UTF-8')."')";
	$conprocesos=$cnx_local->_execute($sql);

	if($conprocesos->_nreg==0){
		echo "0"; echo $sql;
	}else{
		echo $nuevoID;
	}
}else{
	$conprocesos=$cnx_local->_execute("update proceso set 
            proceso_codigo='".htmlentities($_POST['codigoproceso'], ENT_NOQUOTES, 'UTF-8')."',
			proceso_objeto='".htmlentities($_POST['objetoproceso'], ENT_NOQUOTES, 'UTF-8')."',
			proceso_link_secop='".htmlentities($_POST['linksecop'], ENT_NOQUOTES, 'UTF-8')."',
			proceso_valor='".htmlentities($_POST['valorcontrato'], ENT_NOQUOTES, 'UTF-8')."',
			proceso_fecha='".htmlentities($_POST['fechaproceso'], ENT_NOQUOTES, 'UTF-8')."',
			tipo_proceso_codigo='".htmlentities($_POST['tipoproceso'], ENT_NOQUOTES, 'UTF-8')."',
			estado_contrato_codigo='".htmlentities($_POST['estadocontrato'], ENT_NOQUOTES, 'UTF-8')."',  
            tipo_contrato_codigo='".htmlentities($_POST['tipocontrato'], ENT_NOQUOTES, 'UTF-8')."'
			where proceso_codigo='".$_POST['codigoproceso']."'");

	if($conprocesos->_nreg==0){
		echo "0";
	}else{
		echo "editado";
	}
}
?>