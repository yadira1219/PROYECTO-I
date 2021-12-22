<?php //signup.php
    require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db, $port);
    if ($conexion->connect_error) die ("Fatal error");

    if(isset($_POST['username']) && isset($_POST['password']))
    {
        $nombre = mysql_entities_fix_string($conexion, $_POST['nombre']);
        $apellido = mysql_entities_fix_string($conexion, $_POST['apellido']);
        $username = mysql_entities_fix_string($conexion, $_POST['username']);
        $pw_temp = mysql_entities_fix_string($conexion, $_POST['password']);

        $password = password_hash($pw_temp, PASSWORD_DEFAULT);

        $query = "INSERT INTO usuarios 
            VALUES('$nombre','$apellido','$username', '$password')";

        $result = $conexion->query($query);
        if (!$result) die ("Falló registro");

        echo "Registro exitoso <a href='inicioSesion.php'>Ingresar</a>";
        
    }
    else
    {
        echo <<<_END
        <h1>Regístrate</h1>
        <form action="registroSesion.php" method="post"><pre>
        Nombre  <input type="text" name="nombre">
        Apellido  <input type="text" name="apellido">
        Usuario  <input type="text" name="username" placeholder="¿Con que nombre te gustaria registrarte?">
        Password <input type="password" name="password" placeholder="¿Tu contraseña es?">
                 <input type="hidden" name="reg" value="yes">
                 <input type="submit" value="REGISTRAR">
        </form>
        _END;
    }
    function mysql_entities_fix_string($conexion, $string)
    {
        return htmlentities(mysql_fix_string($conexion, $string));
      }
    function mysql_fix_string($conexion, $string)
    {
        return $conexion->real_escape_string($string);
      }   
?>