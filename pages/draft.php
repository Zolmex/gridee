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
    <header class="site-header">
        <div class="h-side-container">
            <img src="../images/logo-full.png" alt="Gridee logo">
        </div>
    </header>
    <main class="draft-content">
        <div class="draft-container">
            <section class="draft-panel">
                <header class="draft-panel-header">
                    <p>Draft a new post</p>
                    <svg id="draft-panel-back-btn" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                        <path
                            d="M73.4 297.4C60.9 309.9 60.9 330.2 73.4 342.7L233.4 502.7C245.9 515.2 266.2 515.2 278.7 502.7C291.2 490.2 291.2 469.9 278.7 457.4L173.3 352L544 352C561.7 352 576 337.7 576 320C576 302.3 561.7 288 544 288L173.3 288L278.7 182.6C291.2 170.1 291.2 149.8 278.7 137.3C266.2 124.8 245.9 124.8 233.4 137.3L73.4 297.3z" />
                    </svg>
                </header>
                <section class="draft-panel-edit">
                    <form action="../server/publish.php" method="POST" enctype="multipart/form-data">
                        <div class="draft-panel-title-input-container">
                            <input type="text" id="post-title-input" name="title" placeholder="Post title...">
                            <a>Link preview:</a>
                            <a id="title-link-preview"></a>
                        </div>
                        <input type="file" id="post-banner-input" name="banner"/>
                        <input type="hidden" id="post-body-input" name="body"/>
                        <div id="editor">
                            <p>Hello from CKEditor 5!</p>
                        </div>
                        <div class="draft-panel-options">
                            <input type="submit" class="draft-panel-option-button" id="publish-btn" value="Publish"/>
                        </div>
                    </form>
                </section>
            </section>
        </div>
    </main>
    <footer>
        <div>
            <a href="https://instagram.com" target="_blank">
                <img src="https://www.google.com/s2/favicons?domain=instagram.com" alt="Instagram" width="24"
                    height="24">
            </a>
            <a href="https://youtube.com" target="_blank">
                <img src="https://www.google.com/s2/favicons?domain=youtube.com" alt="YouTube" width="24" height="24">
            </a>
            <a href="https://x.com" target="_blank">
                <img src="https://www.google.com/s2/favicons?domain=x.com" alt="X" width="24" height="24">
            </a>
            <a href="https://linkedin.com" target="_blank">
                <img src="https://www.google.com/s2/favicons?domain=linkedin.com" alt="LinkedIn" width="24" height="24">
            </a>
        </div>
        <p>&copy; 2025 Gridee. All rights reserved.</p>
    </footer>
    <script type="module" src="../scripts/draft.js"></script>
</body>

</html>