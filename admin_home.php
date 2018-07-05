<?php

// retrieve session information
session_start();

// if no username set, then redirect to login
if(!isset($_SESSION['username'])){
    header("location:admin_login.php");
    exit;
}
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>Welcome, Admin!</title>
    <link rel="stylesheet" type="text/css" href="style_welcome.css">
</head>
<!-- ************************** Begin HTML Body ************************************ -->

<body id="full">
    <table border="0" width="100%">
                    <!-- ************************** Create User Form ************************************ -->
        <h1>Admin Homepage</h1>
        <p>This will give options to edit games belonging to teachers...blueleaders, states, other stuff...reset games?</p>
        <div id="welcome"><br />
        <em>Welcome,
            <?php echo $_SESSION['username'].'.<br/>'; ?></em></div>
        <tbody>
                    <!-- ************************** Logout Form ************************************ -->
                    <hr>
                    <div class="spacer">
                        <form name="logout_form" method="post" id="logout_form" action="logout.php">
                            <input type="Submit" name="Submit" value="Logout">
                        </form>
                    </div>
        </tbody>
    </table>
</body>
</html>
</html>