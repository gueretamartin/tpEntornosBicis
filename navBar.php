
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
    if (isset($_usuario) && $_usuario=="123")
    echo  '<li><a href="">Empty Admin</a></li>';

      elseif (isset($_usuario)){
        echo '<li><a href="">Empty User</a></li>'
    
// other user (no admin)
     ;
      }
// all users
    echo ' 
        <li><a href="newUser.php">Registrarse</a></li>   
        <li><a href="gallery.php">Galería</a></li>
        <li><a href="contact.php">Contacto</a></li>
       <!-- <li><a href="about.php">¿Quienes somos?</a></li>-->';

         if(isset($_usuario))
           echo '<li><a href="closeSession.php" >Cerrar Sesión</a></li>';
         else
           echo '<li><a href="startSession.php" class="session">Iniciar Sesion</a></li>';
echo'
        </ul>
      </div>
    </div>
  </div>
  '
  ?>
