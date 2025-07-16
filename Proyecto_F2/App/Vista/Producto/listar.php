<h2>Productos registrados</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio de costo</th>
        <th>Precio de venta</th>
        <th>Cantidad</th>
    </tr>
    <?php foreach ($productos as $p): ?>
        
    <tr>
        
        <td><?= $p['Id_Producto'] ?></td>
        <td><?= $p['Nombre_Producto'] ?></td>
        <td><?= $p['Precio_costo']?></td>
        <td><?= $p['Precio_venta'] ?></td>
        <td><?= $p['Cantidad_en_Stock'] ?></td>
        <td><a href="editar_producto.php?id=<?= $p['Id_Producto'] ?>">✏️ Editar</a></td>
    </tr>
    <?php endforeach; ?>
</table>

<br>
<a href="/Proyecto_F2/Public/producto.php">← Volver al formulario</a>

