<?php

class User {
	private $con, $data;

	public function __construct($con, $username){
		$this->con = $con;
		// please add security
		$sql = "SELECT username, firstname, lastname, email FROM users WHERE username = '$username'";
		$query = $this->con->query($sql);
		$this->data = $query->fetch_assoc();

		$_SESSION["userLoggedIn"] = $this->data;
	}

	public static function isLoggedIn(){
		return isset($_SESSION["userLoggedIn"]);
	}

	public static function getUser(){
		if(self::isLoggedIn())
			return $_SESSION["userLoggedIn"];
	}

	public static function getProfileAvatar($size = "40", $attr = array()){
		$url = "https://www.gravatar.com/avatar/";
		$default = "https://www.gravatar.com/avatar/?d=mp&s=$size";
		if(self::isLoggedIn())
			$url .= md5( strtolower( trim( self::getUser()["email"] ) ) ) . "?s=$size";
		else
			$url = $default;
		$url = "<img src='$url'";
		foreach ($attr as $key => $val) {
			$url .= " $key='$val'";
		}
		$url .= " />";
		return $url;
	}

}

class Account {
	private $con;
	private $error = array();

	public static $loginFailed = "loginFailed";
	public static $registerFailed = "registerFailed";

	public function __construct($con){
		$this->con = $con;
	}

	public function login($username, $password){
		$password = md5($password);
		// please add security
		$sql = "SELECT username FROM users WHERE username = '$username' AND password = '$password'";
		$query = $this->con->query($sql);
		if($query->num_rows >= 1)
			return new User($this->con, $username);
		else{
			$this->error["loginFailed"] = '<strong>Invalid Credentials!</strong> Please check your info and try again.';
			return false;
		}
	}

	public function register($username, $password, $firstname, $lastname, $email){
		$this->validateUsername($username);
		$this->validateEmail($email);

		$password = md5($password);

		if(empty($this->error))
			return $this->insertUser($username, $password, $firstname, $lastname, $email);
		else
			return false;
	}

	public function insertUser($un, $pw, $fn, $ln, $e){
		// please add security
		$sql = "INSERT INTO users (username, password, firstname, lastname, email) VALUES ('$un','$pw','$fn','$ln','$e')";
		if($this->con->query($sql)){
			return new User($this->con, $un);
		}
	}

	public function validateUsername($username){
		// please add security
		$sql = "SELECT username FROM users WHERE username = '$username'";
		$query = $this->con->query($sql);
		if($query->num_rows > 0)
			$this->error["registerFailed"] = '<strong>Oh no!</strong> Username ['.$username.'] is already registered.';
	}

	public function validateEmail($email){
		// please add security
		$sql = "SELECT email FROM users WHERE email = '$email'";
		$query = $this->con->query($sql);
		if($query->num_rows > 0)
			$this->error["registerFailed"] = '<strong>Oh no!</strong> Email ['.$email.'] is already registered.';
	}

	public function getError($index, $before, $after){
		if(!empty($this->error[$index]))
			return $before.$this->error[$index].$after;
	}

}