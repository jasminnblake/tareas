<?php
session_start();

// Inicializar contador de intentos fallidos
$_SESSION['fallos'] = $_SESSION['fallos'] ?? 0;

// Bloquear acceso si se superan los intentos permitidos
if ($_SESSION['fallos'] >= 5) {
    include_once('./app/accesobloqueado.php');
    exit;
}

include_once('./app/funciones.php');

// Verificar credenciales
if (!empty($_GET['login']) && !empty($_GET['clave'])) {
    if (userOk($_GET['login'], $_GET['clave'])) {
        $_SESSION['fallos'] = 0; // Reiniciar intentos fallidos

        // Mostrar contenido según el rol
        $contenido = (getUserRol($_GET['login']) == ROL_PROFESOR)
            ? verNotaTodas($_GET['login'])
            : verNotasAlumno($_GET['login']);

        include_once('app/resultado.php');
    } else {
        $_SESSION['fallos']++;
        $contenido = "Usuario o contraseña incorrectos.";
        include_once('./app/acceso.php');
    }
} else {
    $contenido = "Introduzca su usuario y contraseña.";
    include_once('./app/acceso.php');
}






