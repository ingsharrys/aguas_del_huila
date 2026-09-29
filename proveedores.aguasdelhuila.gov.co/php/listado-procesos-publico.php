<?php
require_once("../funciones.php");
include("../dbconnection/connections.php");
//validasesion();   // público

header('Content-Type: application/json; charset=utf-8');

/* ── Consulta ────────────────────────────────────────────────────────── */
$sql = "
  SELECT  proceso_codigo,
          proceso_objeto,
          proceso_link_secop,
          proceso_valor,
          DATE_FORMAT(proceso_fecha,'%Y-%m-%d') AS proceso_fecha,
          tp.tipo_proceso_nombre,
          ec.estado_contrato_nombre
  FROM proceso p
  JOIN tipo_proceso    tp ON p.tipo_proceso_codigo    = tp.tipo_proceso_codigo
  JOIN estado_contrato ec ON p.estado_contrato_codigo = ec.estado_contrato_codigo
  ORDER BY p.proceso_fecha DESC
";
$res = $cnx_local->_query($sql, 0, 0);

/* ── Armar array $data ───────────────────────────────────────────────── */
$data = [];

foreach ($res->_array as $r) {

    // Valores seguros para HTML
    $codigo = htmlspecialchars($r['proceso_codigo'], ENT_QUOTES, 'UTF-8');
    $objeto = htmlspecialchars($r['proceso_objeto'], ENT_QUOTES, 'UTF-8');
    $tipo   = htmlspecialchars($r['tipo_proceso_nombre'], ENT_QUOTES, 'UTF-8');
    $estado = htmlspecialchars($r['estado_contrato_nombre'], ENT_QUOTES, 'UTF-8');

    // Valor numérico con separador de miles
    $valor  = number_format($r['proceso_valor'], 0, ',', '.');

    // Fecha
    $fecha  = $r['proceso_fecha'];

    // Enlace interno que abrirá el modal
    $link = "<a href='#' class='lnk-codigo'
               data-codigo=\"$codigo\"
               data-fecha=\"$fecha\"
               data-objeto=\"$objeto\"
               data-valor=\"$valor\"
               data-tipo=\"$tipo\"
               data-estado=\"$estado\"
               data-secop=\"{$r['proceso_link_secop']}\">$codigo</a>";

    // Fila (6 columnas)
    $data[] = [$link, $fecha, $objeto, $valor, $tipo, $estado];
}

if (empty($data)) {
    $data[] = ["No hay Datos", "", "", "", "", ""];
}

/* ── Salida JSON ─────────────────────────────────────────────────────── */
echo json_encode(['data' => $data], JSON_UNESCAPED_UNICODE);
