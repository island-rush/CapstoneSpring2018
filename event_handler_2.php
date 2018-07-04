<?php

@ $db = new mysqli('LOCALHOST', 'root', '', 'island_rush');
if (mysqli_connect_errno()) {
    echo 'ERROR: Could not connect to database.  Error is '.mysqli_connect_error();
    exit;
}

$query = 'SELECT * FROM test_table WHERE testId = 2';
$query = $db->prepare($query);
$query->execute();
$results = $query->get_result();
$r= $results->fetch_assoc();
$update_value = $r['testValue'];
if ($update_value == "no_update") {
    echo "do not update";
} else {
    echo "update";
}

$results->free();
$db->close();
