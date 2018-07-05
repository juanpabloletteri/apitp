<?php

class encuesta {

    private $_id_encuesta;
    private $_id_viaje;
    private $_puntaje_viaje;
    private $_id_chofer;
    private $_puntaje_chofer;
    private $_id_vehiculo;
    private $_puntaje_vehiculo;
    private $_pregunta1;
    private $_pregunta2;
    private $_pregunta3;
    private $_pregunta4;
    private $_observaciones;
    
    //AGREGAR encuesta
    public static function agregarEncuesta($id_viaje,$puntaje_viaje,$id_chofer,$puntaje_chofer,$id_vehiculo,$puntaje_vehiculo,$pregunta1,$pregunta2,$pregunta3,$pregunta4,$observaciones){
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into  
        encuestas (id_viaje,puntaje_viaje,id_chofer,puntaje_chofer,id_vehiculo,puntaje_vehiculo,pregunta1,pregunta2,pregunta3,pregunta4,observaciones)
        values(:id_viaje,:puntaje_viaje,:id_chofer,:puntaje_chofer,:id_vehiculo,:puntaje_vehiculo,:pregunta1,:pregunta2,:pregunta3,:pregunta4,:observaciones)");
        $consulta->bindValue(':id_viaje',$id_viaje);
        $consulta->bindValue(':puntaje_viaje',$puntaje_viaje);
        $consulta->bindValue(':id_chofer',$id_chofer);
        $consulta->bindValue(':puntaje_chofer',$puntaje_chofer);
        $consulta->bindValue(':id_vehiculo',$id_vehiculo);
        $consulta->bindValue(':puntaje_vehiculo',$puntaje_vehiculo);
        $consulta->bindValue(':pregunta1',$pregunta1);
        $consulta->bindValue(':pregunta2',$pregunta2);
        $consulta->bindValue(':pregunta3',$pregunta3);
        $consulta->bindValue(':pregunta4',$pregunta4);
        $consulta->bindValue(':observaciones',$observaciones);
        
        if($consulta->execute()){
            $rta = true;
        }
        return $rta; 
    }    
    //TRAER TODAS LAS ENCUESTAS
    public static function traerTodasLasEncuestas()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM encuestas");
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }
        //TRAER ENCUESTA POR ID VIAJE
    public static function traerEncuestaPorIdViaje($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM encuestas WHERE id_viaje=:id");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }
 
}
?>