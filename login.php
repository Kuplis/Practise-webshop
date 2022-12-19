<?php
require('headers.php');
session_start();
require('user_functions.php');

if(isset($_SESSION['username'])) {
  http_response_code(200);
  echo $_SESSION['username'];
  return;
}

if(!isset($_POST['uname']) || (!isset($_POST['passwd']))) {
  http_response_code(401);
  echo "Käyttäjää ei löytynyt.";
  return;
}

$uname = $_POST['uname'];
$passwd = $_POST['passwd'];

$verified_username = checkUser($uname, $passwd);

if($verified_username) {
  $_SESSION['username'] = $verified_username;
  http_response_code(200);
  echo $verified_username;
}else {
  http_response_code(401);
  echo "Väärä käyttäjä tai salasana.";
}