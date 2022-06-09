<?php
    include('../configuracion/configdb.php');
        session_start();
        
        if (isset($_POST['login'])) {
            $nombre = $_POST['nombre'];
            $pw = $_POST['pw'];
        
            $query = $conexion->prepare("SELECT * FROM usuarios WHERE nombre=$nombre");
            $query->bind_param('s', $nombre);
            $query->execute();
        
            $resultado = $query->fetch(PDO::FETCH_ASSOC);
            
            if (!$resultado) {
                echo '<p class="error">Combinación incorrecta!</p>';
            } else {
                if (password_verify($pw, $resultado['pw'])) {
                    echo '<p class="success">Combinación correcta!</p>';
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
      <link rel="icon" href="imagen/escarbar.png">
      <title>Palabritas</title>
  </head>
  <body>
    <header>
    <h1>Palabritas</h1>
    </header>
        <nav>
            <ul>
                <li id="alineacion"><a href="../index.html">Inicio</a></li>
                <li><a href="categoria.php">Categoría</a></li>
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