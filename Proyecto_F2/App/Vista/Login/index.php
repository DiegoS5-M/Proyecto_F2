<!-- Formulario para iniciar sesión -->
<form action="../../Public/login.php" method="POST">
    <!-- Título del formulario -->
    <h2>Iniciar sesión</h2>

    <!-- Campo de entrada para el correo electrónico -->
    <input 
        type="text"           <!-- Tipo de entrada: texto -->
        name="correo"         <!-- Nombre del campo (clave que se enviará por POST) -->
        placeholder="Correo electrónico" <!-- Texto guía dentro del campo -->
        required              <!-- Hace que el campo sea obligatorio -->
    >

    <!-- Campo de entrada para el número de celular -->
    <input 
        type="text" 
        name="celular" 
        placeholder="Celular" 
        required 
    >

    <!-- Botón para enviar el formulario -->
    <button type="submit">Entrar</button>
</form>