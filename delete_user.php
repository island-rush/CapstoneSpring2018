<?php
  // delete_user.php - 3/24/2011 - Steve Hadfield
  // Modified by C2C Christopher Darcy, April 2018
  // delete a selected user 

  // check that a userId value was sent

  if ( !isset($_POST['user']) )
  {
    header("location:admin_home.php?deleteUserError=1");
    exit;
  }
  //do not allow user to delete itself
  if($_POST['user'] === $_SESSION['username']){
      header("location:admin_home.php?deleteUserError=1");
      exit;
  }

  // open connection to the database on LOCALHOST with

  @ $db = new mysqli('LOCALHOST', 'root', '', 'island_rush');

  // Check if there were error and if so, report and exit

  if (mysqli_connect_errno()) 
  { 
    echo 'ERROR: Could not connect to database, error is '.mysqli_connect_error();
    exit;
  }

  // delete the selected user with a prepared statement

  $query = "DELETE FROM USERS WHERE userId = ?";

  $stmt = $db->prepare($query);

  $stmt->bind_param("s", $_POST['user']);

  $stmt->execute();

  // check for errors

  if ($stmt->errno <> 0)
  {
    $stmt->close();
    $db->close();
    header("location:admin_home.php?deleteUserError=2");
    exit;
  }

  // deallocate memory for the results and close the database connection

  $stmt->close();

  $db->close();

  // return to admin.php successfully

  header("location:admin_home.php?deleteUserSuccess=1");

?>
