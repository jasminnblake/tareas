<?php
session_start();

// Actualizo el contador de visitas
$visitas = isset($_COOKIE['visitascasino']) ? $_COOKIE['visitascasino'] : 1;

// Entra en el casino --------------------------------
if (!isset($_SESSION['disponible'])) {
    if (empty($_POST['cantidadini'])) {
        require_once "form_bienvenida.php";
    } else {
        $_SESSION['disponible'] = $_POST['cantidadini'];
        header("Refresh:0");
    }
    exit();
}

// Procesa la apuesta ----------------------------------
if (isset($_POST["apostar"]) && is_numeric($_POST["cantidad"]) && $_POST["cantidad"] > 0) {
    $msg = procesarApuesta($_POST["cantidad"], $_SESSION['disponible'], $_POST['apuesta']);
} elseif (isset($_POST["apostar"])) {
    $msg = "El valor {$_POST['cantidad']} no es válido.";
}

// Si abandona o ya no tiene saldo ------------------------
if (isset($_POST["dejar"]) || $_SESSION["disponible"] == 0) {
    dejarCasino($visitas);
    require_once "despedida.php";
    exit();
}

// Muestra el formulario de apuesta
require_once "form_apuesta.php";

// Función para procesar la apuesta
function procesarApuesta(int $cantidad, int &$saldo, string $apuesta): string {
    if ($cantidad > $saldo) {
        return "Error: no dispone de $cantidad euros.";
    }

    $resultado = (random_int(1, 100) % 2 == 0) ? "PAR" : "IMPAR";
    $msg = "RESULTADO DE LA APUESTA: $resultado";

    if ($apuesta == $resultado) {
        $msg .= " GANASTE!";
        $saldo += $cantidad;
    } else {
        $msg .= " PERDISTE!";
        $saldo -= $cantidad;
    }

    return $msg;
}

// Función para registrar una visita
function dejarCasino($visitas) {
    setcookie("visitascasino", ++$visitas, time() + 30 * 24 * 3600); // Un mes
}
?>
