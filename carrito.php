<?php
session_start();

// Leer el contenido del carrito desde el archivo .txt
$carritoFile = 'data/carrito.txt';
$carrito = file($carritoFile, FILE_IGNORE_NEW_LINES);

// Cargar la plantilla HTML
$plantilla = file_get_contents('carrito.html');

// Crear el listado del carrito
$listaCarrito = '';
if (empty($carrito)) {
    $listaCarrito = '<p>El carrito está vacío.</p>';
} else {
    foreach ($carrito as $index => $item) {
        // Añadir un salto de línea o espacio para separar cada producto
        $listaCarrito .= "<li>$item <form action='quitar_producto.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='indice' value='$index'>
                            <button type='submit'>Quitar</button>
                          </form></li>\n";
    }
}

// Insertar el contenido del carrito en la plantilla
$plantilla = str_replace('{{CARRITO_LIST}}', $listaCarrito, $plantilla);

// Mostrar la plantilla con datos insertados
echo $plantilla;
