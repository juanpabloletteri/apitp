<?php
class item{

    private $_id;
    private $_modelo;
    private $_tipo;
    private $_anio;
    private $_foto;

    //AGREGAR ITEMS
    public static function AgregarItem($modelo,$tipo,$anio,$foto)
    {
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into  
        vehiculo (modelo,tipo,anio,foto)
        values(:modelo,:tipo,:anio,:foto)");

        $consulta->bindValue(':modelo',$modelo);
        $consulta->bindValue(':tipo', $tipo);
        $consulta->bindValue(':anio', $anio);
        $consulta->bindValue(':foto',$foto);

        if($consulta->execute()){
            $rta = true;
        }
        return $rta; 
    }
 
    //TRAER TODOS LOS ITEMS
    public static function TraerTodosLosItems()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM vehiculo");
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }
   //TRAER ITEM POR ID
   public static function TraerItemPorId($modelo)
   {
       $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
       $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM vehiculo WHERE modelo=:modelo");
       $consulta->bindValue(":modelo",$modelo);
       $consulta->execute();
       $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
       //$modelosusuario = json_encode($datos);
       //return $modelosusuario;
       return json_encode($datos);     
   }
    public static function borrarVehiculo($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM vehiculo WHERE id=:id");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        //$modelosusuario = json_encode($datos);
        //return $modelosusuario;
        return json_encode($datos);     
    }

    public static function modificarItem($id,$modelo,$tipo,$anio){
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE `vehiculo` 
        SET `modelo`= :modelo,
        `tipo`=:tipo,
        `anio`= :anio 
         WHERE id = :id");
        $consulta->bindValue(':id',$id);
        $consulta->bindValue(':modelo',$modelo);
        $consulta->bindValue(':tipo',$tipo);
        $consulta->bindValue(':anio',$anio);
        if ($consulta->execute()){
            $rta = true;
        }
        return $rta;
    }
}
?>