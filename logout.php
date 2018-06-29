<?php
  
  // logout.php - Steve Hadfield - 3/24/2011
  // Modified by C2C Christopher Darcy, April 2018
  // destroys the current session and redirects back to login.php

  session_start();
  session_destroy();

  header("location:home.html");

?>