<!DOCTYPE html>
<html lang="es"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="bootstrap.css" media="screen">
    <link rel="stylesheet" href="bootswatch.min.css">
</head>
<body>

<?php
    session_start();
    if(isset($_SESSION['fullName'])){
        $_fullName = (string)$_SESSION['fullName'];
        $_type = (int)$_SESSION['type'];
    } else {
        $_errorValidacion = 1;
    }
?>

<?php
    if ($_type == 1) {
        if (isset($_POST['submit'])) {

            $id = $_POST['id'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $image1 = $_POST['image1'];
            $image2 = $_POST['image2'];
            $image3 = $_POST['image3'];
            $image4 = $_POST['image4'];
            $image5 = $_POST['image5'];

            if (empty($price)) {
                $_errorValidacion = 3;
            } else {
                include ("connection.inc");

                $query = "UPDATE bikeType SET description='" . $description . "', price='" . $price . "', image1=" . $image1 . ", image2='".$image2."', image3='".$image3."', image4='".$image4."', image5='".$image5."', status=" . $state. " where id=" . $_GET['id'];

                mysqli_query($link, $query) or die (mysqli_error($link));
                $_errorValidacion = 0;

                mysqli_close($link);
                header("location:showBikeTypes.php");
            }
        } else {
            if(isset($_GET['id'])) {
                echo $_GET['id'];
                include ("connection.inc");

                $query = "select * from bikeType where id = ".$_GET["id"];

                $vResultado = mysqli_query($link, $query) or die (mysqli_error($link));;
                $fila = mysqli_fetch_array($vResultado);
                if(mysqli_num_rows($vResultado) == 0) {
                    $_errorAutenticacion = 4;
                } else {
                    $id = $fila['id'];
                    $description = $fila['description'];
                    $price = $fila['price'];
                    $image1 = $fila['image1'];
                    $image2 = $fila['image2'];
                    $image3 = $fila['image3'];
                    $image4 = $fila['image4'];
                    $image5 = $fila['image5'];

                }
                mysqli_close($link);
            }
        }

    } else {
        // must be admin to access
        $_errorValidacion = 2;
    }
?>
        <div id="wrap">
            <?php include("navBar.php") ?>
            <br>
            <div class="container-fluid ">
                <div class= "col-lg-12 text-center">
                    <h3>Editar tipo de bicicleta</h3>
                </div>
                <div class = "col-lg-3"></div>
                <div class = "col-lg-6">
                    <form action="modifyBikeType.php" method="POST">
                        <div class="form-group row">
                            <div id="mensajes">
                                <?php
                                if (isset($_errorValidacion))
                                {
                                    if ($_errorValidacion == 2)
                                    echo '<h4 class="alert alert-danger text-center">No está autorizado para realizar esta acción.</h1>';
                                    if ($_errorValidacion == 1)
                                    '<script type="text/javascript"> window.location = "/startSession.php" </script>';
                                    if ($_errorValidacion == 3)
                                    echo '<h4 class="alert alert-success text-center">El precio no puede estar vacío.</h4>';
                                    if ($_errorValidacion == 4)
                                    echo '<h4 class="alert alert-success text-center">No se ha encontrado ese tipo de bicicleta.</h4>';
                                }
                                ?>
                            </div>
                            <label class="control-label">Identificador</label>
                            <input type="text" class="form-control" id="id" name="id" disabled value="<?php if(isset($_GET['id'])) {echo (string)$id ;} else {echo '';}?>" >
                            <label class="control-label">Descripción</label>
                            <input type="text" class="form-control" id="description" name="description" required value="<?php if(isset($_GET['id'])) {echo (string)$description ;} else {echo '';}?>" >
                            <label class="control-label">Precio</label>
                            <input type="number" max="999999999999" min="1" class="form-control" id="price" name="price" value="<?php if(isset($_GET['id'])) {echo (string)$price ;} else {echo '';}?>"  required>
                        </div>
                        <div class="form-group row" style="margin-top: 0;">
                            <button type="reset" class="btn btn-warning col-lg-5 col-md-5 col-xs-12 pull" onclick="goBack();">Descartar cambios</button>
                            <button type="submit" name="submit" id="submit" class="btn btn-primary col-lg-5 col-md-5 col-xs-12 pull-right">Actualizar</button>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>




    </form> <!-- End Form -->
    <div class="col-lg-3"></div>

</div> <!-- Close div to form -->

</div> <!-- End Container Fluid -->
</div> <!-- End id Wrap -->

<?php include("footer.php") ?>

<script src="jquery-1.10.2.min.js"></script>
<script src="bootstrap.min.js"></script>
<script src="bootswatch.js"></script>

<script type="text/javascript">
    function goBack() {
        window.location = "./showBikeTypes.php"
    }
</script>
<!-- <script>

function validaCampos(){

if ((document.getElementById("calle").value.length == 0) || (document.getElementById("numero").value.length == 0)){
document.getElementById("mensajes").innerHTML = '<h4 class="alert alert-danger text-center">Complete todos los campos</h1>';
return false;}
else {
return true;
}

}
</script>-->
</body>
</html>
