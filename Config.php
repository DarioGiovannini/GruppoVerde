<?php
try{
    $db = new PDO("mysql:host=192.168.245.14;dbname=mediaworldgruppoverde", 'root', '', array(
        PDO::ATTR_PERSISTENT => true
    ));
    $perpage=2;
}
catch(PDOException $e){
    echo $e->getMessage(); 
}
