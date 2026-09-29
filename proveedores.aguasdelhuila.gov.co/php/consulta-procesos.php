<?php
require_once("../funciones.php");
include("../dbconnection/connections.php");
validasesion();

if($_POST['codigo']==''){
	$consulta=$cnx_local->_query("select proceso_codigo, proceso_objeto, proceso_link_secop, proceso_valor, 
                                        proceso_fecha, tipo_proceso_codigo, estado_contrato_codigo, tipo_contrato_codigo 
							from proceso 
							where proceso_codigo='".$_POST['codigoproceso']."'",0,1);
							echo "hola";
}else{
	$consulta=$cnx_local->_query("select proceso_codigo, proceso_objeto, proceso_link_secop, proceso_valor, 
                                        proceso_fecha, tipo_proceso_codigo, estado_contrato_codigo, tipo_contrato_codigo  
                                        from proceso
                                        where proceso_codigo='".$_POST['codigo']."'",0,1);	

    
}
if($consulta->_nreg==1){
	echo json_encode(array('id'=>'1', 'codigoproceso'=>$consulta->_array[0]['proceso_codigo'], 
						   'objetoproceso'=>html_entity_decode($consulta->_array[0]['proceso_objeto'], ENT_COMPAT, 'utf-8'), 
						   'linksecop'=>html_entity_decode($consulta->_array[0]['proceso_link_secop'], ENT_COMPAT, 'utf-8'), 
						   'valorcontrato'=>html_entity_decode($consulta->_array[0]['proceso_valor'], ENT_COMPAT, 'utf-8'), 
						   'fechaproceso'=>html_entity_decode($consulta->_array[0]['proceso_fecha'], ENT_COMPAT, 'utf-8'),
						   'tipoproceso'=>html_entity_decode($consulta->_array[0]['tipo_proceso_codigo'], ENT_COMPAT, 'utf-8'),
						   'estadocontrato'=>html_entity_decode($consulta->_array[0]['estado_contrato_codigo'], ENT_COMPAT, 'utf-8'),
						   'tipocontrato'=>html_entity_decode($consulta->_array[0]['tipo_contrato_codigo'], ENT_COMPAT, 'utf-8')),
						   JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_QUOT);
}else{
	echo json_encode(array('id'=>'0'), JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_QUOT);
}



?>
