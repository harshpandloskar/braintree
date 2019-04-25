<?php
  require 'userData.php';

  $cookie_name = "isLoggedIn";
  $cookie_value = "false";

  function resultToArray($result) {
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
  }

  $userEmaill = $_SESSION["email"];
  $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
  /**
   * Let's remove the notification by updating queries.
   */
  $notifySql = "UPDATE `notification` SET shouldDisplay = 'N', notificationMsg = '' WHERE userEmail = '$userEmaill'";
  mysqli_query($conn, $notifySql);
  /**
   * Default value queue is false
   */
  $_isQueue = false;

  if(isset($_COOKIE[$cookie_name])) {
    if($_COOKIE[$cookie_name] == "true" && $_SESSION["uname"] != '') {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Events | Booking history</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/main.js"></script>
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/main.css">
  <script type="text/javascript">
    /*
    * Registering service worker in sw.js file
    */
    if('serviceWorker' in navigator) {
      navigator.serviceWorker.register('/sw.js')
        .then(function() {
              console.log('Service Worker Registered');
        });
    }
  </script>
  <script type="text/javascript">
    /**
    * Here I am storing all caches information related to listing and synopsis.
    */
    self.addEventListener('fetch', function(event) {
    console.log('Service Worker Fetch...');

    event.respondWith(
      caches.match(event.request)
        .then(function(response) {
          if(event.request.url.indexOf('facebook') > -1){
            return fetch(event.request);
          }
          if(response){
            console.log('Serve from cache', response);
            return response;
          }
          return fetch(event.request)
              .then(response =>
                caches.open(CURRENT_CACHES.prefetch)
                  .then((cache) => {
                    // cache response after making a request
                    cache.put(event.request, response.clone());
                    // return original response
                    return response;
                  })
              )}
        ))});
        /*--------------------------------------------------------------*/
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
        <li class="active"><a href="index.php">Home</a></li>
      </ul>
      <ul class="login-oauth">
        <?php
          if($_SESSION["full_name"] != ''){
        ?>
          <li>
            <!-- User name -->
            <a href="booking.php" style="width:auto;color:#fff;"><?php echo 'Hi, ' . $_SESSION["full_name"] . '!'; ?></a>
          </li>
          <li style="color: #fff;">
            &nbsp;&nbsp;|&nbsp;&nbsp;
          </li>
          <li>
            <!--Logout button -->
            <a href="logout.php" style="width:auto;color:#fff;"><?php echo 'Logout'; ?></a>
          </li>
        <?php
          } else{
        ?>
        <li>
          <!-- Facebook login or logout button -->
          <a href="javascript:void(0);" onclick="document.getElementById('id01').style.display='block'" style="width:auto;color:#fff;">Login</a>
        </li>
        <li>
          <p class="_or_p">or</p>
        </li>
        <li>
          <a href="javascript:void(0);" onclick="document.getElementById('id02').style.display='block'" style="width:auto;color:#fff;">Sign up!</a>
        </li>
        <?php
          }
        ?>
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
    <div class="loader">
        <img src="./assets/loader/loader.gif" />
    </div>
    <div class="movies-data" style="display:none;">
        <h3 class="panel-body"><strong>Purchase history</strong></h3>
        <?php

          $useremail = $_SESSION["email"];

          // Create connection
          $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
          // Check connection
          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          }

          $sql = "SELECT * FROM booking WHERE userEmail = '$useremail'";
          $result = mysqli_query($conn, $sql);
          $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);

          // $sqlUpdateQuery = "UPDATE booking SET userName='Doe' WHERE id=2";
           
          for($i=0; $i<count($rows);$i++) {

          /**
           * Queue list from database to confirm "sell back button options should be listed
           * or not.
           */
            /**
             * Events name
             */
            $_eventName = $rows[$i]["eventName"];
            $_sqlQueryTicketLimit = "SELECT * FROM `ticket_tbl` WHERE events='$_eventName'";
            $resultConfirmationTicketLimit = mysqli_query($conn, $_sqlQueryTicketLimit);
            $rowCTcktLimit = mysqli_fetch_row($resultConfirmationTicketLimit);
            $_queueNum = $rowCTcktLimit[3];
            
            if($_queueNum == 'Y') {
              $_isQueue = true;
            }else {
              $_isQueue = false;
            }
        ?>
          <div class="_purchase-booking panel panel-default">
            <div class="_bookingInfo">
              <p class="_align-left"><strong>Event:</strong> <?php echo $rows[$i]["eventName"]; ?></p>
              <p class="_align-left"><strong>Seat:</strong> | <?php echo $rows[$i]["seatNum"]; ?> |</strong></p>
              <p class="_align-left"><strong>Time:</strong> <?php echo $rows[$i]["eventTime"]; ?></strong></p>
              <p class="_align-left"><strong>Day:</strong> <?php echo $rows[$i]["eventDay"]; ?></strong></p>
              <p class="_align-left"><strong>Booking ID:</strong> <?php echo $rows[$i]["bookingID"]; ?></strong></p>
            <?php 
              if($_isQueue || $rows[$i]["bookingStatus"] == "Ticket cancelled" || strpos($rows[$i]["bookingStatus"], 'Confirmed ticket by') !== false || strpos($rows[$i]["bookingStatus"], 'Transferred to') !== false) {
            ?>
              <p class="_align-left"><strong>Booking status:</strong> <?php echo $rows[$i]["bookingStatus"]; ?></strong></p>
              <p class="_align-left"><strong>Waiting status:</strong> <?php echo $rows[$i]["waitingStatus"]; ?></strong></p>
            <?php 
              }else{
            ?>
              <p class="_align-left"><strong>Booking status:</strong> <?php echo "Confirmed"; ?></strong></p>
              <p class="_align-left"><strong>Waiting status:</strong> <?php echo "n/a"; ?></strong></p>
            <?php
              } 
            ?>
            </div>

            <?php
              if($rows[$i]["bookingStatus"] == "Ticket cancelled" || $rows[$i]["bookingStatus"] == "Waiting list" ) {
                //do nothing
              }else {
            ?>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cancellationModal<?php echo $i; ?>">Ticket cancellation available</button>
            <?php 
              }
            ?>
          </div><br/>

          <!-- Ticket cancel ask option -->
          <!-- Modal -->
          <div class="modal fade" id="cancellationModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ticket cancellation</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  What would you like to do?
                </div>
                <div class="modal-footer">
                  <button type="button" id="transferTicket<?php echo $i; ?>" class="btn btn-primary" data-toggle="modal" data-target="#transferTicketModal<?php echo $i; ?>">Transfer ticket</button>
                  
                  <?php 
                    /**
                     * If ticket is in queue process then let's don't show the 
                     * sell back button option
                     */
                    if($_isQueue) {
                  ?>
                  <button type="button" class="btn btn-primary" onclick="redirect('cancel_ticket.php?event=<?php echo $rows[$i]["eventName"]; ?>');">Sell back</button>
                  <?php
                    } 
                  ?>
                </div>
              </div>
            </div>
          </div>

          <!--Ticket transfer option modal-->
          <div class="modal fade" id="transferTicketModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">To whom would you like to transfer your ticket?</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="transfer_success.php">
                    <div class="form-group">
                      <label for="recipient-name<?php echo $i; ?>" class="col-form-label">User email:</label>
                      <input type="email" name="userEmail" class="form-control" id="recipient-name<?php echo $i; ?>" required>
                    </div>
                    <input type="hidden" value="<?php echo $rows[$i]["eventName"]; ?>" name="eventName" />
                    <input type="hidden" value="<?php echo $rows[$i]["seatNum"]; ?>" name="seat" />
                    <input type="hidden" value="<?php echo $rows[$i]["eventTime"]; ?>" name="time" />
                    <input type="hidden" value="<?php echo $rows[$i]["eventDay"]; ?>" name="day" />
                    <input type="hidden" value="<?php echo $rows[$i]["bookingID"]; ?>" name="bookingId" />
                    <input type="hidden" value="<?php echo $rows[$i]["bookingStatus"]; ?>" name="bookingStatus" />
                    <input type="hidden" value="<?php echo $rows[$i]["waitingStatus"]; ?>" name="waitingStatus" />
                    <input type="hidden" value="<?php echo $_SESSION["full_name"]; ?>" name="userFullName" />
                    <div class="form-group">
                      <label for="message-text<?php echo $i; ?>" class="col-form-label">Remark:</label>
                      <textarea class="form-control" name="remark" id="message-text<?php echo $i; ?>" required></textarea>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Transfer my ticket!</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <script>

          /**
           * Close current modal after opnening new modal
           */
          $("#transferTicket<?php echo $i; ?>").click(function(){
              $("#cancellationModal<?php echo $i; ?>").hide();
              $('#cancellationModal<?php echo $i; ?>').modal('hide');
          });
          </script>
        <?php
          }
          if(count($rows) == 0) {
        ?>
        <div>
            <h3>You haven't bought any tickets yet.</h3>
        </div>
        <?php
          }

          // Free result set
          mysqli_free_result($result);
          mysqli_close($con);exit;
        ?>

    </div>
</div><br/><br/>

<!--Login form -->
<div id="id01" class="modalM">
  
  <form class="modal-content animate" method="post" action="userData.php">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="./assets/images/user.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit" name="submit" class="btn btn-primary">Login</button><br/><br/>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>
  </form>
</div>

<!--Signup form -->
<div id="id02" class="modalM">
  
  <form class="modal-content animate" action="signup.php">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="./assets/images/user.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="uname"><b>Username:</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="uname"><b>Email:</b></label>
      <input type="text" placeholder="Enter Email" name="uemail" required>

      <label for="uname"><b>Your full name:</b></label>
      <input type="text" placeholder="Enter your full name" name="ufullname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit" class="btn btn-primary">Sign up</button><br/><br/>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>
  </form>
</div>

<script type="text/javascript">
  // Get the modal
  var modal = document.getElementById('id01');
  var modal2 = document.getElementById('id02');

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
      if (event.target == modal) {
          modal.style.display = "none";
      }
      if (event.target == modal2) {
          modal2.style.display = "none";
      }
  }
</script>


<footer class="container-fluid text-center">
<!-- Display login status -->
<div id="status"></div>

<!-- Display user profile data -->
<div id="userData"></div>
  <p>Harsh Pandloskar (10384363) | MSc In Information Systems with Computing</p><br>
</footer>

</body>
</html>
<?php
    }else {
      echo "Please login your account first";
      echo "<br/><a href='index.php'>Go to home page and try again</a>";
      exit;
    }
  }
?>
