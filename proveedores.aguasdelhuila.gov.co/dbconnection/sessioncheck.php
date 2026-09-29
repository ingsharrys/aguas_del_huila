<?php
	session_start();
	if(!isset($_SESSION['sessionId'])){
		header("Location: ".$GLOBALS["path"]."index.php");
	}

?>
