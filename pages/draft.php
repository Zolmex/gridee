<?php
session_start();
include '../server/logout.php';

if (!isset($_SESSION['nombre'])) {
    echo '<script>alert("No permitido.")</script>';
    header('Location: /index.php');
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/draft.css">
    <link rel="stylesheet" href="../ckeditor/ckeditor5/ckeditor5.css">
    <title>Gridee - Draft new post</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>
    <header class="site-header" role="banner">
        <div class="h-side-container">
            <img src="../images/logo-full.png" alt="Gridee logo">
        </div>
        <div>
            <button id="profile-btn" class="h-signin" aria-haspopup="true" aria-expanded="false" aria-controls="profile-card">
                <?php echo $_SESSION["nombre"] ?>
            </button>
        </div>
    </header>

    <div id="profile-card" class="profile-card" role="menu" aria-hidden="true">
        <p>Signed in as <strong><?php echo $_SESSION["nombre"]; ?></strong></p>
        <hr>
        <a href="pfp.php" role="menuitem">Change Profile Picture</a>
        <a href="?logout=true" role="menuitem">Sign out</a>
    </div>

    <main class="draft-content" role="main">
        <div class="draft-container">
            <section class="draft-panel" aria-labelledby="draft-panel-header">
                <header class="draft-panel-header" id="draft-panel-header">
                    <p>Draft a new post</p>
                    <svg id="draft-panel-back-btn" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 640 640" role="button" aria-label="Volver al menú anterior">
                        <path
                            d="M73.4 297.4C60.9 309.9 60.9 330.2 73.4 342.7L233.4 502.7C245.9 515.2 266.2 515.2 278.7 502.7C291.2 490.2 291.2 469.9 278.7 457.4L173.3 352L544 352C561.7 352 576 337.7 576 320C576 302.3 561.7 288 544 288L173.3 288L278.7 182.6C291.2 170.1 291.2 149.8 278.7 137.3C266.2 124.8 245.9 124.8 233.4 137.3L73.4 297.3z" />
                    </svg>
                </header>

                <section class="draft-panel-edit">
                    <form id="publish-form" action="../server/publish.php" method="post" enctype="multipart/form-data" aria-describedby="draft-panel-header">
                        <div class="draft-panel-title-input-container">
                            <input type="text" id="post-title-input" name="title" placeholder="Post title..." aria-label="Título del post">
                            <a>Link preview:</a>
                            <a id="title-link-preview"></a>
                        </div>

                        <input type="file" id="post-banner-input" name="banner" aria-label="Subir banner del post"/>
                        <input type="hidden" id="post-body-input" name="body"/>

                        <div id="editor" role="textbox" aria-multiline="true">
                            <p>Hello from CKEditor 5!</p>
                        </div>

                        <div class="draft-panel-options">
                            <input type="submit" class="draft-panel-option-button" id="publish-btn" value="Publish" aria-label="Publicar post"/>
                        </div>
                    </form>
                </section>
            </section>
        </div>
    </main>

    <footer role="contentinfo">
        <div>
            <a href="https://instagram.com" target="_blank" aria-label="Instagram">
                <img src="https://www.google.com/s2/favicons?domain=instagram.com" alt="Instagram" width="24" height="24">
            </a>
            <a href="https://youtube.com" target="_blank" aria-label="YouTube">
                <img src="https://www.google.com/s2/favicons?domain=youtube.com" alt="YouTube" width="24" height="24">
            </a>
            <a href="https://x.com" target="_blank" aria-label="X">
                <img src="https://www.google.com/s2/favicons?domain=x.com" alt="X" width="24" height="24">
            </a>
            <a href="https://linkedin.com" target="_blank" aria-label="LinkedIn">
                <img src="https://www.google.com/s2/favicons?domain=linkedin.com" alt="LinkedIn" width="24" height="24">
            </a>
        </div>
        <p>&copy; 2025 Gridee. All rights reserved.</p>
    </footer>

    <script type="module" src="../scripts/draft.js"></script>
</body>

</html>
