<?php
function createSqliteConnection() {
  try{
    $dbcon = new PDO("sqlite:teashop.db");
    return $dbcon;
  
  }catch(PDOException $e) {
    echo $e->getMessage();
  }
  return null;
}