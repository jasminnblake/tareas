<?php
require_once('./dat/datos.php');

/**
 * Verifica si el usuario y clave son válidos.
 */
function userOk($login, $clave): bool {
    global $usuarios;
    return isset($usuarios[$login]) && $usuarios[$login][1] === $clave;
}

/**
 * Devuelve el rol del usuario (alumno o profesor).
 */
function getUserRol($login) {
    global $usuarios;
    return $usuarios[$login][2] ?? null;
}

/**
 * Muestra las notas del alumno.
 */
function verNotasAlumno($codigo): string {
    global $nombreModulos, $notas, $usuarios;

    if (!isset($notas[$codigo])) {
        return "No hay datos para el alumno: $codigo.";
    }

    $nombreAlumno = $usuarios[$codigo][0];
    $notasAlumno = $notas[$codigo];

    $tabla = "<table border='1'><tr><th>Módulo</th><th>Nota</th></tr>";
    foreach ($nombreModulos as $i => $modulo) {
        $tabla .= "<tr><td>$modulo</td><td>{$notasAlumno[$i]}</td></tr>";
    }
    $tabla .= "</table>";

    return "Bienvenido/a, $nombreAlumno.<hr>$tabla";
}

/**
 * Muestra las notas de todos los alumnos.
 */
function verNotaTodas($codigo): string {
    global $nombreModulos, $notas, $usuarios;

    $tabla = "<table border='1'><tr><th>Nombre</th>";
    foreach ($nombreModulos as $modulo) {
        $tabla .= "<th>$modulo</th>";
    }
    $tabla .= "</tr>";

    foreach ($notas as $codigoAlumno => $notasAlumno) {
        $tabla .= "<tr><td>{$usuarios[$codigoAlumno][0]}</td>";
        foreach ($notasAlumno as $nota) {
            $tabla .= "<td>$nota</td>";
        }
        $tabla .= "</tr>";
    }
    $tabla .= "</table>";

    return "Bienvenido Profesor: {$usuarios[$codigo][0]}.<hr>$tabla";
}
