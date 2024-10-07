<?php

// Caracteres asociadas a las logos 
define('PIEDRA', "&#x1F91C;");
define('PIEDRA2', "&#x1F91B;"); 
define('TIJERAS', "&#x1F596;"); 
define('PAPEL', "&#x1F91A;");    

// Tabla de mensajes en función del ganador
$tmsg = [
    "¡Empate!",
    "Ha ganado el jugador 1",
    "Ha ganado el jugador 2"
];

// Función para calcular el ganador
function calcularGanador(String $valor1, String $valor2): int {
    if ($valor1 === $valor2) return 0;

    switch ($valor1) {
        case PIEDRA: return ($valor2 === TIJERAS) ? 1 : 2;
        case TIJERAS: return ($valor2 === PAPEL) ? 1 : 2;
        case PAPEL: return ($valor2 === PIEDRA) ? 1 : 2;
    }
}

$valores = [PIEDRA, TIJERAS, PAPEL];
$jugador1 = $valores[rand(0, 2)];
$jugador2 = $valores[rand(0, 2)];
$mensaje = $tmsg[calcularGanador($jugador1, $jugador2)];
$jugador2 = ($jugador2 === PIEDRA) ? PIEDRA2 : $jugador2;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>¡Piedra, papel, tijera!</title>
    <style>
        .jugador {
            font-size: 100px; /* para el tamaño del símbolo */
        }
        table {
            width: 100%; 
            text-align: center; 
        }
    </style>
</head>
<body>
    <h1>¡Piedra, papel, tijera!</h1>
    <p>Actualice la página para mostrar otra partida.</p>
    
    <table>
        <tr>
            <th>Jugador 1</th>
            <th>Jugador 2</th>
        </tr>
        <tr>
            <td><span class="jugador"><?= $jugador1; ?></span></td>
            <td><span class="jugador"><?= $jugador2; ?></span></td>
        </tr>
        <tr>
            <th colspan="2"><?= $mensaje ?></th>
        </tr>
    </table>
</body>
</html>


