<?php

class Viaje {

    private $_id_viaje;
    private $_id_encargado;
    private $_id_cliente;
    private $_id_chofer;
    private $_id_vehiculo;
    private $_direccion_inicio;
    private $_direccion_destino;
    private $_puntaje_chofer;
    private $_puntaje_vehiculo;
    private $_puntaje_cliente;
    private $_estado;
    private $_forma_pago;

    //AGREGAR Viaje
    public static function agregarViaje($id_encargado,$id_cliente,$id_chofer,$id_vehiculo,$direccion_inicio,$direccion_destino,$puntaje_chofer,$puntaje_vehiculo,$puntaje_cliente,$estado,$forma_pago)
    {
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into  
        viajes (id_encargado,id_cliente,id_chofer,id_vehiculo,direccion_inicio,direccion_destino,puntaje_chofer,puntaje_vehiculo,puntaje_cliente,estado,forma_pago)
        values(:id_encargado,:id_cliente,:id_chofer,:id_vehiculo,:direccion_inicio,:direccion_destino,:puntaje_chofer,:puntaje_vehiculo,:puntaje_cliente,:estado,:forma_pago)");

        $consulta->bindValue(':id_encargado',$id_encargado);
        $consulta->bindValue(':id_cliente', $id_cliente);
        $consulta->bindValue(':id_chofer',$id_chofer);
        $consulta->bindValue(':id_vehiculo', $id_vehiculo);
        $consulta->bindValue(':direccion_inicio', $direccion_inicio);
        $consulta->bindValue(':direccion_destino',$direccion_destino);
        $consulta->bindValue(':puntaje_chofer',$puntaje_chofer);
        $consulta->bindValue(':puntaje_vehiculo',$puntaje_vehiculo);
        $consulta->bindValue(':puntaje_cliente',$puntaje_cliente);
        $consulta->bindValue(':estado',$estado);
        $consulta->bindValue(':forma_pago',$forma_pago);

        if($consulta->execute()){
            $rta = true;
        }
        return $rta; 
    }    

    //TRAER TODOS LOS viajes
    public static function traerTodosLosviajes()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM viajes");
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }

    //TRAER Viaje POR ID
    public static function traerViajePorId($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM viajes WHERE id_viaje=:id");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }

   //MODIFICAR Viaje
    public static function modificarViaje($id,$id_encargado,$id_cliente,$id_chofer,$id_vehiculo,$direccion_inicio,$direccion_destino,$puntaje_chofer,$puntaje_vehiculo,$puntaje_cliente,$estado,$forma_pago){
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE `viajes` 
        SET `id_encargado`= :id_encargado,
        `id_cliente`= :id_cliente,
        `id_chofer`= :id_chofer,
        `id_vehiculo`=:id_vehiculo,
        `direccion_inicio`= :direccion_inicio, 
        `direccion_destino`= :direccion_destino,
        `puntaje_chofer`= :puntaje_chofer,
        `puntaje_vehiculo`= :puntaje_vehiculo,
        `puntaje_cliente`= :puntaje_cliente,
        `estado`= :estado,
        `forma_pago`= :forma_pago
        WHERE id_viaje = :id");

        $consulta->bindValue(':id',$id);
        $consulta->bindValue(':id_encargado',$id_encargado);
        $consulta->bindValue(':id_cliente', $id_cliente);
        $consulta->bindValue(':id_chofer',$id_chofer);
        $consulta->bindValue(':id_vehiculo', $id_vehiculo);
        $consulta->bindValue(':direccion_inicio', $direccion_inicio);
        $consulta->bindValue(':direccion_destino',$direccion_destino);
        $consulta->bindValue(':puntaje_chofer',$puntaje_chofer);
        $consulta->bindValue(':puntaje_vehiculo',$puntaje_vehiculo);
        $consulta->bindValue(':puntaje_cliente',$puntaje_cliente);
        $consulta->bindValue(':estado',$estado);
        $consulta->bindValue(':forma_pago',$forma_pago);

        if ($consulta->execute()){
            $rta = true;
        }
        return $rta;
    }

    //BORRAR Viaje
    public static function borrarViaje($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM viajes WHERE id_viaje=:id");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }
 
}
?>