<?php
require "../vendor/autoload.php";
use Clases\Departamentos;

if(!isset($_POST['id'])){
    header("Location:departamentos.php");
    die();
}

$departamento=new Departamentos();
$departamento->setId($_POST['id']);
$departamento->delete();
$departamento=null;
header(("Location:departamentos.php"));