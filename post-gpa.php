<?php

require 'gpaPageController.php';
$controller = new gpaPageController($_POST);

header("location: " . $controller->getRedirect());