<?php
  // build_user_select.php - 3/24/2011 - Steve Hadfield 
  // build a HTML select of current users 

  // open connection to the database on LOCALHOST with 
  // userid of 'root', password 'secret', and database 'csl'

  include("db.php");

  // run the SQL query to retrieve the user info

  $results = $db->query('SELECT userId, userName FROM USERS ORDER BY userName');

  // determine how many rows were returned

  $num_results = $results->num_rows;

  // loop through each row

  for ($i=0; $i < $num_results; $i++) 
  {
    $r= $results->fetch_assoc();
    print '<option value="'.$r['userId'].'">'.$r['userName'].'</option>';
  }

  // deallocate memory for the results and close the database connection

  $results->free();

  $db->close();

?>
