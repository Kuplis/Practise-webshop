<?php
require('functions.php');
require('headers.php');

$uri = parse_url(filter_input(INPUT_SERVER,'PATH_INFO'),PHP_URL_PATH);
$parameters = explode('/',$uri);
$cat_id = $parameters[1];

try {
  $db = createSqliteConnection('teashop.db');
  $sql = "select * from category where cat_id = $cat_id";
  $query = $db->query($sql);
  $category = $query->fetch(PDO::FETCH_ASSOC);

  $sql = "select * from product where cat_id = $cat_id";
  $query = $db->query($sql);
  $products = $query->fetchAll(PDO::FETCH_ASSOC);

  header('HTTP/1.1 200 OK');
  echo json_encode(array(
    "category" => $category['cat_name'],
    "products" => $products
  ));
}
catch (PDOException $pdoex) {
  returnError($pdoex);
}