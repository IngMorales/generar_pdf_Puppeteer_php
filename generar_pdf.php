<?php

// generar_pdf.php

// Ejecuta el script de Node.js que genera el PDF con Puppeteer
exec('node pdfGenerator.js', $output, $return_var);

// Si el retorno es 0, consideramos que fue exitoso
if ($return_var === 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $output]);
}
