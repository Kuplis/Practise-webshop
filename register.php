<?php
require('headers.php');
session_start();
require('user_functions.php');

$body = file_get_contents('php://input');
$user = json_decode($body);

$uname =$user->uname;
$passwd = $user ->passwd;

if(!isset($uname) || !isset($passwd)){
  http_response_code(400);
  echo "Käyttäjää ei löytynyt.";
  return;
}

registerUser($uname, $passwd);

$_SESSION['username'] = $uname;

http_response_code(200);
echo "Käyttäjä " .$uname. " rekisteröity.";
