<?php 
session_start();
$config=require 'config.php';

require 'classes/connection.php';
$db=Connection::connect($config['database']);
require 'classes/queryBilder.php';
require 'classes/user.php';

$query=new QueryBilder($db);
$user=new User($db);


?>