<!DOCTYPE html> <!-- Declaración del tipo de documento HTML5 -->
<html lang="es"> <!-- Inicia el documento HTML en idioma español -->
<head>
    <meta charset="UTF-8"> <!-- Codificación de caracteres para admitir tildes y caracteres especiales -->
    <title>Login - Cafetería Ebenezer</title> <!-- Título que se muestra en la pestaña del navegador -->

    <!-- Enlace al framework Bootstrap para estilos modernos y responsivos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos personalizados para el formulario de login -->
    <style>
        body {
            background-color: #f8f9fa; /* Color de fondo claro (gris suave) */
        }
        .login-box {
            max-width: 400px; /* Ancho máximo del cuadro de login */
            margin: 80px auto; /* Centrado vertical con margen superior */
            padding: 30px; /* Espaciado interno */
            border-radius: 10px; /* Bordes redondeados */
            background-color: white; /* Fondo blanco para el formulario */
            box-shadow: 0 0 15px rgba(0,0,0,0.1); /* Sombra sutil alrededor del cuadro */
        }
    </style>
</head>
<body>
    
    <!-- Contenedor general de Bootstrap -->
    <div class="container">
        <!-- Caja de login centrada -->
        <div class="login-box">
            <!-- Título del formulario -->
            <h3 class="text-center mb-4">🔐 Iniciar sesión</h3>

            <!-- Formulario de inicio de sesión -->
            <form action="login.php" method="POST">
                <!-- Campo para el correo -->
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="correo" name="correo" required>
                </div>

                <!-- Campo para el celular -->
                <div class="mb-3">
                    <label for="celular" class="form-label">Número de celular</label>
                    <input type="text" class="form-control" id="celular" name="celular" required>
                </div>

                <!-- Botón de envío -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </div>
            </form>

            <!-- Mensaje de error si el login falla -->
            <?php if (isset($_SESSION['error_login'])): ?>
                <div class="alert alert-danger mt-3">
                    <?= $_SESSION['error_login'] ?> <!-- Muestra el mensaje de error -->
                    <?php unset($_SESSION['error_login']); ?> <!-- Borra el error de la sesión -->
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>