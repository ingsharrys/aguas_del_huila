<?php
	session_start();
	if(isset($_SESSION['sessionId'])){
		//include_once ("connections.php");
		
		//$userUpdate=$cnx_local->_execute("update user set user_connect=0 where user_id=".$_SESSION['sessionId']."");
		//$cnx_local->_execute("update user set user_newpassword='' where user_id=".$_SESSION['sessionId']."");
		//$accessUpdate=$cnx_local->_execute("update accesslog set accesslog_enddate='".date('Y-m-d H:i:s')."' where accesslog_id=".$_SESSION['sessionId']."");
		session_destroy();
	
	}

	header("Location: index.php");

?>