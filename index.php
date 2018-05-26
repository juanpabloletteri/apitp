<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once './vendor/autoload.php';
require_once './clases/AccesoDatos.php';

require_once './clases/items.php';

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

//ALTA USUARIO *******************/
$app->post('/altaItem',function($request,$response){
    $datos = $request->getParsedBody();
    $modelo = $datos['modelo'];
    $tipo = $datos['tipo'];
    $anio = $datos['anio'];
    $foto = $datos['foto'];
    $response->write(item::AgregarItem($modelo,$tipo,$anio,$foto));
});

//TRAER TODOS LOS USUARIOS *************************/
$app->get('/traerTodosLosItems',function ($request,$response){
    $response->write(item::traerTodosLosItems());
    return $response;
});

//TRAER USUARIO POR ID *************************/
$app->post('/traerItemPorId',function ($request,$response){
    $datos = $request->getParsedBody();
    $modelo = $datos['modelo'];
    $response->write(item::TraerItemPorId($modelo));
    return $response;
});

//TRAER USUARIO POR ID *************************/
$app->post('/borrarVehiculo',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(item::borrarVehiculo($id));
    return $response;
});

//MODIFICAR ITEM *************************/
$app->post('/modificarItem',function($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $modelo = $datos['modelo'];
    $tipo = $datos['tipo'];
    $anio = $datos['anio'];
    $response->write(item::modificarItem($id,$modelo,$tipo,$anio));

    return $response;
});















//TRAER MAILS *************************/
$app->get('/traerMails',function ($request,$response){
    $response->write(usuario::TraerMails());
    return $response;
});

//TRAER modeloS DE USUARIO *************************/
$app->get('/traermodelosusuario',function ($request,$response){
    $response->write(usuario::TraerApodoJugador());
    return $response;
});

//TRAER MAILS Y modeloS DE USUARIO *************************/
$app->get('/traerMailsyApodos',function ($request,$response){
    $response->write(usuario::TraerMailsyApodoJugador());
    return $response;
});

//TRAER MAILS Y CONTRASEÑAS *************************/
$app->get('/traerMailsyPass',function ($request,$response){
    $response->write(usuario::TraerMailsyPass());
    return $response;
});

//SUMAR PUNTOS *******************/
$app->post('/sumarPuntos',function($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $puntos1 = $datos['puntos1'];
    $puntos2 = $datos['puntos2'];
    $puntos3 = $datos['puntos3'];
var_dump($datos);
    $response->write(usuario::SumarPuntos($id,$puntos1,$puntos2,$puntos3));
	
});














//GET PARA DISTINTOS TIPOS DE USUARIOS

$app->get('/todoslosAlumnos',function ($reuqest,$response){
    $response->write(usuario::TraerAlumnos());
    return $response;
});
$app->get('/todoslosProfes',function ($reuqest,$response){
    $response->write(usuario::TraerProfesores());
    return $response;
});
$app->get('/todoslosAdmins',function ($reuqest,$response){
    $response->write(usuario::TraerAdmins());
    return $response;
});
$app->get('/todoslosAdministrativos',function ($reuqest,$response){
    $response->write(usuario::TraerAdminsistrativos());
    return $response;
});

//POST PARA OBTENER UN USUARIO POR ID
/*$app->post('/traerUsuarioPorId',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(usuario::TraerUnUsuario($id));
    return $response;
});*/
//ALTA PROFESOR*******************/
$app->post('/altaProfesor',function($request,$response){
    $datos = $request->getParsedBody();
    $modelo = $datos['modelo'];
    $apellido = $datos['apellido'];
    $dni = $datos['dni'];
    $mail = $datos['mail'];
    $sexo = $datos['sexo'];
    $response->write(usuario::AgregarProfesor($modelo,$apellido,$dni,$mail,$sexo));
});
//********************************/
//ALTA ADMINISTRATIVO*******************/
$app->post('/altaAdministrativo',function($request,$response){
    $datos = $request->getParsedBody();
    $modelo = $datos['modelo'];
    $apellido = $datos['apellido'];
    $dni = $datos['dni'];
    $mail = $datos['mail'];
    $sexo = $datos['sexo'];
    $response->write(usuario::AgregarAdministrativo($modelo,$apellido,$dni,$mail,$sexo));
});
//*************************************/
//ALTA ALUMNO*******************/
$app->post('/altaAlumno',function($request,$response){
    $datos = $request->getParsedBody();
    $modelo = $datos['modelo'];
    $apellido = $datos['apellido'];
    $dni = $datos['dni'];
    $mail = $datos['mail'];
    $sexo = $datos['sexo'];
    $response->write(usuario::AgregarAlumno($modelo,$apellido,$dni,$mail,$sexo));
});
/******************************
*************************************
ALTA ADMIN*******************/
$app->post('/altaAdmin',function($request,$response){
    $datos = $request->getParsedBody();
    $modelo = $datos['modelo'];
    $apellido = $datos['apellido'];
    $dni = $datos['dni'];
    $mail = $datos['mail'];
    $sexo = $datos['sexo'];
    $response->write(usuario::AgregarAdmin($modelo,$apellido,$dni,$mail,$sexo));
});
/*******************************************
 * *****************************
 *BAJA USUARIO*/
$app->post('/bajaUsuario',function($request,$response){
    $datos = $request->getParsedBody();
    $id_usuario = $datos['idUsuario'];
    $response->write(usuario::BajaUsuario($id_usuario));

    return $response;
});
/*******************************************
 * *****************************
 *MODIFICACIONES USUARIO*/
$app->post('/CambiarPassword',function($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $pw = $datos['pw'];
    $response->write(usuario::ActualizarPassword($id,$pw));
    return $response;
});
$app->post('/modificarUsuario',function($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $modelo = $datos['modelo'];
    $apellido = $datos['apellido'];
    $mail = $datos['mail'];
    $response->write(usuario::modificarUsuario($id,$modelo,$apellido,$mail));

    return $response;
});
$app->post('/guardarImagenUsuario',function($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $foto = $datos['foto'];
    $response->write(usuario::subirFoto($foto,$id));

    return $response;
});
$app->post('/imagenUsuario',function($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(usuario::TraerFotoPorId($id));

    return $response;
});
//******************************/

/*
****************************************************************************************************************************************************************
****************************************  MATERIAS ****************************************
*/
$app->post('/altaMateria',function($request,$response){
    $datos = $request->getParsedBody();
    $modelo = $datos['modelo'];
    $aula = $datos['aula'];
    $response->write(materia::AltaDeMateria($modelo,$aula));
});
$app->post('/modiMateria',function($request,$response){
    $datos = $request->getParsedBody();
    $modelo = $datos['modelo'];
    $aula = $datos['aula'];
    $id = $datos['id'];
    $response->write(materia::ModificarMateria($id,$modelo,$aula));
});
$app->get('/traerTodasLasMaterias',function($request,$response){
    $response->write(materia::TraerTodasLasMaterias());
});

/*
****************************************************************************************************************************************************************
****************************************  CURSOS ****************************************
*/
$app->post('/altaCurso',function($request,$response){
    $datos = $request->getParsedBody();
    $aula = $datos['aula'];
    $materia = $datos['materia'];
    $comision = $datos['comision'];
    $profesor = $datos['profesor'];
    $response->write(curso::AgregarCurso($aula,$materia,$comision,$profesor));

    return $response;
});
$app->post('/agregarAlumnosCurso',function ($request,$response){
    $datos = $request->getParsedBody();
    $idAlumno = $datos['idAlumno'];
    $response->write(curso::AgregarDetalleCurso($idAlumno));

    return $response;
});
$app->get('/traerUltimoCurso',function($request,$response){
    $response->write(curso::TraerUltimoCurso());

    return $response;
});
$app->get('/traerCursosPorDiaActual',function ($request,$response){
    $fecha = date('N');
    $response->write(curso::TraerCursosPorFecha($fecha));

    return $response;
});
$app->post('/traerCursosPorDia',function($request,$response){
    $datos = $request->getParsedBody();
    $fecha = $datos['dia'];
    $response->write(curso::TraerCursosPorFecha($fecha));

    return $response;
});
$app->post('/traerCursoPorDiaAula',function($request,$response){
    $datos = $request->getParsedBody();
    $dia = date('N');
    $aula = $datos['aula'];
    $response->write(curso::TraerCursoDiaAula($dia,$aula));
});
$app->get('/traerCursos',function($request,$response){
    $response->write(curso::TraerTodosLosCursos());

    return $response;
});
$app->post('/agregarCurso',function($request,$response){
    $datos = $request->getParsedBody();
    $comision = $datos['comision'];
    $profesor = $datos['profesor'];
    $materia = $datos['materia'];
    $dia = $datos['dia'];
    $aula = $datos['aula'];
    $response->write(curso::AgregarCurso($comision,$profesor,$materia,$dia,$aula));

    return $response;
});
$app->post('/traerListaPorCurso',function($request,$response){
    $datos= $request->getParsedBody();
    $idCurso = $datos['idCurso'];
    $response->write(curso::TraerListaPorCurso($idCurso));

    return $response;
});
/*
****************************************************************************************************************************************************************
****************************************  ASISTENCIAS ****************************************
*/
$app->get('/estadisticaAsistenciaGlobal',function($request,$response){
    $response->write(asistencia::EstadisticaAsistenciaGlobal());

    return $response;
});
$app->post('/estadisticaAsistenciaPorCurso',function($request,$response){
    $datos = $request->getParsedBody();
    $curso = $datos['idCurso'];
    $response->write(asistencia::EstadisticaAsistenciaPorCurso($curso));

    return $response;
});
$app->post('/estadisticaAsistenciaPorAlumno',function($request,$response){
    $datos = $request->getParsedBody();
    $alumno = $datos['idAlumno'];
    $response->write(asistencia::EstadisticaAsistenciaPorAlumno($alumno));

    return $response;
});
$app->post('/validarAsistencia',function($request,$response){
    $datos = $request->getParsedBody();
    $curso = $datos['idCurso'];
    $response->write(asistencia::validarAsistencia($curso));

    return $response;
});
$app->post('/agregarAsistencia',function($request,$response){
    $datos = $request->getParsedBody();
    $curso = $datos['idCurso'];
    $response->write(asistencia::AgregarAsistencia($curso));

    return $response;
});

$app->post('/listaPorCurso', function($request,$response){
    $datos = $request->getParsedBody();
    $curso = $datos['idCurso'];
    $response->write(asistencia::TraerListaPorCurso($curso));

    return $response;
});

$app->post('/agregarDetalleAsistencia',function ($request,$response){
    $datos = $request->getParsedBody();
    $idAlumno = $datos['idAlumno'];
    $response->write(asistencia::AgregarDetalleAsistencia($idAlumno));

    return $response;
});

$app->post('/updateDetalleAsistencia',function ($request,$response){
    $datos = $request->getParsedBody();
    $idAlumno = $datos['idAlumno'];
    $response->write(asistencia::UpdateDetalleAsistencia($idAlumno));

    return $response;
});

$app->get('/eliminarAsistencia',function($request,$response){
    $response->write(asistencia::EliminarAsistencia());

    return $response;
});

$app->get('/historicoAsistencia',function($request,$response){
    $response->write(asistencia::ListaHistoriaDeAsistencias());

    return $response;
});

$app->post('/asistenciaPorId',function($request,$response){
    $datos = $request->getParsedBody();
    $idAsist = $datos['idAsist'];
    $response->write(asistencia::ListaDeAlumnosPorIdAsistencia($idAsist));

    return $response;
});
$app->post('/fotoAsistenciaRecuperada',function($request,$response){
    $datos = $request->getParsedBody();
    $idAsist = $datos['idAsist'];
    $response->write(asistencia::UrlFotoAsistencia($idAsist));

    return $response;
});
$app->post('/updateFotoAsistencia',function($request,$response){
    $datos = $request->getParsedBody();
    $foto = $datos['urlFoto'];
    $response->write(asistencia::UpdateFotoAsistencia($foto));

    return $response;
});
//*********************************************ENCUESTAS***************************************************** */
//*********************************************ENCUESTAS***************************************************** */
$app->get('/mostrarEncuestas',function($request,$response){
    $response->write(encuesta::MostrarEncuestas());

    return $response;
});
$app->post('/mostrarEncuestasPorProf',function($request,$response){
    $datos = $request->getParsedBody();
    $prof = $datos['idProfesor'];
    $response->write(encuesta::MostrarEncuestasPorProf($prof));

    return $response;
});
$app->post('/mostrarEncuestaPorId',function($request,$response){
    $datos = $request->getParsedBody();
    $id_encuesta = $datos['idEncuesta'];
    $response->write(encuesta::MostrarEncuestaPorId($id_encuesta));

    return $response;
});
$app->post('/mostrarDatosEncuestaPorId',function($request,$response){
    $datos = $request->getParsedBody();
    $id_encuesta = $datos['idEncuesta'];
    $response->write(encuesta::MostrarDatosPorEncuestaId($id_encuesta));

    return $response;
});
$app->post('/mostrarEncuestasPorAlumno',function($request,$response){
    $datos = $request->getParsedBody();
    //$id_encuesta = $datos['idEncuesta'];
    $id_alumno = $datos['idAlumno'];
    $response->write(encuesta::MostrarEncuestaDeAlumno($id_alumno));

    return $response;
});
$app->post('/cursosPorProfesor',function($request,$response){
    $datos = $request->getParsedBody();
    $id_prof = $datos['idProfesor'];
    $response->write(encuesta::cursosPorProf($id_prof));

    return $response;
});
$app->post('/ingresarEncuesta',function($request,$response){
    $datos = $request->getParsedBody();
    $curso = $datos['curso'];
    $modelo = $datos['modelo'];
    $opcion1 = $datos['opcion1'];
    $opcion2 = $datos ['opcion2'];
    $duracion = $datos['duracion'];
    $response->write(encuesta::agregarEncuesta($curso,$modelo,$opcion1,$opcion2,$duracion));

    return $response;
});
$app->post('/updateVotoAlumno',function($request,$response){
    $datos = $request->getParsedBody();
    $id_encuesta = $datos['idEncuesta'];
    $id_alumno = $datos['idAlumno'];
    $voto = $datos['voto'];
    $response->write(encuesta::UpdateVotoAlumno($id_encuesta,$id_alumno,$voto));

    return $response;
});
$app->post('/updateEstadoEncuesta',function($request,$response){
    $datos = $request->getParsedBody();
    $id_encuesta = $datos['idEncuesta'];
    $response->write(encuesta::UpdateEstadoEncuesta($id_encuesta));

    return $response;
});
$app->post('/alumnoQr',function($request,$response){
    $datos = $request->getParsedBody();
    $id_alumno = $datos['id_Alumno'];
    $aula = $datos['aula'];
    $response->write(curso::AlumnoQr($aula,$id_alumno));

    return $response;
});
$app->post('/profesorQr',function($request,$response){
    $datos = $request->getParsedBody();
    $id_alumno = $datos['id_Alumno'];
    $aula = $datos['aula'];
    $response->write(curso::ProfesorQr($aula,$id_alumno));

    return $response;
});
$app->post('/activarEncuestaProfesor',function($request,$response){
    $datos = $request->getParsedBody();
    $id_encuesta = $datos['idEncuesta'];
    $response->write(encuesta::activarEncuestaProfesor($id_encuesta));
    return $response;
});
$app->post('/eliminarEncuesta',function($request,$response){
    $datos = $request->getParsedBody();
    $id_encuesta = $datos['idEncuesta'];
    $response->write(encuesta::eliminarEncuesta($id_encuesta));
    return $response;
});
$app->post('/modificarEncuesta',function($request,$response){
    $datos = $request->getParsedBody();
    $id_encuesta = $datos['idEncuesta'];
    $opcion1 = $datos['opcion1'];
    $opcion2 = $datos['opcion2'];
    $response->write(encuesta::modificarEncuesta($id_encuesta,$opcion1,$opcion2));
    return $response;
});







//************************************************************************************************** */
$app->get('/traerArchivos',function($request,$response){
    $response->write(archivo::TraerArchivos());

    return $response;
});
$app->post('/subirArchivo',function($request,$response){
    $datos = $request->getParsedBody();
    $titulo = $datos['titulo'];
    $response->write(archivo::IngresarArchivo($titulo));

    return $response;
});


$app->get('/ultimaAsistencia',function ($request,$response){
    $response->write(asistencia::UltimaAsistencia());

    return $response;
});

//require_once "saludo.php";
//*******************************************************************************
$app->post('/agregarUsuario',function($request,$response){
    $modelo = $request->getParam("modelo");
    $mail = $request->getParam("mail");
    $sexo = $request->getParam("sexo");
    $password = $request->getParam("password");
    //$datos = $request->getParsedBody();
    $response->write(Persona::AgregarUsuario($modelo,$mail,$sexo,$password));
});
$app->post('/caca',function($request,$response){
    $datos = $request->getParsedBody();
    $response->write(Persona::AgregarUsuario($datos["modelo"],$datos["mail"],$datos["sexo"],$datos["password"]));
});



$app->get('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("GET => Bienvenido!!! ,a SlimFramework");
    return $response;

});





$app->delete('[/]', function (Request $request, Response $response) {  
    $response->getBody()->write(" DELETE => Bienvenido!!! ,a SlimFramework");
    return $response;

});




$app->run();
