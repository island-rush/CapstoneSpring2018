<!-- update_user.php - Steve Hadfield - 3/24/2011 -->
<!-- Modified by C2C Christopher Darcy, April 2018
<!-- sets up an update form with selected user's info -->

<?php  // session management

  // retrieve session information
  session_start();

  // if no username set, then redirect to login  || !isset($_SESSION['userId'])
  if(!isset($_SESSION['username']) ){
    header("location:admin_login.php");
    exit;
  }

  // check that the userId was sent
  if(!isset($_POST['user'])){
    header("location:admin_home.php?updateUserError=1");
    exit;
  }
  $user_name=(isset($_SESSION['username']))?$_SESSION['username']:'';
?>

<!-- begin the HTML part -->

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
  <head>
    <title>Update User Form</title>
    <link type="text/css" rel="stylesheet" href="style_welcome.css">

    <!-- Set up style for form error feedback areas -->

    <style type="text/css">
      .formError { color: red; font-weight: bold }
    </style>

    <!-- JavaScript for login form data validation -->

    <script type="text/javascript">

      function checkUpdateUserForm()  // used to verify new info for user
      {
        // clear any old feedback

        document.getElementById('updateUserFormFeedback').innerHTML = "";

        // regex constants
        const passRegex = /^[\w!@#$%^&*<>?+=\-\\]{5,50}$/;

        // get form values

        var newUsernameValue = document.forms["update_user_form"]["newUsername"].value;
        var newPasswordValue = document.forms["update_user_form"]["newPassword"].value;
        var newPasswordRepeatValue = document.forms["update_user_form"]["newPasswordRepeat"].value;

        if (newUsernameValue !== '<?php echo $userName;?>')
        {
          document.getElementById('updateUserFormFeedback').innerHTML = 
                     "ERROR: Cannot update username, must remain \'<?php echo $userName;?>\'";
          return false;
        }

          if(newPasswordValue === "" || newPasswordRepeatValue === ""){
              document.getElementById("newUserFormFeedback").innerHTML = "ERROR: New User must have a password";
              return false;
          }

          if(newPasswordValue !== newPasswordRepeatValue){
              document.getElementById("newUserFormFeedback").innerHTML = "ERROR: Passwords do not match";
              return false;
          }

          if(passRegex.test(newPasswordValue) === false){
              document.getElementById("newUserFormFeedback").innerHTML = "ERROR: Password must be between 5 and" +
                  "50 characters long and may only contain alphanumeric and !@#$%^&*-_+=<>?/\\ characters";
              return false;
          }
          return true;

      }
    </script>	
  </head>

<!--  ********************************* HTML Body begins here ***************************** -->

  <body>
    <table border="0" width="100%">
      <tbody>
            <div id="page_title"><br /><p>Island Rush Admin</p></div>
            <em>Welcome,
              <?php echo $_SESSION['username'].'.<br/>'; ?></em>

<!-- ************************* Retrieve info to pre-populate the update form ************************** -->

             <?php // hit the database to retrieve the current data values

                // open connection to the database on LOCALHOST with 
                // userid of 'root', password of 'secret', and database 'csl'

                @ $db = new mysqli('LOCALHOST', 'root', '', 'island_rush');

                // Check if there were error and if so, report and exit

                if (mysqli_connect_errno()) 
                { 
                  echo 'ERROR: Could not connect to database.  Error is '.mysqli_connect_error();
                  exit;
                }

                // run the SQL query to retrieve the service partner info

                $results = $db->query('SELECT * FROM USERS WHERE userId = '.$_POST['user']);

                $r= $results->fetch_assoc();

                $userId = $r['userId'];
                $userName = $r['userName'];

                // deallocate memory for the results and close the database connection

                $results->free();
                $db->close();

              ?>

<!-- ******************************** User Info Update Form ********************************* -->

              <hr>
              <form name="update_user_form" method="post" id="update_user_form" 
                    action="update_user_action.php" onsubmit="return checkUpdateUserForm()">
                <table border="0" cellpadding="3" cellspacing="1">
                  <tr>
                    <td colspan="2">
                      <center>
                        <div id="updateUserFormFeedback" class="formError"></div>
                      </center>
                    </td>
                  </tr>
                  <tr>
                    <td>Username</td>
                    <td><input name="existingUserId" type="hidden" id="existingUserId" 
                               value="<?php echo $userId; ?>">  <!-- hidden field to hold userId -->
                        <input name="newUsername" type="text" id="newUsername" value="<?php echo $userName; ?>" readonly></td>
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
                        <td><input name="newAdmin" type="checkbox" value="1" id="newAdmin" >Make user Admin</td>
                    </tr>
                  <tr>
                    <td colspan="2"><br/>
                      <center>
                        <input type="submit" name="Submit" value="Update User">
                        <a href="admin_home.php"> Cancel and Return to Admin Home</a>
                      </center>
                    </td>
                  </tr>
                </table>
              </form>

              <hr>
              <form name="logout_form" method="post" id="logout_form" action="logout.php">
                <input type="Submit" name="Submit" value="Logout">
              </form>
            </center>
          </td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
