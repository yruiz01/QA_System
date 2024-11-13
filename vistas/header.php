<?php 
if (strlen(session_id())<1) 
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Qachuu Aloom</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../public/img/favicon.ico">

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">    
    <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">

    <!-- Estilos personalizados para el logo -->
    <style>
      /* Ajustes para el mini logo (cuando el sidebar está comprimido) */
      .img-logo-mini {
          width: 100%; /* Ocupa el 100% del espacio disponible */
          height: auto; /* Mantener la proporción de la imagen */
          display: block;
          max-height: 50px; /* Asegura que el logo no sea más alto de 50px */
      }

      /* Ajustes para el logo completo (cuando el sidebar está expandido) */
      .img-logo-lg {
          max-width: 30px; /* Tamaño del logo completo */
          height: auto; /* Mantener la proporción de la imagen */
          display: inline-block; /* Para alinearlo con el texto */
          margin-right: 10px; /* Espacio entre el logo y el texto */
      }

      /* Posicionamiento del título Qachuu Aloom */
      .logo-lg span {
          font-size: 18px;
          font-weight: bold;
          display: inline-block;
          vertical-align: middle;
          color: #fff; /* Cambiar el color del texto */
      }

      /* Estilo para el contenedor del logo mini (comprimido) */
      .logo-mini {
          width: 50px; /* Tamaño del contenedor en la vista comprimida */
          display: flex;
          align-items: center; /* Centra la imagen verticalmente */
          justify-content: center; /* Centra la imagen horizontalmente */
      }

      /* Estilo para el contenedor del logo completo (expandido) */
      .logo-lg {
          display: flex;
          align-items: center; /* Centra el logo y el texto verticalmente */
          justify-content: flex-start; /* Alinea el logo y el texto a la izquierda */
          padding: 10px; /* Espacio alrededor del logo y el texto */
      }
    </style>
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">


    <header class="main-header">
      <!-- Logo -->
      <a href="escritorio.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
          <img src="../public/img/logo-mini.png" alt="Mini Logo" class="img-logo-mini">
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
          <img src="../public/img/logo.png" alt="Logo Completo" class="img-logo-lg">
          <span>QA SYSTEM</span>
        </span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Navegación</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $_SESSION['nombre']; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" class="img-circle" alt="User Image">

                  <p>
                    <?php echo $_SESSION['nombre'].' '.$_SESSION['cargo']; ?>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="../vistas/perfil.php" class="btn btn-default btn-flat">Perfil</a>
                  </div>
                  <div class="pull-right">
                    <a href="../ajax/usuario.php?op=salir" class="btn btn-default btn-flat">Salir</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->

          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
       
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

        <br>
        <?php 
        if ($_SESSION['escritorio']==1) {
          echo ' <li><a href="escritorio.php"><i class="fa  fa-dashboard (alias)"></i> <span>Escritorio</span></a>
            </li>';
        }

        if ($_SESSION['grupos']==1) {
          echo '<li class="treeview">
                <a href="#">
                  <i class="fa fa-calendar"></i> <span>Calendario</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="calendario.php"><i class="fa fa-circle-o"></i>  Ver Calendario</a></li>
                </ul>
              </li>';
        }


        ?> 


        <?php 
        if ($_SESSION['grupos']==1) {
          echo '<li class="treeview">
                <a href="#">
                  <i class="fa fa-sitemap"></i> <span>Comunidades</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="grupos.php"><i class="fa fa-circle-o"></i> Grupos</a></li>
                </ul>
              </li>';
        }
        ?>


        <?php
        if(isset($_GET["idgrupo"])):?>
        <li class="treeview">
        <a href="#">
          <i class="fa fa-check"></i> <span>Asistencia</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
        <li><a href="conducta.php?idgrupo=<?php echo $_GET["idgrupo"]; ?>"><i class="fa fa-circle-o"></i> Agregar</a></li>
        </ul>
      </li>
        <li class="treeview">
        <a href="#">
          <i class="fa fa-tasks"></i> <span>Asignacion a Proyectos</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
        <li><a href="calificaciones.php?idgrupo=<?php echo $_GET["idgrupo"]; ?>"><i class="fa fa-circle-o"></i> Asignacion</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-th-large"></i> <span> Ver Actividades</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
        <li><a href="actividad.php?idgrupo=<?php echo $_GET["idgrupo"]; ?>"><i class="fa fa-circle-o"></i> Agregar</a></li>
        </ul>
      </li>
        <li class="treeview">
        <a href="#">
          <i class="fa fa-th-large"></i> <span>Proyectos</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
        <li><a id="btncursos" href="cursos.php?idgrupo=<?php echo $_GET["idgrupo"]; ?>"><i class="fa fa-circle-o"></i> Agregar</a></li>
        </ul>
      </li>
        <li class="treeview">
        <a href="#">
          <i class="fa fa-th-list"></i> <span>Listas</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
        <li><a id="btnlistas" href="listasis.php?idgrupo=<?php echo $_GET["idgrupo"]; ?>"><i class="fa fa-circle-o"></i> Agregar</a></li>
        </ul>
      </li>
        <?php endif; ?>


        <?php 
        if ($_SESSION['acceso']==1) {
          echo '  <li class="treeview">
                <a href="#">
                  <i class="fa fa-users"></i> <span>Acceso</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="usuario.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                  <li><a href="permiso.php"><i class="fa fa-circle-o"></i> Permisos</a></li>
                </ul>
              </li>';
        }
        ?> 
      
        <li><a href="https://www.canva.com/design/DAGTHDu637A/m0HJOpjIDFhj8ASkunaJ4g/edit?utm_content=DAGTHDu637A&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton"><i class="fa fa-question-circle"></i> <span>Ayuda</span><small class="label pull-right bg-yellow"></small></a></li>
        <li><a href="https://www.qachuualoom.org" target="_blanck"><i class="fa  fa-exclamation-circle"></i> <span>Acerca de</span><small class="label pull-right bg-yellow"></small></a></li>   
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
