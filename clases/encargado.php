<?php

class encargado{

    private $_id_encargado;
    private $_nombre;
    private $_apellido;
    private $_dni;
    private $_telefono;
    private $_legajo;

    //AGREGAR ENCARGADO
    public static function agregarEncargado($nombre,$apellido,$dni,$telefono,$legajo)
    {
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into  
        encargados (nombre,apellido,dni,telefono, legajo)
        values(:nombre,:apellido,:dni,:telefono,:legajo)");

        $consulta->bindValue(':nombre',$nombre);
        $consulta->bindValue(':apellido', $apellido);
        $consulta->bindValue(':dni', $dni);
        $consulta->bindValue(':telefono',$telefono);
        $consulta->bindValue(':legajo',$legajo);

        if($consulta->execute()){
            $rta = true;
        }
        return $rta; 
    }    

    //TRAER TODOS LOS ENCARGADOS
    public static function traerTodosLosEncargados()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM encargados");
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }

    //TRAER ENCARGADO POR ID
    public static function traerEncargadoPorId($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM encargados WHERE id_encargado=:id");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }

   //MODIFICAR ENCARGADO
    public static function modificarEncargado($nombre,$apellido,$dni,$telefono,$legajo){
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE `encargados` 
        SET `nombre`= :nombre,
        `apellido`=:apellido,
        `dni`= :dni 
        `telefono`= :telefono 
        `legajo`= :legajo 
        WHERE id_encargado = :id");

        $consulta->bindValue(':nombre',$nombre);
        $consulta->bindValue(':apellido', $apellido);
        $consulta->bindValue(':dni', $dni);
        $consulta->bindValue(':telefono',$telefono);
        $consulta->bindValue(':legajo',$legajo);

        if ($consulta->execute()){
            $rta = true;
        }
        return $rta;
    }

    //BORRAR ENCARGADO
    public static function borrarEncargado($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM encargados WHERE id_encargado=:id");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }
 
}
?>