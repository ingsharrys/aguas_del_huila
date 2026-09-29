<?php
/************************************************************************************
*   Driver de conexión a MSSql        												*
*																					*
*	On Tecnología - Todos los derechos reservados									*
*																					*
*	Autor: Oscar Emilio Antolinez Collazos											*
*	Fecha:  diciembre de 2004												        *
*																					*
*	Historial de Cambios															*
*	------------------------------------------------------------------------------	*
*	Fecha		Autor		Descripción												*
************************************************************************************/

require_once("consultares.php");

class on_mssql_driver extends ConsultaRes{



	function _connect($server="", $database="", $port="", $user="", $password=""){
		if($_connection_id=mssql_connect($server, $user, $password)){
			if(mssql_connect($basedatos, $ConexionID)){
				return $_connection_id;
			}else{
				echo "Error al seleccionar la base de datos";
				return 0;
			}
		}
		else{
			echo "Error en la conexion";
			return 0;
		}
	}

	
	function consultar($sql, $ConexionID, $posicion=0, $limite=1){
		
		error_reporting(0);//Deshabilita el reporte de errores para que no interfiera con la generacion del XML
		
		$Resultadocon = new ConsultaRes;
		//echo $sql;
		if($Resultadocon->ConsultaID=mssql_query($sql, $ConexionID)){
			$Resultadocon->ConsultaNcol=mssql_num_fields($Resultadocon->ConsultaID);
			for($c=0;$c<$Resultadocon->ConsultaNcol; $c++)
				$Resultadocon->ConsultaCampos[]=mssql_fetch_field($Resultadocon->ConsultaID);
			$Resultadocon->ConsultaNreg=mssql_num_rows($Resultadocon->ConsultaID);
			if($Resultadocon->ConsultaNreg>0){
				mssql_data_seek($Resultadocon->ConsultaID, $posicion);
				if($Resultadocon->ConsultaNreg > 0){
					$contador=0;
					while($Resultadocon->ConsultaArr[]=mssql_fetch_array($Resultadocon->ConsultaID)){
						$contador++;
						if($contador>=$limite && $limite!=0)
						break;
					}
					$Resultadocon->ConsultaNmue=$contador; //establece el numero de registros de la muestra
					$Resultadocon->ConsultaMsg="Se encontraron ".$Resultadocon->ConsultaNreg." registros";
					mssql_free_result($Resultadocon->ConsultaID);
				}
			}
			else{
				$Resultadocon->ConsultaNreg=0;
				$Resultadocon->ConsultaMsg="No se encontraron registros";
			}
			
			$Resultadocon->ConsultaError=0;
			return $Resultadocon;
		}
		else{
			$Resultadocon->ConsultaNreg=0;
			$Resultadocon->ConsultaError=1;
			$Resultadocon->ConsultaMsg="Error en la Consulta: ".mssql_get_last_message();
			return $Resultadocon;
		}
	}
	
	function adiciona($sql, $ConexionID){

		error_reporting(0);//Deshabilita el reporte de errores para que no interfiera con la generacion del XML

		$Resultadocon = new ConsultaRes;
		//echo $sql;
		if($Resultadocon->ConsultaID=mssql_query($sql, $ConexionID)){
			$Resultadocon->ConsultaNreg=mssql_rows_affected($ConexionID);
			if($Resultadocon->ConsultaNreg > 0){
				$Resultadocon->ConsultaMsg="El registro adicionado. ";
				$Resultadocon->ConsultaError=0;
				//mysql_free_result($Resultadocon->ConsultaID);
			}
			else{
				$Resultadocon->ConsultaNreg=0;
				$Resultadocon->ConsultaError=1;
				$Resultadocon->ConsultaMsg="El registro NO se grabo: ".mssql_get_last_message();
			}
			return $Resultadocon;
		}
		else{
			$Resultadocon->ConsultaNreg=0;
			$Resultadocon->ConsultaError=1;
			$Resultadocon->ConsultaMsg="Error en la Consulta: ".mssql_get_last_message();
			return $Resultadocon;
		}
	}
	
	function actualiza($sql, $ConexionID){
		
		error_reporting(0);//Deshabilita el reporte de errores para que no interfiera con la generacion del XML
		
		$Resultadocon = new ConsultaRes;
		//echo $sql;
		if($Resultadocon->ConsultaID=mssql_query($sql, $ConexionID)){
			$Resultadocon->ConsultaNreg=mssql_rows_affected($ConexionID);
			if($Resultadocon->ConsultaNreg > 0){
				$Resultadocon->ConsultaMsg="El registro actualizado. "." ".$sql;
				$Resultadocon->ConsultaError=0;
				//mysql_free_result($Resultadocon->ConsultaID);
			}
			else{
				$Resultadocon->ConsultaNreg=0;
				$Resultadocon->ConsultaError=1;
				$Resultadocon->ConsultaMsg="El registro NO se grabo: ".mssql_get_last_message()." ".$sql;
			}
			return $Resultadocon;
		}
		else{
			$Resultadocon->ConsultaNreg=0;
			$Resultadocon->ConsultaError=1;
			$Resultadocon->ConsultaMsg="Error en la Consulta: ".mssql_get_last_message()."".$sql;
			return $Resultadocon;
		}
	}
	
	
	function elimina($sql, $ConexionID){
		
		error_reporting(0);//Deshabilita el reporte de errores para que no interfiera con la generacion del XML
		
		$Resultadocon = new ConsultaRes;
		//echo $sql;
		if($Resultadocon->ConsultaID=mssql_query($sql, $ConexionID)){
			$Resultadocon->ConsultaNreg=mssql_rows_affected($ConexionID);
			if($Resultadocon->ConsultaNreg > 0){
				$Resultadocon->ConsultaMsg="Registro eliminado. ";
				$Resultadocon->ConsultaError=0;
				//mysql_free_result($Resultadocon->ConsultaID);
			}
			else{
				$Resultadocon->ConsultaNreg=0;
				$Resultadocon->ConsultaError=1;
				$Resultadocon->ConsultaMsg="El registro NO se elimino: ".mssql_get_last_message();
			}
			return $Resultadocon;
		}
		else{
			$Resultadocon->ConsultaError=1;
			$Resultadocon->ConsultaNreg=0;
			$Resultadocon->ConsultaMsg="Error en la Consulta: ".mssql_get_last_message()."".$sql;
			return $Resultadocon;
		}
	}
	
	
	
}
?>