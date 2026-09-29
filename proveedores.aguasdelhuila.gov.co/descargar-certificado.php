<?php
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Mon, 21 Jul 1973 08:00:00 GMT");
	//header("Content-type:application/pdf");
	date_default_timezone_set('America/Bogota');
	require_once("funciones.php");
	require("plugins/fpdf184/fpdf.php");
	include_once("dbconnection/connections.php");
	validasesion();
	class PDF extends FPDF{
		function Header()
		{
			// Logo
			$this->Image('images/logo-aguas-del-huila.png',20,6,40);
			// Arial bold 15
			$this->SetFont('Arial','B',11);
			// Move to the right
			$this->Cell(80);
			// Title
			$this->Cell(40,10,'AGUAS DEL HUILA S.A. E.S.P',0,0,'C');
			$this->Ln(5);
			$this->Cell(202,10,'NIT. 800.100.553-2',0,0,'C');
			$this->Ln(5);
			$this->Cell(206,10,'CERTIFICADO DE PROPONENTES Y PROVEEDORES',0,0,'C');		
			/*$this->Ln(5);
			$this->Cell(206,10,utf8_decode(html_entity_decode('FECHA DE EXPEDICI&Oacute;N: '.date("Y-m-d h-i-s A"))),0,0,'C');		*/			
			// Line break
			$this->Ln(30);
			$this->Rect(10, 5, 190, 33);
			$this->Line(68, 5, 68, 38);
		}

		function Footer()
		{
			// Go to 1.5 cm from bottom
			$this->SetY(-15);
			// Select Arial italic 8
			$this->SetFont('Arial', 'I', 11);
			$this->Rect(10, 265, 190, 25);
			// Print centered page number
			$this->Cell(0, -20, utf8_decode(html_entity_decode('"Líderes en el sector de agua potable y saneamiento básico"')), 0, 0, 'C');
			$this->Ln(5);
			$this->Cell(0, -20, utf8_decode(html_entity_decode('Calle 21 No. 1C 17 - PBX: 8752321 FAX: 8751391 Neiva, Huila')), 0, 0, 'C');
			$this->Ln(5);
			$this->Cell(0, -20, utf8_decode(html_entity_decode('www.aguasdelhuila.gov.co')), 0, 0, 'C');
			//$this->Ln(5);

			//$this->Cell(0, -10, 'Page '.$this->PageNo(), 0, 0, 'C');
		}
		
	}
	$sql="select proponente_id, estado_codigo, tipo_identificacion_codigo, proponente_razonsocial, 
				proponente_nit, proponente_representante, actividad_codigo, ciiu_nombre, municipio_id, 
				proponente_direccion, proponente_telefono1, proponente_telefono2, proponente_correo, proponente_actividadinicio 
				from proponente, ciiu 
				where proponente.actividad_codigo=ciiu.ciiu_codigo
				and proponente_id=".$_REQUEST['codigo']." ";

	
	//echo $sql; return;
	$conListado=$cnx_local->_query($sql,0,0);
	$file=$conListado->_array[0]['proponente_nit'].".pdf";
	//echo $file; return;
	$pdf = new PDF();$pdf->SetMargins(20, 8);
	$pdf->AddPage();

	$pdf->SetFont('Arial','B',11);
	if($conListado->_array[0]['tipo_identificacion_codigo']=='NIT'){
		$tipopersona="PERSONA JURIDICA";
	}else{
		$tipopersona="PERSONA NATURAL";
	}
	$pdf->Cell(170,10,"DATOS DEL REGISTRO - ".$tipopersona,0,0,'C');
	$pdf->Ln(18);	

	$pdf->SetFont('Arial','',10);

	$pdf->Cell(10,10,utf8_decode("Razón Social:"),0,0,'L');
	$pdf->Ln(0);
	$pdf->SetX(70);
	$pdf->Cell(10,10,utf8_decode(html_entity_decode($conListado->_array[0]['proponente_razonsocial'], ENT_COMPAT, 'utf-8')),0,0,'L');
	$pdf->Ln(9);
	
	
	$pdf->Cell(10,10,utf8_decode("NIT: "),0,0,'L');
	$pdf->Ln(0);
	$pdf->SetX(70);	
	$pdf->Cell(10,10,utf8_decode(html_entity_decode($conListado->_array[0]['proponente_nit'], ENT_COMPAT, 'utf-8'))."",0,0,'L');
	$pdf->Ln(9);
	
	$pdf->Cell(10,10,utf8_decode("DIRECCIÓN: "),0,0,'L');
	$pdf->Ln(0);
	$pdf->SetX(70);	
	$pdf->Cell(10,10,utf8_decode(html_entity_decode($conListado->_array[0]['proponente_direccion'], ENT_COMPAT, 'utf-8'))."",0,0,'L');
	$pdf->Ln(9);

	$pdf->Cell(10,10,utf8_decode("TELÉFONO: "),0,0,'L');
	$pdf->Ln(0);
	$pdf->SetX(70);	
	$pdf->Cell(10,10,utf8_decode(html_entity_decode($conListado->_array[0]['proponente_telefono1'], ENT_COMPAT, 'utf-8'))."",0,0,'L');
	$pdf->Ln(9);

	$pdf->Cell(10,10,utf8_decode("CELULAR: "),0,0,'L');
	$pdf->Ln(0);
	$pdf->SetX(70);	
	$pdf->Cell(10,10,utf8_decode(html_entity_decode($conListado->_array[0]['proponente_telefono2'], ENT_COMPAT, 'utf-8'))."",0,0,'L');
	$pdf->Ln(10);

	$pdf->Cell(10,10,utf8_decode("EMAIL: "),0,0,'L');
	$pdf->Ln(0);
	$pdf->SetX(70);	
	$pdf->Cell(10,10,utf8_decode(html_entity_decode($conListado->_array[0]['proponente_correo'], ENT_COMPAT, 'utf-8'))."",0,0,'L');
	$pdf->Ln(9);

	$pdf->Cell(10,10,utf8_decode("REPRESENTANTE LEGAL: "),0,0,'L');
	$pdf->Ln(0);
	$pdf->SetX(70);	
	$pdf->Cell(10,10,utf8_decode(html_entity_decode($conListado->_array[0]['proponente_representante'], ENT_COMPAT, 'utf-8'))."",0,0,'L');
	$pdf->Ln(9);

	$pdf->Cell(10,10,utf8_decode("ACTIVIDAD ECONÓMICA: "),0,0,'L');
	$pdf->Ln(0);
	$pdf->SetX(70);	
	$pdf->Cell(10,10,utf8_decode(html_entity_decode($conListado->_array[0]['ciiu_nombre'], ENT_COMPAT, 'utf-8'))."",0,0,'L');
	$pdf->Ln(9);

	$pdf->Cell(10,10,utf8_decode("EXPERIENCIA DESDE: "),0,0,'L');
	$pdf->Ln(0);
	$pdf->SetX(70);	
	$pdf->Cell(10,10,utf8_decode(html_entity_decode($conListado->_array[0]['proponente_actividadinicio'], ENT_COMPAT, 'utf-8'))."",0,0,'L');
	$pdf->Ln(9);	

	header("Content-Disposition: attachment; filename=$file");
	$pdf->Output();
?>