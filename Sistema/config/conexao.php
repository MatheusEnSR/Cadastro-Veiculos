<?php 

$host = "localhost";
$user = "root";
$pass = "";
$db = "concessionaria";

$con = new mysqli($host, $user, $pass, $db);

if ($con->connect_error){
    die("Erro de conexão: " .$con->connect_error);
}