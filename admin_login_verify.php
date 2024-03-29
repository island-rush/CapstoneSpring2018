<?php

session_start();

// make sure username and password received
if ( (isset($_POST['username'])) && (isset($_POST['password'])) ){
    // open connection to the database on LOCALHOST with
    // userid of 'root', password of '', and database 'island_rush'

    include("db.php");
    // sanitize the input from the form to eliminate possible SQL Injection

    $myusername = stripslashes($_POST['username']);
    $myusername = $db->real_escape_string($myusername);

    $mypassword = stripslashes($_POST['password']);
    $mypassword = $db->real_escape_string($mypassword);

    // encrypt the password with PHP core hash
    // I used this resource to get this functionality: http://php.net/manual/en/function.password-hash.php

    $secure_pass = password_hash($mypassword, PASSWORD_BCRYPT);

    // prepared statement to check username

    $nameQuery = "SELECT * FROM admins WHERE (adminName = ?)";

    $checkStmt = $db->prepare($nameQuery);
    $checkStmt->bind_param("s", $myusername);
    $checkStmt->execute();

    // This resource helped the following lines of code
    // https://websitebeaver.com/prepared-statements-in-php-mysqli-to-prevent-sql-injection

    $result = $checkStmt->get_result();
    if($result->num_rows == 0){
        header("location:login.php?err=0");
    }
    $result = $result->fetch_assoc();

    if (password_verify($mypassword, $result['adminPassword'])){
        $_SESSION['username'] = $_POST['username'];
        header("location:admin_home.php");

    }else{
        $checkStmt->close();
        header("location:admin_login.php?err=1");
    }
    $checkStmt->close();
    $db->close();


}else{
    header("location:admin_login.php?err=2");
    exit;
}