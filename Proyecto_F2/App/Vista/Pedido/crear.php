<!-- Título principal de la vista -->
<h2>Realizar pedido</h2>

<!-- Formulario que envía los datos del pedido al archivo Public/pedido.php -->
<form action="/Proyecto_F2/Public/pedido.php" method="POST">

    <!-- Bucle para mostrar todos los productos disponibles -->
    <?php foreach ($productos as $producto): ?>
        <div>
            <!-- Etiqueta con el nombre del producto y su precio -->
            <label>
                <?= $producto['nombre'] ?> (<?= $producto['precio'] ?>)
            </label>

            <!-- Campo de cantidad para cada producto -->
            <input 
                type="number" 
                name="productos[<?= $producto['id_producto'] ?>]" <!-- nombre como array asociativo con id_producto -->
                min="0"                                            <!-- No permite valores negativos -->
                max="<?= $producto['Cantidad_en_Stock'] ?>"        <!-- Límite según el stock disponible -->
                value="0"                                          <!-- Valor por defecto -->
            >
        </div>
    <?php endforeach; ?>

    <!-- Botón para enviar el pedido -->
    <button type="submit" name="realizar">Enviar pedido</button>

    <br><br>

    <!-- Enlace para volver al panel del administrador -->
    <a href="/Proyecto_F2/Public/admin.php">← Volver al panel del administrador</a>
</form>