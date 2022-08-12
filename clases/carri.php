<?php
session_start();
require '../config/config.php';
require '../config/database.php';
$db= new Database();
$con= $db->conectar();

$id=isset($_GET['id']) ? $_GET['id']:'';
$sql=$con->prepare("SELECT count(id) FROM productos
WHERE id=? AND activo=1");
 $sql->execute([$id]);
        if($sql->fetchColumn()>0){
    $sql=$con->prepare("SELECT Nombre,Precio,descri,descuento
    FROM productos WHERE id=? AND activo=1 LIMIT 1");
$sql->execute([$id]);
$row=$sql-> fetch(PDO::FETCH_ASSOC);
$nombre=$row['Nombre'];
$precio=$row['Precio'];
$des=$row['descri'];
$descuento=$row['descuento'];
$precio_de=$precio-(($precio*$descuento)/100);
$dir_images='images/productos/'.$id.'/';
$rutaImg=$dir_images.'principal.jpg';}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Maquillaje</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet"
     integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous">
<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<header>
  <div class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="#" class="navbar-brand ">
        <strong>Carrito Tienda de Maquillaje</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarHeader">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                  <a href="#" class="nav-link active">Catalogo</a>
              </li>
              <li class="nav-item">
                  <a href="#" class="nav-link ">Contactos</a>
              </li>

          </ul>
          <a href="carrito.php" class="btn btn-primary">
     Carrito  <span id="num_cart" class="badge bg-secondary"> </span>
     <!--//</?php echo $num_cart; ?-->
            </a>
      </div>
    </div>
  </div>
</header>
<main>
    <div class="container">
    <?php
    if(isset($SESSION['carri'])){
        $datos=$_SESSION['carri'];
        $total=0;
        for($i;$i<count($datos);$i++){
            ?>
            <div class="producto">
                <center>
                <img src="<?php echo $rutaImg; ?>" class="d-block w-100" >
                 <?php  foreach($imagenes as $img){?>
                <img src="<?php echo $img; ?>" class="d-block w-100" >
                <?php }?>
                </center>
            </div>
            <h2> <?php echo $nombre;?> </h2>
                <?php if($descuento>0 ){?>
                    <p><del><?php echo MONEDA.number_format($precio,2,'.',',');?></del></p>
                    <h2> <?php echo MONEDA.number_format($precio_de,2,'.',',');?>
                    <samll class="text_success"><?php echo $descuento;?>% descuento</small>
                </h2>  
                <?php } else{?>
                    <h2> <?php echo MONEDA.number_format($precio_de,2,'.',',');?> </h2>
                    <?php }?>
                <p class="lead">
                <?php echo $nombre.ESPI.$des;?>
                </p>
       <?php }

    }else{
        echo '<center><h2>El carrito de compras esta  vacio</h2><center>';
    }
?>
    </div>
</main>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
crossorigin="anonymous"></script>  
<script>
    
</body>
</html>