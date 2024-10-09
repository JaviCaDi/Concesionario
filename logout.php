<?php
session_start();

// Limpiar el contenido de carrito.txt
$carritoFile = 'data/carrito.txt';
if (file_exists($carritoFile)) {
    file_put_contents($carritoFile, ''); // Vaciar el archivo
}

include "../Login/login.php";

logout();

// Redirigir al usuario al index o a la página de inicio
header("Location: /Servidor/Primer/Concesionario/login/login.html");
exit();