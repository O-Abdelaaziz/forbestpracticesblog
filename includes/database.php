<?php

    $dsn="mysql:host=localhost;dbname=forbestpracticesblog";

    try {
        $pdo=new PDO($dsn,'root','');
    }catch (PDOException $pdoE){
        echo $pdoE->getMessage();
    }

?>