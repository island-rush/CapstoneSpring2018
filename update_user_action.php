<?php
  // update_user_action.php - 3/24/2011 - Steve Hadfield
  // Modified by C2C Christopher Darcy, April 2018
  // performs the update of user info based on info form update_user.php 

  // check that a userId value was sent

  if ( !isset($_POST['existingUserId']) )
  {
    header("location:admin_home.php?updateUserError=1");
    exit;
  }

  // open connection to the database on LOCALHOST with 
  // userid of 'root', password 'secret', and database 'csl'

  include("db.php");

  // sanitize the input from the form to eliminate possible SQL Injection

  $newUsername = stripslashes($_POST['newUsername']);
  $newUsername = $db->real_escape_string($newUsername);

  $newPassword = stripslashes($_POST['newPassword']);
  $newPassword = $db->real_escape_string($newPassword);
  $userAdmin = 3;
  if(isset($_POST['newAdmin'])){
      $userAdmin = 1;
  }

  $newPassword = password_hash($newPassword, PASSWORD_BCRYPT);

  // update the selected user with a prepared statement

  $query = "UPDATE USERS SET userPassword=?, userAdmin=? WHERE userId = ?";

  $stmt = $db->prepare($query);

  $stmt->bind_param("sii",  $newPassword, $userAdmin, $_POST['existingUserId']);

  $stmt->execute();

  // check for errors

  if ($stmt->errno <> 0)
  {
    $stmt->close();
    $db->close();
    header("location:admin_home.php?updateUserError=2");
    exit;
  }

  // deallocate memory for the results and close the database connection

  $stmt->close();

  $db->close();

  // return to admin.php with successful notification

  header("location:admin_home.php?updateUserSuccess=1");

?>
