<?php
/*
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */
 
require_once("resultclass.php");

class mysql_driver extends result{

	function _connect($server="", $database="", $port="", $user="", $password=""){
		if($_connection_id=mysql_connect($server, $user, $password, true)){
			
			if(mysql_select_db($database, $_connection_id)){
				return $_connection_id;
			}else{
				echo "Error al seleccionar la base de datos";
				return 0;
			}
		}else{
			echo "Error en la conexion";
			return 0;
		}
	}
	
	function _query($_sql, $_connection_id, $_offset=0, $_limit=1){
		$_result = new result;
		$_result->_nmue=0;
		
		//echo $_sql;
		
		if($_result->_id=mysql_query($_sql, $_connection_id)){
			$_result->_nreg=mysql_num_rows($_result->_id);
			if($_result->_nreg>0){
				if(mysql_data_seek($_result->_id, $_offset)){
					if($_result->_nreg > 0){
						$counter=0;
						while($_result->_array[]=mysql_fetch_array($_result->_id)){
							$counter++;
							if($counter>=$_limit && $_limit!=0)
							break;
						}
						$_result->_ncol=mysql_num_fields($_result->_id);
						$_result->_nmue=$counter; //establece el numero de registros de la muestra
						
						$_result->_fields=array_keys($_result->_array[0]);
						for($cc=0;$cc<count($_result->_fields);$cc++){
							$cc++;
							$a[]=$_result->_fields[$cc];
						}
						$_result->_fields=$a;
						$_result->_msg="Se encontraron ".$_result->_nreg." registros";
					}
				}
			}else{
				$_result->_nreg=0;
				$_result->_msg="No se encontraron registros";
			}
			$_result->_error=0;
			
			mysql_free_result($_result->_id);
			
		}else{
			$_result->_nreg=0;
			$_result->_error=mysql_errno($_connection_id);
			$_result->_msg="Error en la Consulta: ".mysql_error($_connection_id);
		}
		
		return $_result;
	}
	
	function _execute($_sql, $_connection_id){
		
		$_result = new result;
				
		//echo $_sql;
		if($_result->_id=mysql_query($_sql, $_connection_id)){
			$_result->_nreg=mysql_affected_rows($_connection_id);
			if($_result->_nreg > 0){
				$_result->_msg="Operacion completada. ";
			}else{
				$_result->_nreg=0;
				$_result->_error=mysql_errno($_connection_id);
				$_result->_msg="Fallo la operacion. ".mysql_errno($_connection_id).", ".mysql_error($_connection_id);
			}
		}else{
			$_result->_nreg=0;
			$_result->_error=mysql_errno($_connection_id);
			$_result->_msg="Error en la Consulta: ".mysql_errno($_connection_id).", ".mysql_error($_connection_id);
		}
		
		return $_result;
	}

	function _message($code){
		$a['1062']="Registro Duplicado";
		
		
		return $a[$code];
	}
	
}
?>