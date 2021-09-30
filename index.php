<?php
    $conexion = mysqli_connect("localhost", "root", "", "bd_procedimientos");

    $sql = 'SELECT * FROM alumnos';

    $result = mysqli_query($conexion, $sql);


    if(mysqli_num_rows($result) > 0) {
        /*while($fila = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo 'Key: '. $fila;
        }
        foreach ($result as $key => $value) {
            $fila = mysqli_fetch_array($result, MYSQLI_ASSOC);
            
            //Mostrar valores con el campo automatico.
            echo 'Indice: '.$key. " Valor: ".$fila ."<br>";




            //echo 'Key: '. $key ." Dato: ".$value["nombre"]. " Repite: ".$value["repite"] . "<br>";
            //print_r($value);
        }*/

        echo "<h2>Ambos:</h2>";

        $fila = mysqli_fetch_array($result);
        foreach ($fila as $key => $value) {
            echo ''.$key . " ";
            
            echo ''.$value;
            echo "<br>";
        }

        echo "<h2>Asociativo:</h2>";

        $fila1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
        foreach ($fila1 as $key => $value) {
            echo ''.$key . " ";
            
            echo ''.$value;
            echo "<br>";
        }

        echo "<h2>Numerico:</h2>";

        $fila2 = mysqli_fetch_array($result, MYSQLI_NUM);
        foreach ($fila2 as $key => $value) {
            echo ''.$key . " ";
            
            echo ''.$value;
            echo "<br>";
        }

        echo "<h2>Todo:</h2>";

        echo "<table>";
        echo "<tr>";
        foreach ($fila1 as $key => $value) {
            echo '<td>'.$key . "</td>";
        }
        echo "</tr>";
        echo "<tr>";
        foreach ($fila1 as $key => $value) {
            echo '<td>'.$value."</td>";
        }
        echo "</tr>";
        echo "</table>";

        echo "<h2>WHILE:</h2>";

        echo "<table>";
        echo "<tr>";
        while (($row = mysqli_fetch_row($result)) != null) {
            echo '<td>'.$row . "</td>";
        }
        echo "</tr>";
        echo "<tr>";
        foreach ($fila1 as $key => $value) {
            echo '<td>'.$value."</td>";
        }
        echo "</tr>";
        echo "</table>";

    } else {
        echo "[ERROR] La consulta no devolvió nada";
    }

    mysqli_close($conexion);
?>