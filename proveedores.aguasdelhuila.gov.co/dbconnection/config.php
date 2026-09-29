<?php
/*
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */

	date_default_timezone_set('America/Bogota');

	$GLOBALS["maindomain"] 		= 'portalsalud.co';
	$GLOBALS["path"] 			= 'http://portalsalud.co/';
	$GLOBALS["manager"]			= 'manager/'; //ruta del manager incluir al final "/"
	$GLOBALS["pathrmanager"]	= $GLOBALS["path"].$GLOBALS["manager"];
	$GLOBALS["dir"]				= '/files/'; 
	$GLOBALS["uploads"] 		= $GLOBALS["path"].$GLOBALS["dir"]."uploads/";
	$GLOBALS["multimedia"] 		= $GLOBALS["path"].$GLOBALS["dir"]."multimedia/";
	$GLOBALS["dirmodules"] 		= "modules/";
	$GLOBALS["language"] 		= "es-ES";
	$GLOBALS["document"] 		= "index.php";
	$GLOBALS["client"] 			= "";
	$GLOBALS["site"] 			= "portalsalud";
	$GLOBALS["env"] 			= "portalsalud";
	$GLOBALS["startpage"] 		= 1;
	$GLOBALS["cache"] 			= 0;
	
	$GLOBALS["userblock"]	 	= 0; //bloquear el usuario cuando ya este logueado
	$GLOBALS["maxasddi"] 		= 2; //Numero maximo de sessiones desde diferentes ips el mismo dia
	
	$GLOBALS["siteProperties"]	= array("title" => "", "description" => "", "keywords" => "", "gascript" => "", "copyright" => "");
	
	$GLOBALS["smtphost"]		= "smtp.gmail.com";
	$GLOBALS["smtpsecu"]		= "ssl";
	$GLOBALS["smtpport"]		= "465";
	$GLOBALS["smtpuser"]		= "contactos@portalsalud.co";
	$GLOBALS["smtpname"]		= "contactos@portalsalud.co";
	$GLOBALS["smtppass"]		= "";

	$GLOBALS["capchakey"]		= "6LfHu8oSAAAAAOhcubNaKXQMr6cqtx9aZYmtKUB_";//Porrtalsalud.co



?>