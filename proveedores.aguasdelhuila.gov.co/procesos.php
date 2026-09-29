<?php 
	require_once("funciones.php");
	validasesion();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <title>Procesos | Aguas del Huila S.A. E.S.P.</title>
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

					<h3>Procesos</h3>                    

                </div><!-- End .heading-->

                    <div class="row">

					
                        <div class="col-lg-12">

                            <div class="panel panel-default toggle">

                                <div class="panel-heading">
                                    <h4 class="panel-title">Datos del Proceso</h4>
                                </div>
                                <div class="panel-body pt0 pb0">
                                    
                                    <form class="form-horizontal group-border stripped" id="frmDatos" name="frmDatos" action="php/grabar-proceso.php" method="post" role="form" >
									<div class="row"><div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="required">Código Proceso *</label>
                                            <div class="col-lg-4">
												<input type="hidden" id="codigo" name="codigo" value="0" />
                                                <input type="text" class="form-control" id="codigoproceso" name="codigoproceso" />
                                            </div>
                                            <label class="col-lg-2 control-label" for="required">Tipo Proceso *</label>
                                            <div class="col-lg-4">
                                                <select class="form-control" id="tipoproceso" name="tipoproceso">
													<option value="">Seleccione</option>
													<?php selectGenerate("tipoproceso","", ""); ?>												
												</select>
                                            </div>

                                        </div><!-- End .form-group  -->										

                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="required">Objeto Proceso *</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="objetoproceso" name="objetoproceso" />
                                            </div>

                                        </div><!-- End .form-group  -->	

                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="required">Valor Contrato *</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="valorcontrato" name="valorcontrato" />
                                            </div>
                                            <label class="col-lg-2 control-label" for="required">Fecha Proceso *</label>
                                            <div class="col-lg-4">
                                                <input class="form-control" id="fechaproceso" name="fechaproceso" />
                                            </div>
                                        </div><!-- End .form-group  -->			

                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="required">Link SECOP *</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="linksecop" name="linksecop" />
                                            </div>

                                        </div><!-- End .form-group  -->	

                                        
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="required">Tipo Contrato *</label>
                                            <div class="col-lg-4">
                                                <select class="form-control" id="tipocontrato" name="tipocontrato">
													<option value="">Seleccione</option>
													<?php selectGenerate("tipocontrato","", ""); ?>														
												</select>
                                            </div>
                                            <label class="col-lg-2 control-label" for="required">Estado Contrato *</label>
                                            <div class="col-lg-4">
                                                <select class="form-control" id="estadocontrato" name="estadocontrato">
													<option value="">Seleccione</option>	
                                                    <?php selectGenerate("estadocontrato","", ""); ?>												
												</select>
                                            </div>
                                        </div><!-- End .form-group  -->		
                                        
                                        

										
										
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="required"></label>
                                            <div class="col-lg-4">
                                                
                                            </div>                                         
											<div class="col-lg-4 col-lg-offset-2">
	                                            <button type="button" id="btn-consulta" class="btn btn-primary marginR10">Consultar</button>
                                                <button type="submit" class="btn btn-default marginR10">Grabar</button>
                                                <button type="reset" id="btn-reset" class="btn btn-danger">Limpiar</button>
                                            </div>
                                        </div><!-- End .form-group  -->      
									</div></div>
									
                                    </form>                                    
                                    
                                </div>

                            </div><!-- End .panel -->

                        </div><!-- End .span4 -->					

                        <div class="col-lg-12">

                            <div class="panel panel-default toggle panelMove panelClose panelRefresh">
                                <!-- Start .panel -->
                                <div class="panel-heading">
                                    <h4 class="panel-title">Listado de Procesos</h4>
                                </div>
                                <div class="panel-body">
                                    <table id="table-ajax-defer" class="table table-striped table-bordered display" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Objeto</th>
												<th>Valor</th>
												<th>Contrato</th>
												<th>Fecha</th>
                                                <th>Editar</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Código</th>
                                                <th>Objeto</th>
												<th>Valor</th>
												<th>Fecha</th>
                                                <th>Editar</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
						
						
                        </div><!-- End .span8 -->



                    </div><!-- End .row -->

                
            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    
    </div><!-- End #wrapper -->
    
    
    <!-- Modal detalle proceso -->
<div class="modal fade" id="mdlProceso" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Proceso <span id="mdl-codigo"></span></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <table class="table table-striped">
          <tbody>
              
            <tr><th>Objeto</th> <td id="mdl-objeto"></td></tr>
            <tr><th>Valor</th>  <td id="mdl-valor"></td></tr>
            <tr><th>Estado</th> <td id="mdl-estado"></td></tr>
            <tr><th>Fecha</th>  <td id="mdl-fecha"></td></tr>
          </tbody>
        </table>
<p>Estimado interesado, en cumplimiento de la Ley 2195 de 2022 Art 53 mediante el cual se
adiciona el Art 13 de la Ley 1150 de 2007, el presente contrato se encuentra publicado en el
SECOPII y que podrá acceder a través del siguiente Botón</p>
        <a id="mdl-secop" class="btn btn-primary" href="#" target="_blank">
          Ver en SECOP
        </a>
      </div>
    </div>
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
        <script src="js/main.js"></script>
        <script src="js/pages/tabs.js"></script>
        <script src="plugins/forms/spinner/jquery.bootstrap-touchspin.js"></script>
        <script src="plugins/forms/maskedinput/jquery.maskedinput-1.3.min.js"></script>		
        <script src="plugins/forms/bootstrap-datepicker/bootstrap-datepicker.js"></script>
        <script src="plugins/forms/bootstrap-timepicker/bootstrap-timepicker.js"></script>
		

		<script type="text/javascript" src="js/portalsalud.js"></script>
<script>


$(document).ready(function() {
var selected = [];
var ciudadc = 0;

$("#fechaproceso").datepicker({format: 'yyyy-mm-dd'});

    /*var miTabla=$("#table-ajax-defer").dataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "php/listado-pacientes.php",
        "rowCallback": function( row, data ) {
            if ( $.inArray(data.DT_RowId, selected) !== -1 ) {
                $(row).addClass('selected');
            }
        }
    });*/
	
var miTabla = $('#table-ajax-defer').DataTable({
  ajax: { url: 'php/listado-procesos.php', type: 'POST' },
  deferRender: true,
  ordering: false,
  language: { search:"", lengthMenu:"<span>_MENU_</span>" }
});

$('#table-ajax-defer').on('xhr.dt', function(e,settings,json){
  console.log('Respuesta listado‑procesos.php →', json);
});

/* —— Abrir modal —— */
$('#table-ajax-defer').on('click', '.lnk-codigo', function (e) {
    e.preventDefault();

    const $lnk = $(this);

    $('#mdl-codigo').text($lnk.data('codigo'));
    $('#mdl-objeto').text($lnk.data('objeto'));
    $('#mdl-valor').text($lnk.data('valor'));
    $('#mdl-estado').text($lnk.data('estado'));
    $('#mdl-fecha').text($lnk.data('fecha'));

    $('#mdl-secop').attr(
      'href',
      'https://www.contratos.gov.co/consultas/detalleProceso.do?numConstancia=' + $lnk.data('secop')
    );

    $('#mdlProceso').modal('show');
});


 
 	function consultaFormulario(filtro){
		$.ajax({
			type: "POST",
			url: "php/consulta-procesos.php",
			data: filtro,
			dataType:"json",
			success: function(response){	
				$.each(response, function(index, value) {
					if(index=="id" && value=="0"){
						mensajeRegistro("noexiste");
					}
					if(index=="ciudad"){
						ciudadc=value;
					}
					$('#'+index+'', '#frmDatos').val(value);
				});
				$('#departamento').trigger('change');
				$('#ciudad').val(ciudadc);
			}   			
		});
	}

	function eliminaRegistro(filtro){
		$.ajax({
			type: "POST",
			url: "php/eliminar-proveedor.php",
			data: filtro,
			success: function(response){	
				mensajeRegistro("eliminado");
				miTabla.fnReloadAjax();
				
				if($("#codigo").val()==filtro.codigo){
					$("#frmDatos").each (function(){
						this.reset();
					});
					$("#codigo").val(0);
				}
			}   			
		});
	}

    $('#table-ajax-defer tbody').on('click', '.btn-eliminar', function () {
		var item=$(this);
        bootbox.confirm({
            message: "Confirme por favor",
            title: "¿Esta seguro que desea eliminar este registro?",
            callback: function(result) {
                //callback result
				if(result==true){
					eliminaRegistro({"codigo":item.attr("data-value")});
				}else{
					//
				}
            }
        });		
	});

 

    $('#table-ajax-defer tbody').on('click', '.btn-editar', function () {
        var id = this.id;
        var index = $.inArray(id, selected);
				
        if ( $(this).parents("tr").hasClass('selected') ) {
            $(this).parents("tr").removeClass('selected');
        }
        else {
            miTabla.$('tr.selected').removeClass('selected');
            $(this).parents("tr").addClass('selected');
        }	

		consultaFormulario({"codigo":$(this).attr("data-value")});
		
    } );

	
	$("#btn-consulta").click(function(){
		consultaFormulario($.param($("#frmDatos").serializeArray()));
	});	
	
	$("#btn-reset").click(function(){
		$("#codigo").val(0);
	});	

	
		$("#frmDatos").boostrapvalidate({
			sendType: "ajax",
			errorClass: "has-error",
			beforeSubmit: function(){
				//alert("antes");
			},
			completeSubmit: function(response){
				if(response=='editado'){
					mensajeRegistro("actualizado");
				}else if(parseInt(response)>0){
					$('#codigo').val(response);
					mensajeRegistro("adicionado");
				}else{
					mensajeRegistro("noactualizado");
				}
				
                miTabla.fnReloadAjax();
				
				/*$("#contactos-frm").each (function(){
				    this.reset();
				});*/
				          
			},
			fields: [
				    {
				        "name" : "codigoproceso",
				        "required" : true,
				        "datatype" : "alphanumeric",
				        "mask": "",
				        "minvalue" : "",
				        "maxvalue" : "",
				        "minlength" : "1",
				        "maxlength" : "20",
                        "equalto" : ""
				    },
				    {
				        "name" : "tipoproceso",
				        "required" : true,
				        "datatype" : "numeric",
				        "mask": "",
				        "minvalue" : "",
				        "maxvalue" : "",
				        "minlength" : "4",
				        "maxlength" : "255",
                        "equalto" : ""
				    },
                    {
				        "name" : "objetoproceso",
				        "required" : true,
				        "datatype" : "alphanumeric",
				        "mask": "",
				        "minvalue" : "",
				        "maxvalue" : "",
				        "minlength" : "5",
				        "maxlength" : "512",
                        "equalto" : ""
				    },
				    {
				        "name" : "valorcontrato",
				        "required" : true,
				        "datatype" : "numeric",
				        "mask": "",
				        "minvalue" : "",
				        "maxvalue" : "",
				        "minlength" : "1",
				        "maxlength" : "255",
                        "equalto" : ""
				    },
				    {
				        "name" : "fechaproceso",
				        "required" : true,
				        "datatype" : "date",
				        "mask": "",
				        "minvalue" : "",
				        "maxvalue" : "",
				        "minlength" : "1",
				        "maxlength" : "255",
                        "equalto" : ""
				    },
				    {
				        "name" : "linksecop",
				        "required" : true,
				        "datatype" : "alphanumeric",
				        "mask": "",
				        "minvalue" : "",
				        "maxvalue" : "",
				        "minlength" : "5",
				        "maxlength" : "1024",
                        "equalto" : ""
				    },
				    {
				        "name" : "tipocontrato",
				        "required" : true,
				        "datatype" : "alphanumeric",
				        "mask": "",
				        "minvalue" : "",
				        "maxvalue" : "",
				        "minlength" : "5",
				        "maxlength" : "32",
                        "equalto" : ""
				    },
				    {
				        "name" : "estadocontrato",
				        "required" : true,
				        "datatype" : "alphanumeric",
				        "mask": "",
				        "minvalue" : "",
				        "maxvalue" : "",
				        "minlength" : "5",
				        "maxlength" : "32",
                        "equalto" : ""
				    }
			]
		});        
	

});

//sparkline in sidebar area
var positive = [1,5,3,7,8,6,10];
var negative = [10,6,8,7,3,5,1]
var negative1 = [7,6,8,7,6,5,4]

$('#stat1').sparkline(positive,{
    height:15,
    spotRadius: 0,
    barColor: '#9FC569',
    type: 'bar'
});
$('#stat2').sparkline(negative,{
    height:15,
    spotRadius: 0,
    barColor: '#ED7A53',
    type: 'bar'
});
$('#stat3').sparkline(negative1,{
    height:15,
    spotRadius: 0,
    barColor: '#ED7A53',
    type: 'bar'
});
$('#stat4').sparkline(positive,{
    height:15,
    spotRadius: 0,
    barColor: '#9FC569',
    type: 'bar'
});
//sparkline in widget
$('#stat5').sparkline(positive,{
    height:15,
    spotRadius: 0,
    barColor: '#9FC569',
    type: 'bar'
});

$('#stat6').sparkline(positive, { 
    width: 70,//Width of the chart - Defaults to 'auto' - May be any valid css width - 1.5em, 20px, etc (using a number without a unit specifier won't do what you want) - This option does nothing for bar and tristate chars (see barWidth)
    height: 20,//Height of the chart - Defaults to 'auto' (line height of the containing tag)
    lineColor: '#88bbc8',//Used by line and discrete charts to specify the colour of the line drawn as a CSS values string
    fillColor: '#f2f7f9',//Specify the colour used to fill the area under the graph as a CSS value. Set to false to disable fill
    spotColor: '#e72828',//The CSS colour of the final value marker. Set to false or an empty string to hide it
    maxSpotColor: '#005e20',//The CSS colour of the marker displayed for the maximum value. Set to false or an empty string to hide it
    minSpotColor: '#f7941d',//The CSS colour of the marker displayed for the mimum value. Set to false or an empty string to hide it
    spotRadius: 3,//Radius of all spot markers, In pixels (default: 1.5) - Integer
    lineWidth: 2//In pixels (default: 1) - Integer
});		
</script>		
    </body>
</html>
