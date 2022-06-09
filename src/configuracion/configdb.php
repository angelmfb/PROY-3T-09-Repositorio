<?php
    //Conexión bd local
    define('USERNAME','angel');
    define('SERVERNAME','localhost');
    define('PASSWORD','1234');
    define('DATABASE','palabras');

    try {
        $conexion=new mysqli(SERVERNAME,USERNAME,PASSWORD,DATABASE);
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
    /*
    //Conexión bd hosting
    define('USERNAME','user2daw_07');
    define('SERVERNAME','07@2daw.esvirgua.com');
    define('PASSWORD','MkW(=vk57D{J');
    define('DATABASE','	user2daw_BD1-07');
    */
?>