<?php

require_once __DIR__ . "/../config.php";

$queries = array(
	"CREATE DATABASE IF NOT EXISTS resource_db",
	"USE resource_db",
	"CREATE TABLE IF NOT EXISTS topics (
		id INT NOT NULL AUTO_INCREMENT,
		name VARCHAR(100) NOT NULL,
		PRIMARY KEY (id),
		UNIQUE KEY (name)
	)",
	"CREATE TABLE IF NOT EXISTS resources (
		id INT NOT NULL AUTO_INCREMENT,
		title VARCHAR(50) NULL,
		source VARCHAR(150) NULL,
		started DATE NULL,
		finished DATE NULL,
		topic_id INT NULL,
		published DATE,
		free VARCHAR(50) NULL,
		own VARCHAR(50) NULL,
		format VARCHAR(50) NULL,
		progress VARCHAR(100) NULL,
		notes VARCHAR(150) NULL,
		PRIMARY KEY (id),
		KEY (source),
		KEY (title)
	)",
	"CREATE TABLE IF NOT EXISTS authors (
		id INT NOT NULL AUTO_INCREMENT,
		name VARCHAR(150) NOT NULL,
		PRIMARY KEY (id)
	)",
	"CREATE TABLE IF NOT EXISTS resource_authors (
		id INT NOT NULL AUTO_INCREMENT,
		resource_id INT NOT NULL,
		author_id INT NOT NULL,
		PRIMARY KEY (id),
		UNIQUE KEY (resource_id, author_id)
	)",
	"CREATE TABLE IF NOT EXISTS resource_topics (
		id INT NOT NULL AUTO_INCREMENT,
		resource_id INT NOT NULL,
		topic_id INT NOT NULL,
		PRIMARY KEY (id),
		UNIQUE KEY (resource_id, topic_id)
	)",
	"CREATE TABLE IF NOT EXISTS users (
		id INT NOT NULL AUTO_INCREMENT,
		username VARCHAR(100) NOT NULL,
		hash VARCHAR(150) NOT NULL,
		PRIMARY KEY (id)
	)",
	"CREATE TABLE IF NOT EXISTS resource_progress (
		id INT NOT NULL AUTO_INCREMENT,
		user_id INT NOT NULL,
		resource_id INT NOT NULL,
		progress_date DATE NULL,
		started TINYINT NULL,
		finished TINYINT NULL,
		progress VARCHAR(50) NULL,
		PRIMARY KEY (id),
		KEY user_resource (user_id, resource_id)
	)"
);

$dbConfig = $config["database"];
$host = $dbConfig["host"];
$name = $dbConfig["name"];
$user = $dbConfig["user"];
$pass = $dbConfig["pass"];
$dbh = new PDO("mysql:host=$host", $user, $pass);
foreach ($queries as $query) {
	$dbh->execute($query);
}
