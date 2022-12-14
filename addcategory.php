<?php
require('./functions.php');
$db=createSqliteConnection('./teashop.db');

$body =file_get_contents('php://input');
$dataobject = json_decode($body);

$sql= "insert into category (cat_name) values (?)";
$statement = $db->prepare($sql);
$category = '';
$statement ->bindParam(1, $category);

foreach($dataobject as $name) {
  $category = $name;
  $statement ->execute();
}
/*
$category = $_POST['cat_name'];

$sql= "insert into category (cat_name) values (?)";

$statement =$db->prepare($sql);
$statement ->bindParam(1, $category);
$statement ->execute();
*/