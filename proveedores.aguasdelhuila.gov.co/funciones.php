<?php
session_start();
//validasesion();
include_once("dbconnection/connections.php");

function notificaciones(){
	return '<li class="header"><strong>Notifications</strong> (<?php notificaciones(); ?>) items</li>
            <li><a href="#"><span class="icon"><span class="icon16 icomoon-icon-user-plus"></span></span>
                <span class="event">1 User is registred</span></a>
            </li>
            <li>
            	<a href="#">
                	<span class="icon"><span class="icon16 icomoon-icon-bubble-3"></span></span>
                    <span class="event">Jony add 1 comment</span>
                </a>
             </li>
             <li>
             	<a href="#">
                	<span class="icon"><span class="icon16 icomoon-icon-new"></span></span>
                    <span class="event">admin Julia added post with a long description</span>
                </a>
             </li>
             <li class="view-all"><a href="#">View all notifications <span class="icon16 icomoon-icon-arrow-right-8"></span></a></li>';
}

function nombreusuario(){
	return $_SESSION['sessionNombre'];
}

function validasesion(){
	if(!isset($_SESSION['sessionId'])){
		header("Location: index.php");
	}
}

function nextID($table){
	global $cnx_local;
	
	$nextid=0;
	
	$sql = "select max(".$table."_id) as maxid from ".$table."";
	$r1 = $cnx_local->_query($sql,0,0);
	
	if($r1->_array[0]['maxid']=='NULL'){
		$nextid=1;
	}else{
		$nextid=$r1->_array[0]['maxid']+1;
	}
	//echo $sql;
	return $nextid;
	
}

function selectGenerate($table, $selected="", $filtro=""){
	global $cnx_local;
	$list="";
	
	if($selected==""){
		if(isset($_REQUEST['selected'])){
			$selected==$_REQUEST['selected'];
		}
	}
	
	switch($table){
		case 'actividadeconomica':				
			validasesion();
			$sql = "select ciiu_codigo as value, concat(ciiu_codigo, ' - ', ciiu_nombre) as text from ciiu order by ciiu_codigo";
			$r1 = $cnx_local->_query($sql,0,0);
			break;
		case 'departamento':				
			validasesion();
			$sql = "select departamento_codigo as value, departamento_nombre as text from departamento order by departamento_nombre";
			$r1 = $cnx_local->_query($sql,0,0);
			break;
		case 'ciudad':				
			validasesion();
			if(isset($_REQUEST['state'])){
				$filtro=$_REQUEST['state'];
				$sql = "select ciudad_codigo as value, ciudad_nombre as text from ciudad where departamento_codigo=".$filtro." order by ciudad_nombre";
			}else{
				$sql = "select ciudad_codigo as value, ciudad_nombre as text from ciudad order by ciudad_nombre";				
			}
			$r1 = $cnx_local->_query($sql,0,0);
			break;
		case 'tipoidentificacion':				
			validasesion();
			$sql = "select tipo_identificacion_codigo as value, tipo_identificacion_nombre as text from tipo_identificacion order by tipo_identificacion_nombre";
			$r1 = $cnx_local->_query($sql,0,0);
			break;
		case 'sexo':				
			validasesion();
			$sql = "select sexo_codigo as value, sexo_nombre as text from sexo order by sexo_nombre";
			$r1 = $cnx_local->_query($sql,0,0);
			break;
		case 'tipoproceso':				
			validasesion();
			$sql = "select tipo_proceso_codigo as value, tipo_proceso_nombre as text from tipo_proceso order by tipo_proceso_nombre";
			$r1 = $cnx_local->_query($sql,0,0);
			break;
		case 'ocupacion':				
			validasesion();
			$sql = "select ocupacion_codigo as value, ocupacion_nombre as text from ocupacion order by ocupacion_nombre";
			$r1 = $cnx_local->_query($sql,0,0);
			break;
		case 'tipocontrato':				
			validasesion();
			$sql = "select tipo_contrato_codigo as value, tipo_contrato_nombre as text from tipo_contrato order by tipo_contrato_nombre";
			$r1 = $cnx_local->_query($sql,0,0);
			break;
		case 'zona':				
			validasesion();
			$sql = "select zona_codigo as value, zona_nombre as text from zona order by zona_codigo";
			$r1 = $cnx_local->_query($sql,0,0);
			break;
		case 'estadocontrato':				
			validasesion();
			$sql = "select estado_contrato_codigo as value, estado_contrato_nombre as text from estado_contrato order by estado_contrato_nombre";
			$r1 = $cnx_local->_query($sql,0,0);
			break;
		case 'afiliacion':				
			validasesion();
			$sql = "select tipo_afiliado_codigo as value, tipo_afiliado_nombre as text from tipo_afiliado order by tipo_afiliado_nombre";
			$r1 = $cnx_local->_query($sql,0,0);
			break;
		case 'tiposigno':				
			validasesion();
			$sql = "select tipo_signo_codigo as value, tipo_signo_nombre as text from tipo_signo order by tipo_signo_nombre";
			$r1 = $cnx_local->_query($sql,0,0);
			break;
		case 'profesionalatiende':				
			validasesion();
			$sql = "select tipo_atiende_codigo as value, tipo_atiende_nombre as text from tipo_atiende order by tipo_atiende_nombre";
			$r1 = $cnx_local->_query($sql,0,0);
			break;
		case 'tipoconsulta':				
			validasesion();
			$sql = "select tipo_consulta_codigo as value, tipo_consulta_nombre as text from tipo_consulta order by tipo_consulta_nombre";
			$r1 = $cnx_local->_query($sql,0,0);
			break;
		case 'finalidad':				
			validasesion();
			$sql = "select tipo_finalidad_codigo as value, tipo_finalidad_nombre as text from tipo_finalidad order by tipo_finalidad_nombre";
			$r1 = $cnx_local->_query($sql,0,0);
			break;
		case 'causaconsulta':				
			validasesion();
			$sql = "select tipo_causa_codigo as value, tipo_causa_nombre as text from tipo_causa order by tipo_causa_nombre";
			$r1 = $cnx_local->_query($sql,0,0);
			break;
		case 'diagnosticoconsulta':				
			validasesion();
			$sql = "select tipo_diagnostico_codigo as value, tipo_diagnostico_nombre as text from tipo_diagnostico order by tipo_diagnostico_nombre";
			$r1 = $cnx_local->_query($sql,0,0);
			break;
		case 'ambito':				
			validasesion();
			$sql = "select tipo_ambito_codigo as value, tipo_ambito_nombre as text from tipo_ambito order by tipo_ambito_nombre";
			$r1 = $cnx_local->_query($sql,0,0);
			break;
		case 'finalidad':				
			validasesion();
			$sql = "select tipo_finalidad_codigo as value, tipo_finalidad_nombre as text from tipo_finalidad order by tipo_finalidad_nombre";
			$r1 = $cnx_local->_query($sql,0,0);
			break;
		case 'forma':				
			validasesion();
			$sql = "select tipo_forma_codigo as value, tipo_forma_nombre as text from tipo_forma order by tipo_forma_nombre";
			$r1 = $cnx_local->_query($sql,0,0);
			break;
		case 'religion':				
			validasesion();
			$sql = "select religion_codigo as value, religion_nombre as text from religion order by religion_nombre";
			$r1 = $cnx_local->_query($sql,0,0);
			break;
		case 'finalidadp':				
			validasesion();
			$sql = "select tipo_finalidadp_codigo as value, tipo_finalidadp_nombre as text from tipo_finalidadp order by tipo_finalidadp_nombre";
			$r1 = $cnx_local->_query($sql,0,0);
			break;
		case 'medicamento':				
			validasesion();
			$sql = "select medicamento_codigo as value, medicamento_codigo as text from medicamento";
			$r1 = $cnx_local->_query($sql,0,0);
			break;

	}

	
	for($i=0;$i<$r1->_nreg;$i++){
		if($r1->_array[$i]['value']==$selected){
			$list.="<option value='".$r1->_array[$i]['value']."' selected >".$r1->_array[$i]['text']."</option>";
		}else{
			$list.="<option value='".$r1->_array[$i]['value']."'>".html_entity_decode($r1->_array[$i]['text'], ENT_COMPAT, 'utf-8')."</option>";
		}
	}
	
	echo $list;
}

?>