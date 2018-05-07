
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

    if (isset($_usuario) && $_usuario=="admin")
    echo '
<li><a href="consulta_edificios.php">Edificios</a></li>
<li><a href="consulta_departamentos_edificios.php">Departamentos</a></li>
<li><a href="consultar_inquilino.php">Inquilinos</a></li>
<li><a href="abmliquidaciones.php">Liquidaciones</a></li>';

      elseif (isset($_usuario)){
        echo
     '<li><a href="consultar_liquidacion.php">Consultar</a></li>          ';
      }

    echo '    
        <li><a href="galeria.php">Galería</a></li>
        <li><a href="contacto.php">Contacto</a></li>
        <li><a href="acercade.php">¿Quienes somos?</a></li>';

         if(isset($_usuario))
           echo '<li><a href="cerrarsesion.php" >Cerrar Sesión</a></li>';
         else
           echo '<li><a href="iniciarsesion.php" class="session">Iniciar Sesion</a></li>';
echo'
        </ul>
      </div>
    </div>
  </div>
  '
  ?>
