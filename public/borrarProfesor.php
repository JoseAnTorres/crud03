<?php
require "../vendor/autoload.php";
use Clases\Profesores;

if(!isset($_POST['id'])){
    header("Location:profesores.php");
    die();
}

$profesor=new Profesores();
$profesor->setId($_POST['id']);
$profesor->delete();
$profesor=null;
header(("Location:profesores.php"));