<?php
// CONTROLADOR CON SESIONES Y PROTECCIÓN CSRF
session_start();
include_once 'app/funciones.php';

$msg = ""; // Mensaje por defecto

// Si no hay usuario en sesión
if (!isset($_SESSION['usuario'])) {
    if (!isset($_REQUEST['orden']) || $_REQUEST['orden'] != "Entrar") {
        include_once 'app/entrada.php';
    } elseif ($_REQUEST['orden'] == "Entrar") {
        if (isset($_REQUEST['nombre']) && isset($_REQUEST['contraseña']) && usuarioOK($_REQUEST['nombre'], $_REQUEST['contraseña'])) {
            $_SESSION['usuario'] = $_REQUEST['nombre'];
            $_SESSION['token'] = uniqid(mt_rand(), true);
            $msg = "Bienvenido <b>{$_REQUEST['nombre']}</b><br>";
            include_once 'app/comentario.php';
        } else {
            $msg = "<br>Usuario no válido</br>";
            include_once 'app/entrada.php';
        }
    }
} else {
    // Evitar ataques CSRF verificando el token
    if (!isset($_REQUEST['token']) || $_REQUEST['token'] != $_SESSION['token']) {
        echo "Intento de ataque detectado.";
        die();
    }
    $_SESSION['token'] = uniqid(mt_rand(), true);  // Generar nuevo token
    switch ($_REQUEST['orden']) {
        case "Nueva opinión":
            $msg = "Nueva opinión <br>";
            include_once 'app/comentario.php';
            break;
            
        case "Detalles":
            $msg = "Detalles de su opinión";
            limpiarEntrada($_REQUEST['comentario']);
            limpiarEntrada($_REQUEST['tema']);
            include_once 'app/comentariorelleno.php';
            break;
            
        case "Terminar":
            session_destroy();
            include_once 'app/entrada.php';
            break;
    }
}
