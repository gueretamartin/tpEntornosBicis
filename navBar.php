
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

        echo  '<li><a href="showBooking.php">Ver Reservas</a></li>
              <li><a href="showBikeTypes.php">Tipos de Bici</a></li>
							<li><a href="showUsers.php">Usuarios</a></li>';

    }
      elseif (isset($_fullName)){
        echo
        '<li><a class="booking" href="showBooking.php">Ver reservas</a></li>
        <li><a  class="buttonAddBooking" href="addBooking.php">Reservar</a></li>';

      }
// all users
    echo '

        <li><a href="gallery.php">Galería</a></li>

        <li><a href="contact.php">Contacto</a></li>
       <!-- <li><a href="about.php">¿Quienes somos?</a></li>-->';

         if(isset($_fullName))
           echo '<li><a class="profile" href="myProfile.php">'.$_fullName.'</a></li>
								 <li><a class="buttonCloseSession" href="closeSession.php" >Cerrar Sesión</a></li>';
         else{
           echo '<li><a class="registrarse" href="newUser.php">Registrarse</a></li>
         <li><a class="iniciar" href="startSession.php" >Iniciar Sesion</a></li>';
         }

echo'
        </ul>
      </div>
    </div>
  </div>
  '
  ?>
