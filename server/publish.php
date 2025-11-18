<?php
session_start();
include 'conexionbd.php';
include 'logout.php';
include 'util.php';

if (!isset($_SESSION['nombre'])) {
    header('Location: ../pages/signin.php');
    exit();
}

if (isset($_POST["title"]) && isset($_POST["body"])) {
    $postTitle = htmlspecialchars($_POST["title"]);
    $postBody = htmlspecialchars($_POST["body"]);
    $targetFile = guardar_imagen($_FILES["banner"]);

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