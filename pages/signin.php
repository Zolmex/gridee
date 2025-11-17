<?php
session_start();
include '../server/logout.php';
include '../server/conexionbd.php';

$error = '';
$redirect = '';

if (isset($_POST['username'])) {
    conectar('gridee');
    $nombre = htmlspecialchars($_POST['username']);
    $clave = htmlspecialchars($_POST['password']);

    $sql = 'SELECT contraseña, id FROM usuario WHERE nombre LIKE \'' . $nombre . '\'';
    $result = mysqli_query($con, $sql);

    if ($result->num_rows == 0) { // Login fallido
        $error = "Nombre de usuario incorrecto.";
    } else { // Verificar contraseña
        $resultado = $result->fetch_assoc();
        $clave_hash_usuario = $resultado["contraseña"];
        if (password_verify($clave, $clave_hash_usuario)) {
            $_SESSION["nombre"] = $nombre; // Login exitoso, guardamos los datos del usuario en una sesión nueva
            $_SESSION["id"] = (int)$resultado["id"];
            $error = "Bienvenido de nuevo " . $nombre . "!";
            $redirect = "/index.php";
        } else {
            $error = "Nombre de usuario o contraseña incorrectos.";
        }
    }
    desconectar();
}
if ($error != '') {
    echo '<script>alert("' . $error . '")</script>';
}
if ($redirect != ''){
    header('Location: '.$redirect);
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/signin.css">
    <title>Gridee - Sign in</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>
    <header class="site-header">
        <div class="h-side-container">
            <img src="../images/logo-full.png" alt="Gridee logo">
        </div>
    </header>
    <main class="login-content">
        <div class="login-container">
            <section class="login-panel-container">
                <header class="login-panel-header">
                    <img src="../images/logo-full.png" alt="Gridee logo">
                    <p>Welcome back</p>
                </header>
                <div class="login-panel">
                    <form class="login-panel-input-grid" action="/pages/signin.php" method="post">
                        <label for="login-panel-username">Username</label>
                        <div class="login-panel-input-field-username">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path
                                    d="M320 312C386.3 312 440 258.3 440 192C440 125.7 386.3 72 320 72C253.7 72 200 125.7 200 192C200 258.3 253.7 312 320 312zM290.3 368C191.8 368 112 447.8 112 546.3C112 562.7 125.3 576 141.7 576L498.3 576C514.7 576 528 562.7 528 546.3C528 447.8 448.2 368 349.7 368L290.3 368z" />
                            </svg>
                            <input id="login-panel-username" name="username" type="text" placeholder="Username">
                        </div>
                        <label for="login-panel-password">Password</label>
                        <div class="login-panel-input-field-password">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path
                                    d="M256 160L256 224L384 224L384 160C384 124.7 355.3 96 320 96C284.7 96 256 124.7 256 160zM192 224L192 160C192 89.3 249.3 32 320 32C390.7 32 448 89.3 448 160L448 224C483.3 224 512 252.7 512 288L512 512C512 547.3 483.3 576 448 576L192 576C156.7 576 128 547.3 128 512L128 288C128 252.7 156.7 224 192 224z" />
                            </svg>
                            <input id="login-panel-password" type="password" name="password" placeholder="Password">
                        </div>
                        <button type="submit" class="login-panel-signin-button">Sign In</button>
                    </form>
                    <div class="login-panel-options">
                        <a href="/pages/signup.php">Don't have an account?</a>
                        <a href="#">Forgot password?</a>
                    </div>
                </div>
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
    <script type="module" src="../scripts/signin.js"></script>
</body>

</html>
