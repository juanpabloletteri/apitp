<?php

class cliente{

    private $_id_cliente;
    private $_nombre;
    private $_apellido;
    private $_dni;
    private $_telefono;
    private $_domicilio;

    //AGREGAR cliente
    public static function agregarCliente($nombre,$apellido,$dni,$telefono,$domicilio)
    {
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into  
        clientes (nombre,apellido,dni,telefono,domicilio)
        values(:nombre,:apellido,:dni,:telefono,:domicilio)");

        $consulta->bindValue(':nombre',$nombre);
        $consulta->bindValue(':apellido', $apellido);
        $consulta->bindValue(':dni', $dni);
        $consulta->bindValue(':telefono',$telefono);
        $consulta->bindValue(':domicilio',$domicilio);

        if($consulta->execute()){
            $rta = true;
        }
        return $rta; 
    }    

    //TRAER TODOS LOS clientes
    public static function traerTodosLosClientes()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM clientes");
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }

    //TRAER cliente POR ID
    public static function traerClientePorId($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM clientes WHERE id_cliente=:id");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }

   //MODIFICAR cliente
    public static function modificarCliente($id,$nombre,$apellido,$dni,$telefono,$domicilio){
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE `clientes` 
        SET `nombre`= :nombre,
        `apellido`=:apellido,
        `dni`= :dni, 
        `telefono`= :telefono, 
        `domicilio`= :domicilio 
        WHERE 'id_cliente' = :id");

        $consulta->bindValue(':id',$id);
        $consulta->bindValue(':nombre',$nombre);
        $consulta->bindValue(':apellido', $apellido);
        $consulta->bindValue(':dni', $dni);
        $consulta->bindValue(':telefono',$telefono);
        $consulta->bindValue(':domicilio',$domicilio);

        if ($consulta->execute()){
            $rta = true;
        }
        return $rta;
    }

    //BORRAR cliente
    public static function borrarCliente($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM clientes WHERE id_cliente=:id");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }
 
}
?>