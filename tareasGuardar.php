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

    echo <<<_END
    <form action="tareasGuardar.php" method="post"><pre>
        Id <input type="text" name= "id">    
        Titulo <input type="text" name="titulo">>
        Contenido <textarea name="contenido" cols="20" rows="10" maxlength=="200" wrap="type" placeholder="¿Que necesitas anotar?">
        </textarea>
        FechaRegistro <input type="date" name="fecharegistro">
        FechaVencimiento <input type="date" name= "fechavencimiento">
        Baja <input type="radio" name="prioridad" value="Baja">
        Media <input type="radio" name="prioridad" value="Media">
        Alta <input type="radio" name="prioridad" value="Alta">
        
             <input type="submit" value="Añadir tarea">
    </pre></form>
    _END;

    $query = "SELECT * FROM tareas WHERE username='$username' ORDER BY fechaVencimiento";
    $select = "SELECT * FROM tareas WHERE STR_TO_DATW(fecha) BETWEEN curdate() and date_add(curdate(), interval 30 days";

    $result = $conexion->query($query);
    if (!$result) die ("Falló el acceso a la base de datos");

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
        <form action='tareasGuardar.php' method='post'>
        <input type='hidden' name='delete' value='yes'>
        <input type='hidden' name='id' value='$r0'>
        <input type='submit' value='BORRAR TAREA'></form>

        <form action='update.php' method='post'>
        <input type='hidden' name='update' value='yes'>
        <input type='hidden' name='id' value='$r0'>
        <input type='submit' value='EDITAR TAREA'></form>

        <form action='archivados.php' method='post'>
        <input type='hidden' name='archivados' value='yes'>
        <input type='hidden' name='id' value='$r0'>
        <input type='submit' value='ARCHIVAR TAREA'></form>
        
        _END;

    }

    echo "Querido usuario aqui puede <a href=tareas.php>Volver atras</a>";
    echo "<br>";
    echo "Querido usuario aqui puede <a href=logout.php>Cerrar sesion</a>";
    echo "<br>";

    $result = $conexion->query($select);
    if (!$result) die ("TUS TAREAS VENCERAN PRONTO REVISALAS :)");

    $result->close();
    $conexion->close();
    

    function get_post($con, $var)
    {
        return $con->real_escape_string($_POST[$var]);
    }
?>
