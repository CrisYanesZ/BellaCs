<?php
    include './library/configServer.php';
    include './library/consulSQL.php';
    include './process/securityPanel.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Bella Cosmetics |Admin</title>
    <link rel="icon" href="nuevologo.png">
    <link rel="stylesheet" href="css/est.css">
    <?php include './inc/link.php'; ?>
</head>
<body id="container-page-configAdmin">
    <?php include './inc/navbar.php'; ?>
    <section id="prove-product-cat-config">
        <div class="container">
          <div class="page-header">
            <h1>Administración <small class="tittles-pages-logo">Bella Cosmetics</small></h1>
          </div>
          <!--====  Nav Tabs  ====-->
          <ul class="nav nav-tabs nav-justified" style="margin-bottom: 15px;background-color:#1E1B1C;;">
            <li>
              <a href="configAdmin.php?view=product">
                <i class="fa fa-cubes" aria-hidden="true"></i> &nbsp; Productos
              </a>
            </li>
            <li>
              <a href="configAdmin.php?view=provider">
                <i class="fa fa-truck" aria-hidden="true"></i> &nbsp; Proveedores
              </a>
            </li>
            <li>
              <a href="configAdmin.php?view=category">
                <i class="fa fa-shopping-basket" aria-hidden="true"></i> &nbsp; Categorías
              </a>
            </li>
            <li>
              <a href="configAdmin.php?view=admin">
                <i class="fa fa-users" aria-hidden="true"></i> &nbsp; Administradores
              </a>
            </li>
            <!--<li>
              <a href="configAdmin.php?view=order">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> &nbsp; Pedidos
              </a></li>
              <li>
              
              <a href="configAdmin.php?view=bank">
                <i class="fa fa-university" aria-hidden="true"></i> &nbsp; Cuenta bancaria
              </a>
            </li>-->
            <li>
              <a href="configAdmin.php?view=account">
                <i class="fa fa-address-card" aria-hidden="true"></i> &nbsp; Mi cuenta
              </a>
            </li>
          </ul>
          <?php
            $content=$_GET['view'];
            $WhiteList=["product","productlist","productinfo","provider","providerlist","providerinfo","category","categorylist","categoryinfo","admin","adminlist","order","bank","account"];
            if(isset($content)){
              if(in_array($content, $WhiteList) && is_file("./admin/".$content."-view.php")){
                include "./admin/".$content."-view.php";
              }else{
                echo '<h2 class="text-center">Lo sentimos, la opción que ha seleccionado no se encuentra disponible</h2>';
              }
            }else{
              echo '<h2 class="text-center">Para empezar, por favor escoja una opción del menú de administración</h2>';
            }
          ?>
        </div>
    </section>
    <footer class="pie-pagina">
        <div class="grupo-1" style="background-color: #1E1B1C; border:0;">
            <div class="box" style="background-color: #1E1B1C; border:0;">
                <figure style="background-color: #1E1B1C; border:0;">
                    <a href="#">
                        <img src="nuevologo.png" alt="Logo de SLee Dw">
                    </a>
                </figure>
            </div>
            <div class="box" style="background-color: #1E1B1C; border:0;">
                <h2 style="color: #fff;
    margin-bottom: 25px;
    font-size: 20px;"><b>SOBRE NOSOTROS</b></h2>
                <p>Bella Cosmetics | Lo mejor en Cosmeticos</p>
                <p>Contactanos:+504 2772-0090 </p>
                <p>Dirección: Comayagua </p>
            </div>
            <div class="box" style="background-color: #1E1B1C;border:0;">
                <h2 style="color: #fff;
    margin-bottom: 25px;
    font-size: 20px;"><b>SIGUENOS</b></h2>
                <div class="red-social">
                    <a class="btn btn-default" type= "button" style="font-size:25px;color:white" href="#"><i class="fa fa-facebook"></i> </a>
                    <a class="btn btn-default" type= "button" style="font-size:25px;color:white" href="#"><i class="fa fa-instagram"></i> </a>
                    <a class="btn btn-default" type= "button" style="font-size:25px;color:white" href="#"><i class="fa fa-twitter"></i> </a>
                    <a class="btn btn-default" type= "button" style="font-size:25px;color:white" href="#"><i class="fa fa-whatsapp"></i> </a>
                    <a class="btn btn-default" type= "button" style="font-size:25px;color:white" href="#"><i class="fa fa-youtube"></i> </a>
                </div>
            </div>
        </div>
        <div class="grupo-2" style="background-color: #1E1B1C">
            <small>&copy; 2021 <b>Bella Cosmetics</b> - Todos los Derechos Reservados.</small>
        </div>
    </footer>
</body>
</html>