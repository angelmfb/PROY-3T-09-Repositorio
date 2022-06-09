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
            <form action="#" method="post">
                <select name="categoria">
                    <?php
                        include('../configuracion/configdb.php');
                        $consulta = "SELECT * FROM categoria";
                        $resultado = mysqli_query($conexion, $consulta);
                        
                        while($fila=$resultado->fetch_assoc()){
                            echo "<option value=".$fila['idCategoria'].">".$fila['nombre']."</option>";
                        }
                    ?>
                </select>
                <button type="submit" name="enviar">Enviar</button>
            </form>
            <?php
                if(isset($_POST['enviar'])){
                    $consulta = "SELECT * FROM palabra WHERE idCategoria=".$_POST['categoria'];
                    $resultado = mysqli_query($conexion, $consulta);
                    echo    "
                                <table>
                                <tr>
                                    <th>Ingles</th>
                                    <th>Español</th>
                                </tr>
                                ";
                                //plan de pruebas, ahora solo me muestra una linea cuando deberian de ser 3 que son los que tengo en la bd de cada categoria por ahora
                    while($fila=$resultado->fetch_assoc()){
                        echo "<tr>
                                <td>".$fila['ingles']."</td>
                                <td>
                                    <select name='palabra'>".
                                        $consulta = "SELECT español FROM palabra WHERE idCategoria=".$_POST['categoria'];
                                        $resultado = mysqli_query($conexion, $consulta);
                                        
                                        while($fila=$resultado->fetch_assoc()){
                                            echo "<option value=".$fila['idPalabra'].">".$fila['español']."</option>";//plan de pruebas, siempre me sale en el select de español los animales cuando deberia vatiar en funcion de la categoria escogida
                                        }
                                    "</select>
                                </td>
                            </tr>";
                    }
                    echo    "</table>";
                }
            ?>
        </main>
  </body>
</html>