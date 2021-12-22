<?php 
    require_once 'login.php';
    session_start();
    $conexion = new mysqli($hn, $un, $pw, $db, $port);

    if ($conexion->connect_error) die ("Fatal error");
    $username = $_SESSION['username'];
    if(isset($_POST['editado'])){
        if  (isset($_POST['id']) &&
        isset($_POST['titulo']) &&
        isset($_POST['contenido']) &&
        isset($_POST['fecharegistro']) &&
        isset($_POST['fechavencimiento']))
    {
        $id = get_post($conexion, 'id');
        $titulo = get_post($conexion, 'titulo');
        $contenido = get_post($conexion, 'contenido');
        $fechaRegistro = get_post($conexion, 'fecharegistro');
        $fechaVencimiento = get_post($conexion, 'fechavencimiento');
        $username = $_SESSION['username'];
        $query = "UPDATE tareas SET id='$id', titulo='$titulo', contenido='$contenido', fechaRegistro='$fechaRegistro', fechaVencimiento='$fechaVencimiento' WHERE id='$id'";
        $result = $conexion->query($query);
        if (!$result) echo "INSERT falló <br><br>";
    }
    echo "Continua registrando y revisando tus tareas <a href=tareasGuardar.php>Volver atras</a>";
    }
    if (isset($_POST['update']) && isset($_POST['id']))
    {   
        $id = get_post($conexion, 'id');
        $query = "SELECT * FROM tareas WHERE id='$id'";
        echo $id;
        $result = $conexion->query($query);
        if (!$result) echo "BORRAR falló"; 
        
    

    $rows = $result->num_rows;

    for ($j = 0; $j < $rows; $j++)
    {
        $row = $result->fetch_array(MYSQLI_NUM);

        $r0 = htmlspecialchars($row[0]);
        $r1 = htmlspecialchars($row[1]);
        $r2 = htmlspecialchars($row[2]);
        $r3 = htmlspecialchars($row[3]);
        $r4 = htmlspecialchars($row[4]);
        $r5 = htmlspecialchars($row[5]);

        echo "<hr>";

        echo <<<_END
        
    <form action="update.php" method="post"><pre>
        Id <input type="text" name= "id" value="$r0">    
        Titulo <input type="text" name="titulo" value="$r1">
        Contenido <textarea name="contenido" cols="20" rows="10" maxlength=="200" wrap="type" placeholder="¿Que necesitas anotar?">
        $r2</textarea>
        FechaRegistro <input type="date" name="fecharegistro" value="$r3">
        FechaVencimiento <input type="date" name= "fechavencimiento" value="$r4">
        
             <input type="submit" value="Añadir tarea" name="editado">
    </pre></form>
    _END; 
    $result->close();
    $conexion->close();
    }
    echo "Querido usuario aqui puede <a href=logout.php>Cerrar sesion</a>";

    }
    

    function get_post($con, $var)
    {
        return $con->real_escape_string($_POST[$var]);
    }
?>