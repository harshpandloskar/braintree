<?php

/**
 * Adding signup data to database.
 */
//Load the database configuration file
require 'dbConfig.php';

$username       = test_data($_REQUEST['uname']);
$userEmail      = test_data($_REQUEST['uemail']);
$userFullName   = test_data($_REQUEST['ufullname']);
$Password       = test_data($_REQUEST['psw']);


function test_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Create connection
$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
// Check connection
if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
}

/**
 * CHECK USER EXISTS OR NOT OTHERWISE SAYS "USERS ALREADY EXISTS"
 */
$sql = "SELECT * FROM users WHERE userName = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);

if (!empty($row) && $row[1] === $username){    
    echo "Users already exists!!";
    echo "<br/><a href='index.php'>Go back and try again</a>";
    exit;
    
    
}else{
    
    $Isql = "INSERT INTO users (userName, userEmail, userFullName, pass)
    VALUES ('$username', '$userEmail', '$userFullName', '$Password')";
    $Iresult = mysqli_query($conn, $Isql);

    /**
     * Add notification table to show icon.
     */
    $notifySql = "INSERT INTO `notification` (userEmail, shouldDisplay, notificationMsg)
    VALUES ('$userEmail', 'Y', 'Welcome $username to ticketing app!')";
    $resNotify = mysqli_query($conn, $notifySql);

    if($Iresult == true && $resNotify == true){
        header('Location: successful.php');
        exit;
    }else {
        echo "Something wait wrong!!";
        exit;
    }
}
mysqli_close($conn);
exit;

?>