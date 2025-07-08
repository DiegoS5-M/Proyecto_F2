<h2>Realizar pedido</h2>
<form action="/Proyecto_F2/Public/pedido.php" method="POST">
    <?php foreach ($productos as $producto): ?>
        <div>
            <label><?= $producto['nombre'] ?> (<?= $producto['precio'] ?>)</label>
            <input type="number" name="productos[<?= $producto['id_producto'] ?>]" min="0" max="<?= $producto['Cantidad_en_Stock'] ?>" value="0">
        </div>
    <?php endforeach; ?>

    <button type="submit" name="realizar">Enviar pedido</button>
    <br><br>
<a href="/Proyecto_F2/Public/admin.php">← Volver al panel del administrador</a>
</form>