<?php

namespace Config\Core;

class Route{
	private array $getRoutes = [];
	private array $postRoutes = [];
	private array $patchRoutes = [];
	private array $deleteRoutes = [];
	
	public function start(){
		$controllerName = 'Main';
		$actionName = 'index';

		$path = $_SERVER['REQUEST_URI'];
		switch($_SERVER['REQUEST_METHOD']){
			case 'GET':
				$route = $this->getRoutes[$path];
				break;
			case 'POST':
				$route = $this->postRoutes[$path];
				break;
			case 'PATCH':
				$route = $this->patchRoutes[$path];
				break;
			case 'DELETE':
				// $path = explode("?", $path);
				// $path = implode("/",$path);
				// $path = explode("/",$path);
				// $path = implode("/",$path);
				// $path = explode("=",$path);
				// $path = implode("/",$path);
				// $path = explode("id",$path);
				// $path = implode("/",$path);
				// $trimmed = trim($path, '/');
     			// $path = preg_replace('/\/+/', '/', $trimmed);
				// $path = explode("/",$path);

				$route = $this->deleteRoutes[$path];

				// $route = $this->deleteRoutes['controller'] = $path[0];
				// $route = $this->deleteRoutes['action'] = $path[1];
				// $route = $this->deleteRoutes['id'] = $path[2];

				// $route = [
				// 	'controller' => $path[0],
				// 	'action' => $path[1],
				// 	'id' => $path[2]
				// ];
				break;
			default:
				$this->ErrorPage404();
				break;
		}

		// if(str_contains($_SERVER['REQUEST_URI'],'store')){
		// 	$route = $this->postRoutes[$path];
		// }elseif(str_contains($_SERVER['REQUEST_URI'],'destroy')){
		// 	$route = $this->deleteRoutes[$path];
		// }elseif(str_contains($_SERVER['REQUEST_URI'],'patch')){
		// 	$route = $this->patchRoutes[$path];
		// }else{
		// 	$route = $this->getRoutes[$path];
		// }

		if(is_null($route)){
			$this->ErrorPage404('null route');
		}
		$controllerName = $route['controller'];
		$actionName = $route['action'];
		if($route['id'] != null){
			$id = $route['id'];
		}else{$id = null;}

		$controllerFile = $controllerName.'.php';
		$controllerPath = "../app/controllers/".$controllerFile;
		if(file_exists($controllerPath))
		{
			include "../app/controllers/".$controllerFile;
		}
		else
		{
			$this->ErrorPage404('controller path does not exist');
		}
		$controller = 'Controllers\\'.$controllerName;
		$controller = new $controller;
		$action = $actionName;
		
		if(method_exists($controller, $action))
		{
			$data = $controller->$action($id);
			header('Content-Type: application/json');
			echo json_encode($data);
			// $controller->$action();
		}
		else
		{
			$this->ErrorPage404('controller method does not exit');
		}
	}

	public function get(string $url, string $controller, string $action): void {
		$this->getRoutes[$url] = [
				'controller' => $controller,
				'action' => $action
			];
	}

	public function post(string $url, string $controller, string $action): void {
		$this->postRoutes[$url] = [
			'controller' => $controller,
			'action' => $action,
		];
	}

	public function patch(string $url, string $controller, string $action): void {
		$this->patchRoutes[$url] = [
			'controller' => $controller,
			'action' => $action
		];
	}

	public function delete(string $url, string $controller, string $action): void {
		// Получаем часть строки запроса из URL
		$queryString = parse_url($url, PHP_URL_QUERY);

		// Разбираем часть строки запроса в массив
		parse_str($queryString, $queryParameters);

		// Получаем значение id
		$id = $queryParameters['id'];
		$this->deleteRoutes[$url] = [
			'controller' => $controller,
			'action' => $action,
			'id' => $id
		];
	}

	private function ErrorPage404($from): void
	{
		header('Content-Type: application/json');
		http_response_code(404);
		echo json_encode([
			'status_code' => 404,
			'error' => 'Not Found',
			'from' => $from
		]);
		die();
    }
}
