<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: index.php");
    exit();
}
include("conexion.php");
$resultado = $conexion->query("SELECT * FROM productos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario - Home</title>
    <link rel="stylesheet" href="estilos/home.css">    
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>

    <nav>
        <div class="user-section">
            <i data-lucide="user" style="width: 20px; height: 20px;"></i>
            <?php echo htmlspecialchars($_SESSION['nombre']); ?>
        </div>
        <a href="logout.php" class="btn-logout">
            Cerrar Sesión 
            <i data-lucide="log-out" style="width: 16px; height: 16px;"></i>
        </a>
    </nav>

    <div class="container">
        <h2 style="margin-bottom: 1.5rem;">Inventario de Productos</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th style="text-align: center;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $resultado->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id_producto']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['cantidad']; ?></td>
                    <td>$<?php echo number_format((float)$row['precio'], 2); ?></td>
                    <td style="text-align: center;">
                        <a href="#" class="action-icon" style="color: #2563eb; margin-right: 12px;" title="Editar">
                            <i data-lucide="pencil" style="width: 18px; height: 18px;"></i>
                        </a>
                        <a href="#" class="action-icon" style="color: #ef4444;" title="Eliminar">
                            <i data-lucide="trash-2" style="width: 18px; height: 18px;"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>