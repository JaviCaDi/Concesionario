<?php
session_start();

// Obtener el coche y la marca seleccionada
$coche = $_POST['coche'];
$marca = $_POST['marca'];

// Agregar el coche al archivo del carrito
$carritoFile = 'data/carrito.txt';
file_put_contents($carritoFile, "$marca - $coche\n", FILE_APPEND);

// Redirigir de nuevo a la lista de coches de la marca
header("Location: marcas.php?marca=" . urlencode($marca));
exit();