<?php

require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../lib/webapp/LoginResultPage.php";

$page = new LoginResultPage($config);
$page->show();