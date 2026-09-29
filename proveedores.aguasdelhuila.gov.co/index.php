<?php 
	include("dbconnection/connections.php");
	$msg="";
	if(isset($_POST['usuario'])){
		$sql="select usuario_id, usuario_nombre, usuario_fecha_creacion, usuario_fecha_acceso, usuario_clave, estado_codigo, usuario_email, perfil_codigo  
								   from usuario where usuario_email='".$_POST['usuario']."' and usuario_clave='".md5(md5($_POST['password']))."'";
		//echo $sql."<br>";
		$conValida=$cnx_local->_query($sql);
		if($conValida->_nreg==1){
			session_start();
			$_SESSION['sessionId']=$conValida->_array[0]['usuario_id'];
			$_SESSION['sessionNombre']=$conValida->_array[0]['usuario_nombre'];
			$_SESSION['sessionPerfil']=$conValida->_array[0]['perfil_codigo'];
			header("Location: dashboard.php");
		}else{
			$msg="Usuario o password incorrectos";
			
		}
		echo $conValida->_msg;
	}
?>
<!DOCTYPE html>
<html lang="en">
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
                    <form class="form-horizontal mt0" id="loginForm" role="form" method="post">
						<div class="form-group">
							<div class="col-md-12">
								<img src="images/logo-aguas-del-huila-gobernacion-del-huila.jpg" width="100%" height="auto" alt="Logo Aguas del Huila" />
							</div>
						</div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <!-- col-md-12 start here -->
                                <label for="">Usuario:</label>
                            </div>
                            <!-- col-md-12 end here -->
                            <div class="col-lg-12">
                                <div class="input-group input-icon">
                                    <input type="text" name="usuario" id="usuario" class="form-control" value="" placeholder="Ingrese su usuario">
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
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Su contraseña">
                                    <span class="input-group-addon"><i class="icomoon-icon-lock s16"></i></span> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb0">
                            <div class="col-md-12">
                                <p class="text-center">
                                    <button class="btn btn-primary btn-lg" type="submit">  Ingresar  </button>
                                </p>
                            </div>
                        </div>
                        <div class="form-group mb0">
                            <div class="col-md-12">
                                <span class="help-block text-center">¿Olvido su contraseña?: <a href="#">Recuperar contraseña</a></span>
                            </div>
                        </div>                        
                    </form>
                </div>
                <div class="panel-footer gray-lighter-bg">
                    <h4 class="text-center"><strong>¿No tiene cuenta?</strong>
                    </h4>
                    <p class="text-center"><a href="registro-proponente.php" class="btn btn-success">Registrese como Proponente</a>
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
        <!-- Important javascript libs(put in all pages) -->
        <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script>
        window.jQuery || document.write('<script src="assets/js/libs/jquery-2.1.1.min.js">\x3C/script>')
        </script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <script>
        window.jQuery || document.write('<script src="assets/js/libs/jquery-ui-1.10.4.min.js">\x3C/script>')
        </script>
        <!--[if lt IE 9]>
  <script type="text/javascript" src="js/libs/excanvas.min.js"></script>
  <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <script type="text/javascript" src="js/libs/respond.min.js"></script>
<![endif]-->
        <!-- Bootstrap plugins -->
        <script src="js/bootstrap/bootstrap.js"></script>
        <!-- Form plugins -->
        <script src="plugins/forms/validation/jquery.validate.js"></script>
        <script src="plugins/forms/validation/additional-methods.min.js"></script>
        <!-- Init plugins olny for this page -->
        <script src="js/pages/login.js"></script>

    <!-- Le javascript
    ================================================== -->
    <script type="text/javascript" src="js/libs/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap/bootstrap.js"></script>  
    <script type="text/javascript" src="plugins/forms/validate/jquery.validate.min.js"></script>
    <script type="text/javascript" src="plugins/forms/uniform/jquery.uniform.min.js"></script>

     <script type="text/javascript">
        // document ready function
        $(document).ready(function() {
            //------------- Options for Supr - admin tempalte -------------//
            var supr_Options = {
                rtl:false//activate rtl version with true
            }
            //rtl version
            if(supr_Options.rtl) {
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
                    usuario: {
                        required: true,
                        minlength: 4
                    },
                    password: {
                        required: true,
                        minlength: 6
                    }  
                },
                messages: {
                    usuario: {
                        required: "Diligencie el usuario",
                        minlength: "Minimo 4 caracteres"
                    },
                    password: {
                        required: "Digite su password",
                        minlength: "La contraseña debe ser de almenos 6 caracteres"
                    }
                }   
            });
        });
    </script> 
    </body>
</html>
