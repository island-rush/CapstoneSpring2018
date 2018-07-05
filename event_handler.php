<?php

//$q = $_REQUEST["question"];
//$a = $_REQUEST["answer"];
//$c = $_REQUEST["button"];

include("db.php");


$query = 'SELECT * FROM test_table WHERE testId = 2';
$query = $db->prepare($query);
$query->execute();
$results = $query->get_result();
$r= $results->fetch_assoc();
$b = $r['testValue'];

if ($b == "no_update") {
    $query = 'UPDATE test_table SET testValue="yes_update" WHERE testId = 2';
    $query = $db->prepare($query);
    $query->execute();

    $query = 'SELECT * FROM test_table WHERE testId = 1';
    $query = $db->prepare($query);
    $query->execute();
    $results = $query->get_result();
    $r= $results->fetch_assoc();
    $n = $r['testValue'];
    if ($n == "yes") {
        $query = 'UPDATE test_table SET testValue="no" WHERE testId = 1';
        $query = $db->prepare($query);
        $query->execute();
        echo "no";
    } else {
        $query = 'UPDATE test_table SET testValue="yes" WHERE testId = 1';
        $query = $db->prepare($query);
        $query->execute();
        echo "yes";
    }
} else {
    $query = 'UPDATE test_table SET testValue="no_update" WHERE testId = 2';
    $query = $db->prepare($query);
    $query->execute();

    $query = 'SELECT * FROM test_table WHERE testId = 1';
    $query = $db->prepare($query);
    $query->execute();
    $results = $query->get_result();
    $r= $results->fetch_assoc();
    $n = $r['testValue'];
    echo $n;
}




//
//
//
//$query = 'SELECT * FROM test_table WHERE testId = 1';
//$query = $db->prepare($query);
//$query->execute();
//$results = $query->get_result();
//$r= $results->fetch_assoc();
//$b = $r['testValue'];
//
//$query = 'UPDATE test_table SET testValue="no_update" WHERE testId = 2';
//$query = $db->prepare($query);
//$query->execute();
//
//if ($b == "yes") {
//    $query = 'UPDATE test_table SET testValue="no" WHERE testId = 1';
//    $query = $db->prepare($query);
//    $query->execute();
//    echo "no";
////    $query = 'UPDATE test_table SET testValue="no_update" WHERE testId = 2';
////    $query = $db->prepare($query);
////    $query->execute();
//} else {
//    $query = 'UPDATE test_table SET testValue="yes" WHERE testId = 1';
//    $query = $db->prepare($query);
//    $query->execute();
//    echo "yes";
////    $query = 'UPDATE test_table SET testValue="no_update" WHERE testId = 2';
////    $query = $db->prepare($query);
////    $query->execute();
//}

$results->free();
$db->close();

//echo "test";

//Whatever is echo'd is like the return from a function
//echo $q." is equal to ".$a;
//echo "BRO, YOU FIGURED OUT AJAX";
//echo $b.".";