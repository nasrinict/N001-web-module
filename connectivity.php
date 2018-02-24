<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'N001-database');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

/*
  $con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
  $db = mysql_select_db(DB_NAME, $con) or die("Failed to connect to MySQL: " . mysql_error());
 */
/*
  $ID = $_POST['user'];
  $Password = $_POST['pass'];
 */

$connection = mysqli_connect('localhost', 'root', '');
if (!$connection) {
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'n001-database');
if (!$select_db) {
    die("Database Selection Failed" . mysqli_error($connection));
}

function SignIn() {
    session_start();
    if (isset($_POST['username']) and isset($_POST['password'])) {
//3.1.1 Assigning posted values to variables.
        $username = $_POST['user'];
        $password = $_POST['pass'];
//3.1.2 Checking the values are existing in the database or not
        $query = "SELECT * FROM `user` WHERE username='$username' and password='$password'";

        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        $count = mysqli_num_rows($result);
//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
        if ($count == 1) {
            $_SESSION['username'] = $username;
            //echo "SUCCESSFULLY LOGIN TO USER PROFILE PAGE...";
            //header('Location: Building-website.html');
        } else {
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
            $fmsg = "Invalid Login Credentials.";
            //echo "SORRY... YOU ENTERD WRONG ID AND PASSWORD... PLEASE RETRY...";
        }
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            echo "Hai " . $username . "
";
            echo "This is the Members Area
";
            echo "<a href='logout.php'>Logout</a>";
        }
    }
    /*
      session_start();   //starting the session for user profile page
      if (!empty($_POST['user'])) {   //checking the 'user' name which is from Sign-In.html, is it empty or have some text
      $query = mysqli_query("SELECT *  FROM username where userName = '$_POST[user]' AND pass = '$_POST[pass]'") or die(mysqli_error());
      $row = mysqli_fetch_array($query) or die(mysqli_error());
      if (!empty($row['userName']) AND ! empty($row['pass'])) {
      $_SESSION['userName'] = $row['pass'];
      echo "SUCCESSFULLY LOGIN TO USER PROFILE PAGE...";
      } else {
      echo "SORRY... YOU ENTERD WRONG ID AND PASSWORD... PLEASE RETRY...";
      }
      }
     */
}

if (isset($_POST['submit'])) {
    SignIn();
}
?>
