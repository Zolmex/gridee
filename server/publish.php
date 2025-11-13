<?php
session_start();
include 'conexionbd.php';
include 'sesion.php';

if (!isset($_SESSION['nombre'])) {
    header('Location: ../pages/signin.php');
    exit();
}

if (isset($_POST["title"]) && isset($_POST["body"]) && isset($_POST["banner"])) {
    $postTitle = htmlspecialchars($_POST["title"]);
    $postBody = htmlspecialchars($_POST["body"]);
    
    // Validacion de la imagen
    $targetDir = "/data/uploads/"; // Directorio donde se guardarán las imágenes
    $targetFile = $targetDir . basename($_FILES["banner"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    // Guardamos el archivo
    if (!file_exists("../". $targetFile) && !move_uploaded_file($_FILES["banner"]["tmp_name"], "../". $targetFile)){
        echo "<script>alert('Archivo de imagen inválido.')</script>";
        exit();
    }

    global $con;
    conectar('gridee');
    $sql = 'INSERT INTO post (usuario_id, title, body, banner_path) VALUES ("'.$nombre.'", "'.$desc.'", "'.$targetFile.'")';
    $result = mysqli_query($con, $sql);
    if ($result) { // Exito
        echo "<script>alert('Disfraz publicado con éxito!.')</script>";
    }
    else {
        echo "<script>alert('Ha ocurrido un error al publicar el disfraz.')</script>";
    }
    desconectar();
}

?>