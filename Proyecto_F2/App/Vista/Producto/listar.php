<!-- Título de la sección -->
<h2>Productos registrados</h2>

<!-- Tabla HTML para mostrar los productos -->
<table border="1"> <!-- border="1" dibuja un borde negro simple -->

    <!-- Encabezados de la tabla -->
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio de costo</th>
        <th>Precio de venta</th>
        <th>Cantidad</th>
    </tr>

    <!-- Recorrido de los productos con un bucle foreach -->
    <?php foreach ($productos as $p): ?>
        
    <tr>
        <!-- Mostrar cada dato del producto -->
        <td><?= $p['Id_Producto'] ?></td> <!-- ID del producto -->
        <td><?= $p['Nombre_Producto'] ?></td> <!-- Nombre del producto -->
        <td><?= $p['Precio_costo']?></td> <!-- Precio de costo -->
        <td><?= $p['Precio_venta'] ?></td> <!-- Precio de venta -->
        <td><?= $p['Cantidad_en_Stock'] ?></td> <!-- Cantidad en stock -->

        <!-- Enlace para editar el producto -->
        <td>
            <a href="editar_producto.php?id=<?= $p['Id_Producto'] ?>">✏️ Editar</a>
        </td>
    </tr>

    <?php endforeach; ?>
</table>

<br>

<!-- Enlace para regresar al formulario de productos -->
<a href="/Proyecto_F2/Public/producto.php">← Volver al formulario</a>

