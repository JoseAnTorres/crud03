<?php

use Clases\Departamentos;

require '../vendor/autoload.php';
$departamento = new Departamentos();
$departamentoMostrar = $departamento->mostrarDepartamentos();
$departamento = null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departamentos</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</head>

<body style="background-color: CadetBlue;">
    <div class="container mt-3">
    </div>
    <a href="crearDepartamento.php" class='btn btn-primary my-3'>Añadir departamento</a>
    <table class="table table-success table-striped">
        <thead>
            <tr>
                <th scope="col">Nombre departamento</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            //Repetir el proceso mientras haya departamentos
            while ($departamento = $departamentoMostrar->fetch(PDO::FETCH_OBJ)) {
                echo "<tr>";
                echo "<td>{$departamento->nom_dep}</td>";
                echo "<td>";
                echo "<form name='borrar' method='POST' class='form-inline' action='borrarDepartamento.php'>";
                echo "<a href='editarDepartamento.php?id={$departamento->id}' class='btn btn-primary m-auto'></i>Editar</a>";
                echo "<input type='hidden' name='id' value='{$departamento->id}'>";
                echo "<button type='submit' class='ml-2 btn btn-danger'>Borrar</button></form>";
                echo "</td>\n";
                echo "</tr>\n";
            }
            ?>
        </tbody>
    </table>
    </table>
    <div class="col-md-12 text-center">
        <a href="index.php" class='btn btn-primary my-3'>Volver</a>
    </div>
</body>

</html>