<?php
try{
    $db = new PDO("mysql:host=localhost;dbname=prodotti", 'root', '', array(
        PDO::ATTR_PERSISTENT => true
    ));
}
catch(PDOException $e){
    echo $e->getMessage(); 
}
