<?php
function obtenerIntervalo($fecha)
{
    $fecha = new DateTime($fecha);
    $ahora = new DateTime();
    $diff = $fecha->diff($ahora);

    $intervalo = 'Hace ';

    if ($diff->y > 0) {
        $intervalo .= $diff->y . " años";
    } elseif ($diff->m > 0) {
        $intervalo .= $diff->m . " meses";
    } elseif ($diff->d > 0) {
        $intervalo .= $diff->d . " días";
    } elseif ($diff->h > 0) {
        $intervalo .= $diff->h . " horas";
    } elseif ($diff->i > 0) {
        $intervalo .= $diff->i . " minutos";
    } else {
        $intervalo .= $diff->s . " segundos";
    }
    return $intervalo;
}
