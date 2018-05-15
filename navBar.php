
<?php
echo '
<div class="navbar navbar-default navbar-fixed-top ">
    <div class="container-fluid">
      <div class="navbar-header">
        <a href="index.php" class="navbar-brand negrita">Inicio</a>
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div class="navbar-collapse collapse" id="navbar-main">
       <!--Aca va lo que sea responsive-->


       <ul class="nav navbar-nav navbar-right">';


// only admin
    if (isset($_fullName) && $_fullName=="Administrador"){
        echo  '<li class="buttonAddBooking"><a class="session" href="showBooking.php">Reservas</a></li>
              <li><a href="showBikeTypes.php" class="gallery">Tipos de Bici</a></li>';
    }
      elseif (isset($_fullName)){
        echo
        '<li><a href="showBooking.php">Ver reservas</a></li>
        <li><a class="session" href="addBooking.php">Reservar</a></li>';
      }
// all users
    echo '

        <li><a href="gallery.php" class="gallery">Galería</a></li>

        <li><a href="contact.php" class="contact">Contacto</a></li>
       <!-- <li><a href="about.php">¿Quienes somos?</a></li>-->';

         if(isset($_fullName))
           echo '<li><a class="profile" href="myProfile.php">Usuario:'.$_fullName.'</a></li>
								 <li><a class="out" href="closeSession.php" >Cerrar Sesión</a></li>';
         else{
           echo '<li><a href="newUser.php" class="profile">Registrarse</a></li>
         <li><a href="startSession.php" class="session">Iniciar Sesion</a></li>';
         }

echo'
        </ul>
      </div>
    </div>
  </div>
  '
  ?>
