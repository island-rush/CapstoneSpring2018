<!--admin_login.php handles user login before game   -->
<!-- Created by Jack Kulp and Chris Darcy, April 2018   -->
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
    <script type="text/javascript">
        function checkNewUserForm(){
            const nameRegex = /^[\w_\-]{1,50}$/;
            const passRegex = /^[\w!@#$%^&*<>?+=\-\\]{5,50}$/;
            var newUserName = document.forms["new_user_form"]["newUsername"].value;
            var pass1 = document.forms["new_user_form"]["newPassword"].value;
            var pass2 = document.forms["new_user_form"]["newPasswordRepeat"].value;

            if(newUserName === ""){
                document.getElementById("newUserFormFeedback").innerHTML = "ERROR: New User must have a username";
                return false;
            }

            if(nameRegex.test(newUserName) === false){
                document.getElementById("newUserFormFeedback").innerHTML = "ERROR: Username must be alphanumeric " +
                    "(- and _ allowed) and less than 50 characters";
                return false;
            }

            if(pass1 === "" || pass2 === ""){
                document.getElementById("newUserFormFeedback").innerHTML = "ERROR: New User must have a password";
                return false;
            }

            if(pass1 !== pass2){
                document.getElementById("newUserFormFeedback").innerHTML = "ERROR: Passwords do not match";
                return false;
            }

            if(passRegex.test(pass1) === false){
                document.getElementById("newUserFormFeedback").innerHTML = "ERROR: Password must be between 5 and" +
                    "50 characters long and may only contain alphanumeric and !@#$%^&*-_+=<>?/\\ characters";
                return false;
            }
            return true;
        }
    </script>
</head>
<!-- ************************** Begin HTML Body ************************************ -->

<body id="full">
    <table border="0" width="100%">
                    <!-- ************************** Create User Form ************************************ -->
        <h1>Admin Homepage</h1>
        <div id="welcome"><br />
        <em>Welcome,
            <?php echo $_SESSION['username'].'.<br/>'; ?></em></div>
        <tbody>
                <hr>
                    <div class="spacer">
                        <form name="new_user_form" method="post" id="new_user_form" action="create_user.php" onsubmit="return checkNewUserForm()">
                            <table border="0" cellpadding="3" cellspacing="1">
                                <th colspan="3">Create User</th>
                                <tr>
                                    <td colspan="2">
                                        <div id="newUserFormFeedback" class="formError">
                                            <?php
                                            if (isset($_GET['newUserError']))
                                            {echo 'ERROR: New user not created.'; }
                                            if (isset($_GET['newUserSuccess']))
                                            {echo '<font color="green">New user was created.</font>'; }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td><input name="newUsername" type="text" id="newUsername"></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td><input name="newPassword" type="password" id="newPassword"></td>
                                </tr>
                                <tr>
                                    <td>Repeat Password</td>
                                    <td><input name="newPasswordRepeat" type="password" id="newPasswordRepeat"></td>
                                </tr>
                                <tr>
                                    <td>Admin?</td>
                                    <td><input name="adminPrivilege" type="checkbox" value="1" id="adminPrivilege">This user is Admin</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><br/>
                                        <center><input type="submit" name="Submit" value="Create User"></center>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>

                    <!-- ************************** Update User Form ************************************ -->

                    <hr>
                    <div class="spacer">
                        <form name="update_user_form" method="post" id="update_user_form"
                              action="update_user.php" onsubmit="return verifyUpdate()">
                            <table border="0" cellpadding="3" cellspacing="1">
                                <tr>
                                    <td colspan="3">
                                        <center>
                                            <div id="updateUserFormFeedback" class="formError">
                                                <?php
                                                if (isset($_GET['updateUserError']))
                                                {echo 'ERROR: User could not be updated.'; }
                                                if (isset($_GET['updateUserSuccess']))
                                                {echo '<font color="green">Selected user was updated.</font>'; }
                                                ?>
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Select User: </td>
                                    <td>
                                        <select name="user">
                                            <?php include('build_user_select.php'); ?>
                                        </select>
                                    </td>
                                    <td>
                                        <center><input type="submit" name="Submit" value="Update User"></center>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>


                    <!-- ************************** Delete User Form ************************************ -->

                    <hr>
                    <div class="spacer">
                        <form name="delete_user_form" method="post" id="delete_user_form"
                              action="delete_user.php" onsubmit="return verifyDelete()">
                            <table border="0" cellpadding="3" cellspacing="1">
                                <tr>
                                    <td colspan="3">
                                        <center>
                                            <div id="deleteUserFormFeedback" class="formError">
                                                <?php
                                                if (isset($_GET['deleteUserError']))
                                                {echo 'ERROR: User could not be deleted.'; }
                                                if (isset($_GET['deleteUserSuccess']))
                                                {echo '<font color="green">Selected user was deleted.</font>'; }
                                                ?>
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Select User: </td>
                                    <td>
                                        <select name="user">
                                            <?php include('build_user_select.php'); ?>
                                        </select>
                                    </td>
                                    <td>
                                        <center><input type="submit" name="Submit" value="Delete User"></center>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>

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