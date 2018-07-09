<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once './vendor/autoload.php';
require_once './clases/AccesoDatos.php';
require_once './clases/AutentificadorJWT.php';

require_once './clases/usuario.php';
require_once './clases/chofer.php';
require_once './clases/cliente.php';
require_once './clases/encargado.php';
require_once './clases/vehiculo.php';
require_once './clases/viaje.php';
require_once './clases/encuesta.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

/*

¡La primera línea es la más importante! A su vez en el modo de 
desarrollo para obtener información sobre los errores
 (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
  el construido en PHP webserver, entonces usted verá en la salida de la consola 
  que es útil).

  La segunda línea permite al servidor web establecer el encabezado Content-Length, 
  lo que hace que Slim se comporte de manera más predecible.
*/
////USAR APRA AUTENTICACION ULTIMA LINEA           })->add($mdwAuth);

$app = new \Slim\App(["settings" => $config]);


$app->get('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("GET => Bienvenido!!! ,a SlimFramework");
    return $response;

});

//************ LOGIN ************//
$app->post('/login', function (Request $request, Response $response) {
    $datos = $request->getParsedBody();
    $mail = $datos["mail"];
    $password = $datos["password"];
    $newResponse = $response->withJson(usuario::login($mail,$password));
    //$response->write($pw);
    return $newResponse;
});

//************ AUTENTICACION ************//
$mdwAuth = function ( $request, $response, $next) {
    $token = $request->getHeader('token');
    if(AutentificadorJWT::verificarToken($token[0])){
        $response = $next($request,$response);
    }  
    return $response;
};

//************ TOKEN ************//
$app->post('/crearToken', function (Request $request, Response $response) {
    $datos = $request->getParsedBody();
    //$datos = array('usuario' => 'rogelio@agua.com','perfil' => 'profe', 'alias' => "PinkBoy");
    $token= AutentificadorJWT::CrearToken($datos); 
    $newResponse = $response->withJson($token, 200); 
    return $newResponse;
});

////revisar!
$app->post('/leerHeader', function (Request $request, Response $response) {
    $datos = $request->getParsedBody();
    $header = $request->getHeader('miHeader');
    $leido = AutentificadorJWT::ObtenerPayLoad($header);
    var_dump($leido);
    $newResponse = $response->withJson($header, 200); 
    return $newResponse;
});
//************************//

//************ CLIENTES ************//

//AGREGAR CLIENTE  *************************/
$app->post('/agregarCliente',function($request,$response){
    $datos = $request->getParsedBody();
    $mail = $datos['mail'];
    $password = $datos['password'];
    $nombre = $datos['nombre'];
    $apellido = $datos['apellido'];
    $dni = $datos['dni'];
    $telefono = $datos['telefono'];
    $tipo = $datos['tipo'];
    $domicilio = $datos['domicilio'];
    if(usuario::verificarMail($mail)){
        //$response->write(usuario::agregarUsuario($mail,$password,$nombre,$apellido,$tipo));
        $id_usuario=$response->write(cliente::agregarCliente($mail,$password,$nombre,$apellido,$dni,$telefono,$tipo,$domicilio));  
    }
    else{
        $newResponse = $response->withJson('Mail en uso');
        return $newResponse;
    }
});

//TRAER TODOS LOS CLIENTES *************************/
$app->get('/traerTodosLosClientes',function ($request,$response){
    $response->write(cliente::traerTodosLosClientes());
    return $response;
})->add($mdwAuth);

//TRAER CLIENTE POR ID *************************/
$app->post('/traerClientePorId',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(cliente::traerClientePorId($id));
    return $response;
})->add($mdwAuth);

//TRAER CLIENTE POR DNI *************************/
$app->post('/traerClientePorDni',function ($request,$response){
    $datos = $request->getParsedBody();
    $dni = $datos['dni'];
    $response->write(cliente::traerClientePorDni($dni));
    return $response;
})->add($mdwAuth);

//TRAER CLIENTE POR DOMICILIO *************************/
$app->post('/traerClientePorDomicilio',function ($request,$response){
    $datos = $request->getParsedBody();
    $domicilio = $datos['domicilio'];
    $response->write(cliente::traerClientePorDomicilio($domicilio));
    return $response;
})->add($mdwAuth);

//MODIFICAR Estado cliente *************************/
$app->post('/cambiarEstadoCliente',function($request,$response){
    $datos = $request->getParsedBody();
      $id = $datos['id'];
      $estado = $datos['estado'];
      $response->write(cliente::cambiarEstadoCliente($id,$estado));
      return $response;
})->add($mdwAuth);


//MODIFICAR CLIENTE *************************/
$app->post('/modificarCliente',function($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id_usuario'];
    $mail = $datos['mail'];
    $password = $datos['password'];
    $nombre = $datos['nombre'];
    $apellido = $datos['apellido'];
    $dni = $datos['dni'];
    $telefono = $datos['telefono'];
    $domicilio = $datos['domicilio'];
    $response->write(cliente::modificarCliente($id,$mail,$password,$nombre,$apellido,$dni,$telefono,$domicilio));

    return $response;
})->add($mdwAuth);

//BORRAR CLIENTE *************************/
$app->post('/borrarCliente',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(cliente::borrarCliente($id));
    return $response;
})->add($mdwAuth);

//**********************************//





//************ CHOFERES ************//

//AGREGAR CHOFER  *************************/
$app->post('/agregarChofer',function($request,$response){
    $datos = $request->getParsedBody();
    $mail = $datos['mail'];
    $password = $datos['password'];
    $nombre = $datos['nombre'];
    $apellido = $datos['apellido'];
    $dni = $datos['dni'];
    $telefono = $datos['telefono'];
    $tipo = $datos['tipo'];
    $legajo = $datos['legajo'];
    $id_usuario=$response->write(chofer::agregarChofer($mail,$password,$nombre,$apellido,$dni,$telefono,$tipo,$legajo));
    return $response;
})->add($mdwAuth);

//TRAER TODOS LOS CHOFERES *************************/
$app->get('/traerTodosLosChoferes',function ($request,$response){
    $response->write(chofer::traerTodosLosChoferes());
    return $response;
})->add($mdwAuth);

//TRAER CHOFERES *************************/
$app->get('/traerChoferesValidos',function ($request,$response){
    $response->write(chofer::traerChoferesValidos());
    return $response;
})->add($mdwAuth);

//TRAER TODOS LOS CHOFERES LIBRES *************************/
$app->get('/traerTodosLosChoferesLibres',function ($request,$response){
    $response->write(chofer::traerTodosLosChoferesLibres());
    return $response;
})->add($mdwAuth);

//TRAER Chofer POR ID *************************/
$app->post('/traerChoferPorId',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(chofer::traerChoferPorId($id));
    return $response;
})->add($mdwAuth);

//TRAER CHOFER POR DNI *************************/
$app->post('/traerChoferPorDni',function ($request,$response){
    $datos = $request->getParsedBody();
    $dni = $datos['dni'];
    $response->write(chofer::traerChoferPorDni($dni));
    return $response;
})->add($mdwAuth);

//TRAER CHOFER POR LEGAJO *************************/
$app->post('/traerChoferPorLegajo',function ($request,$response){
    $datos = $request->getParsedBody();
    $legajo = $datos['legajo'];
    $response->write(chofer::traerChoferPorLegajo($legajo));
    return $response;
})->add($mdwAuth);

//MODIFICAR Estado chofer *************************/
$app->post('/cambiarEstadoChofer',function($request,$response){
    $datos = $request->getParsedBody();
      $id = $datos['id'];
      $estado = $datos['estado'];
      $response->write(chofer::cambiarEstadoChofer($id,$estado));
      return $response;
  })->add($mdwAuth);

//MODIFICAR CHOFER *************************/
$app->post('/modificarChofer',function($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id_usuario'];
    $mail = $datos['mail'];
    $password = $datos['password'];
    $nombre = $datos['nombre'];
    $apellido = $datos['apellido'];
    $dni = $datos['dni'];
    $telefono = $datos['telefono'];
    $legajo = $datos['legajo'];
    $response->write(chofer::modificarChofer($id,$mail,$password,$nombre,$apellido,$dni,$telefono,$legajo));

    return $response;
})->add($mdwAuth);

//BORRAR CHOFER *************************/
$app->post('/borrarChofer',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(chofer::borrarChofer($id));
    return $response;
})->add($mdwAuth);

//**********************************//






//************ ENCARGADOS ************//

//AGREGAR Encargado  *************************/
$app->post('/agregarEncargado',function($request,$response){
    $datos = $request->getParsedBody();
    $mail = $datos['mail'];
    $password = $datos['password'];
    $nombre = $datos['nombre'];
    $apellido = $datos['apellido'];
    $dni = $datos['dni'];
    $telefono = $datos['telefono'];
    $tipo = $datos['tipo'];
    $legajo = $datos['legajo'];
    $id_usuario=$response->write(encargado::agregarEncargado($mail,$password,$nombre,$apellido,$dni,$telefono,$tipo,$legajo));
    return $response;
})->add($mdwAuth);

//TRAER TODOS LOS Encargados *************************/
$app->get('/traerTodosLosEncargados',function ($request,$response){
    $response->write(encargado::traerTodosLosEncargados());
    return $response;
})->add($mdwAuth);

//TRAER Encargado POR ID *************************/
$app->post('/traerEncargadoPorId',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(encargado::traerEncargadoPorId($id));
    return $response;
})->add($mdwAuth);

//TRAER Encargado POR DNI *************************/
$app->post('/traerEncargadoPorDni',function ($request,$response){
    $datos = $request->getParsedBody();
    $dni = $datos['dni'];
    $response->write(encargado::traerEncargadoPorDni($dni));
    return $response;
})->add($mdwAuth);

//TRAER Encargado POR LEGAJO *************************/
$app->post('/traerEncargadoPorLegajo',function ($request,$response){
    $datos = $request->getParsedBody();
    $legajo = $datos['legajo'];
    $response->write(encargado::traerEncargadoPorLegajo($legajo));
    return $response;
})->add($mdwAuth);

//MODIFICAR Encargado *************************/
$app->post('/modificarEncargado',function($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id_usuario'];
    $mail = $datos['mail'];
    $password = $datos['password'];
    $nombre = $datos['nombre'];
    $apellido = $datos['apellido'];
    $dni = $datos['dni'];
    $telefono = $datos['telefono'];
    $legajo = $datos['legajo'];
    $response->write(encargado::modificarEncargado($id,$mail,$password,$nombre,$apellido,$dni,$telefono,$legajo));

    return $response;
})->add($mdwAuth);

//BORRAR Encargado *************************/
$app->post('/borrarEncargado',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(encargado::borrarEncargado($id));
    return $response;
})->add($mdwAuth);

//**********************************//

//************ VEHICULOS ************//

//AGREGAR Vehiculo  *************************/
$app->post('/agregarVehiculo',function($request,$response){
    $datos = $request->getParsedBody();
    $id_chofer = $datos['id_chofer'];
    $marca = $datos['marca'];
    $modelo = $datos['modelo'];
    $anio = $datos['anio'];
    $fumar = $datos['fumar'];
    $aire = $datos['aire'];
    $baul = $datos['baul'];
    $response->write(vehiculo::agregarVehiculo($id_chofer,$marca,$modelo,$anio,$fumar,$aire,$baul));
})->add($mdwAuth);

//TRAER TODOS LOS Vehiculos *************************/
$app->get('/traerTodosLosVehiculos',function ($request,$response){
    $response->write(vehiculo::traerTodosLosVehiculos());
    return $response;
})->add($mdwAuth);

//TRAER TODOS LOS Vehiculos con choferes *************************/
$app->get('/traerTodosLosVehiculosConChoferes',function ($request,$response){
    $response->write(vehiculo::traerTodosLosVehiculosConChoferes());
    return $response;
})->add($mdwAuth);

//TRAER Vehiculo POR ID *************************/
$app->post('/traerVehiculoPorId',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(vehiculo::traerVehiculoPorId($id));
    return $response;
})->add($mdwAuth);

//MODIFICAR Vehiculo *************************/
$app->post('/modificarVehiculo',function($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $id_chofer = $datos['id_chofer'];
    $marca = $datos['marca'];
    $modelo = $datos['modelo'];
    $anio = $datos['anio'];
    $fumar = $datos['fumar'];
    $aire = $datos['aire'];
    $baul = $datos['baul'];
    $response->write(vehiculo::modificarVehiculo($id,$id_chofer,$marca,$modelo,$anio,$fumar,$aire,$baul));

    return $response;
})->add($mdwAuth);

//BORRAR Vehiculo *************************/
$app->post('/borrarVehiculo',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(vehiculo::borrarVehiculo($id));
    return $response;
})->add($mdwAuth);

//**********************************//



//************ VIAJES ************//
//AGREGAR Viaje  *************************/
$app->post('/agregarViaje',function($request,$response){
    $datos = $request->getParsedBody();
    $idE = $datos['id_encargado'];
    $idC = $datos['id_cliente'];
    $idCho = $datos['id_chofer'];
    $idV = $datos['id_vehiculo'];
    $latIn = $datos['latitud_inicio'];
    $lonIn = $datos['longitud_inicio'];
    $latDest = $datos['latitud_destino'];
    $lonDest =$datos['longitud_destino'];
    $formaPago = $datos['forma_pago'];
    $fecha = $datos['fecha'];
    //$estado = $datos['estado'];
    $dist = $datos['distancia'];
    $costo = $datos['costo'];
    $inicio = $datos['inicio'];
    $destino = $datos['destino'];
    $response->write(Viaje::agregarViaje($idE,$idC,$idCho,$idV,$dist,$costo,$formaPago,$latIn,$lonIn,$latDest,$lonDest,$inicio,$destino,$fecha));
})->add($mdwAuth);
//TRAER TODOS LOS viajes *************************/
$app->get('/traerTodosLosviajes',function ($request,$response){
    $response->write(Viaje::traerTodosLosviajes());
    return $response;
})->add($mdwAuth);
//TRAER TODOS LOS viajes CON CLIENTES*************************/
$app->get('/traerTodosLosviajesConClientes',function ($request,$response){
    $response->write(Viaje::traerTodosLosviajesConClientes());
    return $response;
})->add($mdwAuth);
//TRAER TODOS LOS viajes CON CHOFERES*************************/
$app->get('/traerTodosLosviajesConChoferes',function ($request,$response){
    $response->write(Viaje::traerTodosLosviajesConChoferes());
    return $response;
})->add($mdwAuth);
//TRAER Viaje POR ID *************************/
$app->post('/traerViajePorId',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(Viaje::traerViajePorId($id));
    return $response;
})->add($mdwAuth);
//TRAER Viaje POR CHOFER *************************/
$app->post('/traerViajesPorChofer',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(Viaje::traerViajesPorChofer($id));
    return $response;
})->add($mdwAuth);
//TRAER Viaje POR CLIENTE *************************/
$app->post('/traerViajesPorCliente',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(Viaje::traerViajesPorCliente($id));
    return $response;
})->add($mdwAuth);
//MODIFICAR Viaje *************************/
$app->post('/cambiarEstadoViaje',function($request,$response){
  $datos = $request->getParsedBody();
    $id = $datos['id'];
    $estado = $datos['estado'];
    $response->write(Viaje::cambiarEstadoViaje($id,$estado));
    return $response;
})->add($mdwAuth);
//MODIFICAR Viaje *************************/
$app->post('/modificarViaje',function($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $id_encargado = $datos['id_encargado'];
    $id_cliente = $datos['id_cliente'];
    $id_chofer = $datos['id_chofer'];
    $id_vehiculo = $datos['id_vehiculo'];
    $direccion_inicio = $datos['direccion_inicio'];
    $direccion_destino = $datos['direccion_destino'];
    $puntaje_chofer = $datos['puntaje_chofer'];
    $puntaje_vehiculo = $datos['puntaje_vehiculo'];
    $puntaje_cliente = $datos['puntaje_cliente'];
    $estado = $datos['estado'];
    $forma_pago = $datos['forma_pago'];
    $response->write(Viaje::modificarViaje($id_encargado,$id_cliente,$id_chofer,$id_vehiculo,$direccion_inicio,$direccion_destino,$puntaje_chofer,$puntaje_vehiculo,$puntaje_cliente,$estado,$forma_pago));
    return $response;
})->add($mdwAuth);
//BORRAR Viaje *************************/
$app->post('/borrarViaje',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(Viaje::borrarViaje($id));
    return $response;
})->add($mdwAuth);
//**********************************//

//************ ENCUESTAS ************////AGREGAR encuesta  *************************/
$app->post('/agregarEncuesta',function($request,$response){
    $datos = $request->getParsedBody();
    $id_viaje = $datos['id_viaje'];
    $puntaje_viaje = $datos['puntaje_viaje'];
    $id_chofer = $datos['id_chofer'];
    $puntaje_chofer = $datos['puntaje_chofer'];
    $id_vehiculo = $datos['id_vehiculo'];
    $puntaje_vehiculo = $datos['puntaje_vehiculo'];
    $pregunta1 = $datos['pregunta1'];
    $pregunta2 = $datos['pregunta2'];
    $pregunta3 = $datos['pregunta3'];
    $pregunta4 = $datos['pregunta4'];
    $observaciones = $datos['observaciones'];
    $response->write(encuesta::agregarEncuesta($id_viaje,$puntaje_viaje,$id_chofer,$puntaje_chofer,$id_vehiculo,$puntaje_vehiculo,$pregunta1,$pregunta2,$pregunta3,$pregunta4,$observaciones));
})->add($mdwAuth);
//TRAER TODAS LAS ENCUESTAS *************************/
$app->get('/traerTodasLasEncuestas',function ($request,$response){
    $response->write(encuesta::traerTodasLasEncuestas());
    return $response;
})->add($mdwAuth);
//TRAER ENCUESTA POR ID VIAJE *************************/
$app->post('/traerEncuestaPorIdViaje',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(encuesta::traerEncuestaPorIdViaje($id));
    return $response;
})->add($mdwAuth);

$app->run();
