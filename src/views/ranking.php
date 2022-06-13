<?php
     session_start();
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
                <li class="alineacion2"><a href="juego.php">Juego</a></li>
                <li><a href="ranking.php">Ranking</a></li>
                <?php
                if($_SESSION){
                    echo "<li><a href='login.php'>Cerrar Sesion</a></li>";
                    if($_SESSION['tipo']=='a'){
                       echo "<li><a href='crear.php'>Crear</a></li>";
                    }
                }
                ?>
            </ul>
            
        </nav>
        <main>
            <?php
                include('../configuracion/configdb.php');
               
                $consulta = "SELECT usuario.nombre as 'usuarioNombre',actividad.nombre,puntuacion,fecha FROM usuario inner join realiza on usuario.idUsuario=realiza.idUsuario inner join actividad on realiza.idActividad=actividad.idActividad WHERE puntuacion>=80";
                $resultado = mysqli_query($conexion, $consulta);
                echo    "
                        <table>
                            <tr>
                                <th>nombreUsuario</th>
                                <th>nombreActividad</th>
                                <th>puntuacion</th>
                                <th>fecha</th>
                            </tr>
                        ";
                while($fila=$resultado->fetch_assoc()) {
                    echo "<tr>
                            <td>".$fila['usuarioNombre']."</td>
                            <td>".$fila['nombre']."</td>
                            <td>".$fila['puntuacion']."</td>
                            <td>".$fila['fecha']."</td>
                        </tr>";
                }
                echo    "</table>";
            ?>
        </main>
  </body>
</html>