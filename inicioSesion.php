<?php 
    require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db, $port);

    if($conexion->connect_error) die("Error fatal");

    session_start();
    if(isset($_SESSION['nombre']))
    {
      header('Location: tareas.php');
    }
    session_destroy();

    if (isset($_POST['username'])&&
        isset($_POST['password']))
    {
        $un_temp = mysql_entities_fix_string($conexion, $_POST['username']);
        $pw_temp = mysql_entities_fix_string($conexion, $_POST['password']);
        $query   = "SELECT * FROM usuarios WHERE username='$un_temp'";
        $result  = $conexion->query($query);
        
        if (!$result) die ("Usuario no encontrado");
        elseif ($result->num_rows)
        {
            $row = $result->fetch_array(MYSQLI_NUM);
            $result->close();

            
                session_start();
                $_SESSION['nombre']=$row[0];
                $_SESSION['apellido']=$row[1];
                $_SESSION['username']=$row[2];
                echo htmlspecialchars("$row[0] $row[1]:
                    HOLA $row[0], HAS INGRESADO COMO '$row[0]'");
                die ("<p><a href='tareas.php'>
              Click para continuar</a></p>");
           
                echo "Usuario/password incorrecto <p><a href='registroSesion.php'>
            Registrarse</a></p>";
            
        }
        else {
          echo "Usuario/password incorrecto <p><a href='registroSesion.php'>
      Registrarse</a></p>";
      }   
    }
    else
    {
      echo <<<_END
      <h1>Iniciar sesion</h1>
      <form action="inicioSesion.php" method="post"><pre>
      Usuario  <input type="text" name="username">
      Password <input type="password" name="password">
               <input type="submit" value="INGRESAR">
      </form>
      _END;
    }

    $conexion->close();

    function mysql_entities_fix_string($conexion, $string)
    {
        return htmlentities(mysql_fix_string($conexion, $string));
      }
    function mysql_fix_string($conexion, $string)
    {
        return $conexion->real_escape_string($string);
      }  
?>
