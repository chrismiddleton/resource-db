<?php

require_once __DIR__ . "/Page.php";

class LoginResultPage extends Page {

	public function __construct($config) {
		parent::__construct($config);
	}

	public function attemptLogin(string $username, string $password): boolean {
		$sth = $this->dbh->prepare("SELECT hash FROM users WHERE username = :username");
		$sth->execute(array(':username' => $username));
		$row = $sth->fetch();
		$hash = $row["hash"];
		if (password_verify($password, $hash)) {
			$_SESSION["username"] = $username;
			return true;
		} else {
			return false;
		}
	}
	
	public function getTitle(): string {
		return "Login Result";
	}
	
	public function renderBody(): string {
		// TODO: instead, go back to the login page
		return "<p>Login was unsuccessful.</p>";
	}
	
	public function show() {
		if (empty($_SESSION)) session_start();
		$username = $_POST["username"];
		$password = $_POST["password"];
		if ($this->attemptLogin($username, $password)) {
			$dest = trim($_POST["dest"]);
			if (empty($dest) || preg_match("/[\\n\\r]/", $dest)) {
				$dest = "index.php";
			}
			header("Location: $dest");
		}
	}
	
}
