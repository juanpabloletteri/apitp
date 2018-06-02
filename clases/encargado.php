<?php

class encargado{

    private $_id_usuario;
    private $_id_encargado;
    private $_mail;
    private $_password;
    private $_nombre;
    private $_apellido;
    private $_dni;
    private $_telefono;
    private $_tipo;
    private $_legajo;

    //AGREGAR Encargado
    public static function agregarEncargado($mail,$password,$nombre,$apellido,$dni,$telefono,$tipo,$legajo)
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
            `encargados` ( `id_usuario`, `legajo`)
            VALUES (:id_usuario, :legajo);");

            $consulta->bindValue(':id_usuario', $id_usuario);
            $consulta->bindValue(':legajo',$legajo);
        if($consulta->execute()){
            $rta=3; 
        }

        }
        return $rta; 
    }    

    //TRAER TODOS LOS encargados
    public static function traerTodosLosEncargados()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * 
        FROM usuarios AS u, encargados AS c 
        WHERE u.id_usuario=c.id_usuario");
        
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }

    //TRAER Encargado POR ID
    public static function traerEncargadoPorId($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * 
        FROM usuarios AS u, encargados AS c 
        WHERE u.id_usuario=c.id_usuario AND u.id_usuario=:id");

        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }

    //TRAER Encargado POR DNI
    public static function traerEncargadoPorDni($dni)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * 
        FROM usuarios AS u, encargados AS c 
        WHERE u.id_usuario=c.id_usuario AND u.dni=:dni");

        $consulta->bindValue(":dni",$dni);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }

    //TRAER Encargado POR legajo
    public static function traerEncargadoPorlegajo($legajo)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * 
        FROM usuarios AS u, encargados AS c 
        WHERE u.id_usuario=c.id_usuario AND c.legajo like '%$legajo%'
        ORDER BY c.legajo ");

        $consulta->bindValue(":legajo",$legajo);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }

    //MODIFICAR Encargado
    public static function modificarEncargado($id,$mail,$password,$nombre,$apellido,$dni,$telefono,$legajo){
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE usuarios AS u, encargados AS c 
        SET u.mail=:mail,
        u.password=:password,
        u.nombre=:nombre,
        u.apellido=:apellido,
        u.dni=:dni,
        u.telefono=:telefono,
        c.legajo=:legajo
        WHERE u.id_usuario=c.id_usuario AND u.id_usuario = :id");

        $consulta->bindValue(':id',$id);
        $consulta->bindValue(':mail',$mail);
        $consulta->bindValue(':password', $password);
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

    //BORRAR Encargado
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