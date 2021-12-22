<?php 
    require_once 'login.php';
    session_start();
    $conexion = new mysqli($hn, $un, $pw, $db, $port);

    if ($conexion->connect_error) die ("Fatal error");
    $username = $_SESSION['username'];
    if (isset($_POST['delete']) && isset($_POST['id']))
    {   
        $id = get_post($conexion, 'id');
        $query = "DELETE FROM tareas WHERE id='$id'";
        $result = $conexion->query($query);
        if (!$result) echo "BORRAR falló"; 
    }

    if  (isset($_POST['id']) &&
        isset($_POST['titulo']) &&
        isset($_POST['contenido']) &&
        isset($_POST['fecharegistro']) &&
        isset($_POST['fechavencimiento']) &&
        isset($_POST['prioridad']))
    {
        $id = get_post($conexion, 'id');
        $titulo = get_post($conexion, 'titulo');
        $contenido = get_post($conexion, 'contenido');
        $fechaRegistro = get_post($conexion, 'fecharegistro');
        $fechaVencimiento = get_post($conexion, 'fechavencimiento');
        $prioridad = get_post($conexion, 'prioridad');
        $username = $_SESSION['username'];
        $query = "INSERT INTO tareas VALUE" .
            "('$id', '$titulo', '$contenido', '$fechaRegistro', '$fechaVencimiento', '$prioridad', '$username')";
        $result = $conexion->query($query);
        if (!$result) echo "INSERT falló <br><br>";
    }

    if ($conexion->connect_error) die ("Fatal error");
    $username = $_SESSION['username'];
    if(isset($_POST['archivados'])){
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
    echo "<br>";
    }
    if (isset($_POST['archivados']) && isset($_POST['id']))
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
        
        <pre>
        Id: $r0
        Titulo: $r1
        Contenido: $r2
        FechaRegistro: $r3
        FechaVencimiento: $r4
        Prioridad: $r5
        </pre>
          </pre>      
        _END;

    $file = "archivados.php";
    $fp = fopen($file, "r");
    $contents = fread($fp, filesize($file));

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