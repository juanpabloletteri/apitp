<?php

class chofer{

    private $_id_usuario;
    private $_id_chofer;
    private $_mail;
    private $_password;
    private $_nombre;
    private $_apellido;
    private $_dni;
    private $_telefono;
    private $_tipo;
    private $_legajo;

    //AGREGAR chofer
    public static function agregarChofer($mail,$password,$nombre,$apellido,$dni,$telefono,$tipo,$legajo)
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
            `choferes` ( `id_usuario`, `legajo`)
            VALUES (:id_usuario, :legajo);");

            $consulta->bindValue(':id_usuario', $id_usuario);
            $consulta->bindValue(':legajo',$legajo);
        if($consulta->execute()){
            $rta=3; 
        }

        }
        return $rta; 
    }    

    //TRAER TODOS LOS choferes
    public static function traerTodosLosChoferes()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * 
        FROM usuarios AS u, choferes AS c 
        WHERE u.id_usuario=c.id_usuario");
        
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }

    //TRAER chofer POR ID
    public static function traerChoferPorId($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * 
        FROM usuarios AS u, choferes AS c 
        WHERE u.id_usuario=c.id_usuario AND c.id_chofer=:id");

        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }

    //TRAER chofer POR DNI
    public static function traerChoferPorDni($dni)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * 
        FROM usuarios AS u, choferes AS c 
        WHERE u.id_usuario=c.id_usuario AND u.dni=:dni");

        $consulta->bindValue(":dni",$dni);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }

    //TRAER chofer POR legajo
    public static function traerChoferPorlegajo($legajo)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * 
        FROM usuarios AS u, choferes AS c 
        WHERE u.id_usuario=c.id_usuario AND c.legajo like '%$legajo%'
        ORDER BY c.legajo ");

        $consulta->bindValue(":legajo",$legajo);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }

    //MODIFICAR chofer
    public static function modificarChofer($id,$mail,$password,$nombre,$apellido,$dni,$telefono,$legajo){
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE usuarios AS u, choferes AS c 
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

    //BORRAR chofer
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