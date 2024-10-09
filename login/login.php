<?php
// Verificar si la solicitud se ha hecho mediante el método POST (es decir, cuando el usuario envía el formulario)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el nombre de usuario y la contraseña enviados desde el formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Definir el archivo que contiene los usuarios registrados
    $archivo = 'usuarios.txt';
    
    // Leer el contenido del archivo 'usuarios.txt' en un array, donde cada línea será un elemento del array
    $usuarios = file($archivo, FILE_IGNORE_NEW_LINES);

    $usuarioEncontrado = false;

    // Recorrer el archivo de usuarios
    foreach ($usuarios as $usuario) {
        // Separar la línea en nombre de usuario y contraseña usando el separador ';'
        $datosUsuario = explode(';', $usuario);

        // Comprobar si el nombre de usuario y la contraseña coinciden con los datos proporcionados por el usuario
        if ($datosUsuario[0] === $username && $datosUsuario[1] === $password) {
            $usuarioEncontrado = true;
            break;
        }
    }

    // Si el usuario fue encontrado, redirigir a otra página
    if ($usuarioEncontrado) {
        // Crear un archivo de texto con el nombre de usuario
        $nombreArchivo = $username . '.txt';
        
        // Escribir un mensaje de bienvenida en el archivo
        if (!file_exists($nombreArchivo)) {
            // Escribir un mensaje de bienvenida en el archivo solo si no existe
            file_put_contents($nombreArchivo, "Nombre: " . htmlspecialchars($username) . "\nContraseña: " . htmlspecialchars($password));
        }

        // Redirigir a la página de bienvenida
        header("Location: ../index.php?username=" . urlencode($username));
        exit();
    } else {
        // Si el usuario no fue encontrado o las credenciales son incorrectas, mostrar un mensaje de error
        echo "Usuario o contraseña incorrecta.";
    }
}