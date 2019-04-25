<?php
  require 'userData.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Events</title>
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
            <a href="javascript:void(0);" style="width:auto;color:#fff;"><?php echo 'Hi, ' . $_SESSION["full_name"] . '!'; ?></a>
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
        <h3>Account is created Succuessfully</h3>
        <h3>please <a onclick="document.getElementById('id01').style.display='block'">login</a> again</h3>
    </div>
</div><br/><br/>

<!--Login form -->
<div id="id01" class="modal">
  
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
<div id="id02" class="modal">
  
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

<script>
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
