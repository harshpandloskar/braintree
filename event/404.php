<!DOCTYPE html>
<html lang="en">
<head>
  <title>404!</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/main.js"></script>
  <link rel="stylesheet" href="assets/main.css">
  <link rel="manifest" href="manifest.json">
  <script>
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
    <div class="movies-data" style="display:none;">
        <h3>404! Oops the page you are looking not found!</h3><br> 
    </div>
</div><br/><br/>

<footer class="container-fluid text-center">
  <p>Harsh Pandloskar (10384363) | MSc In Information Systems with Computing</p><br>
</footer>

</body>
</html>
