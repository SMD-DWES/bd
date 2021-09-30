<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulario</title>
    </head>
    <body>
        <form action="#" method="post">
            <p>
                ID:
                <input type="text" name="idAlu" id="">
            </p>
            <p>
                Nombre del alumno:
                <input type="text" name="nombreAlu" id="">
            </p>

            <input type="submit" value="Enviar" name="enviar[]">
        </form>
    </body>
</html>

<?php
    //print_r($_POST);

    if(isset($_POST["enviar"])) {

        //Si ambos campos estan vacios, entonces no se hace nada.
        if(empty($_POST["idAlu"]) && empty($_POST["nombreAlu"]))
            return;

        if(!empty($_POST["idAlu"]) && !empty($_POST["nombreAlu"])) {
            echo '<br /><b>ERROR, no puedes buscar por los dos campos a la vez, elige uno de los dos.</b>';
        } else {
            $conexion = mysqli_connect("localhost","root","","bd_procedimientos");

            //Si alguno de los dos campos NO esta vacío usará el sql especificado.
            if(!empty($_POST["idAlu"]))
                $sql = 'SELECT * FROM alumnos WHERE id="'.$_POST["idAlu"].'"';
            if(!empty($_POST["nombreAlu"]))
                $sql = 'SELECT * FROM alumnos WHERE nombre LIKE "'.$_POST["nombreAlu"].'%"';

            //Si el query es correcto devuelve un objeto de tipo mysqli_result, en caso contrario, return.
            $query = mysqli_query($conexion,$sql);
            
            if(mysqli_num_rows($query)>0) {

                while($fila = mysqli_fetch_array($query,MYSQLI_ASSOC)){

                    echo '<br>ID: <b>'.$fila["id"].'</b><br />';
                    echo 'Nombre: <b>'.$fila["nombre"].'</b><br />';

                    $repetidor = ($fila["repite"] == 0) ? "No" : "Sí";

                    echo 'Repite: <b>'.$repetidor.'</b><br />';
                }
            } else {
                echo '<h3>Error, dato no encontrado.</h3>';
            }
            mysqli_close($conexion);
        }
    }


?>