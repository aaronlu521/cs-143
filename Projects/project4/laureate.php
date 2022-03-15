<?php
header('Content-Type: application/json');

// get the id parameter from the request
//$mng = new MongoDB\Driver\Manager("http://localhost:8889"); //web server
$mng = new MongoDB\Driver\Manager("mongodb://localhost:27017"); //protocal mongodb
$id = intval($_GET['id']);
$filter = ['id' => strval($id)];
$options = ["projection" => ['_id' => 0]];
$query = new MongoDB\Driver\Query($filter, $options); 
$rows = $mng->executeQuery("nobel.laureates", $query);
foreach ($rows as $row) {
        echo json_encode($row);
}

?>