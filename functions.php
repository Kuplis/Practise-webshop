<?php
function createSqliteConnection($filename) {
  try{
    $dbcon = new PDO("sqlite:".$filename);
    return $dbcon;
  
  }catch(PDOException $e) {
    http_response_code('505');
    echo "Sivua ei löydy,";
    echo $e->getMessage();
  }
  return null;
}
// poista jos ei käyttöä
function selectAsJson(object $db,string $sql): void {
  $query = $db->query($sql);
  $results = $query->fetchAll(PDO::FETCH_ASSOC);
  //header('HTTP/1.1 200 OK');
  echo json_encode($results);
}

// poista jos ei käyttöä
function selectRowAsJson(object $db,string $sql): void {
  $query = $db->query($sql);
  $results = $query->fetch(PDO::FETCH_ASSOC);
  header('HTTP/1.1 200 OK');
  echo json_encode($results);
}

function executeInsert(object $db,string $sql): int {
  $query = $db->query($sql); 
  //$results = $query->fetch(PDO::FETCH_ASSOC); // ei alkuperäisessä
  return $db->lastInsertId();
  //echo json_encode($results); // ei alkuperäisessä
}

function returnError(PDOException $pdoex): void {
  header('HTTP/1.1 500 Internal Server Error');
  $error = array('error' => $pdoex->getMessage());
  echo json_encode($error);
  exit;
}