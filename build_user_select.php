<?php
  include("db.php");
  $results = $db->query('SELECT adminId, adminName FROM admins ORDER BY adminName');
  $num_results = $results->num_rows;
  for ($i=0; $i < $num_results; $i++) 
  {
    $r= $results->fetch_assoc();
    echo '<option value="'.$r['adminId'].'">'.$r['adminName'].'</option>';
  }
  $results->free();
  $db->close();