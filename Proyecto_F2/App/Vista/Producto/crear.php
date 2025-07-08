<h2>Registrar producto</h2>
<form action="/Proyecto_F2/Public/producto.php" method="POST">
    <label>Nombre del producto:</label>
    <input type="text" name="nombre" required><br>

    <label>Código del producto (ID):</label>
    <input type="text" name="id" required><br>

    <label>Precio de costo:</label>
    <input type="number" name="precio_costo" step="0.01" required><br>

    <label>Precio de venta:</label> 
    <input type="number" name="precio_venta" step="0.01" required><br>

    <label>Cantidad en stock:</label>
    <input type="number" name="cantidad" required><br><br>

    <label>Categoría:</label>
<select name="tipo_producto" required>
    <option value="">Seleccione</option>
    <option value="1">Bebidas</option>
    <option value="2">Comidas</option>
    <option value="3">Snacks</option>
    <option value="4">Postres</option>
    <option value="5">Otros</option>
</select>

    <button type="submit" name="registrar">Guardar producto</button>
</form>

<br>
<a href="/Proyecto_F2/Public/producto.php?listar=1">📋 Ver productos registrados</a>
<br><br>
<a href="/Proyecto_F2/Public/admin.php">← Volver al panel del administrador</a>

