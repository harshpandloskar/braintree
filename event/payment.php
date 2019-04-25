<?php
  require 'userData.php';
  
  $cookie_name = "isLoggedIn";
  $cookie_value = "false";

/**
 * Get parameters request.
 */
$_eventName = ucfirst($_GET["event"]);
$_day = $_GET["day"];
$_time = $_GET["time"];

  /**
   * Queue process bool
   */
  $isQueue = false;
  
  /**
   * Booking ID
   */
  $length = 6;
  $_bookingID = strtoupper(substr(str_shuffle("abcdefghijklmnopqrstuvwxyz123456789"), 0, $length));
  
  /**
   * Event name
   */
  $_eventName = ucfirst($_GET["event"]);

  /**
   * Seat number
   */
  $length = 2;
  $random_seat = strtoupper(substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $length));

  $seat_num = strtoupper($random_seat. '' .rand(0,10));
  
  if(isset($_COOKIE[$cookie_name])) {
    
    if($_COOKIE[$cookie_name] == "true" && $_SESSION["uname"] != '') {
      
      // function test_data($data) {
      //   $data = trim($data);
      //   $data = stripslashes($data);
      //   $data = htmlspecialchars($data);
      //   return $data;
      // }

      // Create connection
      $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
      // Check connection
      if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
      }

      $userNameC = $_SESSION["uname"];
      $userEmailC = $_SESSION["email"];

      /**
       * Checking info for ticket limits.
       */
      $_sqlQueryLimit = "SELECT * FROM `ticket_tbl` WHERE events='$_eventName'";
      $resultConfirmationLimit = mysqli_query($conn, $_sqlQueryLimit);
      $rowLimit = mysqli_fetch_row($resultConfirmationLimit);
      $_queueNum = $rowLimit[2];

      if($_queueNum == '0') {
        $isQueue = true;
      }
      
      /**
       * Checking booking info in database
       */
      $sqlQueryConfirmation = "SELECT * FROM booking WHERE userName = '$userNameC'";
      $resultConfirmation = mysqli_query($conn, $sqlQueryConfirmation);
      $rowC = mysqli_fetch_row($resultConfirmation);

      $_eventNameD = $rowC[5];
      $bookingID = $rowC[3];

      if($bookingID != $_bookingID && $_eventNameD != $_eventName) {

        /**
         * checking if user is in waiting list or not 
         * else put the ticket with confirmation.
         */
        $_statusMsg = $isQueue == true ? 'Waiting list' : 'Confirmed';
        $_status = $isQueue == true ? 'Queue' : 'n/a';
        

        /**
         * Insert into database.
         */
        $sqlQueryInsertion = "INSERT INTO booking (userName, userEmail, bookingID, seatNum, eventName, eventDay, eventTime, bookingStatus, waitingStatus)
        VALUES ('$userNameC', '$userEmailC', '$_bookingID', '$seat_num', '$_eventName', '$_day', '$_time', '$_statusMsg', '$_status')";
        // print_r($userEmailC);

        if (mysqli_query($conn, $sqlQueryInsertion)) {
          echo "";
        }

        /**
         * Once users book ticket, the limit has to be decremented.
         * Update query for ticketing table.
         */
        $_sqlQuery = "UPDATE ticket_tbl SET ticket_limit=ticket_limit-1 WHERE events='$_eventName'";
        
        if (mysqli_query($conn, $_sqlQuery)) {
          echo "";
        }
      }

    $proceed = '<a href="./confirmation.php?event='.$_eventName.'&day='.$_day.'&time='.$_time.'">Proceed</a>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Boooking confirmed!</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/confirmation.js"></script>
  <link rel="stylesheet" href="assets/confirmation.css">
  <link rel="manifest" href="manifest.json">
  <script src="https://js.braintreegateway.com/js/braintree-2.32.1.min.js"></script>
  <script>

    /*Registering service worker in sw.js*/
    if('serviceWorker' in navigator) {
      navigator.serviceWorker.register('/sw.js')
        .then(function() {
              console.log('Service Worker Registered');
        });
    }
  </script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php">Events</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- 
<div class="jumbotron">
  <div class="container text-center">
    <h2>DBS - Movies</h2> 
  </div>
</div> -->
  
<div class="jumbotron container-fluid bg-3 text-center">    
    <div class="movies-data">
        <h3>Payment</h3>
        <form>
            <div id="dropin-container"></div>
        </form>
        <div class="btn-grp">
            <?php echo $proceed; ?>
            <a href='./' class='btn btn-primary'>Cancel</a>
        </div>
    </div>
</div><br/><br/>

<footer class="container-fluid text-center">
  <p>Harsh Pandloskar (10384363) | MSc In Information Systems with Computing</p><br>
</footer>

</body>
<script>
    braintree.setup('sandbox_6m9bs5m6_vp22p6vr2hhpbhxf', 'dropin', {
        container: 'dropin-container'
    });
</script>
</html>
<?php
    }else {
      echo "Please login your account first before booking";
      echo "<br/><a href='index.php'>Go to home page and try again</a>";
      exit;
    }
  }else {
    echo "Please login your account first before booking";
    echo "<br/><a href='index.php'>Go to home page and try again</a>";
    exit;
  }
?>

