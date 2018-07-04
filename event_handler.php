<?php

//$q = $_REQUEST["question"];
//$a = $_REQUEST["answer"];
$b = $_REQUEST["button"];

@ $db = new mysqli('LOCALHOST', 'root', '', 'island_rush');
if (mysqli_connect_errno()) {
    echo 'ERROR: Could not connect to database.  Error is '.mysqli_connect_error();
    exit;
}

if ($b == "green") {
    $query = 'UPDATE test_table SET testValue="red" WHERE testId = 1';
    $query = $db->prepare($query);
    $query->execute();
} else {
    $query = 'UPDATE test_table SET testValue="green" WHERE testId = 1';
    $query = $db->prepare($query);
    $query->execute();
}
$query = 'SELECT * FROM test_table';
$query = $db->prepare($query);
$query->execute();
$results = $query->get_result();
$r= $results->fetch_assoc();
echo $r['testValue'];

$results->free();
$db->close();

//echo "test";

//Whatever is echo'd is like the return from a function
//echo $q." is equal to ".$a;
//echo "BRO, YOU FIGURED OUT AJAX";
//echo $b.".";