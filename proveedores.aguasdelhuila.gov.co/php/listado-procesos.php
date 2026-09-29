<?php
require_once("../funciones.php");
include("../dbconnection/connections.php");
validasesion();

header('Content-Type: application/json; charset=utf-8');

/* ── Consulta: solo columnas existentes ─────────────────────────────────── */
$sql = "
    SELECT  proceso_codigo,
            proceso_objeto,
            proceso_link_secop,
            proceso_valor,
            proceso_fecha,
            estado_contrato_codigo
    FROM proceso
    ORDER BY proceso_fecha DESC
";
$conListado = $cnx_local->_query($sql, 0, 0);

/* ── Construcción del JSON ─────────────────────────────────────────────── */
$data = [];

if ($conListado->_nreg > 0) {
    foreach ($conListado->_array as $row) {
        $codigo  = addslashes($row['proceso_codigo']);          // id único
        $objeto  = addslashes($row['proceso_objeto']);
        $valor   = number_format($row['proceso_valor']);
        $estado  = addslashes($row['estado_contrato_codigo']);
        $fecha   = $row['proceso_fecha'];
        $secop   = addslashes($row['proceso_link_secop']);

        /* Enlace interno que abre el modal */
        $linkCodigo = "<a href='#' class='lnk-codigo'
                           data-codigo=\"$codigo\"
                           data-objeto=\"$objeto\"
                           data-valor=\"$valor\"
                           data-estado=\"$estado\"
                           data-fecha=\"$fecha\"
                           data-secop=\"$secop\">$codigo</a>";

        /* Botones */
        $btnEditar   = "<button data-value=\"$codigo\" class='btn btn-primary btn-sm mr5 mb10 btn-editar'>Editar</button>";
        $btnEliminar = "<button data-value=\"$codigo\" class='btn btn-danger  btn-sm mr5 mb10 btn-eliminar'>Eliminar</button>";

        /* Fila (7 columnas, mismo número que tus <th>) */
        $data[] = [
            $linkCodigo,         // 0 Código
            $objeto,             // 1 Objeto
            $valor,              // 2 Valor
            $estado,             // 3 Estado
            $fecha,              // 4 Fecha
            $btnEditar,          // 5 Editar
            $btnEliminar         // 6 Eliminar
        ];
    }
} else {
    $data[] = ["No hay Datos, ingrese procesos en el formulario","","","","","",""];
}

echo json_encode(["data" => $data], JSON_UNESCAPED_UNICODE);

/* Depuración opcional */
error_log("listado-procesos filas devueltas = ".$conListado->_nreg);
?>
