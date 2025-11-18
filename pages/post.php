<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
session_start();
include '../server/logout.php';
include '../server/conexionbd.php';
include '../server/util.php';

if (!isset($_GET['p'])){
    header('Location: /index.php'); // Redireccionar al index si no se especifico un post
    exit();
}

if (isset($_GET['react'])) { // Agregar una reaccion al post
    global $con;
    conectar('gridee');

    $sql = 'UPDATE post SET reacciones = reacciones + 1 WHERE id = '.htmlspecialchars($_GET['p']).'';
    $result = $con->query($sql);
    if ($result) {
        header('Location: /pages/post.php?p='.htmlspecialchars($_GET['p']));
        exit();
    }

    desconectar();
}

function cargar_post() {
    global $con;
    conectar('gridee');
    
    $sql = 'SELECT * FROM post WHERE id = '.htmlspecialchars($_GET['p']).';';
    $result = $con->query($sql);
    if ($result->num_rows > 0) { // Crear elemento
        $post = $result->fetch_assoc();
        $sql2 = 'SELECT nombre, picture FROM usuario WHERE id = "' . $post['usuario_id'] . '"';
        $result2 = mysqli_query($con, $sql2);
        $autor = $result2->fetch_assoc();

        $postAutor = $autor['nombre'];
        $postAutorPic = $autor['picture'];
        $postId = $post['id'];
        $postTitle = $post['title'];
        $postBody = html_entity_decode($post['body'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $bannerPath = $post['banner_path'];
        $intervalo = obtenerIntervalo($post['fecha_hora_alta']);
        $postReactions = $post['reacciones'];

        echo '
<article class="post-view" role="article" aria-labelledby="post-title-'.$postId.'" id="post-'.$postId.'">
  <header class="post-view__header">
    <h1 id="post-title-'.$postId.'" class="post-view__title">'.$postTitle.'</h1>
    <div class="post-view__meta">
      <div class="author">
        <img class="author__avatar" src="'.$postAutorPic.'" alt="Foto de perfil de '.$postAutor.'">
        <div class="author__info">
          <span class="author__name">'.$postAutor.'</span>
          <time class="author__time" datetime="'.$post['fecha_hora_alta'].'">'.$intervalo.'</time>
        </div>
      </div>
    </div>
  </header>

  <figure class="post-view__banner" role="img" aria-label="Banner del artículo" style="background-image: url(\''.$bannerPath.'\')">
    <figcaption class="sr-only">Banner del artículo</figcaption>
  </figure>

  <section class="post-view__body" id="post-body" aria-label="Contenido del artículo">
    <div class="post-content">
        '.$postBody.'  
    </div>
  </section>

  <footer class="post-view__footer">
    <div class="reactions" role="group" aria-label="Reacciones del post">
      <button class="reactions__btn reactions__btn--like" aria-pressed="false" aria-label="Me gusta, actualmente '.$postReactions.' reacciones">
        ❤️ <span class="reactions__count" aria-hidden="true">+'.$postReactions.'</span>
      </button>
    </div>
  </footer>
</article>
        ';
    }
    else {
        header('Location: /index.php'); // Redireccionar al index si el post es inválido
        exit();
    }

    desconectar();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/post.css">
    <title>Gridee</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>
    <header class="site-header" role="banner">
        <div class="h-side-container">
            <img src="../images/logo-full.png" alt="Gridee logo">
        </div>
        <nav aria-label="Navegación de usuario">
            <?php if (!isset($_SESSION["nombre"])): ?>
            <button id="signin-btn" class="h-signin" aria-label="Iniciar sesión">Sign in</button>
            <?php else: ?>
            <button id="profile-btn" class="h-signin" aria-expanded="false" aria-haspopup="true" aria-controls="profile-card"><?php echo $_SESSION["nombre"] ?></button>
            <?php endif; ?>
        </nav>
    </header>
    <?php if (isset($_SESSION["nombre"])): ?>
    <div id="profile-card" class="profile-card" role="menu" aria-label="Menú de perfil">
        <p>Signed in as <strong><?php echo $_SESSION["nombre"]; ?></strong></p>
        <hr role="separator">
        <a href="pfp.php" role="menuitem">Change Profile Picture</a>
        <a href="?logout=true" role="menuitem">Sign out</a>
    </div>
    <?php endif; ?>
    <main class="main-content" role="main">
        <div class="article-view" id="article-view">
            <?php cargar_post(); ?>
        </div>
    </main>
    <footer role="contentinfo">
        <nav aria-label="Redes sociales">
            <a href="https://instagram.com" target="_blank" aria-label="Visita nuestro Instagram">
                <img src="https://www.google.com/s2/favicons?domain=instagram.com" alt="" width="24"
                    height="24">
            </a>
            <a href="https://youtube.com" target="_blank" aria-label="Visita nuestro YouTube">
                <img src="https://www.google.com/s2/favicons?domain=youtube.com" alt="" width="24" height="24">
            </a>
            <a href="https://x.com" target="_blank" aria-label="Visita nuestro X">
                <img src="https://www.google.com/s2/favicons?domain=x.com" alt="" width="24" height="24">
            </a>
            <a href="https://linkedin.com" target="_blank" aria-label="Visita nuestro LinkedIn">
                <img src="https://www.google.com/s2/favicons?domain=linkedin.com" alt="" width="24" height="24">
            </a>
        </nav>
        <p>&copy; 2025 Gridee. All rights reserved.</p>
    </footer>
    <script type="module" src="../scripts/post.js"></script>
</body>

</html>