<!--Connects to the database-->
<?php
@ $db = new mysqli('LOCALHOST', 'root', '', 'island_rush');
if (mysqli_connect_errno()) {
    echo 'ERROR: Could not connect to database.  Error is '.mysqli_connect_error();
    exit;
}