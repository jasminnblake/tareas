<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinco dados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        h1 {
            font-size: 2rem;
        }
        .cont_jugador {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
        }
        .jugador {
            width: 300px;
            padding: 20px;
            font-weight: bold;
            display: inline-block;
        }
        .jugador1 {
            background-color: red;
        }
        .jugador2 {
            background-color: blue;
        }
        .dados {
            font-size: 4rem;
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
            color: black;
        }
        .puntos {
            margin-left: 20px;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .resultado {
            margin-top: 30px;
        }
    </style>
</head>
<body>

<h1>Cinco dados</h1>
<p>Actualice la página para mostrar una nueva tirada.</p>

<?php
function jugar_dados() {
    $dados_cod = ['&#9856;', '&#9857;', '&#9858;', '&#9859;', '&#9860;', '&#9861;'];
    $dados = [];

    for ($i = 0; $i < 5; $i++) {
        $tirada = rand(1, 6); // Generar un número aleatorio entre 1 y 6
        $dados[] = $tirada;
    }

    foreach ($dados as $dado) { 
        echo $dados_cod[$dado - 1] . " ";
    }

    sort($dados);
    array_shift($dados); // Elimina el más bajo
    array_pop($dados);   // Elimina el más alto

    // Suma del más bajo y más alto
    $puntos = array_sum($dados);
    
    return $puntos;
}

// Jugador 1 
echo "<div class='cont_jugador'>";
echo "<div><h2>Jugador 1</h2></div>";
echo "<div class='jugador jugador1'>";
echo "<div class='dados'>";
$puntos_rojo = jugar_dados();
echo "</div></div>";
echo "<div class='puntos'>{$puntos_rojo} puntos</div>";
echo "</div>";

// Jugador 2
echo "<div class='cont_jugador'>";
echo "<div><h2>Jugador 2</h2></div>";
echo "<div class='jugador jugador2'>";
echo "<div class='dados'>";
$puntos_azul = jugar_dados();
echo "</div></div>";
echo "<div class='puntos'>{$puntos_azul} puntos</div>";
echo "</div>";

echo "<div class='resultado'><h2>Resultado</h2>";
if ($puntos_rojo > $puntos_azul) {
    echo "Ha Ganado el Jugador 1";
} elseif ($puntos_azul > $puntos_rojo) {
    echo "Ha Ganado el Jugador 2";
} else {
    echo "¡Empate!";
}
echo "</div>";
?>

</body>
</html>
