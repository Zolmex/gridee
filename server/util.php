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

function uuidv4() { // Generador de UUID para guardar las imagenes cargadas por los usuarios
    $data = random_bytes(16);

    // Ajustar bits versión y variante
    $data[6] = chr((ord($data[6]) & 0x0f) | 0x40); // versión 4
    $data[8] = chr((ord($data[8]) & 0x3f) | 0x80); // variante RFC4122

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function guardar_imagen($imagen) {
    // Validacion de la imagen
    $targetDir = "/server/data/uploads/"; // Directorio donde se guardarán las imágenes
    $extension = pathinfo($imagen["name"], PATHINFO_EXTENSION);
    $targetFile = $targetDir . uuidv4() . '.' . $extension;

    $serverDir = $_SERVER['DOCUMENT_ROOT'] . $targetDir;
    $serverFile = $_SERVER['DOCUMENT_ROOT'] . $targetFile;
    
    if (!is_dir($serverDir)) { // Crear directorios si no existen
        mkdir($serverDir, 0777, true);
    }

    // Guardamos el archivo
    if (!move_uploaded_file($imagen["tmp_name"], $serverFile)){
        echo "<script>alert('Archivo de imagen inválido.')</script>";
        exit();
    }
    return $targetFile;
}

?>
