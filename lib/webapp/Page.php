<?php

class Page {

	public function __construct($config) {
		$this->config = $config;
		$this->dbh = $this->getDbh();
	}
	
	public function authorize() {
		if (empty($_SESSION)) session_start();
		if (empty($_SESSION["username"])) {
			header("Location: " . $this->getLoginUrl());
		}
	}
	
	public function getDbh() {
		$dbConfig = $this->config["database"];
		$host = $dbConfig["host"];
		$name = $dbConfig["name"];
		$username = $dbConfig["username"];
		$password = $dbConfig["password"];
		$dbh = new PDO("mysql:host=$host;dbname=$name", $username, $password);
		return $dbh;
	}
	
	public function getLoginUrl() {
		return "login.php";
	}

	public function getTitle() {
		return "";
	}
	
	public function init() {
		$this->authorize();
	}

	public function renderBody() {
		return "";
	}

	public function render() {
		return "<!DOCTYPE html>
			<html>
			<head>
			<meta charset='utf-8' />
			<title>" .
			htmlspecialchars($this->getTitle()) .
			"</title>
			</head>
			<body>" .
			$this->renderBody() .
			"</body>
			</html>";
	}
	
	public function show() {
		$this->init();
		echo $this->render();
	}

}