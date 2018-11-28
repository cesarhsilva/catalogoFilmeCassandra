<?php
/*
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'locadora');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$link->set_charset("utf8");

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
*/

$cluster  = Cassandra::cluster()
                ->build();
$keyspace  = 'catalogofilmes';
$session  = $cluster->connect($keyspace);

?>