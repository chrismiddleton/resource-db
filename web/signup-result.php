<?php

require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../lib/webapp/SignupResultPage.php";

$page = new SignupResultPage($config);
$page->show();