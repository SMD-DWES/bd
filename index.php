<?php
    $conexion = mysqli_connect("localhost", "root", "", "bd_procedimientos");

    $sql = 'SELECT * FROM alumnos';

    $result = mysqli_query($conexion, $sql);


    if(mysqli_num_rows($result) > 0)
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
        $fila = mysqli_fetch_array($result);
        foreach ($fila as $key => $value) {
            echo ''.$key . " ";
            
            echo ''.$value;
            echo "<br>";
        }

?>