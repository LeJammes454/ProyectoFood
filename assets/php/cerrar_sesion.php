<?php
// Incluir la función session_start() al comienzo del archivo
session_start();

// Destruir la sesión actual
session_destroy();

// Redirigir al formulario de inicio de sesión o a otra página
header("Location: ../../index.php");
exit(); // Detener la ejecución del resto del código
?>
