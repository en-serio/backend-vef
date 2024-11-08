<?php

require_once './database.php';

$data_base = new Database();

echo "Executing query\n";
$data_base->execute(
  "INSERT INTO `transfer_vehiculo` (`Descripción`, `email_conductor`, `password` ) VALUES (:description, :email, :password)",
  array(
    'description' => "Este es nuestro primer vehiculo",
    'email' => "pino@pinoweb.com",
    'password' => "olahehe"
  )
  );
echo "Query executed\n";

$data_base->closeConnection();