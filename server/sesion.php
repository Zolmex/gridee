<?php
if (isset($_GET["logout"])){ // Cerramos sesion primero
    session_destroy();
}
else if (isset($_SESSION["nombre"])){
    echo "<div><p>Usuario: ".$_SESSION["nombre"]."</p>";
    echo "<button onclick='window.location.href += \"?logout=true\"'>Cerrar sesión</button></div>";
}
?>