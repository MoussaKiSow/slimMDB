<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;



return function (App $app) {
    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });
    
    // get all todos
    $app->get('/todos', function ($request, $response, $args) {
		require_once("dbconnect.php");
         $result = $conex->query("SELECT * FROM tasks ORDER BY task");
        
			while($row=$result->fetch_assoc()){
				$data[]=$row;
				}
				// return $this->response->withJson($todos);
				//echo "<pre>";print_r($data);
				
				//return $this->response->withJson($data);
				echo json_encode($data);
				exit;
        
        
    });
    
    $app->get('/employees',function(Request $request, Response $response){
		require_once('dbconnect.php');
        $_col =array('Name','Position','Office','Age','StartDate','Salary');
		$result=$conex->query("SELECT Name,Position,Office,Age,StartDate,Salary FROM Employees");

		while($row=$result->fetch_assoc()){
            $_linea=array();
            foreach($_col as $_one_c){
                $_linea[]=$row[$_one_c];
            }
			$data[] = $_linea;
			}
		
		
		echo json_encode(array('data'=>$data));
      
	 exit;
    });



};
