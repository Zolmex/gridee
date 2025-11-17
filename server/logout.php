<?php
if (isset($_GET["logout"])){ // Cerramos sesion primero
    session_destroy();
    session_unset();
    header('Location: /index.php');
}
?>