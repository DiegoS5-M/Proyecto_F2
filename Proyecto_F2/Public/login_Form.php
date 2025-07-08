<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
</head>
<body>
    <h2>Inicio de sesión</h2>

    <form action="login.php" method="POST">
        <label for="correo">Correo electrónico:</label>
        <input type="email" name="correo" required><br><br>

        <label for="celular">Celular:</label>
        <input type="text" name="celular" required><br><br>

        <button type="submit">Iniciar sesión</button>
    </form>
</body>
</html>