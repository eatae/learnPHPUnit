<?php

use App\Models\User;

require "vendor/autoload.php";

echo 'Hello';

$user = new User('TestName', 'test@email.com', '1234', 23);

var_dump($user);
