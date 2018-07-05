<!-- login.php handles admin login before game   -->
<!-- Created by Jack Kulp and Chris Darcy, April 2018   -->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <title>Admin Login</title>
        <link rel="stylesheet" type="text/css" href="style_welcome.css">
        <script type="text/javascript">
                function checkLoginForm(){
                    // add verifications
                    var userName = document.forms["login"]["username"].value;
                    var passEnter = document.forms["login"]["password"].value;

                    if(userName === "" || passEnter === ""){
                        document.getElementById('formFeedback').innerHTML = "ERROR: User Name and/or password must be specified.";
                        return false;
                    }
                    return true;
                }
        </script>
    </head>
    <!-- ************************ Begin the HTML Body ************************** -->
    <body>
    <h1>Island Rush Admin</h1>
    <nav>
        <a href="./home.php">Home</a>
        <a href="./game_login.php">Play the Game</a>
        <a style="float:right" class="active" href="./admin_login.php">Admin</a>
    </nav>
    <!-- ***************************** Begin the actual login form ***************************** -->
    <div class="spacer">
        <table border="0" width="100%">
            <tbody>
            <tr>
                <td colspan="4">
                    <br />
                    <div id="login_header">Login to Admin:</div>
                    <form name="login" method="post" id="login" action="verifylogin.php" onsubmit="return checkLoginForm()">
                        <table border="0" cellpadding="3" cellspacing="1">
                            <tr>
                                <td colspan="2">
                                    <div id="formFeedback" class="formError">
                                        <?php
                                        if (isset($_GET['err'])) {echo 'ERROR: Username - password not valid.'; }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td><input name="username" type="text" id="username"></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td><input name="password" type="password" id="password"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><br/><input type="submit" name="Submit" value="Login"></td>
                            </tr>
                        </table>
                    </form>
                </td>
            </tr>
            </tbody>
        </table>
        <p>Login with u: admin p: password</p>
    </div> <!-- end of spacer -->
    </body>
</html>


