<?php
require('functions.php');
require('headers.php');

try {
  $db = createSqliteConnection('teashop.db');
  selectAsJson($db,'select * from category');
}
catch (PDOException $pdoex) {
  returnError($pdoex);
}