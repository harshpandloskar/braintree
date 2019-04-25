<?php  
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>  

<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

//Load the database configuration file
require 'dbConfig.php';

$ID       = $_POST['uname'];
$Password = $_POST['psw'];

// Create connection
$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
// Check connection
if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
}
$userName = test_data($_REQUEST["uname"]);    
$mypswd = test_data($_REQUEST["psw"]);

function test_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$sql = "SELECT * FROM users WHERE userName = '$userName' and pass = '$mypswd'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);



if (!empty($row) && $row[1] === $userName){    
    // Set session variables
    $_SESSION["uname"] = $userName;
    $_SESSION["full_name"] = $row[3];
    $_SESSION["email"] = $row[2];
    
    /**
     * Set logged in cookie in browser
     */
    $cookie_name = "isLoggedIn";
    $cookie_value = "true";

    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
    header('Location: index.php');
    exit;
}
else if($userName != '' && $mypswd != '') {
    echo "username and password are incorrect";
    echo "<br/><a href='index.php'>Go back and try again</a>";
    exit;
}

mysqli_close($conn);

?>