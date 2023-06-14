<?php

namespace Controllers;

use Models\Post;
use Config\Core\BaseController;

class PostController extends BaseController{

	public function index()
	{
		$posts = $this->conn->executeQuery('SELECT * FROM posts')->fetchAll();

		return $posts;

		// $this->view->render('posts.php','layout.php',['posts'=>$posts]);

		// foreach($_SERVER as $key=>$word){
		// 	echo "<p>$key:$word</p>";
		// }
	}

	public function store(){
		$title = $_POST['title'];
		$body = $_POST['body'];
		$this->conn->executeQuery("INSERT INTO posts (title,body) VALUES ('$title','$body')");
		$posts = $this->conn->executeQuery('SELECT * FROM posts')->fetchAll();

		// $this->view->render('posts.php','layout.php',['posts'=>$posts]);
		return $posts;

		// $_SERVER['REQUEST_URI'] = '/posts';
		// $_SERVER['REQUEST_METHOD'] = 'GET';

		// header("location: http://127.0.0.1:8080/posts");
		// foreach($_SERVER as $key=>$word){
		// 	echo "<p>$key:$word</p>";
		// }
	}

	public function destroy($id){

		$this->conn->executeQuery("DELETE FROM posts WHERE id='$id'");

		$posts = $this->conn->executeQuery('SELECT * FROM posts')->fetchAll();
		return [$posts,'data'=>$data];
	}

	public function patch(){
		$data  = [];
		parse_str(file_get_contents("php://input"),$data);
		$id = $data['id'];
		$title = $data['title'];
		$body = $data['body'];

		$sql = "UPDATE posts SET title='$title',body='$body' WHERE id='$id'";
		$this->conn->executeQuery($sql);

		$posts = $this->conn->executeQuery('SELECT * FROM posts')->fetchAll();
		return [$posts];
	}
}