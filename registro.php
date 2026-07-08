<?php
include("conexion.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre_completo'];
    $user = $_POST['usuario'];
    $pass = hash('sha256', $_POST['contrasena']);
    
    $stmt = $conexion->prepare("INSERT INTO usuarios (usuario, contrasena, nombre_completo) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $user, $pass, $nombre);
    
    if ($stmt->execute()) {
        header("Location: home.php");
        exit();
    } else {
        $error = "Error al crear la cuenta.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos/registro.css">
    <title>Crear Cuenta</title>
</head>
<body>
    <div class="box">
        <h2>Crear Cuenta</h2>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="nombre_completo" placeholder="Nombre completo" required>
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="password" name="contrasena" placeholder="Contraseña" required>
            <button type="submit">Completar Registro</button>
        </form>
        <p>¿Ya tienes cuenta? <a href="index.php">Inicia sesión</a></p>
    </div>
</body>
</html>