<!DOCTYPE html>
<html lang="en">
<head>
  <title>Synopsis</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/synopsis.js"></script>
  <link rel="stylesheet" href="assets/synopsis.css">
  <link rel="manifest" href="manifest.json">
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
    <div class="loader">
        <img src="./assets/loader/loader.gif" />
    </div>
    <div class="movies-data" style="display:none;">
        <h3 class="_movie-name"></h3><br>
        <div class="_background-white">
            <ul class="movie-synopsis-container">
                <li class="_img-poster"></li>
                <li class="_movie_name"></li>
            </ul> 
            <div class="_background-design-white"> 
                <div class="_cast-mem">
                    <div class="_director-name"><strong>Artist: </strong></div><br/><br/>
                    <div class="_cast"><strong>Cast: </strong></div><br/><br/>
                    <div class="_notes"><strong>Notes: </strong></div><br/><br/>
                    <div class="_year"><strong>Relasing date: </strong></div><br/><br/>
                </div>
            </div>
        </div>
    </div>
</div><br/>

<div class="__showtimes text-center">
    <h2 class="_showtimes-text">Showtimes available</h2>
    <div class="_list-showtimes-container">
        <div class="_weekend-name-list">
            <br/>
                
                <!-- Bootstrap light button -->
                <div class="row">
                    <button data-toggle="modal" data-target="#monday" type="button" class="btn btn-light">Monday</button>
                    <button data-toggle="modal" data-target="#tuesday" type="button" class="btn btn-light">Tuesday</button>
                    <button data-toggle="modal" data-target="#wednesday" type="button" class="btn btn-light">Wednesday</button>
                    <button data-toggle="modal" data-target="#thursday" type="button" class="btn btn-light">Thursday</button>
                    <button data-toggle="modal" data-target="#friday" type="button" class="btn btn-light">Friday</button>
                    <button data-toggle="modal" data-target="#saturday" type="button" class="btn btn-light">Saturday</button>
                    <button data-toggle="modal" data-target="#sunday" type="button" class="btn btn-light">Sunday</button>
                </div>
                                    
                <!-- Dialog modal -->
                <div id="monday" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><strong>SHOWTIMES</strong></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span> 
                                </button>
                            </div>  
                            <div class="modal-body">
                                <p>Showtimes available on Monday</p><br/>
                                <div class="_time-available">
                                </div><br/>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dialog modal -->
                <div id="tuesday" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><strong>SHOWTIMES</strong></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span> 
                                </button>
                            </div>  
                            <div class="modal-body">
                                <p>Showtimes available on Tuesday</p><br/>
                                <div class="_time-available">
                                </div><br/>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Dialog modal -->
                <div id="wednesday" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><strong>SHOWTIMES</strong></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span> 
                                </button>
                            </div>  
                            <div class="modal-body">
                                <p>Showtimes available on Wednesday</p><br/>
                                <div class="_time-available">
                                </div><br/>
                            </div>
                        </div>
                    </div>
                </div>

                 <!-- Dialog modal -->
                 <div id="thursday" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><strong>SHOWTIMES</strong></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span> 
                                </button>
                            </div>  
                            <div class="modal-body">
                                <p>Showtimes available on Thursday</p><br/>
                                <div class="_time-available">
                                </div><br/>
                            </div>
                        </div>
                    </div>
                </div>

                 <!-- Dialog modal -->
                 <div id="friday" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><strong>SHOWTIMES</strong></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span> 
                                </button>
                            </div>  
                            <div class="modal-body">
                                <p>Showtimes available on Friday</p><br/>
                                <div class="_time-available">
                                </div><br/>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Dialog modal -->
                <div id="saturday" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><strong>SHOWTIMES</strong></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span> 
                                </button>
                            </div>  
                            <div class="modal-body">
                                <p>Showtimes available on Friday</p><br/>
                                <div class="_time-available">
                                </div><br/>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Dialog modal -->
                <div id="sunday" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><strong>SHOWTIMES</strong></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span> 
                                </button>
                            </div>  
                            <div class="modal-body">
                                <p>Showtimes available on Sunday</p><br/>
                                <div class="_time-available">
                                </div><br/>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- <ul class="_weekend-name-container">
                <li>Monday</li>
                <li>Tuesday</li>
                <li>Wednesday</li>
                <li>Thursday</li>
                <li>Friday</li>
                <li>Saturday</li>
                <li>Sunday</li>
            </ul> -->

        </div>
    </div>
</div>

<br/><br/>

<footer class="container-fluid text-center">
    <p>Harsh Pandloskar (10384363) | MSc In Information Systems with Computing</p><br>
</footer>

</body>
</html>
