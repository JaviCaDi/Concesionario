<?php
session_start();

// Leer las marcas desde el archivo .txt
$marcasFile = 'data/marcas.txt';
$marcas = file($marcasFile, FILE_IGNORE_NEW_LINES);

// Cargar la plantilla HTML
$plantilla = file_get_contents('marcas.html');

// Crear el listado de marcas dinámicamente
$listaMarcas = '';
foreach ($marcas as $marca) {
    $listaMarcas .= "<li>$marca <a href='marcas.php?marca=" . urlencode($marca) . "'>Ver Modelos</a></li>";
}

// Insertar el listado en la plantilla
$plantilla = str_replace('{{MARCA_LIST}}', $listaMarcas, $plantilla);

// Mostrar la plantilla con datos insertados
echo $plantilla;
