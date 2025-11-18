<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
session_start();
include 'server/logout.php';
include 'server/conexionbd.php';
include 'server/util.php';

global $filtro;
$filtro = 0;

if (isset($_GET['filtro'])) {
    $filtro = (int) $_GET['filtro']; // Guardar en la variable local el filtro seleccionado
}

function cargar_posts()
{
    global $con, $filtro;
    conectar('gridee');
    $sql = '';
    switch ($filtro) {
        case 1: // Ordernar del más reaccionado al menos reaccionado
            $sql = 'SELECT * FROM post ORDER BY reacciones DESC;';
            break;
        case 2: // Ordenar del más reciente al más antiguo
            $sql = 'SELECT * FROM post ORDER BY fecha_hora_alta DESC;';
            break;
        default: // Ordenar del más antiguo al más reciente
            $sql = 'SELECT * FROM post;';
            break;
    }

    $result = $con->query($sql);
    if ($result->num_rows <= 0) {
        echo '<script>alert("NO DATA")</script>';
        desconectar();
        return;
    }

    while ($fila = $result->fetch_assoc()) {
        $sql2 = 'SELECT nombre, picture FROM usuario WHERE id = "' . $fila['usuario_id'] . '"';
        $result2 = mysqli_query($con, $sql2);
        $autor = $result2->fetch_assoc();

        $postAutor = $autor['nombre'];
        $postAutorPic = $autor['picture'];
        $postTitle = $fila['title'];
        $postBody = html_entity_decode($fila['body'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $bannerPath = $fila['banner_path'];
        $postReactions = $fila['reacciones'];
        $intervalo = obtenerIntervalo($fila['fecha_hora_alta']);
        $postId = $fila['id'];

        echo '
        <article id="post-' . $postId . '" class="post-card" aria-labelledby="post-title-' . $postId . '">
            <header class="post-title" style="background-image: url(\'' . $bannerPath . '\');" role="img" aria-label="Banner del post">
                <h2 id="post-title-' . $postId . '">' . $postTitle . '</h2>
            </header>
            <section class="post-body" aria-label="Contenido del post">
                <div class="post-description">
                    ' . $postBody . '
                </div>
                <div class="post-author-details">
                    <img src="' . $postAutorPic . '" alt="Foto de perfil de ' . $postAutor . '">
                    <div>
                        <p>' . $postAutor . '</p>
                        <time datetime="' . $fila['fecha_hora_alta'] . '">' . $intervalo . '</time>
                    </div>
                </div>
                <div class="post-reactions" role="group" aria-label="Reacciones del post">
                    <p aria-label="' . $postReactions . ' reacciones positivas"><span aria-hidden="true">&#129505; +' . $postReactions . '</span></p>
                </div>
            </section>
        </article>
';
    }

    desconectar();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/index.css">
    <title>Gridee</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>
    <header class="site-header" role="banner">
        <div class="h-side-container">
            <button class="h-side-btn" aria-label="Abrir menú lateral" aria-expanded="false" aria-controls="side-menu">☰</button>
            <img src="images/logo-full.png" alt="Gridee logo">
        </div>
        <div>
            <input id="h-search" class="h-search" type="search" placeholder="Search..." aria-label="Buscar posts">
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
        <a href="/pages/pfp.php" role="menuitem">Change Profile Picture</a>
        <a href="?logout=true" role="menuitem">Sign out</a>
    </div>
    <?php endif; ?>
    <div class="side-menu-wrapper">
        <aside id="side-menu" class="side-menu" role="navigation" aria-label="Menú de filtros">
            <nav class="side-menu-grid">
                <a href="?filtro=1" class="side-menu-link" aria-label="Filtrar por posts más reaccionados">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"
                        viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                        <path
                            d="M341.5 45.1C337.4 37.1 329.1 32 320.1 32C311.1 32 302.8 37.1 298.7 45.1L225.1 189.3L65.2 214.7C56.3 216.1 48.9 222.4 46.1 231C43.3 239.6 45.6 249 51.9 255.4L166.3 369.9L141.1 529.8C139.7 538.7 143.4 547.7 150.7 553C158 558.3 167.6 559.1 175.7 555L320.1 481.6L464.4 555C472.4 559.1 482.1 558.3 489.4 553C496.7 547.7 500.4 538.8 499 529.8L473.7 369.9L588.1 255.4C594.5 249 596.7 239.6 593.9 231C591.1 222.4 583.8 216.1 574.8 214.7L415 189.3L341.5 45.1z" />
                    </svg>
                    <p>Most reacted</p>
                </a>
                <a href="?filtro=2" class="side-menu-link" aria-label="Filtrar por posts más recientes">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M224 64C206.3 64 192 78.3 192 96L192 128L160 128C124.7 128 96 156.7 96 192L96 240L544 240L544 192C544 156.7 515.3 128 480 128L448 128L448 96C448 78.3 433.7 64 416 64C398.3 64 384 78.3 384 96L384 128L256 128L256 96C256 78.3 241.7 64 224 64zM96 288L96 480C96 515.3 124.7 544 160 544L480 544C515.3 544 544 515.3 544 480L544 288L96 288z"/></svg>
                    <p>Newest</p>
                </a>
            </nav>
        </aside>
        <div class="side-menu-overlay" aria-hidden="true"></div>
    </div>
    <main class="main-content" role="main">
        <div class="article-grid" id="article-list" role="feed" aria-label="Lista de posts">
            <?php cargar_posts(); ?>
        </div>
        <?php if (isset($_SESSION["nombre"])): ?>
        <div class="create-post-container">
            <button class="create-post-btn" aria-label="Crear nuevo post">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"
                    viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                    <path
                        d="M416.9 85.2L372 130.1L509.9 268L554.8 223.1C568.4 209.6 576 191.2 576 172C576 152.8 568.4 134.4 554.8 120.9L519.1 85.2C505.6 71.6 487.2 64 468 64C448.8 64 430.4 71.6 416.9 85.2zM338.1 164L122.9 379.1C112.2 389.8 104.4 403.2 100.3 417.8L64.9 545.6C62.6 553.9 64.9 562.9 71.1 569C77.3 575.1 86.2 577.5 94.5 575.2L222.3 539.7C236.9 535.6 250.2 527.9 261 517.1L476 301.9L338.1 164z" />
                </svg>
                <span>Create Post</span>
            </button>
        </div>
        <?php endif; ?>
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
    <script type="module" src="scripts/index.js"></script>
</body>

</html>