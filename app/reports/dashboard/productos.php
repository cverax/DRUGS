<?php
require('../../helpers/report.php');
require('../../models/productos.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Productos por categoría');

// Se instancia el módelo Categorías para obtener los datos.
$categoria = new Productos;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataCategorias = $categoria->readCategoria()) {
    // Se recorren los registros ($dataCategorias) fila por fila ($rowCategoria).
    foreach ($dataCategorias as $rowCategoria) {
        // Se establece un color de relleno para mostrar el nombre de la categoría.
        $pdf->SetFillColor(170);
        // Se establece la fuente para el nombre de la categoría.
        $pdf->SetFont('Times', 'B', 12);
        // Se imprime una celda con el nombre de la categoría.
        $pdf->Cell(193, 10, utf8_decode('Categoría: '.$rowCategoria['categoria']), 1, 1, 'C', 1);
        // Se establece la categoría para obtener sus productos, de lo contrario se imprime un mensaje de error.
        if ($categoria->setCategoria($rowCategoria['categoria'])) {
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataProductos = $categoria->readProductos()) {
                // Se establece un color de relleno para los encabezados.
                $pdf->SetFillColor(225);
                $pdf->SetFont('Arial', 'B', 11);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(193, 10, utf8_decode('Producto'), 1, 0, 'C', 1);
                $pdf->Ln();
                // Se establece la fuente para los datos de los productos.
                // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                foreach ($dataProductos as $rowProducto) {
                    // Se imprimen las celdas con los datos de los productos.
                    $pdf->Cell(193, 10, utf8_decode($rowProducto['nombreproducto']), 1, 0);
                    $pdf->Ln();
                }   
            } else {
                $pdf->SetFont('Arial', '', 11);
                $pdf->Cell(193, 20, utf8_decode('                        '.'                            '.' No hay productos registrados para esta categoría'), 1, 1);
            }
            }
}
} else {
$pdf->Cell(0, 10, utf8_decode('No hay productos para mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>