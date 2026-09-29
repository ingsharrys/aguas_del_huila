<?php
/*
 * Postgres Database Driver  - Version 0.3
 *
 * http://www.ontecnologia.com/code/dbconnection/
 * http://code.google.com/ontecnologia/dbconnection/
 *
 * Copyright (c) 2008 ON Tecnologia
 * Autor: Oscar Emilio Antolinez Collazos
 * Date: 23/03/2007
 *
 * 
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */

require_once("resultclass.php");


class postgres_driver extends result{

	function _connect($server="", $database="", $port="", $user="", $password=""){
		if($_connection_id=pg_connect("host=$server user=$user password=$password dbname=$database port=$port")){
			return $_connection_id;
		}
		else{
			echo $php_errormsg;
			echo "Error en la conexion";
			return 0;
		}
	}
	
	function _query($_sql, $_connection_id, $_offset=0, $_limit=1){
		$_result = new result;
		$_result->_nmue=0;
		
		if($_result->_id=pg_query($_connection_id, $_sql)){
			$_result->_nreg=pg_num_rows($_result->_id);
			if($_result->_nreg>0){
				pg_result_seek($_result->_id, $_offset);
				if($_result->_nreg > 0){
					$counter=0;
					while($_result->_array[]=pg_fetch_array($_result->_id)){
						$counter++;
						if($counter>=$_limit && $_limit!=0)
						break;
					}
					$_result->_ncol=pg_num_fields($_result->_id);
					$_result->_nmue=$counter; //establece el numero de registros de la muestra
					
					$_result->_fields=array_keys($_result->_array[0]);
					for($cc=0;$cc<count($_result->_fields);$cc++){
						$cc++;
						$a[]=$_result->_fields[$cc];
					}
					$_result->_fields=$a;
					
					$_result->_msg="Se encontraron ".$_result->_nreg." registros";
					//pg_free_result($_result->_id);
				}
			}
			else{
				$_result->_nreg=0;
				$_result->_msg="No se encontraron registros";
			}
			$_result->_error=0;
			//return $_result;
		}
		else{
			$_result->_nreg=0;
			$_result->_error=pg_last_error($_connection_id);
			$_result->_msg="Error en la Consulta: ".pg_last_error($_connection_id);
			//return $_result;
		}
		
		pg_free_result($_result->_id);
		
		//Genera XML
/*		$_result->_xml = "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>";
		$_result->_xml .= "<resultado>";
		$_result->_xml .= "<consulta></consulta>";
		$_result->_xml .= "<mensaje>".$_result->_msg."</mensaje>";
		$_result->_xml .= "<posicion>".$_offset."</posicion><numfilas>".$_result->_nreg."</numfilas><nmuestra>".$_result->_nmue."</nmuestra>";
			for($i=0; $i<$_result->_nmue; $i++){	
				$_result->_xml .= "<registro>";
					reset($_result->_fields);
					while (list($pos, $nombre) = each($_result->_fields)) {
						$_result->_xml .= "<".$nombre.">".html_entity_decode($_result->_array[$i][$pos])."</".$nombre.">";
					}
				$_result->_xml .= "</registro>";
			}
		$_result->_xml .= "</resultado>";
*/		
		return $_result;
	}
	
	function _execute($_sql, $_connection_id){
		$_result = new result;
		
		if($_result->_id=pg_query($_connection_id, $_sql)){
			$_result->_nreg=pg_affected_rows($_result->_id);
			if($_result->_nreg > 0){
				$_result->_msg="Operacion completada. ";
			}
			else{
				$_result->_nreg=0;
				$_result->_msg="Fallo la operacion. ".pg_last_error($_connection_id);
			}
		}
		else{
			$_result->_nreg=0;
			$_result->_msg="Error en la Consulta: ".pg_last_error($_connection_id)." - ".$_sql;
		}
		
		//pg_free_result($_result->_id);
		
		//Genera XML
/*		$_result->_xml = "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>";
		$_result->_xml .= "<resultado>";
		$_result->_xml .= "<consulta></consulta>";
		$_result->_xml .= "<mensaje>".$_result->_msg."</mensaje>";
		$_result->_xml .= "<posicion>".$_offset."</posicion><numfilas>".$_result->_nreg."</numfilas><nmuestra>".$_result->_nmue."</nmuestra>";
			for($i=0; $i<$_result->_nmue; $i++){	
				$_result->_xml .= "<registro>";
					reset($_result->_fields);
					while (list($pos, $nombre) = each($_result->_fields)) {
						$_result->_xml .= "<".$nombre.">".html_entity_decode($_result->_array[$i][$pos])."</".$nombre.">";
					}
				$_result->_xml .= "</registro>";
			}
		$_result->_xml .= "</resultado>";
*/		
		return $_result;
		
	}

}
?>