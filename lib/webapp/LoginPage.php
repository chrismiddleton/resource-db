<?php

require_once __DIR__ . "/Page.php";

class LoginPage extends Page {

	public function getTitle(): string {
		return "Login";
	}
	
	public function init() {
		session_start();
		// don't require authorization like we normally do by default
	}
	
	public function renderBody(): string {
		return "<div>
			<h1>Login</h1>
			<form action='login-result.php' method='post'>
				<div><label>Username: <input type='text' name='username' /></label></div>
				<div><label>Password: <input type='password' name='password' /></label></div>
				<div><input type='submit' value='Log in' /></div>
			</form>
			<h1>Signup</h1>
			<form action='signup-result.php' method='post'>
				<div><label>Username: <input type='text' name='username' /></label></div>
				<div><label>Password: <input type='password' name='password' /></label></div>
				<div><input type='submit' value='Sign up' /></div>
			</form>
		</div>";
	}
	
}