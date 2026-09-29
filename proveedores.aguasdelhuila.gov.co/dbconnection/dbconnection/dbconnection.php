<?php
/*
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */

class dbConnection{
	
	var $_driver; //Identificador de la conexion
	var $_connection_id; //Identificador de la conexion
	var $_engine; // Tipo de base de datos
	var $_database;
	var $_server;
	var $_port;
	var $_user;
	var $_password;
	
	//clase constructora, establece el tipo de conexion
	function __construct($_engine="", $_server="", $_database="", $_port="", $_user="", $_password=""){
		$this->_engine=$_engine;
		$this->_server=$_server;
		$this->_database=$_database;
		$this->_port=$_port;
		$this->_user=$_user;
		$this->_password=$_password;
		
		switch ($this->_engine){
			
			case 'mysql':
				require_once('drivers/mysql_driver.php');
				$this->_driver = new mysql_driver();
				break;

			case 'mysqlii':
				require_once('drivers/mysqlii_driver.php');
				$this->_driver = new mysqlii_driver();
				break;
							
			case 'pgsql':
				require_once('drivers/pgsql_driver.php');
				$this->_driver = new postgres_driver();
				break;
				
			case 'mssql':
				require_once('drivers/mssql_driver.php');
				$this->_driver = new mssql_driver();
				break;
			
			case 'oracle':
				require_once('drivers/oracle_driver.php');
				$this->_driver = new oracle_driver();
				break;
				
		}
		
		$this->_connection_id = $this->_driver->_connect($this->_server, $this->_database, $this->_port, $this->_user, $this->_password);
		return $this->_connection_id;
		
	}// Fin de funcion dbconnection

	function _query($_sql="", $offset=0, $limit=1){
		$_result = new result;
		$_result = $this->_driver->_query($_sql, $this->_connection_id, $offset, $limit);
		return $_result;
	}
	
	function _execute($_sql=""){
		$_result = new result;
		$_result = $this->_driver->_execute($_sql, $this->_connection_id);
		return $_result;
	}

	function _message($code=""){
		$_message = $this->_driver->_message($code);
		return $_message;
	}

}//Fin de la clase

?>