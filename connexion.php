<?php

try{
$pdo=new PDO("mysql:host=localhost;dbname=managementincident","root"); 

} 
catch(PDOException $e){ 
echo $e->getMessage(); 
}


?>