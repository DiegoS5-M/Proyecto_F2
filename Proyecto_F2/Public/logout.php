<?php
session_start();
session_unset(); // Limpia todas las variables de sesión
session_destroy(); // Destruye la sesión

header("Location: login_Form.php"); // Redirige al login
exit;
