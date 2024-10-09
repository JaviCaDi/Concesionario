<?php
session_start();

// Obtener el índice del producto a eliminar
if (isset($_POST['indice'])) {
    $indice = (int)$_POST['indice'];

    // Leer el contenido actual del carrito
    $carritoFile = 'data/carrito.txt';
    $carrito = file($carritoFile, FILE_IGNORE_NEW_LINES);

    // Eliminar el producto en el índice proporcionado
    if (isset($carrito[$indice])) {
        unset($carrito[$indice]);
        // Reindexar el arreglo para mantener los índices secuenciales
        $carrito = array_values($carrito);

        // Guardar el nuevo contenido del carrito en el archivo
        file_put_contents($carritoFile, implode(PHP_EOL, $carrito));
    }
}

// Redirigir de vuelta a la página del carrito
header("Location: carrito.php");
exit();