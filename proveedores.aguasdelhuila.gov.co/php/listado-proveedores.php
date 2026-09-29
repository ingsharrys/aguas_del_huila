<?php
	require_once("../funciones.php");
	include("../dbconnection/connections.php");
	validasesion();
	
	$conListado=$cnx_local->_query("select proponente_id, proponente_nit, proponente_razonsocial, ciiu_nombre, ciudad_nombre 
									from proponente, ciiu, ciudad 
									where proponente.actividad_codigo=ciiu.ciiu_codigo 
									and proponente.municipio_id=ciudad.ciudad_codigo and estado_codigo = 1
									order by proponente_id DESC",0,0);
	
	$strResultado='{"data": [';
	for($i=0;$i<$conListado->_nreg;$i++){
		$strResultado.='[';
		$strResultado.='"'.$conListado->_array[$i]['proponente_nit'].'",';
		$strResultado.='"'.$conListado->_array[$i]['proponente_razonsocial'].'",';
		$strResultado.='"'.$conListado->_array[$i]['ciiu_nombre'].'",';
		$strResultado.='"'.$conListado->_array[$i]['ciudad_nombre'].'",';		
		$strResultado.='"<button data-value=\"'.$conListado->_array[$i]['proponente_id'].'\" id=\"btnEditar-'.$conListado->_array[$i]['proponente_id'].'\" type=\"button\" class=\"btn btn-primary btn-sm mr5 mb10 btn-editar \">Editar</button>",';
		$strResultado.='"<button onclick=\"window.open(\'descargar-certificado.php?codigo='.$conListado->_array[$i]['proponente_id'].'\', \'_blank\')\" id=\"btnDescargar-'.$conListado->_array[$i]['proponente_id'].'\" type=\"button\" class=\"btn btn-primary btn-sm mr5 mb10 btn-descargar \">Descargar</button>",';
		//$strResultado.='"<button data-value=\"'.$conListado->_array[$i]['proponente_id'].'\" id=\"btnDescargar-'.$conListado->_array[$i]['proponente_id'].'\" type=\"button\" class=\"btn btn-danger btn-sm mr5 mb10 btn-descargar \">Descargar</button>",';
		$strResultado = substr($strResultado, 0, -1);
		$strResultado.='],';
	}
	$strResultado = substr($strResultado, 0, -1);
	$strResultado.=']}';
	echo $strResultado;
?>