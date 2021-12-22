<?php //continue.php
    session_start();

    if (isset($_SESSION['nombre']))
    {
        $nombre = htmlspecialchars($_SESSION['nombre']);
        $apellido = htmlspecialchars($_SESSION['apellido']);

        echo "Bienvenido otra vez $nombre.<br>
               Tu nombre completo es $nombre $apellido.<br>
               <a href=logout.php>Cerrar sesion</a>.<br>";
               echo "<hr>";
        echo "Usuario $nombre:<br>
               para crear y ver tus tareas pendientes en linea.<br>
               <a href=tareasGuardar.php> Click aqui</a>.<br>";

    }
    else echo "Por favor <a href=inicioSesion.php>Click aqui</a>
                para ingresar";
?>