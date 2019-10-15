<?php

require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../lib/webapp/LoginPage.php";

$page = new LoginPage($config);
$page->show();