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
            <form action="#" method="post">
                <select name="idActividad">
                    <?php
                        include('../configuracion/configdb.php');
                       
                    
                        $consulta = "select actividad.nombre as 'nombreActividad', actividad.idActividad, categoria.nombre, categoria.idCategoria
                        from actividad inner join categoria ON
                            actividad.idCategoria=categoria.idCategoria";
                        $resultado = mysqli_query($conexion, $consulta);
                        
                        while($fila=$resultado->fetch_assoc()){
                            
                            echo "<option value=".$fila['idActividad'].">".$fila['nombreActividad']."</option>";
                        }
                    ?>
                </select>
                <button type="submit" name="enviar">Enviar</button>
            </form>
            <?php
                if(isset($_POST['enviar'])){
                    $consulta = "SELECT palabra.idPalabra, ingles, español, categoria.idCategoria,idActividad 
                    FROM palabra inner join categoria ON
                        palabra.idCategoria=categoria.idCategoria
                        inner join actividad ON
                        categoria.idCategoria=actividad.idCategoria
                    WHERE actividad.idActividad='".$_POST['idActividad']."';";
                    $resultado = mysqli_query($conexion, $consulta);
                    echo    "<form action='#' method='post'>
                                <table>
                                <tr>
                                    <th>Ingles</th>
                                    <th>Español</th>
                                </tr>
                                ";
                                //plan de pruebas, ahora solo me muestra una linea cuando deberian de ser 3 que son los que tengo en la bd de cada categoria por ahora
                                $i=0;
                                while($fila=$resultado->fetch_assoc()){
                                    echo "<tr>
                                <td>".$fila['ingles']."<input type='hidden' name='ingles[$i]' value='".$fila['ingles']."'>
                                </td>
                                <td>
                                    <select name='espanol[$i]'>".
                                        $consulta = "SELECT español FROM palabra WHERE idCategoria=".$fila['idCategoria'];
                                        $resultado2 = mysqli_query($conexion, $consulta);
                                        
                                        while($fila2=$resultado2->fetch_assoc()){
                                            echo "<option name=".$fila2['español']." >".$fila2['español']."</option>";//plan de pruebas, siempre me sale en el select de español los animales cuando deberia vatiar en funcion de la categoria escogida
                                        }
                                    "</select>
                                </td>
                            </tr>";
                            $i=$i+1;
                            
                    }
                    echo "  </table>
                            <input type='hidden' name='idActividad' value='".$_POST['idActividad']."'>
                            <button type='submit' name='comprobar'>Comprobar</button>
                        
                        </form>
                        ";
                    
                    
                    
                }
                if(isset($_POST['comprobar'])){
                    $puntos=0;
                    print_r($_POST);
                    for ($i=0;$i<10;$i++) { 
                        $consulta = "SELECT idpalabra FROM palabra WHERE ingles='".$_POST['ingles'][$i]."' && español='".$_POST['espanol'][$i]."';";
                        $resultado3 = mysqli_query($conexion, $consulta);
                        if($resultado3->num_rows){
                        
                            $puntos=$puntos+10;
                        }
                    }
                    echo $puntos;
                    if($puntos==100){
                        echo '<p class="success">Campeón!</p>';
                    }
                    if($_SESSION){
                        echo $_SESSION['idUsuario'];
                        echo $_POST['idActividad'];
                        $consulta4="INSERT INTO realiza(idUsuario, idActividad, puntuacion, fecha)
                        VALUES ('".$_SESSION['idUsuario']."','".$_POST['idActividad']."',$puntos,now());"; 
                        $resul4=mysqli_query($conexion, $consulta4);
                    }
                    header('Location: ranking.php');
                    
                }
            ?>
        </main>
  </body>
</html>