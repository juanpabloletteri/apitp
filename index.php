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

$app = new \Slim\App(["settings" => $config]);


$app->get('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("GET => Bienvenido!!! ,a SlimFramework");
    return $response;

});


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
    $id_usuario=$response->write(cliente::agregarCliente($mail,$password,$nombre,$apellido,$dni,$telefono,$tipo,$domicilio));
    return $response;
});

//TRAER TODOS LOS CLIENTES *************************/
$app->get('/traerTodosLosClientes',function ($request,$response){
    $response->write(cliente::traerTodosLosClientes());
    return $response;
});

//TRAER CLIENTE POR ID *************************/
$app->post('/traerClientePorId',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(cliente::traerClientePorId($id));
    return $response;
});

//TRAER CLIENTE POR DNI *************************/
$app->post('/traerClientePorDni',function ($request,$response){
    $datos = $request->getParsedBody();
    $dni = $datos['dni'];
    $response->write(cliente::traerClientePorDni($dni));
    return $response;
});

//TRAER CLIENTE POR DOMICILIO *************************/
$app->post('/traerClientePorDomicilio',function ($request,$response){
    $datos = $request->getParsedBody();
    $domicilio = $datos['domicilio'];
    $response->write(cliente::traerClientePorDomicilio($domicilio));
    return $response;
});

//MODIFICAR CLIENTE *************************/
$app->post('/modificarCliente',function($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $mail = $datos['mail'];
    $password = $datos['password'];
    $nombre = $datos['nombre'];
    $apellido = $datos['apellido'];
    $dni = $datos['dni'];
    $telefono = $datos['telefono'];
    $domicilio = $datos['domicilio'];
    $response->write(cliente::modificarCliente($id,$mail,$password,$nombre,$apellido,$dni,$telefono,$domicilio));

    return $response;
});

//BORRAR CLIENTE *************************/
$app->post('/borrarCliente',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(cliente::borrarCliente($id));
    return $response;
});

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
});

//TRAER TODOS LOS CHOFERES *************************/
$app->get('/traerTodosLosChoferes',function ($request,$response){
    $response->write(chofer::traerTodosLosChoferes());
    return $response;
});

//TRAER Chofer POR ID *************************/
$app->post('/traerChoferPorId',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(chofer::traerChoferPorId($id));
    return $response;
});

//TRAER CHOFER POR DNI *************************/
$app->post('/traerChoferPorDni',function ($request,$response){
    $datos = $request->getParsedBody();
    $dni = $datos['dni'];
    $response->write(chofer::traerChoferPorDni($dni));
    return $response;
});

//TRAER CHOFER POR LEGAJO *************************/
$app->post('/traerChoferPorLegajo',function ($request,$response){
    $datos = $request->getParsedBody();
    $legajo = $datos['legajo'];
    $response->write(chofer::traerChoferPorLegajo($legajo));
    return $response;
});

//MODIFICAR CHOFER *************************/
$app->post('/modificarChofer',function($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $mail = $datos['mail'];
    $password = $datos['password'];
    $nombre = $datos['nombre'];
    $apellido = $datos['apellido'];
    $dni = $datos['dni'];
    $telefono = $datos['telefono'];
    $legajo = $datos['legajo'];
    $response->write(chofer::modificarChofer($id,$mail,$password,$nombre,$apellido,$dni,$telefono,$legajo));

    return $response;
});

//BORRAR CHOFER *************************/
$app->post('/borrarChofer',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(chofer::borrarChofer($id));
    return $response;
});

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
});

//TRAER TODOS LOS Encargados *************************/
$app->get('/traerTodosLosEncargados',function ($request,$response){
    $response->write(encargado::traerTodosLosEncargados());
    return $response;
});

//TRAER Encargado POR ID *************************/
$app->post('/traerEncargadoPorId',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(encargado::traerEncargadoPorId($id));
    return $response;
});

//TRAER Encargado POR DNI *************************/
$app->post('/traerEncargadoPorDni',function ($request,$response){
    $datos = $request->getParsedBody();
    $dni = $datos['dni'];
    $response->write(encargado::traerEncargadoPorDni($dni));
    return $response;
});

//TRAER Encargado POR LEGAJO *************************/
$app->post('/traerEncargadoPorLegajo',function ($request,$response){
    $datos = $request->getParsedBody();
    $legajo = $datos['legajo'];
    $response->write(encargado::traerEncargadoPorLegajo($legajo));
    return $response;
});

//MODIFICAR Encargado *************************/
$app->post('/modificarEncargado',function($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $mail = $datos['mail'];
    $password = $datos['password'];
    $nombre = $datos['nombre'];
    $apellido = $datos['apellido'];
    $dni = $datos['dni'];
    $telefono = $datos['telefono'];
    $legajo = $datos['legajo'];
    $response->write(encargado::modificarEncargado($id,$mail,$password,$nombre,$apellido,$dni,$telefono,$legajo));

    return $response;
});

//BORRAR Encargado *************************/
$app->post('/borrarEncargado',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(encargado::borrarEncargado($id));
    return $response;
});

//**********************************//














































































///////////////////////////////////////////////////////////////////////
//************ USUARIOS ************//

//AGREGAR USUARIO  *************************/
$app->post('/agregarUsuario',function($request,$response){
    $datos = $request->getParsedBody();
    $mail = $datos['mail'];
    $password = $datos['password'];
    $nombre = $datos['nombre'];
    $apellido = $datos['apellido'];
    $dni = $datos['dni'];
    $telefono = $datos['telefono'];
    $tipo = $datos['tipo'];
    $response->write(usuario::agregarUsuario($mail,$password,$nombre,$apellido,$dni,$telefono,$tipo));
});

//TRAER TODOS LOS USUARIOS *************************/
$app->get('/traerTodosLosUsuarios',function ($request,$response){
    $response->write(usuario::traerTodosLosUsuarios());
    return $response;
});

//TRAER USUARIO POR ID *************************/
$app->post('/traerUsuarioPorId',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(usuario::traerUsuarioPorId($id));
    return $response;
});

//MODIFICAR USUARIO *************************/
$app->post('/modificarUsuario',function($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $mail = $datos['mail'];
    $password = $datos['password'];
    $nombre = $datos['nombre'];
    $apellido = $datos['apellido'];
    $dni = $datos['dni'];
    $telefono = $datos['telefono'];
    $tipo = $datos['tipo'];
    $response->write(usuario::modificarUsuario($id,$mail,$password,$nombre,$apellido,$dni,$telefono,$tipo));

    return $response;
});

//BORRAR USUARIO *************************/
$app->post('/borrarUsuario',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(usuario::borrarUsuario($id));
    return $response;
});

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
});

//TRAER TODOS LOS Vehiculos *************************/
$app->get('/traerTodosLosVehiculos',function ($request,$response){
    $response->write(vehiculo::traerTodosLosVehiculos());
    return $response;
});

//TRAER Vehiculo POR ID *************************/
$app->post('/traerVehiculoPorId',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(vehiculo::traerVehiculoPorId($id));
    return $response;
});

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
});

//BORRAR Vehiculo *************************/
$app->post('/borrarVehiculo',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(vehiculo::borrarVehiculo($id));
    return $response;
});

//**********************************//



//************ VIAJES ************//

//AGREGAR Viaje  *************************/
$app->post('/agregarViaje',function($request,$response){
    $datos = $request->getParsedBody();
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
    $response->write(Viaje::agregarViaje($id_encargado,$id_cliente,$id_chofer,$id_vehiculo,$direccion_inicio,$direccion_destino,$puntaje_chofer,$puntaje_vehiculo,$puntaje_cliente,$estado,$forma_pago));
});

//TRAER TODOS LOS viajes *************************/
$app->get('/traerTodosLosviajes',function ($request,$response){
    $response->write(Viaje::traerTodosLosviajes());
    return $response;
});

//TRAER Viaje POR ID *************************/
$app->post('/traerViajePorId',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(Viaje::traerViajePorId($id));
    return $response;
});

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
});

//BORRAR Viaje *************************/
$app->post('/borrarViaje',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(Viaje::borrarViaje($id));
    return $response;
});

//**********************************//





$app->run();
