<?php
session_start();
include '../server/logout.php';
include '../server/conexionbd.php';
include '../server/util.php';

if (!isset($_SESSION['nombre'])) {
    echo '<script>alert("Usuario inválido.")</script>';   
    exit();
}

if (isset($_FILES["pfp"])) {
    $archivo = guardar_imagen($_FILES["pfp"]);

    global $con;
    conectar('gridee');
    $sql = 'UPDATE usuario SET picture = "'.$archivo.'" WHERE id = '.$_SESSION['id'].';';
    $result = mysqli_query($con, $sql);
    if ($result) { // Exito
        echo "<script>alert('Foto de perfil actualizado con éxito!.')</script>";
    }
    else {
        echo "<script>alert('Ha ocurrido un error al actualizar la foto de perfil.')</script>";
    }
    desconectar();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/signin.css">
    <title>Gridee - Update profile picture</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>
    <header class="site-header" role="banner">
        <div class="h-side-container">
            <img src="../images/logo-full.png" alt="Gridee logo">
        </div>
    </header>
    <main class="login-content" role="main">
        <div class="login-container">
            <section class="login-panel-container" aria-labelledby="profile-picture-heading">
                <header class="login-panel-header">
                    <img src="../images/logo-full.png" alt="Gridee logo">
                    <p id="profile-picture-heading">Choose a profile picture</p>
                </header>
                <div class="login-panel">
                    <form class="login-panel-input-grid" action="/pages/pfp.php" method="post" enctype="multipart/form-data" aria-label="Profile picture upload form">
                        <input type="file" id="post-banner-input" name="pfp" aria-label="Select profile picture file" accept="image/*"/>
                        <button type="submit" class="login-panel-signin-button" aria-label="Upload and update profile picture">Update</button>
                    </form>
                </div>
            </section>
        </div>
    </main>
    <footer role="contentinfo">
        <nav>
            <a href="https://instagram.com" target="_blank" aria-label="Visit our Instagram page">
                <img src="https://www.google.com/s2/favicons?domain=instagram.com" alt="Instagram" width="24"
                    height="24">
            </a>
            <a href="https://youtube.com" target="_blank" aria-label="Visit our YouTube channel">
                <img src="https://www.google.com/s2/favicons?domain=youtube.com" alt="YouTube" width="24" height="24">
            </a>
            <a href="https://x.com" target="_blank" aria-label="Visit our X profile">
                <img src="https://www.google.com/s2/favicons?domain=x.com" alt="X" width="24" height="24">
            </a>
            <a href="https://linkedin.com" target="_blank" aria-label="Visit our LinkedIn page">
                <img src="https://www.google.com/s2/favicons?domain=linkedin.com" alt="LinkedIn" width="24" height="24">
            </a>
        </nav>
        <p>&copy; 2025 Gridee. All rights reserved.</p>
    </footer>
    <script type="module" src="../scripts/pfp.js"></script>
</body>

</html>