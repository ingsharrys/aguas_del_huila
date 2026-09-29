<?php
require_once("../funciones.php");
include("../dbconnection/connections.php");
validasesion();


$consulta=$cnx_local->_query("select departamento_codigo, departamento_nombre from departamento where departamento_codigo='".$_POST['codigo']."'",0,1);

if($consulta->_nreg==1){
	echo json_encode(array('id'=>'1', 'codigo'=>$consulta->_array[0]['departamento_codigo'], 'nombre'=>html_entity_decode($consulta->_array[0]['departamento_nombre'], ENT_COMPAT, 'utf-8')), JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_QUOT);
}else{
	echo json_encode(array('id'=>'0'), JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_QUOT);
}



?>
