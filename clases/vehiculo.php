<?php

class vehiculo {

    private $_id_vehiculo;
    private $_id_chofer;
    private $_marca;
    private $_modelo;
    private $_anio;
    private $_fumar;
    private $_aire;
    private $_baul;

    //AGREGAR vehiculo
    public static function agregarVehiculo($id_chofer,$marca,$modelo,$anio,$fumar,$aire,$baul)
    {
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into  
        vehiculos (id_chofer,marca,modelo,anio,fumar,aire,baul)
        values(:id_chofer,:marca,:modelo,:anio,:fumar,:aire,:baul)");

        $consulta->bindValue(':id_chofer',$id_chofer);
        $consulta->bindValue(':marca', $marca);
        $consulta->bindValue(':modelo',$modelo);
        $consulta->bindValue(':anio', $anio);
        $consulta->bindValue(':fumar', $fumar);
        $consulta->bindValue(':aire',$aire);
        $consulta->bindValue(':baul',$baul);
        
        if($consulta->execute()){
            $rta = true;
        }
        return $rta; 
    }    

    //TRAER TODOS LOS vehiculos
    public static function traerTodosLosVehiculos()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM vehiculos");
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }

    //TRAER TODOS LOS vehiculos CON SUS CHOFERES
    public static function traerTodosLosVehiculosConChoferes()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * 
        FROM vehiculos AS v, choferes AS c, usuarios AS u
        WHERE v.id_chofer = c.id_chofer AND c.id_usuario = u.id_usuario AND u.tipo!=-2");
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }

    //TRAER vehiculo POR ID
    public static function traerVehiculoPorId($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM vehiculos WHERE id_vehiculo=:id");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }

   //MODIFICAR vehiculo
    public static function modificarVehiculo($id,$id_chofer,$marca,$modelo,$anio,$fumar,$aire,$baul){
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE `vehiculos` 
        SET `id_chofer`= :id_chofer,
        `marca`= :marca,
        `modelo`= :modelo,
        `anio`=:anio,
        `fumar`= :fumar, 
        `aire`= :aire,
        `baul`= :baul
        WHERE id_vehiculo = :id");

        $consulta->bindValue(':id',$id);
        $consulta->bindValue(':id_chofer',$id_chofer);
        $consulta->bindValue(':marca', $marca);
        $consulta->bindValue(':modelo',$modelo);
        $consulta->bindValue(':anio', $anio);
        $consulta->bindValue(':fumar', $fumar);
        $consulta->bindValue(':aire',$aire);
        $consulta->bindValue(':baul',$baul);

        if ($consulta->execute()){
            $rta = true;
        }
        return $rta;
    }

    //BORRAR vehiculo
    public static function borrarVehiculo($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM vehiculos WHERE id_vehiculo=:id");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }
 
}
?>