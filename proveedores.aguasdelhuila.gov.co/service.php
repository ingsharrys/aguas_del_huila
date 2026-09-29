<?php
include_once("funciones.php");
validasesion();

switch($_POST['tabla']){
	case "ciudad":
			selectGenerate($_POST['tabla'], "", $_POST["state"]);
		break;		
}

?>