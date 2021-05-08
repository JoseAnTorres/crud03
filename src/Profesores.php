<?php

namespace Clases;

use Clases\Conexion;
use PDO;
use PDOException;

class Profesores extends Conexion
{
    private $id;
    private $nombre;
    private $sueldo;
    private $fecha;
    private $idDep;

    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        //consulta de insercion de profesores
        $consulta = "insert into profesores(nom_prof, sueldo, fecha_prof, dep) values(:n, :s, now(), :d)";
        //preparar consulta con el codigo
        $stmt = parent::$conexion->prepare($consulta);
        try {
            //ejecutar consulta con parametros
            $stmt->execute([
                ':n' => $this->nombre,
                ':s' => $this->sueldo,
                ':d' => $this->idDep
            ]);
        } catch (PDOException $ex) {
            //error si el intento falla
            die("Error al insertar profesor: " . $ex->getMessage());
        }
    }

     //recuperar aquel profesor con el id que coincida con el parametro
     public function read()
     {
         //recuperar el profesor con el id leido
         $consulta = "select * from profesores where id=:i";
         $stmt = parent::$conexion->prepare($consulta);
         try {
             //ejecutar consulta con parametros :atributo
             $stmt->execute([
                 ':i' => $this->id
             ]);
         } catch (PDOException $ex) {
             //error si el intento falla
             die("Error al leer profesor: " . $ex->getMessage());
         }
         return $stmt->fetch(PDO::FETCH_OBJ);
     }

     //para obtener el index seleccionado del select
     public function readSelected()
     {
         //recuperar aquel profesor con el id leido (uniendo las dos tablas por el foreign key)
         $consulta = "select * from profesores p inner join departamentos d
         on p.dep = d.id where P.id=:i";
         $stmt = parent::$conexion->prepare($consulta);
         try {
             //ejecutar consulta con parametros :atributo
             $stmt->execute([
                 ':i' => $this->id
             ]);
         } catch (PDOException $ex) {
             //error si el intento falla
             die("Error al leer profesor: " . $ex->getMessage());
         }
         return $stmt->fetch(PDO::FETCH_OBJ);
     }
 
     //actualizar los profesores con los parametros nombre, stock, pvp e id
     public function update(){
         //realizar la actualizacion de las variables a partir del id deseado
         $consulta="update profesores set nom_prof=:n, sueldo=:s, dep=:d where id=:i";
         $stmt=parent::$conexion->prepare($consulta);
         try{
             //ejecucion de la consulta con estos parametros
             $stmt->execute([
                 ':i'=>$this->id,
                 ':n'=>$this->nombre,
                 ':s'=>$this->sueldo,
                 ':d'=>$this->idDep
                 ]);
         }catch(PDOException $ex){
             //error si falla el intento
             die("Error al actualizar profesor: ".$ex->getMessage());
         }
     }
 

    //Para borrar profesores desde borrarProfesor
    public function delete()
    {
        //consulta para borrar desde tabla profesores que posea el id correspondiente
        $consulta = "delete from profesores where id=:i";
        $stmt = parent::$conexion->prepare($consulta);
        try {
            //ejecutar consulta
            $stmt->execute([
                ':i' => $this->id
            ]);
        } catch (PDOException $ex) {
            //error si el intento falla
            die("Error al borrar profesor: " . $ex->getMessage());
        }
    }

    public function mostrarProfesores()
    {
        //muestro todos los profesores de la tabla
        $consulta = "select p.id, p.nom_prof, p.sueldo, p.fecha_prof, d.nom_dep
        from profesores p inner join departamentos d
        on p.dep = d.id";
        //preparar consulta
        $stmt = parent::$conexion->prepare($consulta);
        try {
            //ejecutar consulta
            $stmt->execute();
        } catch (PDOException $ex) {
            //error si el intento falla
            die("Error no carga tabla: " . $ex->getMessage());
        }
        return $stmt;
    }

    //devolver la informacion de los profesores y recibirlo para la tabla
    public function devolverTodos(){
        $c="select * from profesores order by dep";
        $stmt=parent::$conexion->prepare($c);
        try{
            $stmt->execute();
        }catch(PDOException $ex){
            die("Error al devolver tags: ".$ex->getMessage());
        }
        return $stmt;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of sueldo
     */
    public function getSueldo()
    {
        return $this->sueldo;
    }

    /**
     * Set the value of sueldo
     *
     * @return  self
     */
    public function setSueldo($sueldo)
    {
        $this->sueldo = $sueldo;

        return $this;
    }

    /**
     * Get the value of fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of idDep
     */
    public function getIdDep()
    {
        return $this->idDep;
    }

    /**
     * Set the value of idDep
     *
     * @return  self
     */
    public function setIdDep($idDep)
    {
        $this->idDep = $idDep;

        return $this;
    }
}
