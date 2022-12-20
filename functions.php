<?php
function createSqliteConnection($filename) {
  try{
    $dbcon = new PDO("sqlite:".$filename);
    return $dbcon;
  
  }catch(PDOException $e) {
    http_response_code(505);
    echo "Sivua ei löydy,";
    echo $e->getMessage();
  }
  return null;
}

function selectAsJson(object $db,string $sql): void {
  $query = $db->query($sql);
  $results = $query->fetchAll(PDO::FETCH_ASSOC);
  header('HTTP/1.1 200 OK');
  echo json_encode($results);
}

function executeInsert(object $db,string $sql): int {
  $query = $db->query($sql); 
  return $db->lastInsertId();
}

function returnError(PDOException $pdoex): void {
  header('HTTP/1.1 500 Internal Server Error');
  $error = array('error' => $pdoex->getMessage());
  echo json_encode($error);
  exit;
}