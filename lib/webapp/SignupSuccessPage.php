<?php

require_once __DIR__ . "/Page.php";

class SignupSuccessPage extends Page {

	public function __construct($config) {
		parent::__construct($config);
	}
	
	public function getTitle(): string {
		return "Signup Success";
	}
	
	public function renderBody(): string {
		return "<div>
			<p>Signup was successful. Please login.</p>
			<form action='login-result.php' method='post'>
				<div><label>Username: <input type='text' name='username' /></label></div>
				<div><label>Password: <input type='password' name='password' /></label></div>
				<div><input type='submit' value='Log in' /></div>
			</form>
		</div>";
	}
	
	public function show() {
		if (empty($_SESSION)) session_start();
		$username = $_POST["username"];
		$password = $_POST["password"];
		$hash = password_hash($password, PASSWORD_DEFAULT);
		$sth = $this->dbh->prepare("INSERT INTO users SET username = :username, hash = :hash");
		if ($sth->execute(array(':username' => $username, ':hash' => $hash))) {
			$dest = $_POST["dest"];
			if (empty($dest) || preg_match("/[\\n\\r]/", $dest)) {
				$dest = "signup-success.php";
			}
			header("Location: $dest");
		}
	}
	
}