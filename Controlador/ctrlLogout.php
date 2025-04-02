<?php
  session_start();

// Obtener la URL actual
$current_url = $_SERVER['REQUEST_URI']; 

// Destruir sesión
session_unset();  // Elimina las variables de sesión
session_destroy(); // Destruye la sesión

// Redirigir al index (puedes pasar la URL actual como referencia)
header("Location: ../index.php");
exit();
?>
