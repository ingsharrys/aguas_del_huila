<?php 
	require_once("funciones.php");
	validasesion();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <title>Tabs | Supr Admin Template</title>
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
      
    <body>
        
	<?php include_once("header.php"); ?>

    <div id="wrapper">

		<div id="sidebarbg" class="hidden-lg hidden-md hidden-sm hidden-xs"></div>
        <!--Sidebar content-->
        <div id="sidebar" class="page-sidebar hidden-lg hidden-md hidden-sm hidden-xs">

            <div class="sidenav">
				<?php include_once("menu-principal.php"); ?>
            </div><!-- End sidenav -->

            <div class="sidebar-widget">

            </div><!-- End .sidenav-widget -->

            <div class="sidebar-widget">

            </div><!-- End .sidenav-widget -->

            <div class="sidebar-widget">

            </div><!-- End .sidenav-widget -->

            <div class="sidebar-widget">

            </div><!-- End .sidenav-widget -->

        </div><!-- End #sidebar -->


        <!--Body content-->
        <div id="content" class="page-content clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">

                    <h3>Escritorio</h3>                    

                    <!--<div class="resBtnSearch">
                        <a href="#"><span class="icon16 icomoon-icon-search-3"></span></a>
                    </div>

                    <div class="search">

                        <form id="searchform" action="search.html">
                            <input type="text" id="tipue_search_input" class="top-search" placeholder="Search here ..." />
                            <input type="submit" id="tipue_search_button" class="search-btn" value=""/>
                        </form>
                
                    </div>
                    
                    <ul class="breadcrumb">
                        <li>You are here:</li>
                        <li>
                            <a href="#" class="tip" title="back to dashboard">
                                <span class="icon16 icomoon-icon-screen-2"></span>
                            </a> 
                            <span class="divider">
                                <span class="icon16 icomoon-icon-arrow-right-3"></span>
                            </span>
                        </li>
                        <li class="active">Dashboard</li>
                    </ul>-->

                </div><!-- End .heading-->


                <div class="row">

                    <div class="col-lg-8">
                        <!--<div class="panel panel-default calendar gradient">
                            <div class="panel-heading">
                                <h4>
                                    <span class="icon16 icomoon-icon-calendar"></span>
                                    <span>Agenda</span>
                                </h4>
                                
                            </div>
                            <div class="panel-body noPad"> 
                                <div id="calendar">
                                </div>
                            </div>

                        </div>--><!-- End .panel -->  
                    </div><!-- End .span8 --> 

                    <div class="col-lg-4">

                        <div class="todo">
                            <!--<h4>Últimos Proveedores Registrados<a href="#" class="icon tip" title="Ver más"><span class="icon16 icomoon-icon-plus"></span></a></h4>
                            <ul>
                                <li class="clearfix">
                                    <div class="txt">
                                        Pepito Perez
                                        <span class="by badge">SALUDCOOP</span>
                                        <span class="date label label-danger">Hoy</span>
                                    </div>
                                    <div class="controls">
                                        <a href="#" title="Remove task" class="tip"><span class="icon12 icomoon-icon-eye"></span></a>
                                    </div>
                                </li>
                                
                            </ul>-->
                        </div>

                    </div><!-- End .span4 -->


                </div><!-- End .row -->
                
            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    
		<div id="footer" class="clearfix sidebar-page right-sidebar-page">
			<!-- Start #footer  -->
			<p class="pull-left">
				Desarrollado por <a href="#" class="color-blue strong" target="_blank"></a>Click Masivo SAS - Todos los derechos reservados.
			</p>
			<p class="pull-right">
				<a href="#" class="mr5">Soporte</a>
				|
				<a href="#" class="ml5 mr25">Manual</a>
			</p>
		</div>
	
	
    </div><!-- End #wrapper -->
    
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
        <script src="js/jquery.supr.js"></script>
        <script src="js/main.js"></script>
        <script src="js/pages/tabs.js"></script>
		<script type="text/javascript" src="js/portalsalud.js"></script>

    </body>
</html>
