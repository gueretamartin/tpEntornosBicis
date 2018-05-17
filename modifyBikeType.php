<!DOCTYPE html>
<html lang="es"><head><meta http-equiv="Content-Type" content="application/x-www-form-urlencoded; charset=UTF-8">
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
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            //$image1 = $_POST['image1'];
            //$image2 = $_POST['image2'];
            //$image3 = $_POST['image3'];
            //$image4 = $_POST['image4'];
            //$image5 = $_POST['image5'];

            $target_dir = "img/portfolio/".str_replace(' ','',strtolower($_POST['name']))."/";

            $imgColumn="";
            $imgvalue="";


            if(isset($_FILES["image1"]["tmp_name"]) && !empty($_FILES["image1"]["tmp_name"])){
                $target_file = $target_dir . basename($_FILES["image1"]["name"]);
                $uploadOk = 1;

                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["image1"]["tmp_name"]);
                if($check !== false) {
                    // echo "File is an image - " . $check["mime"] . ".";
                    $image1 = $target_dir.$_FILES["image1"]["name"];
                    $file_data = file_get_contents($_FILES["image1"]["tmp_name"]);
                    file_put_contents($target_file,$file_data);

                    $imgvalue = $imgvalue . ", image1='".$image1."'";

                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }    
            }


            if(isset($_FILES["image2"]) && !empty($_FILES["image2"]["tmp_name"])){
                $target_file = $target_dir . basename($_FILES["image2"]["name"]);
                $uploadOk = 1;
                $check = getimagesize($_FILES["image2"]["tmp_name"]);
                if($check !== false) {
                    $image2 = $target_dir.$_FILES["image2"]["name"];
                    $file_data = file_get_contents($_FILES["image2"]["tmp_name"]);
                    file_put_contents($target_file,$file_data);

                    $imgvalue = $imgvalue . ", image2= '".$image2."'";

                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }    
            } 

            if(isset($_FILES["image3"]) && !empty($_FILES["image3"]["tmp_name"])){
                $target_file = $target_dir . basename($_FILES["image3"]["name"]);
                $uploadOk = 1;

                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["image3"]["tmp_name"]);
                if($check !== false) {
                    // echo "File is an image - " . $check["mime"] . ".";
                    $image3 = $target_dir.$_FILES["image3"]["name"];
                    $file_data = file_get_contents($_FILES["image3"]["tmp_name"]);
                    file_put_contents($target_file,$file_data);

                    $imgvalue = $imgvalue . ", image3='".$image3."'";

                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }    
            }           
            
            if(isset($_FILES["image4"]) && !empty($_FILES["image4"]["tmp_name"])){
                $target_file = $target_dir . basename($_FILES["image4"]["name"]);
                $uploadOk = 1;

                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["image4"]["tmp_name"]);
                if($check !== false) {
                    // echo "File is an image - " . $check["mime"] . ".";
                    $image4 = $target_dir.$_FILES["image4"]["name"];
                    $file_data = file_get_contents($_FILES["image4"]["tmp_name"]);
                    file_put_contents($target_file,$file_data);

                    $imgvalue = $imgvalue . ", image4= '".$image4."'";

                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }    
            }

            if(isset($_FILES["image5"]) && !empty($_FILES["image5"]["tmp_name"])){
                $target_file = $target_dir . basename($_FILES["image5"]["name"]);
                $uploadOk = 1;

                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["image5"]["tmp_name"]);
                if($check !== false) {
                    // echo "File is an image - " . $check["mime"] . ".";
                    $image5 = $target_dir.$_FILES["image5"]["name"];
                    $file_data = file_get_contents($_FILES["image5"]["tmp_name"]);
                    file_put_contents($target_file,$file_data);
                    $imgvalue = $imgvalue . ", image5 = '".$image5."'";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }    
            }



            if(isset($uploadOk) && $uploadOk == 0){
                $_errorValidacion = 4;
            }
            elseif (empty($price)) {
                $_errorValidacion = 3;
            } else {
                include ("connection.inc");
                //$preparedStatement = $link->prepare("UPDATE bikeType SET name = ?, description = ?, price = ?, image1 = ?, image2 = ?, image3 = ?, image4 = ?, image5 = ?  WHERE id = ?");
                // $preparedStatement->bind_param('ssdsi', $name, $description, $price, $image1, $id);
                //$preparedStatement->bind_param('ssdsi', $name,$description, $price, $image1, $image2, $image3, $image4, $image5,$id);
                //$preparedStatement->execute();
                //$preparedStatement->close();

                 $query = "UPDATE biketype SET name='" . $name . "', description='" . $description . "', price=" . $price . $imgvalue . " where id=" . $id;
 

                mysqli_query($link, $query) or die (mysqli_error($link));

                // mysqli_query($link, $query) or die (mysqli_error($link));
                $_errorValidacion = 0;

                mysqli_close($link);

                header("location:showBikeTypes.php");
            }
        } else {
            if(isset($_GET['id'])) {
                include ("connection.inc");

                $query = "select * from bikeType where id = ".$_GET["id"];

                $vResultado = mysqli_query($link, $query) or die (mysqli_error($link));;
                $fila = mysqli_fetch_array($vResultado);
                if(mysqli_num_rows($vResultado) == 0) {
                    $_errorAutenticacion = 4;
                } else {
                    $id = $fila['id'];
                    $name = $fila['name'];
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
                    <form action="modifyBikeType.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <div id="mensajes">
                                <?php
                                    if (isset($_errorValidacion)) {
                                        if ($_errorValidacion == 0)
                                            echo '<h4 class="alert alert-success text-center">¡Modificación exitosa!</h4>';
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
                            <input type="text" class="form-control" id="id" name="id" readonly value="<?php echo (string)$id ?>" >
                            <label class="control-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required value="<?php echo $name ;?>" >
                            <label class="control-label">Descripción</label>
                            <input type="text" class="form-control" id="description" name="description" required value="<?php echo $description ;?>" >
                            <label class="control-label">Precio</label>
                            <input type="number" max="999999999999" min="1" class="form-control" id="price" name="price" value="<?php echo $price ;?>" required>

<!--                             <label class="control-label">Imagen 1</label>
                            <input type="file" name="image1" id="image1">
                            <img alt="image" id="image1" name="image1" class="image" height="200px" <?php echo 'src="'.$image1.'"'?>/>
</br></br>
                            <label class="control-label">Imagen 2</label>
                            <input type="file" name="image2" id="image2">
                            <img alt="image" name="image2" class="image" height="200px" <?php echo 'src="'.$image2.'"'?>/>
</br></br>
                            <label class="control-label">Imagen 3</label>
                            <input type="file" name="image3" id="image3">
                            <img alt="image" name="image3" class="image" height="200px" <?php echo 'src="'.$image3.'"'?>/>
</br></br>
                            <label class="control-label">Imagen 4</label>
                            <input type="file" name="image4" id="image4">
                            <img alt="image" name="image4" class="image" height="200px" <?php echo 'src="'.$image4.'"'?>/>
</br></br>
                            <label class="control-label">Imagen 5</label>
                            <input type="file" name="image5" id="image5">
                            <img alt="image" name="image5" class="image" height="200px" <?php echo 'src="'.$image5.'"'?>/> -->
                            <div class="row">
                              <div class="col-lg-4">
                                    <div class="row" style="margin:30px 0;">
                                        <div class="thumbnail">
                                  <img alt="image" name="image1" class="image" height="200px" <?php echo 'src="'.$image1.'"'?>/>
                                  <div class="caption" style="overflow: hidden;">
                                    <label class="control-label">Imagen 1</label></br>
                                     <p><input type="file" name="image1" id="image1"></p>
                                  </div>
                                </div>
                                    </div>
                              </div>

                              <div class="col-lg-8" style="margin:0;padding:0;">
                                  <div class="row">
                                         <div class="col-lg-6">
                                    <div class="thumbnail">
                                  <img alt="image" name="image2" class="image" height="200px" <?php echo 'src="'.$image2.'"'?>/>
                                  <div class="caption" style="overflow: hidden;">
                                    <label class="control-label">Imagen 2</label>
                                    <p><input type="file" name="image2" id="image2"></p>
                                  </div>
                                </div>
                              </div>
                               <div class="col-lg-6">
                                    <div class="thumbnail">
                                  <img alt="image" name="image3" class="image" height="200px" <?php echo 'src="'.$image3.'"'?>/>
                                    <div class="caption" style="overflow: hidden;">
                                    <label class="control-label">Imagen 3</label>
                                    <p><input type="file" name="image3" id="image3"></p>
                                  </div>
                                </div>
                              </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-lg-6">
                                    <div class="thumbnail">
                                  <img alt="image" name="image4" class="image" height="200px" <?php echo 'src="'.$image4.'"'?>/>
                                  <div class="caption" style="overflow: hidden;">
                                    <label class="control-label">Imagen 4</label>
                                    <p><input type="file" name="image4" id="image4"></p>
                                  </div>
                                </div>
                              </div>
                               <div class="col-lg-6">
                                    <div class="thumbnail">
                                  <img alt="image" name="image5" class="image" height="200px" <?php echo 'src="'.$image5.'"'?>/>
                                  <div class="caption" style="overflow: hidden;">
                                    <label class="control-label">Imagen 5</label>
                                    <p><input type="file" name="image5" id="image5"></p>
                                  </div>
                                </div>
                              </div>
                            </div>                          
                                  </div>
                              </div>
                            
                                                                                         


                        </div>
                        <div class="form-group row" style="margin-top: 0;">
                            <button type="reset" class="btn btn-warning col-lg-5 col-md-5 col-xs-12 pull" onclick="goBack();">Volver</button>
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

</body>
</html>
