<?php
if (isset($_GET["logout"])){ // Cerramos sesion primero
    session_destroy();
    session_unset();
    echo '<script>window.location.href = "/index.php"</script>';
}
?>