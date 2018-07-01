<?php

class usuario {

    private $_id_usuario;
    private $_mail;
    private $_password;
    private $_nombre;
    private $_apellido;
    private $_tipo;

    //LOGIN
    public static function login($mail, $password){
        $rta = "error";
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE mail=:mail AND password=:password");
        $consulta->bindValue(':mail',$mail);
        $consulta->bindValue(':password', $password);
        if ($consulta->execute()){
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            if (isset($datos[0]['nombre'])){
                $datospayload = array('id_usuario'=>$datos[0]['id_usuario'],'nombre'=>$datos[0]['nombre'],'apellido'=>$datos[0]['apellido'],'mail'=>$datos[0]['mail'],'tipo'=>$datos[0]['tipo']);
                return AutentificadorJWT::CrearToken($datospayload);
            }
        }
        return $rta;
    }

   //VERIFICAR MAIL
   public static function verificarMail($mail){
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE mail=:mail");
    $consulta->bindValue(":mail",$mail);
    $consulta->execute();
    $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
    if(isset($datos[0])){
       return false;
    }
    else{
        return true;
    }
   }

    //TRAER usuario POR ID
    public static function traerUsuarioPorId($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE id_usuario=:id");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }
 
}
?>