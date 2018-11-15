<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once './vendor/autoload.php';
require_once './clases/AccesoDatos.php';

require_once 'clases/alumno.php';

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

//*********************************************************************************************//
//INICIALIZO EL APIREST
//*********************************************************************************************//
$app = new \Slim\App(["settings" => $config]);

//*********************************************************************************************//
//CONFIGURO LOS VERBOS GET, POST, PUT Y DELETE
//*********************************************************************************************//
 
    $app->get('[/]', function (Request $request, Response $response) {    
        $url = "./home.php";
        return $response->withRedirect($url);
    });
//*********************************************************************************************//
/*LLAMADA A METODOS DE INSTANCIA DE UNA CLASE*/
//*********************************************************************************************//
    $app->group('/uss', function () {   

        
        $this->post('/filtro', \Usuario::class . ':traerUno');
        $this->post('/todos',\Usuario::class . ':traerTodos');
        $this->post('/',\Usuario::class . ':CargarUno');
        $this->delete('/', \Usuario::class . ':BorrarUno');
        $this->put('/', \Usuario::class . ':ModificarUno');


    });
    $app->group('/a', function () {   

        $this->post('/filtro', \Alumno::class . ':traerUno');
        $this->post('/todos', \Alumno::class . ':traerTodos');
        $this->post('/',\Alumno::class . ':CargarUno');
        $this->delete('/', \Alumno::class . ':BorrarUno');
        $this->put('/', \Alumno::class . ':ModificarUno');
    });

$app->run();