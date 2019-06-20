<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Buyout - Login</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- site icon -->
       <link rel="icon" href="images/logo/buyout_icon.png" type="image/png" />
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <!-- site css -->
      <link rel="stylesheet" href="style.css" />
      <!-- responsive css -->
      <link rel="stylesheet" href="css/responsive.css" />
      <!-- color css -->
      <link rel="stylesheet" href="css/colors.css" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="css/bootstrap-select.css" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="css/perfect-scrollbar.css" />
      <!-- custom css -->
      <link rel="stylesheet" href="css/custom.css" />
      <!-- calendar file css -->
      <link rel="stylesheet" href="js/semantic.min.css" />
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body class="inner_page login">
      <div class="full_container">
         <div class="container">
            <div class="center verticle_center full_height">
               <div class="login_section">
                  <div class="logo_login">
                     <div class="center">

                         <h1 class="text-white" >Buyout - Login</h1>

                     </div>
                  </div>
                  <div class="login_form">
                     <form id="formLogin" action="php/controller/login.php">
                        <fieldset>
                           <div class="field">
                              <label class="label_field">Email Address</label>
                              <input type="email" id="username" name="username" placeholder="E-mail" />
                           </div>
                           <div class="field">
                              <label class="label_field">Password</label>
                              <input type="password" id="password" name="password" placeholder="Password" />
                           </div>
                           <div class="field">
                              <label class="label_field hidden">hidden label</label>
                              <label class="form-check-label"><input type="checkbox" class="form-check-input"> Remember Me</label>
                              <a class="forgot" href="">Forgotten Password?</a>
                           </div>
                           <div class="field margin_0">
                              <label class="label_field hidden">hidden label</label>
                              <button type="button" class="main_bt" id="bt_login">Sign In</button>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- jQuery -->
      <script src="js/jquery/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="js/animate.js"></script>
      <!-- select country -->
      <script src="js/bootstrap-select.js"></script>
      <!-- nice scrollbar -->


      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

      <script>

          $('#bt_login').on('click', function () {


              var nome = $('#username').val();
              var email = $('#password').val();


              if(nome === "" || email === ""){
                  swal({
                      title: "Campos vazios!",
                      text: "Preencha todos campos obrigatórios!",
                      icon: "warning",
                      button: "Ok!"
                  });
              }else{

                  var form = $('#formLogin');

                  $.ajax({
                      type: "POST",
                      url: form.attr('action'),
                      data: form.serialize(),
                      beforeSend: function(){
                          $('#carregamento').css("display","block");
                      },
                      complete: function(){
                          $('#carregamento').css("display","none");
                      },
                      success: function (response) {

                          alert(response);

                          var result = JSON.parse(response);

                          if (result.estado === 'sucesso') {

                              if (result.tipo === 'admin') {

                                window.location.href = 'dashboard.php';

                              }


                          } else if (result.estado === 'invalido') {

                              swal({
                                  title: "A combinação não corresponde!",
                                  text: "Verifique o seu username e password",
                                  icon: "warning",
                                  button: "Tentar novamente!"
                              });

                          } else if (result.estado === 'pendente') {

                              swal({
                                  title: "Utilizador não confirmado!",
                                  text: "Verifique o seu email",
                                  icon: "warning",
                                  button: "Ok!"
                              });

                          } else {

                              swal({
                                  title: "Erro!",
                                  text: "Contacte o administrador",
                                  icon: "warning",
                                  button: "Tentar novamente!"
                              });
                          }


                      },
                      error: function () {

                          alert("ocorreu um erro");

                          return false;
                      }
                  });




              }


          });


      </script>



   </body>
</html>