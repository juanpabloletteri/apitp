<?php

class Viaje {
    private $_id_viaje;
    private $_id_encargado;
    private $_id_cliente;
    private $_id_chofer;
    private $_id_vehiculo;
    private $_latitud_inicio;
    private $_longitud_inicio;
    private $_latitud_destino;
    private $_longitud_destino;
    private $_puntaje_chofer;
    private $_puntaje_vehiculo;
    private $_puntaje_cliente;
    private $_fecha_salida;
    private $_fecha_llegada;
    private $_estado;
    private $_forma_pago;
    
    //AGREGAR Viaje
    public static function agregarViaje($idE,$idC,$idCho,$idV,$dist,$costo,$formaPago,$latIn,$lonIn,$latDest,$lonDest,$inicio,$destino,$fecha_salida){
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into  
        viajes (id_encargado,id_cliente,id_chofer,id_vehiculo,distancia,estado,costo,forma_pago,latitud_inicio,longitud_inicio,latitud_destino,longitud_destino,inicio,destino,fecha_salida,fecha_llegada)
        values(:idE, :idC, :idCho, :idV, :dist, 0, :costo, :formaPago, :latIn, :lonIn, :latDest, :lonDest, :inicio, :destino, :fecha_salida,0)");
        $consulta->bindValue(':idE',$idE);
        $consulta->bindValue(':idC',$idC);
        $consulta->bindValue(':idCho',$idCho);
        $consulta->bindValue(':idV',$idV);
        $consulta->bindValue(':dist',$dist);
        $consulta->bindValue(':costo',$costo);
        $consulta->bindValue(':formaPago',$formaPago);
        $consulta->bindValue(':latIn',$latIn);
        $consulta->bindValue(':lonIn',$lonIn);
        $consulta->bindValue(':latDest',$latDest);
        $consulta->bindValue(':lonDest',$lonDest);
        $consulta->bindValue(':inicio',$inicio);
        $consulta->bindValue(':destino',$destino);
        $consulta->bindValue(':fecha_salida',$fecha_salida);
        
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
    //TRAER VIAJES CON CLIENTES
        public static function traerTodosLosviajesConClientes()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM viajes AS v, usuarios AS u WHERE v.id_cliente = u.id_usuario");
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }
    //TRAER VIAJES CON CHOFER
    public static function traerTodosLosviajesConChoferes()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM viajes AS v, usuarios AS u, choferes as c WHERE v.id_chofer = u.id_usuario AND c.id_usuario=u.id_usuario");
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
    //TRAER Viaje POR CHOFER
    public static function traerViajesPorChofer($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * 
        FROM viajes AS v, usuarios AS u  
        WHERE v.id_chofer=:id AND v.id_cliente=u.id_usuario");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }
    //TRAER Viaje POR CLIENTE
    public static function traerViajesPorCliente($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM viajes WHERE id_cliente=:id");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }       
    //CAMBIAR ESTADO VIAJE
    public static function cambiarEstadoViaje($id,$estado){
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE `viajes` 
        SET `estado`= :estado
        WHERE id_viaje = :id");
        $consulta->bindValue(':id',$id);
        $consulta->bindValue(':estado',$estado);
        if ($consulta->execute()){
            $rta = true;
        }
        return $rta;
    }
    //ESTADISTICAS
    //todos los viajes por estado
    public static function traerCantidadDeViajes(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT `estado`, COUNT(*) AS cantidad FROM `viajes` GROUP BY `estado`");
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }
    public static function traerMetrosRecorridos(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT SUM(`distancia`) AS distancia FROM `viajes` WHERE estado=-3");
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }
    public static function traerDineroGanado(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT SUM(`costo`) AS costo FROM `viajes` WHERE estado=-3");
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }
    public static function estadisticasCliente(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta(
        "SELECT id_cliente, nombre, apellido, mail, SUM(`distancia`/1000) AS distancia, SUM(`costo`) AS dinero, COUNT(*) AS viajes 
        FROM `viajes` AS v, `usuarios` AS u 
        WHERE v.id_cliente=u.id_usuario AND estado=-3 
        GROUP BY `id_cliente`");
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }
    public static function estadisticasChofer(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta(
        "SELECT v.id_chofer, legajo, nombre, apellido, mail, SUM(`distancia`/1000) AS distancia, SUM(`costo`) AS dinero, COUNT(*) AS viajes  
        FROM `viajes` AS v, `usuarios` AS u, `choferes` AS c
        WHERE v.id_chofer=u.id_usuario AND u.id_usuario=c.id_usuario AND estado=-3 
        GROUP BY `id_chofer`");
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }
    //ESTADISTICAS - CLIENTES
    public static function traerCantidadDeViajesPorCliente($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT `estado`, COUNT(*) AS cantidad FROM `viajes` WHERE id_cliente=:id GROUP BY `estado`");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }
    public static function traerMetrosRecorridosPorCliente($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT SUM(`distancia`) AS distancia FROM `viajes` WHERE id_cliente=:id AND estado=-3");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }
    public static function traerDineroGastadoPorCliente($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT SUM(`costo`) AS costo FROM `viajes` WHERE id_cliente=:id AND estado=-3");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }

    //ESTADISTICAS - CHOFERES
    public static function traerCantidadDeViajesPorChofer($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT `estado`, count(*) AS cantidad FROM `viajes` WHERE id_chofer=:id GROUP BY `estado`");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }
    public static function traerMetrosRecorridosPorChofer($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT SUM(`distancia`) AS distancia FROM `viajes` WHERE id_chofer=:id AND estado=-3");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }
    public static function traerDineroGanadoPorChofer($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT SUM(`costo`) AS costo FROM `viajes` WHERE id_chofer=:id AND estado=-3");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }














    //NO FUNCIONAN VIEJOS
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