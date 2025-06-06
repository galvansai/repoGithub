<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $domicilio = $_POST['domicilio'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $email = $_POST['email'] ?? '';

    if ($nombre && $apellido && $domicilio && $telefono && $email) {
        // Creamos la carpeta datos si no existe
        if (!is_dir('datos')) {
            mkdir('datos', 0777, true);
        }

        // Preparamos la línea a guardar
        $linea = "$nombre, $apellido, $domicilio, $telefono, $email" . PHP_EOL;
        $archivo = 'datos/registro.txt';

        if (file_put_contents($archivo, $linea, FILE_APPEND | LOCK_EX) !== false) {
            echo json_encode([
                'estado' => 'ok',
                'mensaje' => 'Registro exitoso. ¡Gracias ' . htmlspecialchars($nombre) . '!'
            ]);
        } else {
            echo json_encode([
                'estado' => 'error',
                'mensaje' => 'Error al guardar los datos. Intente más tarde.'
            ]);
        }
    } else {
        echo json_encode([
            'estado' => 'error',
            'mensaje' => 'Todos los campos son obligatorios.'
        ]);
    }
} else {
    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'Petición inválida.'
    ]);
}