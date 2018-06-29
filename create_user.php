<?php
  // create_user.php - 3/24/2011 - Steve Hadfield
  // Modified by C2C Christopher Darcy, April 2018
  // Shows how to create a new user with encrypted password 

  // check for newUsername and newPassword

  if ( !isset($_POST['newUsername']) || !isset($_POST['newPassword']) )
    header("location:admin.php?newUserError=1");

  // open connection to the database on LOCALHOST with 
  // userid of 'root', password 'secret', and database 'csl'

  @ $db = new mysqli('LOCALHOST', 'root', '', 'island_rush');

  // Check if there were error and if so, report and exit

  if (mysqli_connect_errno()) 
  { 
    echo 'ERROR: Could not connect to database, error is '.mysqli_connect_error();
    exit;
  }

  // sanitize the input from the form to eliminate possible SQL Injection

  $newUsername = stripslashes($_POST['newUsername']);
  $newUsername = $db->real_escape_string($newUsername);

  $newPassword = stripslashes($_POST['newPassword']);
  $newPassword = $db->real_escape_string($newPassword);
  $userAdmin = 3;
  if(isset($_POST['adminPrivilege'])){
      $userAdmin = 1;
  }

  // encrypt the password

  $newPassword = password_hash($newPassword, PASSWORD_BCRYPT);

  // check that new username does not already exist

  $checkQuery = "SELECT * FROM USERS WHERE userName = ?";

  $checkStmt = $db->prepare($checkQuery);

  $checkStmt->bind_param("s", $newUsername);

  $checkStmt->execute();

  $checkStmt->store_result();

  // check for SQL errors and existing users with the username

  if ( ($checkStmt->errno <> 0) || ($checkStmt->num_rows > 0) )
  {
    $checkStmt->close();
    header("location:admin_home.php?newUserError=2");
    exit;
  }

  $checkStmt->close();

  // set up a prepared statement to insert the new user info

  $query = "INSERT INTO USERS (userName, userPassword, userAdmin) VALUES ( ?, ? , ?)";

  $stmt = $db->prepare($query);

  $stmt->bind_param("ssi", $newUsername, $newPassword, $userAdmin);

  $stmt->execute();

  if ($stmt->errno <> 0)
  {
    $stmt->close();
    $db->close();
    header("location:admin_home.php?newUserError=3");
    exit;
  }

  // all was good, do housekeeping

  $stmt->close();

  $db->close();

  // return to admin.php with success notification

  header("location:admin_home.php?newUserSuccess=1");

?>
