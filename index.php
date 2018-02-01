  <?php
  require('connection.php');
  session_start();

  if(isset($_SESSION["id"])){
    header("Location: principal.php");
  }
  
  if(!empty($_POST))
  {
    $username = mysqli_real_escape_string($mysqli,$_POST['inputUsername']);
    $password = mysqli_real_escape_string($mysqli,$_POST['inputPassword']);
    $error = '';

    $sha1_pass = sha1($password);

    $sql = "SELECT id_usr, email, habilitado, es_administrador  from usuarios where email = '$username' and pass ='$sha1_pass'";
    $result=$mysqli->query($sql);
  	$rows = $result->num_rows;

    if($rows > 0 ){
      $row = $result->fetch_assoc();
      $_SESSION['id'] = $row['id_usr'];
      $_SESSION['habilitado'] = $row['habilitado'];
      $_SESSION['es_administrador'] = $row['es_administrador'];
      header("location: principal.php");
    } else {$error = "El nombre de usuario y/o contraseña son incorrectos";}
  }
   ?>

  <!DOCTYPE html>
  <html lang="en">

    <head>

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">

      <title>BiciAmiga</title>
      <link rel="icon" href="img/icon.png">

      <!-- Bootstrap core CSS -->
      <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom fonts for this template -->
      <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
      <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

      <!-- Custom styles for this template -->
      <link href="css/agency.min.css" rel="stylesheet">

    </head>

    <body id="page-top">
      <!-- Navigation -->
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
          <a class="navbar-brand js-scroll-trigger" href="#page-top">BiciAmiga</a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fa fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#services">¿Cómo funciona?</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#portfolio">Nuestras Bicis</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#login">Login</a>
              </li>
              <li class="nav-item" hidden="true">
                <a class="nav-link js-scroll-trigger" href="#about">Cancela tu reserva</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#contact">Contacto</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- Header -->
      <header class="masthead">
        <div class="container">
          <div class="intro-text">
            <div class="intro-lead-in">¡Reservá tu bici ahora!</div>
            <div class="intro-heading text-uppercase">NUNCA FUÉ TAN FÁCIL</div>
            <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Reserva tu BiciAmiga</a>
          </div>
        </div>
      </header>

      <!-- Services -->
      <section id="services">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h2 class="section-heading text-uppercase">¿Cómo funciona?</h2>
              <h3 class="section-subheading text-muted">Reserva tu Bici en tres simples pasos.</h3>
            </div>
          </div>
          <div class="row text-center">
            <div class="col-md-4">
             <span class="fa-stack fa-4x">
                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                <i class="fa fa-mouse-pointer fa-stack-1x fa-inverse"></i>
              </span> 
              <h4 class="service-heading">PASO 1</h4>
              <p class="text-muted">Hace click sobre el Botón "Reservar tu BiciAmiga".</p>
            </div>
            <div class="col-md-4">
              <span class="fa-stack fa-4x">
                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                <i class="fa fa-pencil-square-o fa-stack-1x fa-inverse"></i>
              </span>
              <h4 class="service-heading">PASO 2</h4>
              <p class="text-muted">Completa con tus datos. Elegí el tipo de bicicleta, la fecha y la cantidad de horas que vas a usarla.</p>
            </div>
            <div class="col-md-4">
              <span class="fa-stack fa-4x">
                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                <i class="fa fa-bicycle fa-stack-1x fa-inverse"></i>
              </span>
              <h4 class="service-heading">PASO 3</h4>
              <p class="text-muted">Confirma tu reserva, imprimí tu ticket y estarás listo para usar tu Bici el día elegido!</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Portfolio Grid -->
      <section class="bg-light" id="portfolio">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h2 class="section-heading text-uppercase">Nuestras Bicis</h2>
              <h3 class="section-subheading text-muted">¡Elige el diseño que más te guste!</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 col-sm-6 portfolio-item">
              <a class="portfolio-link" data-toggle="modal" href="#portfolioModal1">
                <div class="portfolio-hover">
                  <div class="portfolio-hover-content">
                    <i class="fa fa-plus fa-3x"></i>
                  </div>
                </div>
                <img class="img-fluid" src="img/portfolio/playera/playera_th_1.jpg" alt="">
              </a>
              <div class="portfolio-caption">
                <h4>Playera</h4>
                <p class="text-muted">Bicicleta de paseo. Simple y cómoda.</p>
              </div>
            </div>
            <div class="col-md-4 col-sm-6 portfolio-item">
              <a class="portfolio-link" data-toggle="modal" href="#portfolioModal2">
                <div class="portfolio-hover">
                  <div class="portfolio-hover-content">
                    <i class="fa fa-plus fa-3x"></i>
                  </div>
                </div>
                <img class="img-fluid" src="img/portfolio/mountain/mountain_th_1.jpg" alt="">
              </a>
              <div class="portfolio-caption">
                <h4>Mountain Bike</h4>
                <p class="text-muted">Bicicleta deportiva. Más ligera.</p>
              </div>
            </div>
            <div class="col-md-4 col-sm-6 portfolio-item">
              <a class="portfolio-link" data-toggle="modal" href="#portfolioModal3">
                <div class="portfolio-hover">
                  <div class="portfolio-hover-content">
                    <i class="fa fa-plus fa-3x"></i>
                  </div>
                </div>
                <img class="img-fluid" src="img/portfolio/doble/doble_th_1.jpg" alt="">
              </a>
              <div class="portfolio-caption">
                <h4>Doble</h4>
                <p class="text-muted">Bicicleta para compartir.</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- About -->
      <section id="about" hidden="true">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h2 class="section-heading text-uppercase">Cancela tu reserva</h2>
              <h3 class="section-subheading text-muted">¿Quieres cancelar tu reserva?</h3>
               <a class="btn btn-danger btn-xl text-uppercase js-scroll-trigger">Cancelar Reserva</a>
            </div>
          </div>
        </div>
      </section>

      <!-- Login -->
      <section id="login">
        <div class="container">
          <div class="panel-body">
              <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" >
              <label for="inputUser" class="sr-only">Usuario</label>
              <input type="text" id="inputUsername" name="inputUsername" class="form-control" placeholder="Usuario">

              <label for="inputPassword" class="sr-only">Contraseña</label>
              <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Contraseña">

              <button id="enviarformulario" class="btn btn-lg btn-success btn-block" type="submit">Enviar</button><br>
              <div style = "font-size:16px; color:#cc0000;"><?php echo isset($error) ? $error : '' ; ?></div>
              <p id="mensajeIncorrecto"></p>
              <a href="">Olvidé mi contraseña</a><br>
              <a href="" data-toggle="modal" data-target="#popUpWindow">Aún no estoy registrado</a>
            </form>
            </div>
        </div>
      </section>

      <!--Modal form -->
          <div class="modal fade" id="popUpWindow" style="z-index: 1400;">
            <div class="modal-dialog">
              <div class="modal-content">
                <!--header-->
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h2><strong>Complete con sus datos:</strong></h2>
                </div>
                <!--body form-->
                <div class="modal-body">
                  <form  class="form-signup" method="POST" action="altaUsuario.php">

                      <label for="inputDNI" class="sr-only">D.N.I.</label>
                      <input type="text" id="inputDNI" name="inputDNI" class="form-control" placeholder="Número de Documento" required autofocus>
                      <p id="mensajeDisponibilidad"></p>

                      <label for="inputName" class="sr-only">Nombre y Apellido</label>
                      <input type="text" id="inputName" name="inputName"  class="form-control" placeholder="Apellido y Nombre" required autofocus>

                      <label for="inputEmail" class="sr-only">E-mail</label>
                      <input type="text" id="inputEmail" name="inputEmail" class="form-control" placeholder="E-mail" required autofocus>

                      <label for="inputFecha">Fecha de Nacimiento</label>
                      <input type="date" id="inputDate" name="inputDate" class="form-control" placeholder="Fecha de Nacimiento" required autofocus>

                      <label for="inputTel" class="sr-only">Teléfono de contacto</label>
                      <input type="text" id="inputTel" name="inputTel" class="form-control" placeholder="Teléfono de Contacto" required autofocus>

                      <label for="inputPassword" class="sr-only">Contraseña</label>
                      <input type="password" id="Password" name="Password" class="form-control" placeholder="Contraseña" required autofocus >

                      <label for="inputPassword2" class="sr-only">Repite contraseña</label>
                      <input type="password" id="inputPassword2" name="inputPassword2" class="form-control" placeholder="Repite Contraseña" >
                      <span id="confirmMessage" class="confirmMessage"></span>

                      <a data-toggle="modal" data-target="#popUpTerms"><br/>Leer los términos y condiciones</a>
                        <!-- Add checkbox-->
                     <div class="checkbox">
                        <label><input  type="checkbox" value="agree" required>Estoy de acuerdo con los términos y condiciones</label>
                </div>
                <!--button-->
                <div class="modal-footer">
                  <button id="enviaform" class="btn btn-lg btn-primary btn-block" type="submit">Enviar</button>
                  <br>
                  </form>
                  <u><a href="index.php">No, ya estoy registrado.</a></u>
                </div>
                </div>
              </div>
            </div>
          </div>

      <!-- Contact -->
      <section id="contact">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h2 class="section-heading text-uppercase">Dejanos un mensaje</h2>
              <h3 class="section-subheading text-muted">Si tuviste algún inconveniente o simplemente tenés alguna duda dejanos tu mensaje</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <form id="contactForm" name="sentMessage" novalidate>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input class="form-control" id="name" type="text" placeholder="Tu nombre *" required data-validation-required-message="Por favor, ingresa tu nombre y apellido.">
                      <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                      <input class="form-control" id="email" type="email" placeholder="Tu Email *" required data-validation-required-message="Por favor, ingresa tu email para contactarnos.">
                      <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                      <input class="form-control" id="phone" type="tel" placeholder="Tu número de contacto *" required data-validation-required-message="Por favor, ingresa algún número de contacto.">
                      <p class="help-block text-danger"></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <textarea class="form-control" id="message" placeholder="Tu comentario *" required data-validation-required-message="Por favor, nos interesa tu comentario."></textarea>
                      <p class="help-block text-danger"></p>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-lg-12 text-center">
                    <div id="success"></div>
                    <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Enviar mensaje</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>

      <!-- Footer -->
      <footer>
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <span class="copyright">Copyright &copy; Your Website 2018</span>
            </div>
            <div class="col-md-4">
              <ul class="list-inline social-buttons">
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fa fa-twitter"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fa fa-facebook"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fa fa-linkedin"></i>
                  </a>
                </li>
              </ul>
            </div>
            <div class="col-md-4">
              <ul class="list-inline quicklinks">
                <li class="list-inline-item">
                  <a href="#">Privacy Policy</a>
                </li>
                <li class="list-inline-item">
                  <a href="#">Terms of Use</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>

      <!-- Portfolio Modals -->

      <!-- Modal 1 -->
      <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
              <div class="lr">
                <div class="rl"></div>
              </div>
            </div>
            <div class="modal-body">
              <!-- Project Details Go Here -->
              <h2 class="text-uppercase">Playera</h2>
              <p class="item-intro text-muted">Bicicleta de paseo. Simple y cómoda.</p>
              <div id="carousel-playera" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
                <ol class="carousel-indicators">
                  <li data-target="#carousel-playera" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-playera" data-slide-to="1"></li>
                  <li data-target="#carousel-playera" data-slide-to="2"></li>
                  <li data-target="#carousel-playera" data-slide-to="3"></li>
                  <li data-target="#carousel-playera" data-slide-to="4"></li>
                  <li data-target="#carousel-playera" data-slide-to="5"></li>
                  <li data-target="#carousel-playera" data-slide-to="6"></li>                  
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                  <div class="item active">
                    <img src="img/portfolio/playera/playera_full_1.jpg" alt="">
                  </div>
                  <div class="item">
                    <img src="img/portfolio/playera/playera_full_2.jpg" alt="">
                  </div>
                  <div class="item">
                    <img src="img/portfolio/playera/playera_full_3.jpg" alt="">
                  </div>
                  <div class="item">
                    <img src="img/portfolio/playera/playera_full_4.jpg" alt="">
                  </div>
                  <div class="item">
                    <img src="img/portfolio/playera/playera_full_5.jpg" alt="">
                  </div>
                  <div class="item">
                    <img src="img/portfolio/playera/playera_full_6.jpg" alt="">
                  </div>
                  <div class="item">
                    <img src="img/portfolio/playera/playera_full_7.jpg" alt="">
                  </div>
                </div>     
                <!-- Controls -->
                <a class="carousel-control-prev" href="#carousel-playera" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#carousel-playera" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  <span class="sr-only">Proxima</span>
                </a>
              </div>
                <p>Por su simpleza y su peso liviano, la recomendamos para moverte por la ciudad de manera cómoda. Posee una velocidad. Opcional: parrilla.</p>
                <ul class="list-inline">
                <li>*AGREGAR CARACTERISTICAS*</li>
              </ul>
              <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Reservala</a>
            </div>
          </div>
        </div>
      </div>

        <!-- Modal 2 -->
        <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                  <div class="rl"></div>
                </div>
              </div>
              <div class="container">
                <div class="row">
                  <div class="col-lg-8 mx-auto">
                    <div class="modal-body">
                      <!-- Project Details Go Here -->
                      <h2 class="text-uppercase">Mountain Bike</h2>
                      <p class="item-intro text-muted">Bicicleta deportiva. Más ligera.</p>
                      <div id="carousel-mountain" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                          <li data-target="#carousel-mountain" data-slide-to="0" class="active"></li>
                          <li data-target="#carousel-mountain" data-slide-to="1"></li>
                          <li data-target="#carousel-mountain" data-slide-to="2"></li>
                          <li data-target="#carousel-mountain" data-slide-to="3"></li>
                          <li data-target="#carousel-mountain" data-slide-to="4"></li>
                          <li data-target="#carousel-mountain" data-slide-to="5"></li>
                          <li data-target="#carousel-mountain" data-slide-to="6"></li>
                          <li data-target="#carousel-mountain" data-slide-to="7"></li>
                          <li data-target="#carousel-mountain" data-slide-to="8"></li>
                          <li data-target="#carousel-mountain" data-slide-to="9"></li>
                          <li data-target="#carousel-mountain" data-slide-to="10"></li>
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                          <div class="item active">
                            <img src="img/portfolio/mountain/mountain_full_1.jpg" alt="">
                          </div>
                          <div class="item">
                            <img src="img/portfolio/mountain/mountain_full_2.jpg" alt="">
                          </div>
                          <div class="item">
                            <img src="img/portfolio/mountain/mountain_full_3.jpg" alt="">
                          </div>
                          <div class="item">
                            <img src="img/portfolio/mountain/mountain_full_4.jpg" alt="">
                          </div>
                          <div class="item">
                            <img src="img/portfolio/mountain/mountain_full_5.jpg" alt="">
                          </div>
                          <div class="item">
                            <img src="img/portfolio/mountain/mountain_full_6.jpg" alt="">
                          </div>
                          <div class="item">
                            <img src="img/portfolio/mountain/mountain_full_7.jpg" alt="">
                          </div>
                          <div class="item">
                            <img src="img/portfolio/mountain/mountain_full_8.jpg" alt="">
                          </div>
                          <div class="item">
                            <img src="img/portfolio/mountain/mountain_full_9.jpg" alt="">
                          </div>
                          <div class="item">
                            <img src="img/portfolio/mountain/mountain_full_10.jpg" alt="">
                          </div>
                          <div class="item">
                            <img src="img/portfolio/mountain/mountain_full_11.jpg" alt="">
                          </div>                          
                        </div>     
                        <!-- Controls -->
                        <a class="carousel-control-prev" href="#carousel-mountain" role="button" data-slide="prev">
                          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                          <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-mountain" role="button" data-slide="next">
                          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                          <span class="sr-only">Proxima</span>
                        </a>
                      </div>
                      <p>La mejor alternativa para disfrutrar de la ciudad desde otra perspectiva, más deportiva y más ligera. Las bicicletas son de aro 26, poseen 21 velocidades, suspensión delantera sin bloqueo y frenos V-brake. Bicicleta de uso recreativo, no aptas para realizar downhill o enduro.</p>
                      <ul class="list-inline">
                        <li>*AGREGAR CARACTERISTICAS*</li>
                      </ul>
                      <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Reservala</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      <!-- Modal 3 -->
      <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
              <div class="lr">
                <div class="rl"></div>
              </div>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-lg-8 mx-auto">
                  <div class="modal-body">
                    <!-- Project Details Go Here -->
                    <h2 class="text-uppercase">Doble</h2>
                    <p class="item-intro text-muted">Bicilcleta para compartir</p>
                    <div id="carousel-doble" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                          <li data-target="#carousel-doble" data-slide-to="0" class="active"></li>
                          <li data-target="#carousel-doble" data-slide-to="1"></li>
                          <li data-target="#carousel-doble" data-slide-to="2"></li>
                          <li data-target="#carousel-doble" data-slide-to="3"></li>
                          <li data-target="#carousel-doble" data-slide-to="4"></li>
                          <li data-target="#carousel-doble" data-slide-to="5"></li>
                          <li data-target="#carousel-doble" data-slide-to="6"></li>
                          <li data-target="#carousel-doble" data-slide-to="7"></li>
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                          <div class="item active">
                            <img src="img/portfolio/doble/doble_full_1.jpg" alt="">
                          </div>
                          <div class="item">
                            <img src="img/portfolio/doble/doble_full_2.jpg" alt="">
                          </div>
                          <div class="item">
                            <img src="img/portfolio/doble/doble_full_3.jpg" alt="">
                          </div>
                          <div class="item">
                            <img src="img/portfolio/doble/doble_full_4.jpg" alt="">
                          </div>
                          <div class="item">
                            <img src="img/portfolio/doble/doble_full_5.jpg" alt="">
                          </div>
                          <div class="item">
                            <img src="img/portfolio/doble/doble_full_6.jpg" alt="">
                          </div>
                          <div class="item">
                            <img src="img/portfolio/doble/doble_full_7.jpg" alt="">
                          </div>
                          <div class="item">
                            <img src="img/portfolio/doble/doble_full_8.jpg" alt="">
                          </div>
                        </div>     
                        <!-- Controls -->
                        <a class="carousel-control-prev" href="#carousel-doble" role="button" data-slide="prev">
                          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                          <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-doble" role="button" data-slide="next">
                          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                          <span class="sr-only">Proxima</span>
                        </a>
                      </div>
                    <p>Para compartir AHRE</p>
                    <ul class="list-inline">
                      <li>*AGREGAR CARACTERISTICAS*</li>
                    </ul>
                    <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Reservala</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

     
      <!-- Bootstrap core JavaScript -->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

      <!-- Plugin JavaScript -->
      <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
      
      <!-- Contact form JavaScript -->
      <script src="js/jqBootstrapValidation.js"></script>
      <script src="js/contact_me.js"></script>    
      <script src="js/validator.js"></script>
      <script src="js/existeDNI.js"></script>

      <!-- Custom scripts for this template -->
      <script src="js/agency.min.js"></script>



    </body>

  </html>
