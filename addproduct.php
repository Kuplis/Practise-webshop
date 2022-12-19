<?php
require('functions.php');
require('headers.php');

if (isset($_POST['tea_name'])) {
  return;
}

$input = json_decode(file_get_contents('php://input'));
$tea_name = filter_var($input->tea_name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$cat_id = filter_var($input->cat_id, FILTER_SANITIZE_NUMBER_INT);
$price = filter_var($input->price, FILTER_SANITIZE_NUMBER_FLOAT);


try {
  $db = createSqliteConnection('teashop.db');
  $sql = "insert into product (tea_name, cat_id, price) values (?,?,?)";
  $statement = $db->prepare($sql);
  $statement->execute(array($tea_name,$cat_id, $price));

} catch (PDOException $pdoex) {
  returnError($pdoex);
}


