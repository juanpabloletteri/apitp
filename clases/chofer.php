<?php

class chofer{

    private $_id_Chofer;
    private $_nombre;
    private $_apellido;
    private $_dni;
    private $_telefono;
    private $_legajo;

    //AGREGAR Chofer
    public static function agregarChofer($nombre,$apellido,$dni,$telefono,$legajo)
    {
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into  
        choferes (nombre,apellido,dni,telefono,legajo)
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

    //TRAER TODOS LOS choferes
    public static function traerTodosLosChoferes()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM choferes");
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }

    //TRAER Chofer POR ID
    public static function traerChoferPorId($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM choferes WHERE id_chofer=:id");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }

   //MODIFICAR Chofer
    public static function modificarChofer($id,$nombre,$apellido,$dni,$telefono,$legajo){
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE `choferes` 
        SET `nombre`= :nombre,
        `apellido`=:apellido,
        `dni`= :dni 
        `telefono`= :telefono 
        `legajo`= :legajo 
        WHERE id_chofer= :id");

        $consulta->bindValue(':id',$id);
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

    //BORRAR Chofer
    public static function borrarChofer($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM choferes WHERE id_chofer=:id");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }
 
}
?>