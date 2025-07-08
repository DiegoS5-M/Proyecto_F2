<h2>Registrar nuevo usuario</h2>
<form action="/Proyecto_F2/Public/usuario.php" method="POST">
    <input type="text" name="nombres" placeholder="Nombres" required>
    <input type="text" name="apellidos" placeholder="Apellidos" required>
    <input type="email" name="correo" placeholder="Correo electrónico" required>
    <input type="text" name="celular" placeholder="Celular" required>
    <input type="number" name="edad" placeholder="Edad" required>

    <label>Tipo de documento</label>
    <select name="tipo_documento">
        <option value="1">Cédula</option>
        <option value="2">Tarjeta de identidad</option>
    </select>
    <input type="number" name="documento" placeholder="Número de documento" required>
    <label>Rol</label>
    <select name="rol">
        <option value="Estudiante">Estudiante</option>
        <option value="Profesor">Profesor</option>
        <option value="Empleado">Empleado</option>
        <option value="Administrador">Administrador</option>
    </select>

    <button type="submit" name="crear">Registrar</button>
    <br><br>
<a href="/Proyecto_F2/Public/admin.php">← Volver al panel del administrador</a>
</form>
