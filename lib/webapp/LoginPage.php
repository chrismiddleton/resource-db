<?php

require_once __DIR__ . "/Page.php";

class LoginPage extends Page {

	public function getTitle() {
		return "Login";
	}
	
	public function init() {
		session_start();
		// don't require authorization like we normally do by default
	}
	
	public function renderBody() {
		return "<form action='login-result' method='post'>
			<label>Username: <input type='text' name='user' /></label>
			<label>Password: <input type='password' name='pass' /></label>
		</form>";
	}
	
}