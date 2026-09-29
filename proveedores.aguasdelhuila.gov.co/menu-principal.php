<?php 
	require_once("funciones.php");
	validasesion();
?>
<div class="sidebar-inner">
	<!-- Start .sidebar-scrollarea -->
	<div class="sidebar-scrollarea">
		<div class="sidenav">
			<div class="sidebar-widget mb0">
				<h6 class="title mb0">Navigation</h6>
			</div>
			<!-- End .sidenav-widget -->
			
			<?php if($_SESSION['sessionPerfil']==1){ ?>
				<div class="mainnav">
					<ul>
                        <li><a href="dashboard.php"><span class="icon16 icomoon-icon-home"></span>Dashboard</a></li>
                        <li>
                            <a href="#"><span class="icon16 icomoon-icon-table-2"></span>Proveedores</a>
                            <ul class="sub">
                                <li><a href="proveedores.php"><span class="icon16 icomoon-icon-arrow-right-3"></span>Listado de Proveedores</a></li>
                                <!--<li><a href="genera-certificado.php"><span class="icon16 icomoon-icon-arrow-right-3"></span>Generar Certificado</a></li>-->
                            </ul>
                        </li>
                        <li>
                            <a href="#"><span class="icon16 icomoon-icon-table-2"></span>Procesos</a>
                            <ul class="sub">
                                <li><a href="procesos.php"><span class="icon16 icomoon-icon-arrow-right-3"></span>Listado de Procesos</a></li>
                                <!--<li><a href="genera-certificado.php"><span class="icon16 icomoon-icon-arrow-right-3"></span>Generar Certificado</a></li>-->
                            </ul>
                        </li>
                        <!--<li><a href="usuarios.php"><span class="icon16 icomoon-icon-user"></span>Usuarios</a></li>
                        <li>
                            <a href="widgets.html"><span class="icon16 icomoon-icon-cube"></span>Widgets<span class="notification green">35</span></a>
                        </li>-->
                        
                        <!--<li>
                            <a href="#"><span class="icon16 icomoon-icon-list"></span>Informes</a>
                            <ul class="sub">
                                <li><a href="hl7.php"><span class="icon16 icomoon-icon-arrow-right-3"></span>Reporte HL7</a></li>
                                <li><a href="historiapdf.php"><span class="icon16 icomoon-icon-arrow-right-3"></span>Historia en PDF</a></li>
                            </ul>
                        </li>-->
                        <!--<li>
                            <a href="#"><span class="icon16 icomoon-icon-list"></span>Parametrización</a>
                            <ul class="sub">
                                <li><a href="eps.php"><span class="icon16 icomoon-icon-arrow-right-3"></span>EPS</a></li>
                                <li><a href="religion.php"><span class="icon16 icomoon-icon-arrow-right-3"></span>Religion</a></li>
                                <li><a href="especialidad.php"><span class="icon16 icomoon-icon-arrow-right-3"></span>Especialidades</a></li>
                                <li><a href="ciudad.php"><span class="icon16 icomoon-icon-arrow-right-3"></span>Ciudades</a></li>
                                <li><a href="departamento.php"><span class="icon16 icomoon-icon-arrow-right-3"></span>Departamentos</a></li>
                                <li><a href="tipoidentificacion.php"><span class="icon16 icomoon-icon-arrow-right-3"></span>Tipo Identificación</a></li>
                                <li><a href="ocupacion.php"><span class="icon16 icomoon-icon-arrow-right-3"></span>Ocupaciones</a></li>
                                <li><a href="sexo.php"><span class="icon16 icomoon-icon-arrow-right-3"></span>Sexos</a></li>
                                <li><a href="tipoafiliado.php"><span class="icon16 icomoon-icon-arrow-right-3"></span>Tipo Afiliado</a></li>
                            </ul>
                        </li>-->
                    </ul>
				</div>
			<?php } ?>
			<?php if($_SESSION['sessionPerfil']==3){ ?>
				<div class="mainnav">
					<ul>
                    <li><a href="dashboard.php"><span class="icon16 icomoon-icon-home"></span>Dashboard</a></li>
                        <li><a href="datos-proveedor.php"><span class="icon16 icomoon-icon-table-2"></span>Datos de Proveedor</a></li>
                                <!--<li><a href="genera-certificado.php"><span class="icon16 icomoon-icon-arrow-right-3"></span>Generar Certificado</a></li>-->
                        </li>
                    </ul>
				</div>
			<?php } ?>
			

			
		</div>
	</div>
</div><!-- End sidenav -->
					