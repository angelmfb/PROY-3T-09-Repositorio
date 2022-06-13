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
                    if($_SESSION['tipo']=='u'){
                       echo "<li><a href='crear.php'>Crear</a></li>";
                    }
                }
                ?>
            </ul>
        </nav>
        <main>
            <h4>CREANDO ACTIVIDAD</h4>
            <form action="#" method="post">
                <label for="nombreActividad">Nombre Actividad</label>
                <input type="text" id="nombreActividad" name="nombreActividad"><br /><br />
                <label for="">Selecciona una categoría</label>
                <select name="categoria">
                <?php
                        include('../configuracion/configdb.php');
                    
                        $consulta = "select * from categoria";
                        $resultado = mysqli_query($conexion, $consulta);
                        
                        while($fila=$resultado->fetch_assoc()){
                            
                            echo "<option value=".$fila['idCategoria'].">".$fila['nombre']."</option>";
                        }
                    ?>
                </select>
                <button type="submit" name="mostrar">Mostrar categorías</button>
            </form>
            <?php
                if(isset($_POST['mostrar'])){
                    print_r($_POST['categoria']);
                    $consulta = "SELECT ingles, idCategoria  from palabra 
                    where idCategoria='".$_POST['categoria']."';";
                     $resultado = mysqli_query($conexion, $consulta);
                echo    "<form action='#' method='post'>
                            <table>
                            ";
                            
                            $i=0;
                            $consulta = "SELECT ingles FROM palabra WHERE idCategoria=".$_POST['categoria']."';";
                            $resultado = mysqli_query($conexion, $consulta);
                            $conexion->error;
                            while($fila=$resultado->fetch_assoc()){
                                
                                echo "<tr>
                                <td><label> palabra$i</label> </td>
                                <td>";
                                $consulta2 = "SELECT ingles FROM palabra WHERE idCategoria=1;";
                                $resultado2 = mysqli_query($conexion, $consulta2);
                                $conexion->error;
                                while($fila2=$resultado2->fetch_assoc()){
                                    echo "<select name='ingles[$i]'>
                                        <option name=".$fila2['ingles']." >".$fila2['ingles']."</option>";
                                }
                                    echo "</select>
                                            </td>
                                        </tr>";
                            $i=$i+1;
                            }
                     echo "  </table>
                             <button type='submit' name='crear'>Crear</button>
                         </form>
                         ";
                }   
            ?>
        </main>
  </body>
</html>