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
                <li class="alineacion2"><a href="categoria.php">Categoría</a></li>
                <li><a href="ranking.php">Ranking</a></li>
            </ul>
        </nav>
        <main>
            <?php
                include('../configuracion/configdb.php');
                $consulta = "SELECT * FROM realiza WHERE puntuacion>=8";
                $resultado = mysqli_query($conexion, $consulta);
                echo    "
                        <table>
                            <tr>
                                <th>idUsuario</th>
                                <th>idActividad</th>
                                <th>puntuacion</th>
                                <th>fecha</th>
                            </tr>
                        ";
                while($fila=$resultado->fetch_assoc()) {
                    echo "<tr>
                            <td>".$fila['idUsuario']."</td>
                            <td>".$fila['idActividad']."</td>
                            <td>".$fila['puntuacion']."</td>
                            <td>".$fila['fecha']."</td>
                        </tr>";
                }
                echo    "</table>";
            ?>
        </main>
  </body>
</html>