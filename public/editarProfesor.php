<?php
require '../vendor/autoload.php';

use Clases\Profesores;
use Clases\Departamentos;

$id=$_GET['id'];
$profesor=new Profesores;
$profesor->setId($id);

$departamento = new Departamentos();
$todas = $departamento->devolverTodos();
$departamento = null;

$profesorLeido=$profesor->readSelected();
if(!isset($_GET['id'])){
    header("Location:index.php");
    die();
}
//Al pulsar el boton editar recoger toda la información y contemplar que no tenga errores para guardarlo correctamente
if(isset($_POST['editar'])){
$nombre=trim($_POST['nombre']);
$sueldo=trim($_POST['sueldo']);

if(strlen($nombre)==0 || strlen($sueldo)==0){
    $_SESSION['mensaje']="Rellene el campo";
    header("Location:{$_SERVER['PHP_SELF']}?id=$id");
    die();
}

//Obtener las variables de cada campo
if($profesorLeido==ucwords($nombre) || $profesorLeido==ucwords($sueldo)){
    $profesor=null;
    header(("Location:profesores.php"));
    die();
}
//realizar el cambio a partir del id
    $profesor->setNombre(ucwords($nombre));
    $profesor->setSueldo(ucwords($sueldo));
    $profesor->setIdDep($_POST['departamentos']);
    $profesor->update();
    $profesor=null;
    header(("Location:profesores.php"));
}else{
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar profesor</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    </head>

    <body style="background-color: CadetBlue;">
        <h3 class="text-center mt-3">Editar profesor</h3>
        <div class="container mt-3">
            <form name="nt" action="<?php echo $_SERVER['PHP_SELF'] . "?id=$id"; ?>" method="POST">
                <div class="mt-3">
                    <input type="text" name="nombre" value="<?php echo $profesorLeido->nom_prof; ?>" required class="form-control" />
                </div>
                <div class="mt-3">
                    <input type="text" name="sueldo" value="<?php echo $profesorLeido->sueldo; ?>" required class="form-control" />
                </div>
                <div class="mt-3">
                        <select name ='departamentos' class="form-select" aria-label="Default select example">  
                        <!--<option selected><?php echo $profesorLeido->nom_dep; ?></option>; -->
                        <?php
                        while ($item = $todas->fetch(PDO::FETCH_OBJ)) {
                            echo "<option value='{$item->id}'>{$item->nom_dep}</option>";
                        }
                        ?>
                        </select>
                </div>
                <div class="mt-2">
                    <input type="submit" name="editar" value="Editar" class="btn btn-success mr-2" />
                    <a href="profesores.php" class="btn btn-primary mr-2">Volver</a>
                </div>
            </form>
        </div>
    </body>
    </html>
<?php
}
?>