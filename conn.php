<?php
try{
  $sDatabaseUserName = 'root';
  $sDatabasePassword = '';
  $sDatabaseConnection = "mysql:host=localhost; dbname=web-sec; charset=utf8mb4";

  $aDatabaseOptions = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NUM
  );
  $db = new PDO( $sDatabaseConnection, $sDatabaseUserName, $sDatabasePassword, $aDatabaseOptions );
}catch( PDOException $e){
  var_dump($e);
  http_response_code(500);
  exit();
}
