<?php
@session_start();

if(!$_SESSION["loggedin"]){

    echo '<script> window.location.href = "index.php"; </script>';

}else {

    echo
        '
<nav id="sidebar">
               <div class="sidebar_blog_1">
                  <div class="sidebar-header">
                     <div class="logo_section">
                        <a href="dashboard.php"><img class="logo_icon img-responsive" src="images/logo/buyout_icon.png" alt="#" /></a>
                     </div>
                  </div>
                  <div class="sidebar_user_info">
                     <div class="icon_setting"></div>
                     <div class="user_profle_side">
                        <div class="user_img"><img class="img-responsive" src="images/layout_img/user_img.jpg" alt="#" /></div>
                        <div class="user_info">
                           <h6>' . $_SESSION["usuario_nome"] . '</h6>
                           <p><span class="online_animation"></span> Online</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="sidebar_blog_2">
                  <h4>Dashboard</h4>
                  <ul class="list-unstyled components">
                     <li class="active">
                        <a href="dashboard.php"><i class="fa fa-dashboard yellow_color"></i> <span>Dashboard</span></a>
                     </li>
                     <li>
                        <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-diamond purple_color"></i> <span>Produtos</span></a>
                        <ul class="collapse list-unstyled" id="element">
                           <li><a href="produtos.php">> <span>Produtos</span></a></li>
                           <li><a href="categorias.php">> <span>Categorias</span></a></li>
                           <li><a href="subcategorias.php">> <span>Subcategorias</span></a></li>
                        </ul>
                     </li>
                     <li>
                        <a href="#apps" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-shopping-cart blue2_color"></i> <span>Compras</span></a>
                        <ul class="collapse list-unstyled" id="apps">
                           <li><a href="compras_recebidas.php">> <span>Compras Recebidas</span></a></li>
                           <li><a href="compras_pendentes.php">> <span>Compras Pendentes</span></a></li>
                           <li><a href="compras_canceladas.php">> <span>Compras Canceladas</span></a></li>
                        </ul>
                     </li>

                     <li><a href="motoristas.php"><i class="fa fa-truck purple_color2"></i> <span>Motoristas</span></a></li>

                     <li>
                        <a href="#utilizadores" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-user blue2_color"></i> <span>Utilizadores</span></a>
                        <ul class="collapse list-unstyled" id="utilizadores">
                           <li><a href="admin_utilizador.php">> <span>Administradores</span></a></li>
                           <li><a href="clientes_utilizador.php">> <span>Clientes</span></a></li>
                           <li><a href="motoristas_utilizador.php">> <span>Motoristas</span></a></li>
                        </ul>
                     </li>
                     <li><a href="#"><i class="fa fa-cog yellow_color"></i> <span>Settings</span></a></li>
                  </ul>
               </div>
            </nav>
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
               <!-- topbar -->
               <div class="topbar">
                  <nav class="navbar navbar-expand-lg navbar-light">
                     <div class="full">
                        <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
                        <div class="logo_section">
                           <a href="dashboard.php"><img class="img-responsive" src="images/logo/buyout.png" alt="#" /></a>
                        </div>
                        <div class="right_topbar">
                           <div class="icon_info">
                              <ul>
                                 <li><a href="#"><i class="fa fa-bell-o"></i><span class="badge">2</span></a></li>
                                 <li><a href="#"><i class="fa fa-question-circle"></i></a></li>
                                 <li><a href="#"><i class="fa fa-envelope-o"></i><span class="badge">3</span></a></li>
                              </ul>
                              <ul class="user_profile_dd">
                                 <li>
                                    <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" src="images/layout_img/user_img.jpg" alt="#" /><span class="name_user">' . $_SESSION["usuario_nome"] . '</span></a>
                                    <div class="dropdown-menu">
                                       <a class="dropdown-item" href="#">My Profile</a>
                                       <a class="dropdown-item" href="#">Settings</a>
                                       <a class="dropdown-item" href="#">Help</a>
                                       <a class="dropdown-item" href="php/controller/sair.php"><span>Log Out</span> <i class="fa fa-sign-out"></i></a>
                                    </div>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </nav>
               </div>

';
}
