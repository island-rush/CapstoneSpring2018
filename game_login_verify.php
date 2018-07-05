<?php
/**
 * Created by PhpStorm.
 * User: C19Christopher.Darcy
 * Date: 4/11/2018
 * Time: 2:20 PM
 */

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

    $checkStmt->store_result();
    if(($checkStmt->errno <> 0) || ($checkStmt->num_rows == 0)){
        header("location:game_login.php?err=0");
    }
    $checkStmt->bind_result($result);
    $_SESSION['gameId'] = $result['gameId'];
    $_SESSION['team'] = $_POST['team'];

    //Changed this for testing session information on turn based mechanisms
//    header("location:play.php"); // play.php interprets gamedata and sends the team to the appropriate phase/game state.
    header("location:new_testing_page.php");



    // close and exit query and database
    $checkStmt->close();
    $db->close();


}else{
    header("location:game_login.php?err=2");
    exit;
}
