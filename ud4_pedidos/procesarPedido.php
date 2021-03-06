<?php
    require_once 'enviarEmail.php';
    require_once 'bd.php';
    require_once 'sesion.php';
    comprobarSesion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
</head>
<body>
<?php  
    require 'cabecera.php';
    $pedido = insertarPedido($_SESSION['carrito'], $_SESSION['usuario']->codigo);
    if($pedido === FALSE) {
        echo '<p>ERROR: No se ha podido procesar el pedido.</p>';
    } else {
        $email = $_SESSION['usuario']->email;
        echo '<p>Pedido realizado correctamente</p>';
        echo '<p>Se enviará un correo de confirmación a ' . $_SESSION['usuario']->email;
        $enviarEmail = enviarEmail($_SESSION['carrito'], $pedido, $email);
        if ($enviarEmail!==TRUE) {
            echo "Error al enviar: $enviarEmail <br>";
        }
        $_SESSION['carrito'] = [];
    }
?>
</body>
</html>