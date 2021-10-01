<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alumno</title>
    </head>
    <body>
        <form action="alumno.php" method="post">
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