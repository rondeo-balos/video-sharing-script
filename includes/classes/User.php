<?php

class User {
	private $con, $data;

	public function __construct($con, $username){
		$this->con = $con;
		// please add security
		$sql = "SELECT * FROM users WHERE username = '$username'";
		$query = $this->con->query($sql);
		$this->data = $query->fetch_assoc();
	}

	public function isLoggedIn(){
		return isset($_SESSION["userLoggedIn"]);
	}

}

class Account {
	private $con;
	private $error = array();

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
		else
			return false;
	}

	public function register($username, $password, $firstname, $lastname, $email){
		$this->validateUsername($username);
		$this->validateEmail($email);

		if(empty($this->error))
			return insertUser($username, $password, $firstname, $lastname, $email);
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
			array_push($error, "Username [$username] is already registered.");
	}

	public function validateEmail($email){
		// please add security
		$sql = "SELECT email FROM users WHERE email = '$email'";
		$query = $this->con->query($sql);
		if($query->num_rows > 0)
			array_push($error, "Email [$email] is already registered.");
	}
	
}