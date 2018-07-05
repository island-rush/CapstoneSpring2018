<?php

session_start();

// make sure parameters are received
if ( (isset($_POST['section'])) && (isset($_POST['instructor'])) && (isset($_POST['team'])) ){
    // open connection to the database on LOCALHOST with
    // userid of 'root', password of '', and database 'island_rush'

    include("db.php");
    // sanitize the input from the form to eliminate possible SQL Injection

    $section = stripslashes($_POST['section']);
    $section = $db->real_escape_string($section);

    $instructor = stripslashes($_POST['instructor']);
    $instructor = $db->real_escape_string($instructor);

    // prepared statement to check game

    $nameQuery = "SELECT * FROM GAMES WHERE gameInstructor = ? AND gameSection = ?";

    $checkStmt = $db->prepare($nameQuery);
    $checkStmt->bind_param("ss", $instructor,$section);
    $checkStmt->execute();
    $results = $checkStmt->get_result();
    $r= $results->fetch_assoc();
//    $checkStmt->store_result();
//    if(($checkStmt->errno <> 0) || ($checkStmt->num_rows == 0)){
//        header("location:game_login.php?err=0");
//    }
//    $checkStmt->bind_result($result);
    $_SESSION['gameId'] = $r['gameId'];
//    $_SESSION['gameId'] = 1;
    $_SESSION['team'] = $_POST['team'];

    //Changed this for testing session information on turn based mechanisms
    header("location:game_initialize.php");



    // close and exit query and database
    $checkStmt->close();
    $db->close();


}else{
    header("location:game_login.php?err=2");
    exit;
}
