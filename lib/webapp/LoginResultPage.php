<?php

require_once __DIR__ . "/Page.php";

class LoginResultPage extends Page {

	public function __construct($config) {
		parent::__construct($config);
	}

	public function attemptLogin($user, $pass) {
		$sth = $this->dbh->query("SELECT hash FROM users WHERE username = :username");
		$sth->execute(array(':username' => $username));
		$row = $sth->fetch();
		$hash = $row["hash"];
		if (password_verify($password, $hash)) {
			$_SESSION["user"] = $user;
			return true;
		} else {
			return false;
		}
	}
	
	public function getTitle() {
		return "Login Result";
	}
	
	public function renderBody() {
		// TODO: instead, go back to the login page
		echo "<p>Login was unsuccessful.</p>";
	}
	
	public function show() {
		if (!isset($_SESSION)) session_start();
		$user = $_POST["user"];
		$pass = $_POST["pass"];
		if ($this->attemptLogin($this->dbh, $user, $pass)) {
			$dest = $_POST["dest"];
			if (preg_match("/[\\n\\r]/", $dest)) {
				$dest = "";
			}
			header("Location: $dest");
		}
	}
	
}
		
		

require_once __DIR__ . "/config.php";
require_once __DIR__ . "/lib/account/attemptLogin.php";

$user = $_POST["user"];
$pass = $_POST["pass"];

$dbh = getDbh($config);

$app->attemptLogin($dbh, $user, $pass);
	}
	
}