    <div id="header">
        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="dashboard.php"><img src="images/logo-aguas-del-huila-gobernacion-del-huila.jpg" width="176" height="65" alt="Portalsalud.co" /></a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon16 icomoon-icon-arrow-4"></span>
                </button>
        </div> 
            <div id="navbar-no-collapse" class="navbar-no-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <!--Sidebar collapse button-->
                        <a href="#" class="collapseBtn leftbar"><i class="s16 minia-icon-list-3"></i></a>
                    </li>				
                    <li class="active">
                        <a href="dashboard.html"><span class="icon16 icomoon-icon-screen-2"></span> <span class="txt">Escritorio</span></a>
                    </li>
                    <!--<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="icon16 icomoon-icon-cog"></span><span class="txt"> Configuración</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="menu">
                                <ul>
                                    <li><a href="#"><span class="icon16 icomoon-icon-equalizer"></span>Horarios de Atención</a></li>
                                    <li><a href="#"><span class="icon16 icomoon-icon-wrench"></span>Plugins</a></li>
                                    <li><a href="#"><span class="icon16 icomoon-icon-image-2"></span>Themes</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>-->
                    
                </ul>
              
                <ul class="nav navbar-right usernav">
                    <!--<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="icon16 icomoon-icon-bell"></span><span class="notification">3</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="menu">
                                <ul class="notif">
                                	<?php echo notificaciones(); ?>
                                </ul>
                            </li>
                        </ul>
                    </li>-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="txt"><?php echo nombreusuario(); ?></span>
                            <b class="caret"></b>
                        </a>
                  <ul class="dropdown-menu">
                            <li class="menu">
                                <ul>
                                    <li><a href="editar-perfil.php"><span class="icon16 icomoon-icon-user-plus"></span>Editar Perfil</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="exit.php"><span class="icon16 icomoon-icon-exit"></span><span class="txt"> Salir</span></a></li>
                </ul>
            </div><!-- /.nav-collapse -->
        </nav><!-- /navbar --> 

    </div><!-- End #header -->
