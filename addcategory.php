<?php
require('functions.php');
require('headers.php');

if (isset($_POST['cat_name'])) { //meneeköhän näin??
  return;
}
$input = json_decode(file_get_contents('php://input'));
$cat_name = filter_var($input->cat_name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);


//$cat_name = $_POST['cat_name'];

try {
  $db = createSqliteConnection('teashop.db');
  $sql = "insert into category (cat_name) values (?)";
  $statement = $db->prepare($sql);
  $statement ->execute(array($cat_name));
  
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
