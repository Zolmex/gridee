<?php
session_start();
include 'server/logout.php';

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
    <header class="site-header">
        <div class="h-side-container">
            <button class="h-side-btn" aria-label="Toggle Sidebar">☰</button>
            <img src="images/logo-full.png" alt="Gridee logo">
        </div>
        <div>
            <input class="h-search" type="text" placeholder="Search...">
        </div>
        <div>
            <?php if (!isset($_SESSION["nombre"])): ?>
            <button id="signin-btn" class="h-signin">Sign in</button>
            <?php else: ?>
            <button id="profile-btn" class="h-signin"><?php echo $_SESSION["nombre"] ?></button>
            <?php endif; ?>
        </div>
    </header>
    <?php if (isset($_SESSION["nombre"])): ?>
    <div id="profile-card" class="profile-card">
        <p>Signed in as <strong><?php echo $_SESSION["nombre"]; ?></strong></p>
        <hr>
        <a href="?logout=true">Sign out</a>
    </div>
    <?php endif; ?>
    <div class="side-menu-wrapper">
        <aside class="side-menu">
            <div class="side-menu-grid">
                <div class="side-menu-link">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                        <path
                            d="M416 224C398.3 224 384 209.7 384 192C384 174.3 398.3 160 416 160L576 160C593.7 160 608 174.3 608 192L608 352C608 369.7 593.7 384 576 384C558.3 384 544 369.7 544 352L544 269.3L374.6 438.7C362.1 451.2 341.8 451.2 329.3 438.7L224 333.3L86.6 470.6C74.1 483.1 53.8 483.1 41.3 470.6C28.8 458.1 28.8 437.8 41.3 425.3L201.3 265.3C213.8 252.8 234.1 252.8 246.6 265.3L352 370.7L498.7 224L416 224z" />
                    </svg>
                    <p>Trending</p>
                </div>
                <div class="side-menu-link">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                        <path
                            d="M341.5 45.1C337.4 37.1 329.1 32 320.1 32C311.1 32 302.8 37.1 298.7 45.1L225.1 189.3L65.2 214.7C56.3 216.1 48.9 222.4 46.1 231C43.3 239.6 45.6 249 51.9 255.4L166.3 369.9L141.1 529.8C139.7 538.7 143.4 547.7 150.7 553C158 558.3 167.6 559.1 175.7 555L320.1 481.6L464.4 555C472.4 559.1 482.1 558.3 489.4 553C496.7 547.7 500.4 538.8 499 529.8L473.7 369.9L588.1 255.4C594.5 249 596.7 239.6 593.9 231C591.1 222.4 583.8 216.1 574.8 214.7L415 189.3L341.5 45.1z" />
                    </svg>
                    <p>Most reacted</p>
                </div>
                <div class="side-menu-link">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                        <path
                            d="M320 96C239.2 96 174.5 132.8 127.4 176.6C80.6 220.1 49.3 272 34.4 307.7C31.1 315.6 31.1 324.4 34.4 332.3C49.3 368 80.6 420 127.4 463.4C174.5 507.1 239.2 544 320 544C400.8 544 465.5 507.2 512.6 463.4C559.4 419.9 590.7 368 605.6 332.3C608.9 324.4 608.9 315.6 605.6 307.7C590.7 272 559.4 220 512.6 176.6C465.5 132.9 400.8 96 320 96zM176 320C176 240.5 240.5 176 320 176C399.5 176 464 240.5 464 320C464 399.5 399.5 464 320 464C240.5 464 176 399.5 176 320zM320 256C320 291.3 291.3 320 256 320C244.5 320 233.7 317 224.3 311.6C223.3 322.5 224.2 333.7 227.2 344.8C240.9 396 293.6 426.4 344.8 412.7C396 399 426.4 346.3 412.7 295.1C400.5 249.4 357.2 220.3 311.6 224.3C316.9 233.6 320 244.4 320 256z" />
                    </svg>
                    <p>Most watched</p>
                </div>
            </div>
        </aside>
        <div class="side-menu-overlay"></div>
    </div>
    <main class="main-content">
        <div class="article-grid" id="article-list"></div>
        <?php if(isset($_SESSION["nombre"])): ?>
        <div class="create-post-container">
            <button class="create-post-btn">
                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                    <path
                        d="M416.9 85.2L372 130.1L509.9 268L554.8 223.1C568.4 209.6 576 191.2 576 172C576 152.8 568.4 134.4 554.8 120.9L519.1 85.2C505.6 71.6 487.2 64 468 64C448.8 64 430.4 71.6 416.9 85.2zM338.1 164L122.9 379.1C112.2 389.8 104.4 403.2 100.3 417.8L64.9 545.6C62.6 553.9 64.9 562.9 71.1 569C77.3 575.1 86.2 577.5 94.5 575.2L222.3 539.7C236.9 535.6 250.2 527.9 261 517.1L476 301.9L338.1 164z" />
                </svg>
                <span>Create Post</span>
            </button>
        </div>
        <?php endif; ?>
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
    <script type="module" src="scripts/index.js"></script>
</body>

</html>