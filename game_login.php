<!-- game_.php handles user login before game   -->
<!-- Created by Jack Kulp and Chris Darcy, April 2018   -->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <title>Login to Island Rush</title>
        <link rel="stylesheet" type="text/css" href="style_welcome.css">
        <script type="text/javascript">
                function checkLoginForm(){
                    // add verifications
                    const sectionRegex = /^[MmTt][1-7][ABCDEFabcdef]$/;

                    var section = document.forms['login']['section'].value;
                    var instructor = document.forms['login']['instructor'].value;
                    var team = document.forms['login']['team'].value;
                    var valid = true;

                    if(section === ""){
                        document.getElementById('sectionFeedback').innerHTML = "\tERROR: Section must be specified";
                        valid = false;
                    }
                    else if(sectionRegex.test(section) === false){
                        document.getElementById('sectionFeedback').innerHTML = "\tERROR: Section improperly formatted, " +
                            "must look like 'M3A'";
                        valid = false;
                    }
                    if(instructor === ""){
                        document.getElementById('instructorFeedback').innerHTML = "\tERROR: Instructor must be specified";
                        valid = false;
                    }
                    if(team !== 'red' && team !== 'blue'){
                        document.getElementById('formFeedback').innerHTML = "ERROR: Team not set correctly," +
                            " how'd you even do this?";
                        valid = false;
                    }
                    return valid;
                }
        </script>
    </head>
    <!-- ************************ Begin the HTML Body ************************** -->
    <body>
    <h1>Island Rush</h1>
    <nav>
        <a href="./home.html">Home</a>
        <a class="active" href="./game_login.php">Play the Game</a>
        <a style="float:right" href="./admin_login.php">Admin</a>
    </nav>
    <!-- ***************************** Begin the actual login form ***************************** -->
    <div class="spacer">
        <table border="0" width="100%">
            <tbody>
            <tr>
                <td colspan="4">
                    <br />
                    <div id="login_header">Login to Your Island Rush Game:</div>
                    <form name="login" method="post" id="login" action="game_login_verify.php" onsubmit="return checkLoginForm()">
                        <table border="0" cellpadding="3" cellspacing="1">
                            <tr>
                                <td colspan="2">
                                    <div id="formFeedback" class="formError">
                                        <?php
                                        if (isset($_GET['err'])) {echo 'ERROR: Username and/or password not valid.'; }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Section</td>
                                <td><input name="section" type="text" id="section">
                                    <div style="display: inline" id="sectionFeedback" class="formError"></div></td>
                            </tr>
                            <tr>
                                <td>Teacher Last Name</td>
                                <td><input name="instructor" type="text" id="instructor">
                                    <div style="display: inline" id="instructorFeedback" class="formError"></div></td>
                            </tr>
                            <tr>
                                <td>Red or Blue Team</td>
                                <td><input type="radio" name="team" value="red" checked> Red<br>
                                    <input type="radio" name="team" value="blue"> Blue<br>
                                </td>
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
        <p>Login with section: M1A teach: Darcy   OR   section: T2B teach: Kulp</p>
    </div> <!-- end of spacer -->
    </body>
</html>


