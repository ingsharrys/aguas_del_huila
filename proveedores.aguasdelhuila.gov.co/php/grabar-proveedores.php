<?php
require_once("../funciones.php");
include("../dbconnection/connections.php");
validasesion();

$conU=$cnx_local->_query("select proponente_id from proponente where proponente_id=".$_POST['codigo']."",0,1);

if($conU->_nreg==0){//Nuevo
	$nuevoID=nextID('proponente');
	$sql="insert into proponente(proponente_id, estado_codigo, tipo_identificacion_codigo, proponente_razonsocial, 
				proponente_nit, proponente_representante, actividad_codigo, municipio_id, 
				proponente_direccion, proponente_telefono1, proponente_telefono2, proponente_correo,
				proponente_actividadinicio, proponente_fechacreacion, proponente_fechamodificacion,
				usuario_id, proponente_usuarioaprobo, proponente_observacion, proponente_sitioweb) 
			values('".$nuevoID."', 1, '".htmlentities($_POST['tipoidentificacion'], ENT_NOQUOTES, 'UTF-8')."',
			'".htmlentities($_POST['nombreorazon'], ENT_NOQUOTES, 'UTF-8')."',
			'".htmlentities($_POST['numerodocumento'], ENT_NOQUOTES, 'UTF-8')."',
			'".htmlentities($_POST['representantelegal'], ENT_NOQUOTES, 'UTF-8')."',
			'".htmlentities($_POST['actividadeconomica'], ENT_NOQUOTES, 'UTF-8')."',
			'".htmlentities($_POST['ciudad'], ENT_NOQUOTES, 'UTF-8')."',
			'".htmlentities($_POST['direccion'], ENT_NOQUOTES, 'UTF-8')."',
			'".htmlentities($_POST['telefono'], ENT_NOQUOTES, 'UTF-8')."',
			'".htmlentities($_POST['celular'], ENT_NOQUOTES, 'UTF-8')."',
			'".htmlentities($_POST['email'], ENT_NOQUOTES, 'UTF-8')."',
			'".htmlentities($_POST['fechaactividad'], ENT_NOQUOTES, 'UTF-8')."',
			'".date("Y-m-d h-i-s")."','".date("Y-m-d h-i-s")."',".$_SESSION['sessionId'].",".$_SESSION['sessionId'].",'','')";
	$conProponentes=$cnx_local->_execute($sql);

	if($conProponentes->_nreg==0){
		echo "0"; echo $sql;
	}else{
		echo $nuevoID;
	}
}else{
	$conProponentes=$cnx_local->_execute("update proponente set tipo_identificacion_codigo='".htmlentities($_POST['tipoidentificacion'], ENT_NOQUOTES, 'UTF-8')."',
			proponente_razonsocial='".htmlentities($_POST['nombreorazon'], ENT_NOQUOTES, 'UTF-8')."',
			proponente_nit='".htmlentities($_POST['numerodocumento'], ENT_NOQUOTES, 'UTF-8')."',
			proponente_representante='".htmlentities($_POST['representantelegal'], ENT_NOQUOTES, 'UTF-8')."',
			actividad_codigo='".htmlentities($_POST['actividadeconomica'], ENT_NOQUOTES, 'UTF-8')."',
			municipio_id='".htmlentities($_POST['ciudad'], ENT_NOQUOTES, 'UTF-8')."',
			proponente_direccion='".htmlentities($_POST['direccion'], ENT_NOQUOTES, 'UTF-8')."',
			proponente_telefono1='".htmlentities($_POST['telefono'], ENT_NOQUOTES, 'UTF-8')."',
			proponente_telefono2='".htmlentities($_POST['celular'], ENT_NOQUOTES, 'UTF-8')."',
			proponente_correo='".htmlentities($_POST['email'], ENT_NOQUOTES, 'UTF-8')."',
			proponente_actividadinicio='".$_POST['fechaactividad']."', 
			proponente_fechamodificacion='".date("Y-m-d h-i-s")."'  
			where proponente_id='".$_POST['codigo']."'");

	if($conProponentes->_nreg==0){
		echo "0";
	}else{
		echo "editado";
	}
}

?>
