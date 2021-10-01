<?php
    $conexion = mysqli_connect("localhost", "root", "", "bd_procedimientos");

    $sql = 'SELECT * FROM alumnos';

    $result = mysqli_query($conexion, $sql);


    if(mysqli_num_rows($result) > 0)
        /*
        foreach ($result as $key => $value) {
            $fila = mysqli_fetch_array($result, MYSQLI_ASSOC);
            
            //Mostrar valores con el campo automatico.
            echo 'Indice: '.$key. " Valor: ".$fila ."<br>";




            //echo 'Key: '. $key ." Dato: ".$value["nombre"]. " Repite: ".$value["repite"] . "<br>";
            //print_r($value);
        }*/
        $fila = mysqli_fetch_array($result);
        foreach ($fila as $key => $value) {
            echo ''.$key . " ";
            
            echo ''.$value;
            echo "<br>";
        }

        $filaAsoc = mysqli_fetch_array($result,MYSQLI_ASSOC);
        echo "<table border='1'>";
        echo "<tr>";
        foreach ($filaAsoc as $id => $valor) {
            echo "<td>".$id."</td>";
        }
        echo '</tr>';
        mysqli_data_seek($result,0);

        while($fila = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>';
            echo '<td>'. $fila["id"].'</td>';
            echo '<td>'. $fila["nombre"].'</td>';
            echo '<td>'. $fila["repite"].'</td>';
            echo '</tr>';
        }

?>

//Introducir un numero de alumno y que muestre la info del mismo 
//