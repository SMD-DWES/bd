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

    class Formulario {
        function __construct() {

            $this->comprobaciones();

        }

        function comprobaciones() {

            if(isset($_POST["enviar"])) {

                //Si ambos campos estan vacios, entonces no se hace nada.
                if(empty($_POST["idAlu"]) && empty($_POST["nombreAlu"]))
                    return;

                if(!empty($_POST["idAlu"]) && !empty($_POST["nombreAlu"])) {
                    echo '<br /><b>ERROR, no puedes buscar por los dos campos a la vez, elige uno de los dos.</b>';
                } else {
                    $this->busqueda();
                }
            }
        }

        function busqueda() {

            $conexion = new mysqli("localhost","root","","bd_procedimientos");
                
            //Elimino espacios en blanco antes de pasarlo al SQL, pero solo elimina el del
            //principio y final
            //[OBSOLETO]
            $idAlu = trim($_POST["idAlu"]);
            $nombreAlu = trim($_POST["nombreAlu"]);

            $nombre = "";
            $apellido = "";

            $nombres = array();

            //Utiliza dos vars (nombre y apellido), si encuentra un espacio en blanco en medio
            //deja de escribir en nombre y escribe en la variable de apellido
            //Esto habría que actualizarlo a ARRAY's para poder poner más de un apellido.
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

            array_push($nombres,$nombre,$apellido);
            print_r($nombres);

            $nombreFull = trim($nombre) . " " . trim($apellido);

            //Si alguno de los dos campos NO esta vacío usará el sql especificado. (Esto es susceptible a SQL INJECTION)
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

    new Formulario();

?>