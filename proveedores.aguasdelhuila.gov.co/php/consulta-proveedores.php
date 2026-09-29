<?php
require_once("../funciones.php");
include("../dbconnection/connections.php");
validasesion();

if($_POST['codigo']==0){
	$consulta=$cnx_local->_query("select proponente_id, estado_codigo, tipo_identificacion_codigo, proponente_razonsocial, 
									proponente_nit, proponente_representante, actividad_codigo, municipio_id, 
									proponente_direccion, proponente_telefono1, proponente_telefono2, proponente_correo,
									proponente_actividadinicio, proponente_fechacreacion, proponente_fechamodificacion,
									usuario_id, proponente_usuarioaprobo, proponente_observacion, proponente_sitioweb,
									departamento.departamento_codigo 
							from proponente, ciudad, departamento 
							where proponente.municipio_id=ciudad.ciudad_codigo 
							and departamento.departamento_codigo=ciudad.departamento_codigo 
							and tipo_identificacion_codigo='".$_POST['tipoidentificacion']."'
							and proponente_identificacion='".$_POST['numerodocumento']."'",0,1);
}else{
	$consulta=$cnx_local->_query("select proponente_id, estado_codigo, tipo_identificacion_codigo, proponente_razonsocial, 
									proponente_nit, proponente_representante, actividad_codigo, municipio_id, 
									proponente_direccion, proponente_telefono1, proponente_telefono2, proponente_correo,
									proponente_actividadinicio, proponente_fechacreacion, proponente_fechamodificacion,
									usuario_id, proponente_usuarioaprobo, proponente_observacion, proponente_sitioweb,
									departamento.departamento_codigo  
							from proponente, ciudad, departamento 
							where proponente.municipio_id=ciudad.ciudad_codigo 
							and departamento.departamento_codigo=ciudad.departamento_codigo 
							and proponente_id=".$_POST['codigo']."",0,1);	
}
if($consulta->_nreg==1){
	echo json_encode(array('id'=>'1', 'codigo'=>$consulta->_array[0]['proponente_id'], 
						   'tipoidentificacion'=>html_entity_decode($consulta->_array[0]['tipo_identificacion_codigo'], ENT_COMPAT, 'utf-8'), 
						   'numerodocumento'=>html_entity_decode($consulta->_array[0]['proponente_nit'], ENT_COMPAT, 'utf-8'), 
						   'nombreorazon'=>html_entity_decode($consulta->_array[0]['proponente_razonsocial'], ENT_COMPAT, 'utf-8'), 
						   'departamento'=>html_entity_decode($consulta->_array[0]['departamento_codigo'], ENT_COMPAT, 'utf-8'),
						   'ciudad'=>html_entity_decode($consulta->_array[0]['municipio_id'], ENT_COMPAT, 'utf-8'),
						   'direccion'=>html_entity_decode($consulta->_array[0]['proponente_direccion'], ENT_COMPAT, 'utf-8'),
						   'telefono'=>html_entity_decode($consulta->_array[0]['proponente_telefono1'], ENT_COMPAT, 'utf-8'),
						   'celular'=>html_entity_decode($consulta->_array[0]['proponente_telefono2'], ENT_COMPAT, 'utf-8'),
						   'representantelegal'=>html_entity_decode($consulta->_array[0]['proponente_representante'], ENT_COMPAT, 'utf-8'),
						   'representantelegal'=>html_entity_decode($consulta->_array[0]['proponente_representante'], ENT_COMPAT, 'utf-8'),
						   'email'=>html_entity_decode($consulta->_array[0]['proponente_correo'], ENT_COMPAT, 'utf-8'),
						   'emailproveedorc'=>html_entity_decode($consulta->_array[0]['proponente_correo'], ENT_COMPAT, 'utf-8'),
						   'actividadeconomica'=>html_entity_decode($consulta->_array[0]['actividad_codigo'], ENT_COMPAT, 'utf-8'),
						   'fechaactividad'=>html_entity_decode($consulta->_array[0]['proponente_actividadinicio'], ENT_COMPAT, 'utf-8')),
						   JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_QUOT);
}else{
	echo json_encode(array('id'=>'0'), JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_QUOT);
}



?>
