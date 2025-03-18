<?php
// index.php
include 'conexion.php';

// Consulta a la base de datos
$stmt = $pdo->query('SELECT documento, nombres, apellidos FROM usuario');
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #f2f2f2;
        }
        .container {
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: #fff;
        }
        button {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            display: block;
            margin: 0 auto;
        }
        button:hover {
            background-color: #218838;
        }
        #mensaje {
            text-align: center;
            margin-top: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Reporte de Usuarios</h1>
        <table>
            <thead>
                <tr>
                    <th>Documento</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['documento']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['nombres']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['apellidos']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button id="btnGenerar">Generar PDF</button>
        <div id="mensaje"></div>
    </div>

    <script>
        document.getElementById('btnGenerar').addEventListener('click', function() {
            document.getElementById('mensaje').textContent = 'Generando PDF, por favor espere...';
            fetch('generar_pdf.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('mensaje').innerHTML = 'PDF generado correctamente. <a href="reporte.pdf" target="_blank">Descargar PDF</a>';
                    } else {
                        document.getElementById('mensaje').textContent = 'Error al generar el PDF.';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('mensaje').textContent = 'Error al generar el PDF.';
                });
        });
    </script>
</body>
</html>
