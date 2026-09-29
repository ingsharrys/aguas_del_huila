<?php 
    require_once("funciones.php");
	include("dbconnection/connections.php");
	$msg="";
	if(isset($_POST['email'])){
		$sql="select usuario_id, usuario_nombre, usuario_fecha_creacion  
								   from usuario where usuario_email='".$_POST['email']."'";
		//echo $sql."<br>";
		$conValida=$cnx_local->_query($sql);
		if($conValida->_nreg==1){
            $msg="El correo electrónico ya ha sido registrado como usuario de la aplicación";
			//session_start();
			//$_SESSION['sessionId']=$conValida->_array[0]['usuario_id'];
			//$_SESSION['sessionNombre']=$conValida->_array[0]['usuario_nombre'];
			//$_SESSION['sessionPerfil']=$conValida->_array[0]['perfil_codigo'];
			//header("Location: dashboard.php");
		}else{
            $nuevoID=nextID('usuario');
            $conUsuarios=$cnx_local->_execute("insert into usuario(usuario_id, usuario_nombre, usuario_fecha_creacion, 
                                                    usuario_clave, estado_codigo, usuario_email, perfil_codigo) 
                                                values('".$nuevoID."','".htmlentities($_POST['nombrecompleto'], ENT_NOQUOTES, 'UTF-8')."',
                                                '".date("Y-m-d h-i-s")."',
                                                '".md5(md5(htmlentities($_POST['claveusuario'], ENT_NOQUOTES, 'UTF-8')))."',
                                                'activo',
                                                '".htmlentities($_POST['email'], ENT_NOQUOTES, 'UTF-8')."', 3)");
            if($conUsuarios->_nreg==0){
                $msg="Error al crear usuario";
            }else{
                $msg="Usuario creado";
            }
            
			
		}
		echo $conValida->_msg;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <title>Inicio | Proveedores Aguas del Huila</title>
        <!-- Mobile specific metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- Force IE9 to render in normal mode -->
        <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
        <meta name="author" content="" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="application-name" content="" />
        <!-- Import google fonts - Heading first/ text second -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet" type="text/css">
        <!-- Css files -->
        <!-- Icons -->
        <link href="css/icons.css" rel="stylesheet" />
        <!-- Bootstrap stylesheets (included template modifications) -->
        <link href="css/bootstrap.css" rel="stylesheet" />
        <!-- Plugins stylesheets (all plugin custom css) -->
        <link href="css/plugins.css" rel="stylesheet" />
        <!-- Main stylesheets (template main css file) -->
        <link href="css/main.css" rel="stylesheet" />
        <!-- Custom stylesheets ( Put your own changes here ) -->
        <link href="css/custom.css" rel="stylesheet" />
        <link href="plugins/tables/dataTables/jquery.dataTables.css" rel="stylesheet" />
        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="img/ico/apple-touch-icon-57-precomposed.png">
        <link rel="icon" href="img/ico/favicon.ico" type="image/png">
        <!-- Windows8 touch icon ( http://www.buildmypinnedsite.com/ )-->
        <meta name="msapplication-TileColor" content="#3399cc" />
    </head>
    <body class="login-page">
        <!-- Start login container -->
        <div class="container login-container">
			
            <div class="login-panel panel panel-default plain animated bounceIn">
                <!-- Start .panel -->
                <div class="panel-body">
                    <form class="form-horizontal mt0" id="registerForm" name="registerForm" role="form" method="post">
						<div class="form-group">
							<div class="col-md-12">
								<img src="images/logoah2022.png" width="100%" height="auto" alt="Logo Aguas del Huila" />
							</div>
						</div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <?php echo $msg ?>
                            </div>
                        </div>                          
                        <div class="form-group">
                            <div class="col-md-12">
                                <!-- col-md-12 start here -->
                                <label for="">Email:</label>
                            </div>
                            <!-- col-md-12 end here -->
                            <div class="col-lg-12">
                                <div class="input-group input-icon">
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Correo Electrónico ...">
                                    <span class="input-group-addon"><i class="fa fa-envelope s16"></i></span>
                                </div>
                            </div>
                        </div>        
                        <div class="form-group">
                            <div class="col-md-12">
                                <!-- col-md-12 start here -->
                                <label for="">Verifique su Email:</label>
                            </div>
                            <!-- col-md-12 end here -->
                            <div class="col-lg-12">
                                <div class="input-group input-icon">
                                    <input type="text" name="vemail" id="vemail" class="form-control" placeholder="Verifique su Correo Electrónico ...">
                                    <span class="input-group-addon"><i class="fa fa-envelope s16"></i></span>
                                </div>
                            </div>
                        </div>                                         
                        <div class="form-group">
                            <div class="col-md-12">
                                <!-- col-md-12 start here -->
                                <label for="">Nombre Completo:</label>
                            </div>
                            <!-- col-md-12 end here -->
                            <div class="col-lg-12">
                                <div class="input-group input-icon">
                                    <input type="text" name="nombrecompleto" id="nombrecompleto" class="form-control" value="" placeholder="Ingrese su nombre completo ...">
                                    <span class="input-group-addon"><i class="icomoon-icon-user s16"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <!-- col-md-12 start here -->
                                <label for="">Contraseña:</label>
                            </div>
                            <!-- col-md-12 end here -->
                            <div class="col-lg-12">
                                <div class="input-group input-icon">
                                    <input type="password" name="claveusuario" id="claveusuario" class="form-control" placeholder="Su contraseña">
                                    <span class="input-group-addon"><i class="icomoon-icon-lock s16"></i></span> 
                                </div>
                                 
                            </div>
                        </div>                        
                        <div class="form-group">
                            <div class="col-md-12">
                                <!-- col-md-12 start here -->
                                <label for="">Contraseña:</label>
                            </div>
                            <!-- col-md-12 end here -->
                            <div class="col-lg-12">
                                <div class="input-group input-icon">
                                    <input type="password" name="claveconfirmacion" id="claveconfirmacion" class="form-control" placeholder="Confirme su contraseña">
                                    <span class="input-group-addon"><i class="icomoon-icon-lock s16"></i></span> 
                                </div>
                                 
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="checkbox-custom">
                                    <input type="checkbox" id="checkbox1">
                                    <label for="checkbox1">¿Acepto nuestra política de tratamiento de datos?</label>
                                </div>
                            </div>
                        </div>                        
                        
                        <div class="form-group mb0">
                            <div class="col-md-12">
                                <p class="text-center">
                                    <button class="btn btn-primary btn-lg" type="submit">  Registrarse  </button>
                                </p>
                            </div>
                        </div>                  
                    </form>
                </div>
                <div class="panel-footer gray-lighter-bg">
                    <h4 class="text-center"><strong>¿Ya tiene cuenta?</strong>
                    </h4>
                    <p class="text-center"><a href="index.php" class="btn btn-success">Ingrese aqui</a>
                    </p>
                </div>
            </div>
            <!-- End .panel -->
        </div>
        <!-- End login container -->
        <div class="container">
            <div class="footer">
                <p class="text-center" style="color: #fff" >&copy; Todos los derechos reservados</p>
            </div>
        </div>

        <!-- Javascripts -->
        <!-- Load pace first -->
        <script src="plugins/core/pace/pace.min.js"></script>
        <!-- Important javascript libs(put in all pages) -->
        <script src="js/libs/jquery-2.1.1.min.js"></script>
        <script src="js/libs/jquery-ui-1.10.4.min.js"></script>
        <script src="js/libs/jquery-migrate-1.2.1.min.js"></script>
        <!--[if lt IE 9]>
        <script type="text/javascript" src="js/libs/excanvas.min.js"></script>
        <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script type="text/javascript" src="js/libs/respond.min.js"></script>
        <![endif]-->
        <!-- Bootstrap plugins -->
        <script src="js/bootstrap/bootstrap.js"></script>
        <!-- Core plugins ( not remove ) -->
        <script src="js/libs/modernizr.custom.js"></script>
        <!-- Handle responsive view functions -->
        <script src="js/jRespond.min.js"></script>
        <!-- Custom scroll for sidebars,tables and etc. -->
        <script src="plugins/core/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="plugins/core/slimscroll/jquery.slimscroll.horizontal.min.js"></script>
        <!-- Remove click delay in touch -->
        <script src="plugins/core/fastclick/fastclick.js"></script>
        <!-- Increase jquery animation speed -->
        <script src="plugins/core/velocity/jquery.velocity.min.js"></script>
        <!-- Quick search plugin (fast search for many widgets) -->
        <script src="plugins/core/quicksearch/jquery.quicksearch.js"></script>
        <!-- Bootbox fast bootstrap modals -->
        <script src="plugins/ui/bootbox/bootbox.js"></script>
        <!-- Other plugins ( load only nessesary plugins for every page) -->
        <script src="plugins/charts/sparklines/jquery.sparkline.js"></script>
        <script src="plugins/ui/tabdrop/bootstrap-tabdrop.js"></script>
		
        <script src="plugins/tables/datatables/jquery.dataTables.js"></script>
        <script src="plugins/tables/datatables/dataTables.bootstrap.js"></script>
		<script src="plugins/tables/datatables/fnReloadAjax.js"></script>
		
        <script src="plugins/charts/sparklines/jquery.sparkline.js"></script>
		<script src="plugins/boostrap.validate.js"></script>
		<script src="plugins/ui/bootbox/bootbox.js"></script>
        <script src="plugins/ui/title-notifier/title_notifier.js"></script>
        <script src="plugins/ui/notify/jquery.gritter.js"></script>
        <script src="plugins/ui/bootstrap-sweetalert/sweet-alert.js"></script>

        <script src="js/jquery.supr.js"></script>
        <script src="js/pages/tabs.js"></script>
        <script src="plugins/forms/spinner/jquery.bootstrap-touchspin.js"></script>
        <script src="plugins/forms/maskedinput/jquery.maskedinput-1.3.min.js"></script>		
        <script src="plugins/forms/bootstrap-datepicker/bootstrap-datepicker.js"></script>
        <script src="plugins/forms/bootstrap-timepicker/bootstrap-timepicker.js"></script>
		

		<script type="text/javascript" src="js/portalsalud.js"></script>


     <script type="text/javascript">
        // document ready function
        $(document).ready(function() {
            //------------- Options for Supr - admin tempalte -------------//
            var supr_Options = {
                rtl:false//activate rtl version with true
            }


            $("#registerForm").boostrapvalidate({
                sendType: "normal",
                errorClass: "has-error",
                beforeSubmit: function(){
                    //alert("antes");
                },
                completeSubmit: function(response){
                    //alert(response);
                    /*if(response=='editado'){
                        mensajeRegistro("actualizado");
                    }else if(parseInt(response)>0){
                        $('#codigo').val(response);
                        mensajeRegistro("adicionado");
                    }else{
                        mensajeRegistro("noactualizado");
                    }*/
                    

                    
                    /*$("#contactos-frm").each (function(){
                        this.reset();
                    });*/
                            
                },
                fields: [
                    {
                        "name" : "email",
                        "required" : true,
                        "datatype" : "email",
                        "mask": "",
                        "minvalue" : "",
                        "maxvalue" : "",
                        "minlength" : "2",
                        "maxlength" : "255",
                        "equalto" : ""
                    },
                    {
                        "name" : "vemail",
                        "required" : true,
                        "datatype" : "email",
                        "mask": "",
                        "minvalue" : "",
                        "maxvalue" : "",
                        "minlength" : "2",
                        "maxlength" : "255",
                        "equalto" : "email"
                    },                    
                    {
                        "name" : "nombrecompleto",
                        "required" : true,
                        "datatype" : "alphanumeric",
                        "mask": "",
                        "minvalue" : "",
                        "maxvalue" : "",
                        "minlength" : "4",
                        "maxlength" : "255",
                        "equalto" : ""
                    },
                    {
                        "name" : "claveusuario",
                        "required" : true,
                        "datatype" : "alphanumeric",
                        "mask": "",
                        "minvalue" : "",
                        "maxvalue" : "",
                        "minlength" : "8",
                        "maxlength" : "255",
                        "equalto" : ""
                    },
                    {
                        "name" : "claveconfirmacion",
                        "required" : true,
                        "datatype" : "alphanumeric",
                        "mask": "",
                        "minvalue" : "",
                        "maxvalue" : "",
                        "minlength" : "8",
                        "maxlength" : "255",
                        "equalto" : ""
                    }
                ]
            });        



            //rtl version
            /*if(supr_Options.rtl) {
                localStorage.setItem('rtl', 1);
                $('#bootstrap').attr('href', 'css/bootstrap/bootstrap.rtl.min.css');
                $('#bootstrap-responsive').attr('href', 'css/bootstrap/bootstrap-responsive.rtl.min.css');
                $('body').addClass('rtl');
                $('#sidebar').attr('id', 'sidebar-right');
                $('#sidebarbg').attr('id', 'sidebarbg-right');
                $('.collapseBtn').addClass('rightbar').removeClass('leftbar');
                $('#content').attr('id', 'content-one')
            } else {localStorage.setItem('rtl', 0);}
            
            $("input, textarea, select").not('.nostyle').uniform();
            $("#loginForm").validate({
                rules: {
                    email: {
                        required: true,
                        minlength: 4
                    },
                    vemail: {
                        required: true,
                        minlength: 4
                    },                    
                    clave: {
                        required: true,
                        minlength: 6
                    }  
                },
                messages: {
                    email: {
                        required: "Diligencie su correo",
                        minlength: "Minimo 4 caracteres"
                    },
                    claveusuario: {
                        required: "Digite su password",
                        minlength: "La password debe ser de almenos 6 caracteres"
                    }
                }   
            });*/
        });
    </script> 
    </body>
</html>
