<?php
session_start();
include 'conexionbd.php';
include 'logout.php';

function uuidv4() { // Generador de UUID para guardar las imagenes cargadas por los usuarios
    $data = random_bytes(16);

    // Ajustar bits versión y variante
    $data[6] = chr((ord($data[6]) & 0x0f) | 0x40); // versión 4
    $data[8] = chr((ord($data[8]) & 0x3f) | 0x80); // variante RFC4122

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

if (!isset($_SESSION['nombre'])) {
    header('Location: ../pages/signin.php');
    exit();
}

if (isset($_POST["title"]) && isset($_POST["body"])) {
    $postTitle = htmlspecialchars($_POST["title"]);
    $postBody = htmlspecialchars($_POST["body"]);
    
    // Validacion de la imagen
    $targetDir = "data/uploads/"; // Directorio donde se guardarán las imágenes
    $extension = pathinfo($_FILES["banner"]["name"], PATHINFO_EXTENSION);
    $targetFile = $targetDir . uuidv4() . '.' . $extension;
    
    if (!is_dir($targetDir)) { // Crear directorios si no existen
        mkdir($targetDir, 0777, true);
    }

    // Guardamos el archivo
    if (!move_uploaded_file($_FILES["banner"]["tmp_name"], $targetFile)){
        echo "<script>alert('Archivo de imagen inválido.')</script>";
        exit();
    }

    global $con;
    conectar('gridee');
    $sql = 'INSERT INTO post (usuario_id, title, body, banner_path) VALUES ("'.$_SESSION['id'].'", "'.$postTitle.'", "'.$postBody.'", "'.$targetFile.'")';
    $result = mysqli_query($con, $sql);
    if ($result) { // Exito
        echo "<script>alert('Post realizado con éxito!.')</script>";
    }
    else {
        echo "<script>alert('Ha ocurrido un error al realizar la publicación.')</script>";
    }
    desconectar();
}

header('Location: /index.php'); // Redireccionar al index

?>