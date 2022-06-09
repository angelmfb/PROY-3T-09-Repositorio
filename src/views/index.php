<?php
    require_once __DIR__ . '/../controller/controlador.php';
    $controlador = new Controlador();
    if(isset($_GET['accion'])){
        //Realizo un switch de la accion y según la acción que viene por ruta llamo a un método del controlador u otro
        switch($_GET['accion']){
            case 'login':
                $controlador->login();
                break;
            default:
                echo "Se ha producido un error inesperado";
                break;
        }
    }else{
        echo "No hay ninguna acción seleccionada";
    }
?>