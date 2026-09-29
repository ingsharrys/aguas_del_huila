<?php
	require_once("../funciones.php");
	include("../dbconnection/connections.php");
	validasesion();
	
	$conListado=$cnx_local->_query("select ocupacion_codigo, ocupacion_nombre from ocupacion order by ocupacion_codigo DESC",0,0);
	
	$strResultado='{"data": [';
	for($i=0;$i<$conListado->_nreg;$i++){
		$strResultado.='[';
		$strResultado.='"'.$conListado->_array[$i]['ocupacion_codigo'].'",';
		$strResultado.='"'.$conListado->_array[$i]['ocupacion_nombre'].'",';
		$strResultado.='"<button data-value=\"'.$conListado->_array[$i]['ocupacion_codigo'].'\" id=\"btnEditar-'.$conListado->_array[$i]['ocupacion_codigo'].'\" type=\"button\" class=\"btn btn-primary btn-sm mr5 mb10 btn-editar \">Editar</button>",';
		$strResultado.='"<button data-value=\"'.$conListado->_array[$i]['ocupacion_codigo'].'\" id=\"btnEliminar-'.$conListado->_array[$i]['ocupacion_codigo'].'\" type=\"button\" class=\"btn btn-danger btn-sm mr5 mb10 btn-eliminar \">Eliminar</button>",';
		$strResultado = substr($strResultado, 0, -1);
		$strResultado.='],';
	}
	$strResultado = substr($strResultado, 0, -1);
	$strResultado.=']}';
	echo $strResultado;
?>