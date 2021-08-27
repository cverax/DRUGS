<?php
require('../../helpers/report.php');
require('../../models/registro.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Registro de entradas y salidas');

// Se instancia el módelo Categorías para obtener los datos.
$categoria = new entradasalida;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataCategorias = $categoria->readAll()) {
        // Se establece un color de relleno para mostrar el nombre de la categoría.
        $pdf->SetFillColor(175);
        // Se establece la fuente para el nombre de la categoría.
        $pdf->SetFont('Times', 'B', 12);
        // Se imprime una celda con el nombre de la categoría.
        $pdf->Cell(0, 10, utf8_decode('Entradas y salidas de productos'), 1, 1, 'C', 1);
        // Se establece la categoría para obtener sus productos, de lo contrario se imprime un mensaje de error.
 
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataProductos = $categoria->readProductosCategoria()) {
                // Se establece un color de relleno para los encabezados.
                $pdf->SetFillColor(225);
                // Se establece la fuente para los encabezados.
                $pdf->SetFont('Times', 'B', 11);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(50, 10, utf8_decode('VTA'), 1, 0, 'C', 1);
                $pdf->Cell(45, 10, utf8_decode('Documento'), 1, 0, 'C', 1);
                $pdf->Cell(65, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
                $pdf->Cell(26, 10, utf8_decode('Cantidad'), 1, 1, 'C', 1);
                // Se establece la fuente para los datos de los productos.
                $pdf->SetFont('Times', '', 11);
                // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                foreach ($dataProductos as $rowProducto) {
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->Cell(50, 10, utf8_decode($rowProducto['vta']), 1, 0);
                    $pdf->Cell(45, 10, $rowProducto['documentos'], 1, 0);
                    $pdf->Cell(65, 10, $rowProducto['nombreproducto'], 1, 0);
                    $pdf->Cell(26, 10, $rowProducto['cantidad'], 1, 1);
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay productos para esta categoría'), 1, 1);
            }
} else {
    $pdf->Cell(0, 10, utf8_decode('No hay categorías para mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>