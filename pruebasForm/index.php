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
            $conexion = new mysqli("localhost","root","","bd_procedimientos");
            

            //Elimino espacios en blanco antes de pasarlo al SQL, pero solo elimina el del
            //principio y final
            $idAlu = trim($_POST["idAlu"]);
            $nombreAlu = trim($_POST["nombreAlu"]);

            $nombre = "";
            $apellido = "";

            //Quitar espacios en blanco del medio, utiliza dos variables, nombre y apellido
            $lenght = strlen($nombreAlu);
            $i = 0;
            $hayEspacio = false;
            while($i < $lenght) {
                if($nombreAlu[$i] == ' '){
                    $nombreAlu[$i++];
                    $hayEspacio = true;
                }
                if($hayEspacio){
                    $apellido .= $nombreAlu[$i];
                } else 
                    $nombre .= $nombreAlu[$i];

                $i++;
            }

            //Elimino espacios al principio y al final.
            $nombre = trim($nombre);
            $apellido = trim($apellido);

            $nombreFull = $nombre . " " . $apellido;
            //echo "Nombre: ".$nombre . " <br>Apellido: ".$apellido;


            //Si alguno de los dos campos NO esta vacío usará el sql especificado.
            if(!empty($_POST["idAlu"]))
                $sql = 'SELECT * FROM alumnos WHERE id="'.$idAlu.'"';
            if(!empty($_POST["nombreAlu"]))
                $sql = 'SELECT * FROM alumnos WHERE nombre LIKE "'.trim($nombreFull).'%"';

            //Si el query es correcto devuelve un objeto de tipo mysqli_result, en caso contrario, return.
            $query = $conexion->query($sql);

            
            if($query->num_rows>0) {

                while($fila = $query->fetch_array(MYSQLI_ASSOC)){

                    echo '<br>ID: <b>'.$fila["id"].'</b><br />';
                    echo 'Nombre: <b>'.$fila["nombre"].'</b><br />';

                    $repetidor = ($fila["repite"] == 0) ? "No" : "Sí";

                    echo 'Repite: <b>'.$repetidor.'</b><br />';
                }
            } else {
                echo '<h3>Error, dato no encontrado.</h3>';
            }
            $conexion->close();
        }
    }


?>