<?php

use CIME\Filters\SessionFilter;
use CIME\Models\Usuario;

$user = SessionFilter::getUserBySession();

$params = [];
$httpMethod = null;
$restriction = $user instanceof Usuario;
parse_str(file_get_contents("php://input"),$params);