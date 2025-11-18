<?php
require_once '../vendor/autoload.php';
session_start();
include 'conexionbd.php';
include 'logout.php';
include 'util.php';

if (!isset($_SESSION['nombre'])) {
    header('Location: ../pages/signin.php');
    exit();
}

if (isset($_POST["title"]) && isset($_POST["body"])) {
    $config = HTMLPurifier_Config::createDefault(); // Configurar los tags permitidos con HTMLPurifier
    $config->set('HTML.Allowed', 'p,br,strong,em,u,a[href],ul,ol,li,h1,h2,h3,img[src|alt]');
    $config->set('HTML.AllowedAttributes', 'a.href,img.src,img.alt,*.style');
    $purifier = new HTMLPurifier($config);

    $postTitle = htmlspecialchars($_POST["title"]);
    $postBody = htmlspecialchars($purifier->purify($_POST["body"])); // Purificar el código HTML
    $targetFile = guardar_imagen($_FILES["banner"]); // Guardamos la imagen y obtenemos la dirección del archivo

    global $con;
    conectar('gridee');
    $sql = 'INSERT INTO post (usuario_id, title, body, banner_path) VALUES ("'.$_SESSION['id'].'", "'.$postTitle.'", "'.$postBody.'", "'.$targetFile.'")'; // Guardamos los datos de la publiación
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