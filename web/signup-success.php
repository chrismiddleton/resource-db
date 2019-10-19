<?php

require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../lib/webapp/SignupSuccessPage.php";

$page = new SignupSuccessPage($config);
$page->show();