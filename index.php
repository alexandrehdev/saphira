<?php
require "vendor/autoload.php";
use Saphira\Connectdb\Actions\Action;

$actions = new Action();

$actions->setTable("User");
$response = $actions->selectAll();
var_dump($response);

