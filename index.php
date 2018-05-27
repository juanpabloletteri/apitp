<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once './vendor/autoload.php';
require_once './clases/AccesoDatos.php';

require_once './clases/usuario.php';
require_once './clases/chofer.php';
require_once './clases/cliente.php';
require_once './clases/encargado.php';


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
    $response->write(usuario::agregarUsuario($mail,$password,$nombre,$apellido,$dni,$telefono));
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
    $response->write(usuario::modificarUsuario($id,$mail,$password,$nombre,$apellido,$dni,$telefono));

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



//************ CHOFERES ************//

//AGREGAR CHOFER  *************************/
$app->post('/agregarChofer',function($request,$response){
    $datos = $request->getParsedBody();
    $nombre = $datos['nombre'];
    $apellido = $datos['apellido'];
    $dni = $datos['dni'];
    $telefono = $datos['telefono'];
    $legajo = $datos['legajo'];
    $response->write(chofer::agregarChofer($nombre,$apellido,$dni,$telefono,$legajo));
});

//TRAER TODOS LOS CHOFERES *************************/
$app->get('/traerTodosLosChoferes',function ($request,$response){
    $response->write(chofer::traerTodosLosChoferes());
    return $response;
});

//TRAER CHOFER POR ID *************************/
$app->post('/traerChoferPorId',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(chofer::traerChoferPorId($id));
    return $response;
});

//MODIFICAR CHOFER *************************/
$app->post('/modificarChofer',function($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $nombre = $datos['nombre'];
    $apellido = $datos['apellido'];
    $dni = $datos['dni'];
    $telefono = $datos['telefono'];
    $legajo = $datos['legajo'];
    $response->write(chofer::modificarChofer($id,$nombre,$apellido,$dni,$telefono,$legajo));
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






//************ CLIENTES ************//

//AGREGAR CLIENTE  *************************/
$app->post('/agregarCliente',function($request,$response){
    $datos = $request->getParsedBody();
    $nombre = $datos['nombre'];
    $apellido = $datos['apellido'];
    $dni = $datos['dni'];
    $telefono = $datos['telefono'];
    $domicilio = $datos['domicilio'];
    $response->write(cliente::agregarCliente($nombre,$apellido,$dni,$telefono,$domicilio));
});

//TRAER TODOS LOS CLIENTES *************************/
$app->get('/traerTodosLosClientes',function ($request,$response){
    $response->write(cliente::traerTodosLosClientes());
    return $response;
});

//TRAER CELIENTE POR ID *************************/
$app->post('/traerClientePorId',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(cliente::traerClientePorId($id));
    return $response;
});

//MODIFICAR CLIENTE *************************/
$app->post('/modificarCliente',function($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $nombre = $datos['nombre'];
    $apellido = $datos['apellido'];
    $dni = $datos['dni'];
    $telefono = $datos['telefono'];
    $domicilio = $datos['domicilio'];
    $response->write(cliente::modificarCliente($id,$nombre,$apellido,$dni,$telefono,$domicilio));

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






//************ ENCARGADOS ************//

//AGREGAR ENCARGADO  *************************/
$app->post('/agregarEncargado',function($request,$response){
    $datos = $request->getParsedBody();
    $nombre = $datos['nombre'];
    $apellido = $datos['apellido'];
    $dni = $datos['dni'];
    $telefono = $datos['telefono'];
    $legajo = $datos['legajo'];
    $response->write(encargado::agregarEncargado($nombre,$apellido,$dni,$telefono,$legajo));
});

//TRAER TODOS LOS ENCARGADOS *************************/
$app->get('/traerTodosLosEncargados',function ($request,$response){
    $response->write(encargado::traerTodosLosEncargados());
    return $response;
});

//TRAER ENCARGADO POR ID *************************/
$app->post('/traerEncargadoPorId',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(encargado::traerEncargadoPorId($id));
    return $response;
});

//MODIFICAR ENCARGADO *************************/
$app->post('/modificarEncargado',function($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $nombre = $datos['nombre'];
    $apellido = $datos['apellido'];
    $dni = $datos['dni'];
    $telefono = $datos['telefono'];
    $legajo = $datos['legajo'];
    $response->write(encargado::modificarEncargado($id,$nombre,$apellido,$dni,$telefono,$legajo));

    return $response;
});

//BORRAR ENCARGADO *************************/
$app->post('/borrarEncargado',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(encargado::borrarEncargado($id));
    return $response;
});

//**********************************//


$app->run();
