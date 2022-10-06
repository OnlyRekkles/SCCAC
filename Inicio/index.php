<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../Login/login.php");
    exit();
}
$user=$_SESSION["usuario"];
$empresa=$_SESSION["empresa"];
include("../Conexion/conexion.php");

$sql='SELECT empresas.id_empresa, usuarios.id_usuario,relacion.id_rol,empresas.nombre as nom_emp, empresas.logo,empresas.logo_type, usuarios.nombre,usuarios.apellido
FROM relacion
INNER JOIN empresas ON relacion.id_empresa=empresas.id_empresa
INNER JOIN usuarios ON relacion.id_usuario=usuarios.id_usuario
WHERE relacion.id_usuario='.$user.' AND relacion.id_empresa='.$empresa;
$respuesta=$mysqli->query($sql)->fetch_assoc();

$mysqli->close();

//echo '<a href="mycgi?foo=', urlencode("alv"), '">x</a>';


$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//echo "<h1>".$url."</h1>";


?>



<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIDOC</title>

  <link rel="icon" type="image/png" href="../IMAGES/icons/icono.png"/>


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- Plyr -->
  <link rel="stylesheet" href="../VENDOR/plyr/plyr.css">


  <!-- Mis estilos -->
  <link rel="stylesheet" href="html/style.css"> 
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button" id="pushmenuleft"></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php?<?php echo (parse_url($url, PHP_URL_QUERY));?>" class="nav-link"></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <!-- <a href="#" class="nav-link">Contact</a> -->
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../Empresas/empresas.php" class="brand-link">
      <img src="data:<?php echo $respuesta["logo_type"];?>;base64,<?php echo base64_encode($respuesta['logo']);?>" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .9">
      <span class="brand-text font-weight-light"><?php echo $respuesta['nom_emp']; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      

      <!-- Sidebar Menu -->
      <nav class="mt-2" id="Sidebar-Menu">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <!-- <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a> -->
            <li class="nav-item" style="border-bottom: 1px solid #4b545c;">
            <a href="#" class="nav-link">
              <img src="../IMAGES/img/perfil.png" class="nav-icon img-circle elevation-2" alt="User Image">
              <p style="white-space: nowrap;">
              <?php echo $respuesta['nombre']." ".$respuesta['apellido']; ?>
              </p>
            </a>
              <!-- <li class="nav-item">
                <a href="pages/charts/chartjs.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ChartJS</p>
                </a>
              </li> -->

          </li>
          <li class="nav-item " onclick="contenido('introduccion',this)">
            <a href="#" class="nav-link ">
            <ion-icon name="bookmarks-outline" style="height: 1.5rem; width: 1.5rem;"></ion-icon>  
            <p>Introducción</p>
            </a>
          </li>


                    <li class="nav-item">
                      <a href="#" class="nav-link">
                      <ion-icon name="tv-outline" style="height: 1.5rem; width: 1.5rem;"></ion-icon>
                      <p> Capacitación
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>


                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          <ion-icon name="aperture-outline" style="height: 1.5rem; width: 1.5rem;"></ion-icon>
                            <p>Interpretación ISO:9001
                              <i class="fas fa-angle-left right"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item" onclick="contenido('Interpretacion_1',this)">
                              <a href="#" class="nav-link">
                              <ion-icon name="caret-forward-outline" style="height: 1.4rem; margin-left: 10px; ;width: 1.5rem;"></ion-icon>
                              <p>Sesión 1</p>
                              </a>
                            </li>
                            <li class="nav-item" onclick="contenido('Interpretacion_2',this)">
                              <a href="#" class="nav-link">
                              <ion-icon name="caret-forward-outline" style="height: 1.4rem; margin-left: 10px; ;width: 1.5rem;"></ion-icon>
                                <p>Sesión 2</p>
                              </a>
                            </li>
                            <li class="nav-item" onclick="contenido('Interpretacion_3',this)">
                              <a href="#" class="nav-link">
                              <ion-icon name="caret-forward-outline" style="height: 1.4rem; margin-left: 10px; ;width: 1.5rem;"></ion-icon>
                                <p>Sesión 3</p>
                              </a>
                            </li>
                            <li class="nav-item" onclick="contenido('Interpretacion_4',this)">
                              <a href="#" class="nav-link">
                              <ion-icon name="caret-forward-outline" style="height: 1.4rem; margin-left: 10px; ;width: 1.5rem;"></ion-icon>
                                <p>Sesión 4</p>
                              </a>
                            </li>

                          </ul>
                              </li>
                            </ul>
            
          <li class="nav-item " >
            <a href="../Inicio/html/proceso.html" class="nav-link ">
            <ion-icon name="file-tray-stacked-outline" style="height: 1.5rem; width: 1.5rem;"></ion-icon>
            <p>Organización
              <i class="fas fa-angle-left right"></i> 
              </p>
            </a>
          
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../Inicio/html/tortuga.html" class="nav-link">
                    <ion-icon name="aperture-outline" style="height: 1.5rem; width: 1.5rem;"></ion-icon>
                      <p>Liderazgo</p>
                      <i class="fas fa-angle-left right"></i> 
                    </a>

                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                      <a href="../Inicio/html/objetivo.html" class="nav-link">
                      <ion-icon name="caret-forward-outline" style="height: 1.4rem; margin-left: 10px; ;width: 1.5rem;"></ion-icon>
                      <p>Objetivos</p>
                    </a>
                    </li>
                </ul>

                    
                    <li class="nav-item">
                    <a href="../Inicio/html/tortuga.html" class="nav-link">
                    <ion-icon name="aperture-outline" style="height: 1.5rem; width: 1.5rem;"></ion-icon>
                      <p>Contex de la Organización
                      <i class="fas fa-angle-left right"></i> 
                      </p>
                    </a>

                      <ul class="nav nav-treeview">
                      <li class="nav-item">
                      <a href="../Inicio/html/pestel.html" class="nav-link">
                      <ion-icon name="caret-forward-outline" style="height: 1.4rem; margin-left: 10px; ;width: 1.5rem;"></ion-icon>
                      <p>Pestel</p>
                    </a>

                    
                    <li class="nav-item">
                    <a href="../Inicio/html/foda.html" class="nav-link">
                    <ion-icon name="caret-forward-outline" style="height: 1.4rem; margin-left: 10px; ;width: 1.5rem;"></ion-icon>
                      <p>Foda</p>
                    </a>

                    <li class="nav-item">
                    <a href="../Inicio/html/partes_interesadas.html" class="nav-link">
                    <ion-icon name="caret-forward-outline" style="height: 1.4rem; margin-left: 10px; ;width: 1.5rem;"></ion-icon>
                      <p>Partes Interesadas</p>
                    </a>
                    
                  </li>
                </ul>


                    <li class="nav-item">
                    <a href="../Inicio/html/comunicacion.html" class="nav-link">
                    <ion-icon name="aperture-outline" style="height: 1.5rem; width: 1.5rem;"></ion-icon>
                      <p>Comnunicación
                      </p>
                    </a>
                    
                  </li>
                </ul>
                    </li>
            
            <li class="nav-item " >
            <a href="../Inicio/html/proceso.html" class="nav-link ">
            <ion-icon name="git-compare-outline" style="height: 1.5rem; width: 1.5rem;"></ion-icon>
              <p>Proceso
              <i class="fas fa-angle-left right"></i> 
              </p>
            </a>
          
          
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../Inicio/html/tortuga.html" class="nav-link">
                    <ion-icon name="aperture-outline" style="height: 1.5rem; width: 1.5rem;"></ion-icon>
                      <p>Mapeo
                      <i class="fas fa-angle-left right"></i> 
                      </p>
                    </a>
                  
                 <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="../Inicio/html/tortuga.html" class="nav-link">
                    <ion-icon name="caret-forward-outline" style="height: 1.4rem; margin-left: 10px; ;width: 1.5rem;"></ion-icon>
                    <p>Diagrama de la Tortuga</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../Inicio/html/sipoc.html" class="nav-link">
                    <ion-icon name="caret-forward-outline" style="height: 1.4rem; margin-left: 10px; ;width: 1.5rem;"></ion-icon>
                      <p>Diagrama SIPOC (PEPSU)</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../Inicio/html/otida.html" class="nav-link">
                    <ion-icon name="caret-forward-outline" style="height: 1.4rem; margin-left: 10px; ;width: 1.5rem;"></ion-icon>
                      <p>Diagrama General</p>
                    </a>
                  </li>
                </ul>
                    </li>
                    
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                    <ion-icon name="aperture-outline" style="height: 1.5rem; width: 1.5rem;"></ion-icon>
                      <p>Procedimiento</p>
                    </a>
                  </li>
                  </ul>

            <li class="nav-item " onclick="contenido('riesgos',this)">
            <a href="../Inicio/html/riesgos.html" class="nav-link">
            <ion-icon name="hourglass-outline" style="height: 1.5rem; width: 1.5rem;"></ion-icon>
            <p>Riesgos y Oportunidades</p>
            </a>
          </li>


          <li class="nav-item " >
            <a href="../Inicio/html/proceso.html" class="nav-link ">
            <ion-icon name="folder-open-outline" style="height: 1.5rem; width: 1.5rem;"></ion-icon>
              <p>Recursos
              <i class="fas fa-angle-left right"></i> 
              </p>
            </a>

                   <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="../Inicio/html/tortuga.html" class="nav-link">
                    <ion-icon name="caret-forward-outline" style="height: 1.4rem; margin-left: 10px; ;width: 1.5rem;"></ion-icon>
                    <p>Personal</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../Inicio/html/infraestructura.html" class="nav-link">
                    <ion-icon name="caret-forward-outline" style="height: 1.4rem; margin-left: 10px; ;width: 1.5rem;"></ion-icon>
                      <p>Infraestructura</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../Inicio/html/otida.html" class="nav-link">
                    <ion-icon name="caret-forward-outline" style="height: 1.4rem; margin-left: 10px; ;width: 1.5rem;"></ion-icon>
                      <p>Info. Documentada</p>
                    </a>
                 </li>
                </ul>
                </li>

                   
          <li class="nav-item " onclick="contenido('riesgos',this)">
            <a href="#" class="nav-link ">
            <ion-icon name="stats-chart-outline" style="height: 1.5rem; width: 1.5rem;"></ion-icon>
            <p>Operación</p>
            </a>
          </li>

          <li class="nav-item " onclick="contenido('proveedores',this)">
          <a href="../Inicio/html/proveedores.html" class="nav-link">
            <ion-icon name="ribbon-outline" style="height: 1.5rem; width: 1.5rem;"></ion-icon>
            <p>Proveedores</p>
            </a>
          </li>

          <li class="nav-item " onclick="contenido('mejora',this)">
          <a href="../Inicio/html/desempeño.html" class="nav-link">
            <ion-icon name="trending-up-outline" style="height: 1.5rem; width: 1.5rem;"></ion-icon>
            <p>Desempeño</p>
            </a>
          </li>

          <li class="nav-item " onclick="contenido('introduccion',this)">
            <a href="#" class="nav-link ">
            <ion-icon name="checkmark-done-outline" style="height: 1.5rem; width: 1.5rem;"></ion-icon>
            <p>Mejora</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link" id="btn_sesion_c">
            <ion-icon name="power-outline" style="height: 1.5rem; width: 1.5rem;"></ion-icon>
            <p>Cerrar sesión</p>
            </a>
          </li>

        
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Mapeo y Documentación de Procesos<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item" onclick="contenido('mapeo_1',this)">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sesión 1</p>
                </a>
              </li>
              <li class="nav-item" onclick="contenido('mapeo_2',this)">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sesión 2</p>
                </a>
              </li>
              <li class="nav-item" onclick="contenido('mapeo_3',this)">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sesión 3</p>
                </a>
              </li>
              <li class="nav-item" onclick="contenido('mapeo_4',this)">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sesión 4</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>




      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0">Dashboard :c </h1> -->
          </div><!-- /.col -->
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div>/.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" id="content">
    
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario de contacto</title>

    <link rel="stylesheet" type="text/css" href="../CSS/estilos.css">
</head>
    <body>
    <section class="form_wrap">
    <section class="cantact_info">
        <section class="info_title">
            <span class="fa fas fa-landmark	"></span>
            <h2>FILOSOFIA<br>ORGANIZACIONAL</h2>


            <style>
              input{
                width: 250px;
                padding: 5px;

              }
              .btn {
                padding: 5px;
                margin: 10px 10px;
                background-color: white; 
                color: black; 
                border: 2px solid #008CBA;
                border-radius: 40px;
                text-align: center;
                top: 50%;
                transform: translate(10%, 350%);

                  } 

              .btn:hover {
                background-color: #008CBA;
                color: white;
                  }
                
              textarea{
                resize: none;
                  }
              </style>


        </section>
        <section class="info_items">

        </section>
    </section>

    <form action="" class="form_contact">
        <h2><center>Coloca tu Información<center></h2>
        <div class="user_info">
            <label for="names">Nombre de la Empresa *</label>
            <input type="text" id="names">
           
            <label for="phone">Mision*</label>
            <input type="text" id="phone">

            <label for="email">Vision*</label>
            <input type="text" id="email">

            <label for="phone">Politica de Calidad-Objetivos*</label>
            <input type="text" id="phone">

            <label for="mensaje">Valores*</label>
            <textarea id="mensaje"></textarea>

            <input type="button" value="Enviar Mensaje" id="btnSend">
        </div>
    </form>

</section>
</body>


      <!-- <div class="container-fluid"> -->
        <!-- Small boxes (Stat box) -->
        <!-- <div class="row">
          <div class="col-lg-3 col-6"> -->
            <!-- small box -->
            <!-- <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          <!-- ./col -->
          <!-- <div class="col-lg-3 col-6"> -->
            <!-- small box -->
            <!-- <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          <!-- ./col -->
          <!-- <div class="col-lg-3 col-6"> -->
            <!-- small box -->
            <!-- <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          <!-- ./col -->
          <!-- <div class="col-lg-3 col-6"> -->
            <!-- small box -->
            <!-- <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          <!-- ./col -->
        <!-- </div> -->
        <!-- /.row -->
        <!-- Main row -->
        <!-- <div class="row"> -->
          <!-- Left col -->
          <!-- <section class="col-lg-7 connectedSortable"> -->
            <!-- Custom tabs (Charts with tabs)-->
            <!-- <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Sales
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                    </li>
                  </ul>
                </div>
              </div>/.card-header -->
              <!-- <div class="card-body">
                <div class="tab-content p-0"> -->
                  <!-- Morris chart - Sales -->
                  <!-- <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height: 300px;">
                      <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                   </div>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                  </div>
                </div>
              </div> /.card-body
            </div> -->
            <!-- /.card -->

            <!-- DIRECT CHAT -->
            <!-- <div class="card direct-chat direct-chat-primary">
              <div class="card-header">
                <h3 class="card-title">Direct Chat</h3>

                <div class="card-tools">
                  <span title="3 New Messages" class="badge badge-primary">3</span>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                    <i class="fas fa-comments"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div> -->
              <!-- /.card-header -->
              <!-- <div class="card-body"> -->
                <!-- Conversations are loaded here -->
                <!-- <div class="direct-chat-messages"> -->
                  <!-- Message. Default to the left -->
                  <!-- <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">Alexander Pierce</span>
                      <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                    </div> -->
                    <!-- /.direct-chat-infos -->
                    <!-- <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image"> -->
                    <!-- /.direct-chat-img -->
                    <!-- <div class="direct-chat-text">
                      Is this template really for free? That's unbelievable!
                    </div> -->
                    <!-- /.direct-chat-text -->
                  <!-- </div> -->
                  <!-- /.direct-chat-msg -->

                  <!-- Message to the right -->
                  <!-- <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-right">Sarah Bullock</span>
                      <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                    </div> -->
                    <!-- /.direct-chat-infos -->
                    <!-- <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image"> -->
                    <!-- /.direct-chat-img -->
                    <!-- <div class="direct-chat-text">
                      You better believe it!
                    </div> -->
                    <!-- /.direct-chat-text -->
                  <!-- </div> -->
                  <!-- /.direct-chat-msg -->

                  <!-- Message. Default to the left -->
                  <!-- <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">Alexander Pierce</span>
                      <span class="direct-chat-timestamp float-right">23 Jan 5:37 pm</span>
                    </div> -->
                    <!-- /.direct-chat-infos -->
                    <!-- <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image"> -->
                    <!-- /.direct-chat-img -->
                    <!-- <div class="direct-chat-text">
                      Working with AdminLTE on a great new app! Wanna join?
                    </div> -->
                    <!-- /.direct-chat-text -->
                  <!-- </div> -->
                  <!-- /.direct-chat-msg -->

                  <!-- Message to the right -->
                  <!-- <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-right">Sarah Bullock</span>
                      <span class="direct-chat-timestamp float-left">23 Jan 6:10 pm</span>
                    </div> -->
                    <!-- /.direct-chat-infos -->
                    <!-- <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image"> -->
                    <!-- /.direct-chat-img -->
                    <!-- <div class="direct-chat-text">
                      I would love to.
                    </div> -->
                    <!-- /.direct-chat-text -->
                  <!-- </div> -->
                  <!-- /.direct-chat-msg -->

                <!-- </div> -->
                <!--/.direct-chat-messages-->

                <!-- Contacts are loaded here -->
                <!-- <div class="direct-chat-contacts">
                  <ul class="contacts-list">
                    <li>
                      <a href="#">
                        <img class="contacts-list-img" src="dist/img/user1-128x128.jpg" alt="User Avatar">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Count Dracula
                            <small class="contacts-list-date float-right">2/28/2015</small>
                          </span>
                          <span class="contacts-list-msg">How have you been? I was...</span>
                        </div> -->
                        <!-- /.contacts-list-info -->
                      <!-- </a> -->
                    <!-- </li> -->
                    <!-- End Contact Item -->
                    <!-- <li>
                      <a href="#">
                        <img class="contacts-list-img" src="dist/img/user7-128x128.jpg" alt="User Avatar">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Sarah Doe
                            <small class="contacts-list-date float-right">2/23/2015</small>
                          </span>
                          <span class="contacts-list-msg">I will be waiting for...</span>
                        </div> -->
                        <!-- /.contacts-list-info -->
                      <!-- </a>
                    </li> -->
                    <!-- End Contact Item -->
                    <!-- <li>
                      <a href="#">
                        <img class="contacts-list-img" src="dist/img/user3-128x128.jpg" alt="User Avatar">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Nadia Jolie
                            <small class="contacts-list-date float-right">2/20/2015</small>
                          </span>
                          <span class="contacts-list-msg">I'll call you back at...</span>
                        </div>/.contacts-list-info
                      </a>
                    </li> -->
                    <!-- End Contact Item -->
                    <!-- <li>
                      <a href="#">
                        <img class="contacts-list-img" src="dist/img/user5-128x128.jpg" alt="User Avatar">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Nora S. Vans
                            <small class="contacts-list-date float-right">2/10/2015</small>
                          </span>
                          <span class="contacts-list-msg">Where is your new...</span>
                        </div> -->
                        <!-- /.contacts-list-info -->
                      <!-- </a>
                    </li> -->
                    <!-- End Contact Item -->
                    <!-- <li>
                      <a href="#">
                        <img class="contacts-list-img" src="dist/img/user6-128x128.jpg" alt="User Avatar">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            John K.
                            <small class="contacts-list-date float-right">1/27/2015</small>
                          </span>
                          <span class="contacts-list-msg">Can I take a look at...</span>
                        </div> -->
                        <!-- /.contacts-list-info -->
                      <!-- </a>
                    </li> -->
                    <!-- End Contact Item -->
                    <!-- <li>
                      <a href="#">
                        <img class="contacts-list-img" src="dist/img/user8-128x128.jpg" alt="User Avatar">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Kenneth M.
                            <small class="contacts-list-date float-right">1/4/2015</small>
                          </span>
                          <span class="contacts-list-msg">Never mind I found...</span>
                        </div> -->
                        <!-- /.contacts-list-info -->
                      <!-- </a>
                    </li> -->
                    <!-- End Contact Item -->
                  <!-- </ul> -->
                  <!-- /.contacts-list -->
                <!-- </div> -->
                <!-- /.direct-chat-pane -->
              <!-- </div> -->
              <!-- /.card-body -->
              <!-- <div class="card-footer">
                <form action="#" method="post">
                  <div class="input-group">
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                    <span class="input-group-append">
                      <button type="button" class="btn btn-primary">Send</button>
                    </span>
                  </div>
                </form>
              </div> -->
              <!-- /.card-footer-->
            <!-- </div> -->
            <!--/.direct-chat -->

            <!-- TO DO List -->
            <!-- <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  To Do List
                </h3>

                <div class="card-tools">
                  <ul class="pagination pagination-sm">
                    <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                  </ul>
                </div>
              </div> -->
              <!-- /.card-header -->
              <!-- <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
                  <li> -->
                    <!-- drag handle -->
                    <!-- <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span> -->
                    <!-- checkbox -->
                    <!-- <div  class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo1" id="todoCheck1">
                      <label for="todoCheck1"></label>
                    </div> -->
                    <!-- todo text -->
                    <!-- <span class="text">Design a nice theme</span> -->
                    <!-- Emphasis label -->
                    <!-- <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small> -->
                    <!-- General tools such as edit or delete-->
                    <!-- <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <div  class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo2" id="todoCheck2" checked>
                      <label for="todoCheck2"></label>
                    </div>
                    <span class="text">Make the theme responsive</span>
                    <small class="badge badge-info"><i class="far fa-clock"></i> 4 hours</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <div  class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo3" id="todoCheck3">
                      <label for="todoCheck3"></label>
                    </div>
                    <span class="text">Let theme shine like a star</span>
                    <small class="badge badge-warning"><i class="far fa-clock"></i> 1 day</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <div  class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo4" id="todoCheck4">
                      <label for="todoCheck4"></label>
                    </div>
                    <span class="text">Let theme shine like a star</span>
                    <small class="badge badge-success"><i class="far fa-clock"></i> 3 days</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <div  class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo5" id="todoCheck5">
                      <label for="todoCheck5"></label>
                    </div>
                    <span class="text">Check your messages and notifications</span>
                    <small class="badge badge-primary"><i class="far fa-clock"></i> 1 week</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <div  class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo6" id="todoCheck6">
                      <label for="todoCheck6"></label>
                    </div>
                    <span class="text">Let theme shine like a star</span>
                    <small class="badge badge-secondary"><i class="far fa-clock"></i> 1 month</small>
                    <div class="tools">
                      <i class="fas fa-edit"></i>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>
                </ul>
              </div> -->
              <!-- /.card-body -->
              <!-- <div class="card-footer clearfix">
                <button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add item</button>
              </div>
            </div> -->
            <!-- /.card -->
          <!-- </section> -->
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <!-- <section class="col-lg-5 connectedSortable"> -->

            <!-- Map card -->
            <!-- <div class="card bg-gradient-primary">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Visitors
                </h3> -->
                <!-- card tools -->
                <!-- <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                    <i class="far fa-calendar-alt"></i>
                  </button>
                  <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div> -->
                <!-- /.card-tools -->
              <!-- </div>
              <div class="card-body">
                <div id="world-map" style="height: 250px; width: 100%;"></div>
              </div> -->
              <!-- /.card-body-->
              <!-- <div class="card-footer bg-transparent">
                <div class="row">
                  <div class="col-4 text-center">
                    <div id="sparkline-1"></div>
                    <div class="text-white">Visitors</div>
                  </div> -->
                  <!-- ./col -->
                  <!-- <div class="col-4 text-center">
                    <div id="sparkline-2"></div>
                    <div class="text-white">Online</div>
                  </div> -->
                  <!-- ./col -->
                  <!-- <div class="col-4 text-center">
                    <div id="sparkline-3"></div>
                    <div class="text-white">Sales</div>
                  </div> -->
                  <!-- ./col -->
                <!-- </div> -->
                <!-- /.row -->
              <!-- </div>
            </div> -->
            <!-- /.card -->

            <!-- solid sales graph -->
            <!-- <div class="card bg-gradient-info">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Sales Graph
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div> -->
              <!-- /.card-body -->
              <!-- <div class="card-footer bg-transparent">
                <div class="row">
                  <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">Mail-Orders</div>
                  </div> -->
                  <!-- ./col -->
                  <!-- <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">Online</div>
                  </div> -->
                  <!-- ./col -->
                  <!-- <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">In-Store</div>
                  </div> -->
                  <!-- ./col -->
                <!-- </div> -->
                <!-- /.row -->
              <!-- </div> -->
              <!-- /.card-footer -->
            <!-- </div> -->
            <!-- /.card -->

            <!-- Calendar -->
            <!-- <div class="card bg-gradient-success">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3> -->
                <!-- tools card -->
                <!-- <div class="card-tools"> -->
                  <!-- button with a dropdown -->
                  <!-- <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                      <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a href="#" class="dropdown-item">Add new event</a>
                      <a href="#" class="dropdown-item">Clear events</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">View calendar</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div> -->
                <!-- /. tools -->
              <!-- </div> -->
              <!-- /.card-header -->
              <!-- <div class="card-body pt-0"> -->
                <!--The calendar -->
                <!-- <div id="calendar" style="width: 100%"></div>
              </div> -->
              <!-- /.card-body -->
            <!-- </div> -->
            <!-- /.card -->
          <!-- </section> -->
          <!-- right col -->
        <!-- </div> -->
        <!-- /.row (main row) -->
      <!-- </div>/.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <!-- <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div> -->
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<!-- <script src="plugins/chart.js/Chart.min.js"></script> -->
<!-- Sparkline -->
<!-- <script src="plugins/sparklines/sparkline.js"></script> -->
<!-- JQVMap -->
<!-- <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
<!-- jQuery Knob Chart -->
<!-- <script src="plugins/jquery-knob/jquery.knob.min.js"></script> -->
<!-- daterangepicker -->
<!-- <script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script> -->
<!-- Tempusdominus Bootstrap 4 -->
<!-- <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script> -->
<!-- Summernote -->
<!-- <script src="plugins/summernote/summernote-bs4.min.js"></script> -->
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard.js"></script> -->

<!-- <script src="../VENDOR/jquery/jquery-ui.js"></script> -->
<script src="../VENDOR/pdfjs/pdf.js"></script>
<script src="../VENDOR/plyr/plyr_3.6.12.js"></script>
<script src="../JS/inicio.js"></script>


</body> 
</html>

