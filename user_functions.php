<?php
require('functions.php');

function registerUser($uname, $passwd) {

  try {
    $db = createSqliteConnection('teashop.db');
    $passwd = password_hash($passwd, PASSWORD_DEFAULT);

    $sql = "insert into user (username, password) values (?,?)";
    $statement = $db->prepare($sql);
    $statement->execute(array($uname, $passwd));

  } catch (PDOException $pdoex) {
    returnError($pdoex);
  }
}

function checkUser($uname, $passwd){

  try {
    $db = createSqliteConnection('teashop.db');

    $sql= "select password from user where username=?";
    $statement = $db->prepare($sql);
    $statement->execute(array($uname));

    $hashed_password = $statement-> fetchColumn();

    if (isset($hashed_password)){    
      return password_verify($passwd, $hashed_password) ? $uname : null;
    }
    return null;

  }catch (PDOException $pdoex) {
      returnError($pdoex);
  }
}