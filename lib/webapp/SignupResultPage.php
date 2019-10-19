<?php

require_once __DIR__ . "/Page.php";

class SignupResultPage extends Page {

	public function __construct($config) {
		parent::__construct($config);
	}
	
	public function getTitle(): string {
		return "Sign Up Result";
	}
	
	public function renderBody(): string {
		return "<p>Signup was unsuccessful.</p>";
	}
	
	public function show() {
		if (empty($_SESSION)) session_start();
		$username = $_POST["username"];
		$password = $_POST["password"];
		$hash = password_hash($password, PASSWORD_DEFAULT);
		$sth = $this->dbh->prepare("INSERT INTO users SET username = :username, hash = :hash");
		if ($sth->execute(array(':username' => $username, ':hash' => $hash))) {
			$dest = trim($_POST["dest"]);
			if (empty($dest) || preg_match("/[\\n\\r]/", $dest)) {
				$dest = "signup-success.php";
			}
			header("Location: $dest");
		}
	}
	
}