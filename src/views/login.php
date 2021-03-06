<?php
    if(isset($_SESSION['idUsuario'])){
        session_destroy();
    }
   /*
    Para el login de usuarios:
    usuario:admin   contraseña:1234
    usuario:juan    contraseña:1234
    */
   */
    include('../configuracion/configdb.php');
    session_start();
    
    if (isset($_POST['login'])) {
        $nombre = $_POST['nombre'];
        $pw = $_POST['pw'];
    
        $query = $conexion->prepare("SELECT * FROM usuario WHERE nombre=?");
        $query->bind_param('s',$nombre);
        $resultado=$query->execute();
        
        
        if (!$resultado) {
            echo '<p class="error">Combinación incorrecta!</p>';
        } else {
            $resultado= $query->get_result();
            $fila=$resultado->fetch_assoc();
            print_r($fila);
            /*
             password_verify($pw, $fila['pw'])*/
            
            if ($fila &&  $pw== $fila['pw']) {
                echo '<p class="success">Combinación correcta!</p>';
                $_SESSION['idUsuario'] =$fila['idUsuario'];
                $_SESSION['tipo'] = $fila['tipo'];
                if ($fila['tipo']=='a') {
                    header('Location: crear.php');
                }
                else {
                    header('Location: juego.php');
                }
            } else {
                echo '<p class="error">Combinación incorrecta!</p>';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="author" content="Ángel Manuel Fernández Baños">
      <link rel="stylesheet" href="../css/estilo.css">
      <link rel="icon" href="../imagen/escarbar.png">
      <title>Palabritas</title>
  </head>
  <body>
    <header>
    <h1>Palabritas</h1>
    </header>
        <nav>
            <ul>
                <li id="alineacion"><a href="../index.html">Inicio</a></li>
                <li><a href="juego.php">Juego</a></li>
            </ul>
        </nav>
    <main>
        <form method="post" action="" name="signin-form">
            <label>Nombre</label>
            <input type="text" name="nombre" pattern="[a-zA-Z0-9]+"/><br /><br />
            <label>Contraseña</label>
            <input type="password" name="pw"/><br /><br />
            <input type="submit" name="login" value="login"/><!--plan de pruebas, hay que validar con php, si pones contraseñas incorrectas o nombre da error, sin lo pones bien avanza-->
        </form>
    </main>
  </body>
</html>