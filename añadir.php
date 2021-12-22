<?php 
    require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db, $port);

    if($conexion->connect_error) die("Error fatal");

    $query = "CREATE TABLE usuarios (
        nombre VARCHAR(50) NOT NULL,
        apellido VARCHAR(50) NOT NULL,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(50) NOT NULL
    )";

    $result = $conexion->query($query);
    if (!$result) die("Error fatal");
    add_user($conexion, $nombre, $apellido, $username, $hash);

    function add_user($conexion, $nom, $ape, $usn, $pas)
    {
        $stmt = $conexion->prepare('INSERT INTO usuarios VALUES(?,?,?,?)');
        $stmt->bind_param('ssss', $nom, $ape, $usn, $pas);
        $stmt->execute();
        $stmt->close();
    }
?>

