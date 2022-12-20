<?php
require('functions.php');
require('headers.php');

$uri = parse_url(filter_input(INPUT_SERVER,'PATH_INFO'),PHP_URL_PATH);
// Parametrit erotetaan /
$parameters = explode('/',$uri);
$phrase = $parameters[1];

try {
    $db = createSqliteConnection('teashop.db');
    $sql = "select * from product where cat_id like '%$phrase%' or tea_name like '%$phrase%'";
    selectAsJson($db,$sql);
}
catch (PDOException $pdoex) {
    returnError($pdoex);
}