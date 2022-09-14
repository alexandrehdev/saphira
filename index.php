<?php
    require "vendor/autoload.php";
    use Saphira\Connectdb\Actions\DataActions;

    $dataActions = new DataActions(__DIR__);

    $dataActions->setDatabase("imfree");
    $dataActions->setTable("User");
    $response = $dataActions->selectAll();

    var_dump($response);
