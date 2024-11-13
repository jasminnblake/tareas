<?php
session_start();

// Si se recibe un nuevo cliente, inicializo los datos
if (isset($_GET['cliente'])) {
    $_SESSION['cliente'] = $_GET['cliente'];  // Guardamos el nombre del cliente
    $_SESSION['pedidos'] = [];  // Inicializamos el array de pedidos vacío
}

// Si no hay cliente, muestro la bienvenida
if (!isset($_SESSION['cliente'])) {
    require_once('bienvenida.php');  // Página de bienvenida
    exit();  // Termina el script aquí
}

// Procesar acciones de compra (añadir fruta, eliminar fruta, finalizar compra)
if (isset($_POST['accion'])) {

    // Si el cliente quiere añadir una fruta al pedido
    if ($_POST['accion'] == 'Anotar') {
        $cantidad = $_POST['cantidad'];  // Cantidad de fruta
        $fruta = $_POST['fruta'];  // Tipo de fruta

        // Evitar cantidades negativas
        if ($cantidad > 0) {
            // Si ya hay una cantidad de esa fruta en el pedido, sumamos la nueva cantidad
            if (isset($_SESSION['pedidos'][$fruta])) {
                $_SESSION['pedidos'][$fruta] += $cantidad;
            } else {
                // Si no había pedido esa fruta, la añadimos con la cantidad
                $_SESSION['pedidos'][$fruta] = $cantidad;
            }
        }
    }

    // Si el cliente quiere eliminar una fruta del pedido
    if ($_POST['accion'] == 'Anular') {
        unset($_SESSION['pedidos'][$_POST['fruta']]);  // Eliminamos la fruta seleccionada
    }

    // Si el cliente finaliza la compra
    if ($_POST['accion'] == 'Terminar') {
        $compraFinalizada = generarTablaPedidos();  // Genero la tabla de los pedidos
        require_once('despedida.php');  // Página de despedida
        session_destroy();  // Borrar la sesión (terminar la compra)
        exit();  // Termina el script aquí
    }
}

// Mostrar los pedidos actuales en la página de compra
$compraFinalizada = generarTablaPedidos();
require_once('compra.php');

// Función que genera una tabla HTML con los pedidos del cliente
function generarTablaPedidos(): string
{
    $tabla = "";
    if (count($_SESSION['pedidos']) > 0) {
        $tabla .= "Este es su pedido:";
        $tabla .= "<table style='border: 1px solid black;'>";
        // Recorro cada fruta y su cantidad en el pedido
        foreach ($_SESSION['pedidos'] as $fruta => $cantidad) {
            $tabla .= "<tr><td><b>" . $fruta . "</b></td><td>" . $cantidad . "</td></tr>";
        }
        $tabla .= "</table>";
    }
    return $tabla;  // Devuelvo la tabla generada
}
?>
