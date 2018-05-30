<?php

class cliente{

    private $_id_usuario;
    private $_id_cliente;
    private $_mail;
    private $_password;
    private $_nombre;
    private $_apellido;
    private $_dni;
    private $_telefono;
    private $_tipo;
    private $_domicilio;

    //AGREGAR cliente
    public static function agregarCliente($mail,$password,$nombre,$apellido,$dni,$telefono,$tipo,$domicilio)
    {
        $rta = 0;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into  
        usuarios (mail, password,nombre,apellido,dni,telefono,tipo)
        values(:mail,:password,:nombre,:apellido,:dni,:telefono,:tipo)");

        $consulta->bindValue(':mail',$mail);
        $consulta->bindValue(':password', $password);
        $consulta->bindValue(':nombre',$nombre);
        $consulta->bindValue(':apellido', $apellido);
        $consulta->bindValue(':dni', $dni);
        $consulta->bindValue(':telefono',$telefono);
        $consulta->bindValue(':tipo',$tipo);

       if($consulta->execute()){
            $rta=1;
            $id_usuario = $objetoAccesoDato->RetornarUltimoIdInsertado();

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO 
            `clientes` ( `id_usuario`, `domicilio`)
            VALUES (:id_usuario, :domicilio);");

            $consulta->bindValue(':id_usuario', $id_usuario);
            $consulta->bindValue(':domicilio',$domicilio);
           if($consulta->execute()){
               $rta=3; 
           }
  
        }
        return $rta; 
    }    

    //TRAER TODOS LOS clientes
    public static function traerTodosLosClientes()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * 
        FROM usuarios AS u, clientes AS c 
        WHERE u.id_usuario=c.id_usuario");
        
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }

    //TRAER cliente POR ID
    public static function traerClientePorId($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * 
        FROM usuarios AS u, clientes AS c 
        WHERE u.id_usuario=c.id_usuario AND u.id_usuario=:id");

        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }

    //TRAER cliente POR DNI
    public static function traerClientePorDni($dni)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * 
        FROM usuarios AS u, clientes AS c 
        WHERE u.id_usuario=c.id_usuario AND u.dni=:dni");

        $consulta->bindValue(":dni",$dni);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }

    //TRAER cliente POR DOMICILIO
    public static function traerClientePorDomicilio($domicilio)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * 
        FROM usuarios AS u, clientes AS c 
        WHERE u.id_usuario=c.id_usuario AND c.domicilio like '%$domicilio%'
        ORDER BY c.domicilio ");

        $consulta->bindValue(":domicilio",$domicilio);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }

   //MODIFICAR cliente
    public static function modificarCliente($id,$mail,$password,$nombre,$apellido,$dni,$telefono,$domicilio){
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE usuarios AS u, clientes AS c 
        SET u.mail=:mail,
        u.password=:password,
        u.nombre=:nombre,
        u.apellido=:apellido,
        u.dni=:dni,
        u.telefono=:telefono,
        c.domicilio=:domicilio
        WHERE u.id_usuario=c.id_usuario AND u.id_usuario = :id");

        $consulta->bindValue(':id',$id);
        $consulta->bindValue(':mail',$mail);
        $consulta->bindValue(':password', $password);
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