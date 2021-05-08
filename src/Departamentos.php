<?php

namespace Clases;

use Clases\Conexion;
use PDO;
use PDOException;

class Departamentos extends Conexion
{
    private $id;
    private $nom_dep;

    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        //consulta de insercion de departamentos
        $consulta = "insert into departamentos(nom_dep) values(:n)";
        //preparar consulta con el codigo
        $stmt = parent::$conexion->prepare($consulta);
        try {
            //ejecutar consulta con parametros
            $stmt->execute([
                ':n' => $this->nom_dep
            ]);
        } catch (PDOException $ex) {
            //error si el intento falla
            die("Error al insertar departamento: " . $ex->getMessage());
        }
    }

    //lectura del departamento a partir del id de departamentos
    public function read()
    {
        //recuperar aquel departamento con el id leido
        $consulta = "select * from departamentos where id=:i";
        $stmt = parent::$conexion->prepare($consulta);
        try {
            //ejecutar consulta con parametros :atributo
            $stmt->execute([
                ':i' => $this->id
            ]);
        } catch (PDOException $ex) {
            //error si el intento falla
            die("Error al leer departamento: " . $ex->getMessage());
        }
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    //actualizar el departamento con los parametros nombre, stock, pvp e id
    public function update(){
        //realizar la actualizacion de las variables a partir del id deseado
        $consulta="update departamentos set nom_dep=:n where id=:i";
        $stmt=parent::$conexion->prepare($consulta);
        try{
            //ejecucion de la consulta con estos parametros
            $stmt->execute([
                ':i'=>$this->id,
                ':n'=>$this->nom_dep
                ]);
        }catch(PDOException $ex){
            //error si falla el intento
            die("Error al actualizar departamento: ".$ex->getMessage());
        }
    }

    //Para borrar departamentos desde borrarDepartamento
    public function delete()
    {
        //consulta para borrar desde tabla departamentos que posea el id correspondiente
        $consulta = "delete from departamentos where id=:i";
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

    //devolver la información de los departamentos
    public function mostrarDepartamentos()
    {
        //muestro todos los departamentos de la tabla
        $consulta = "select * from departamentos";
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

    public function devolverTodos(){
        $c="select * from departamentos order by nom_dep";
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
     * Get the value of nom_dep
     */
    public function getNom_dep()
    {
        return $this->nom_dep;
    }

    /**
     * Set the value of nom_dep
     *
     * @return  self
     */
    public function setNom_dep($nom_dep)
    {
        $this->nom_dep = $nom_dep;

        return $this;
    }
}
