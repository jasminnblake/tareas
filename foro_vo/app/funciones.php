<?php
// Verifica si el usuario es válido basado en ciertas condiciones.
function usuarioOk($usuario, $contraseña): bool {
    // Validación con requisitos mínimos (nombre de usuario de al menos 8 caracteres)
    return (strlen($usuario) >= 8 && $usuario === strrev($contraseña));
}

// Cuenta el número total de palabras en una cadena.
function contarPalabras($cadena): int {
    // Utilizamos str_word_count para contar palabras en el texto proporcionado
    return str_word_count($cadena, 0);
}

// Encuentra la letra más repetida en una cadena de texto.
// Esta función no usa funciones de arrays avanzadas, sino un bucle doble.
function letraMasrepetida($cadena): string {
    $vecesMax = 0;
    $letraMax = ''; 
    $tamaño = strlen($cadena);
    
    for ($i = 0; $i < $tamaño; $i++) {
        $veces = 1;
        $letrai = $cadena[$i];

        // Comprobamos el resto de letras en la cadena
        for ($j = $i + 1; $j < $tamaño; $j++) {
            if ($letrai === $cadena[$j]) {
                $veces++;
            }
        }
        // Actualizamos la letra más repetida si se encuentra una con mayor frecuencia
        if ($veces > $vecesMax) {
            $letraMax = $letrai;
            $vecesMax = $veces;
        }
    }
    return $letraMax;  
}

// Obtiene la palabra más repetida en una cadena de texto usando funciones de arrays.
function palabraMasrepetida($cadena): string {
    // Generamos un array con las palabras
    $palabras = str_word_count($cadena, 1);

    // Contamos cada palabra y las ordenamos
    $palabrasveces = array_count_values($palabras);
    arsort($palabrasveces); // Orden descendente para obtener la palabra con mayor repetición

    // Devolvemos la palabra que más se repite en el array
    return array_key_first($palabrasveces); 
}

// Limpia una cadena para prevenir ataques de inyección de HTML.
// Esta función modifica directamente la variable recibida mediante referencia.
function limpiarEntrada(&$cadena): void {
    $cadena = htmlspecialchars($cadena, ENT_QUOTES, 'UTF-8');
}
function mi_lcg_value(): float {
   // Usa la función integrada lcg_value para generar un número aleatorio
   return lcg_value();
}