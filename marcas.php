<?php
session_start();

// Obtener la marca seleccionada
$marca = $_GET['marca'];

// Archivo de coches para la marca seleccionada
$cochesFile = 'data/' . $marca . '.txt';

// Verificar si el archivo de coches existe
if (file_exists($cochesFile)) {
    $cochesMarca = file($cochesFile, FILE_IGNORE_NEW_LINES);
} else {
    $cochesMarca = [];
}

// Cargar la plantilla HTML
$plantilla = file_get_contents('coches.html');

// Crear el listado de coches
$listaCoches = '';
foreach ($cochesMarca as $coche) {
    $listaCoches .= "<li>$coche <form action='comprar.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='coche' value='$coche'>
                        <input type='hidden' name='marca' value='$marca'>
                        <button type='submit'>Comprar</button>
                    </form></li>";
}

// Insertar el listado de coches en la plantilla
$plantilla = str_replace('{{COCHE_LIST}}', $listaCoches, $plantilla);
$plantilla = str_replace('{{MARCA}}', $marca, $plantilla);

// Mostrar la plantilla con datos insertados
echo $plantilla;