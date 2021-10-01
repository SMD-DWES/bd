<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alumno</title>
    </head>
    <body>
        <form action="#" method="post">
            <p>
                Número de clase:
                <input type="text" name="idAlu" id="">
            </p>
            <p>
                Nombre del alumno:
                <input type="text" name="nombreAlu" id="">
            </p>

            <input type="submit" name="enviar[]" value="Enviar">
        </form>
    </body>
</html>

<?php
    //Introducir un numero de alumno y que muestre la info del mismo 

    //print_r($_POST["enviar"]);

    if(isset($POST["enviar"])) {
        $idForm = $_POST["idAlu"];

        $conexion = mysqli_connect("localhost", "root", "", "bd_procedimientos");
        

        $sql = 'SELECT * FROM alumnos WHERE id='.$idForm;

        $result = mysqli_query($conexion, $sql);

        if(mysqli_num_rows($result) > 0) {
            $fila = mysqli_fetch_array($result,MYSQLI_ASSOC);
            echo '<br>ID: <b>'.$fila["id"].'</b>';
            echo '<br>Nombre: <b>'.$fila["nombre"].'</b>';

            //Repetidor
            $repetidor = ($fila["repite"] == 0) ? "No" : "Si";
            echo '<br>Repite: <b>'.$repetidor.'</b>';
        } else {
            echo 'Dato no encontrado';
        }
    }
    else
        echo "Error, te falta rellenar dato";
?>