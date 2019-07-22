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
    <title>Buyout - Backoffice</title>
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
    <!-- fancy box js -->
    <link rel="stylesheet" href="css/jquery.fancybox.css" />
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

        <!-- JQuery DataTable Css -->
    <link href="modules/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <![endif]-->
</head>
<body class="inner_page tables_page">
<div class="full_container">
    <div class="inner_container">

        <?php

        include_once ('aside.php');


        ?>


            <!-- end topbar -->
            <!-- dashboard inner -->
            <div class="midde_cont">
                <div class="container-fluid">
                    <div class="row column_title">
                        <div class="col-md-12">
                            <div class="page_title">
                                <h2>Administradores</h2>
                            </div>
                        </div>
                    </div>
                    <!-- row -->
                    <div class="row">

                        <!-- table section -->
                        <div class="col-md-12">
                            <div class="white_shd full margin_bottom_30">
                                <div class="full graph_head">
                                    <div class="heading1 margin_0">
                                        <h2>Tabela de Administradores</h2>

                                    </div>
                                    <div class="button_block"><button type="button" data-target="#adicionarUtilizadorModal" data-toggle="modal" class="pull-right btn cur-p btn-primary">Adicionar Administrador</button></div>

                                </div>


                                <div class="table_section padding_infor_info">

                                    <div class="table-responsive-sm">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>Contacto</th>
                                                <th>Endereço</th>
                                                <th>Ultimo login</th>
                                                <th>Estado</th>
                                                <th>Data de Criação</th>
                                                <th>Acção</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php


                                            include_once ("php/controller/pesquisar/pesquisar_utilizador.php");

                                            listarUtilizador(1);


                                            ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer -->
                <?php

                include_once ('footer.php');


                ?>
            </div>
            <!-- end dashboard inner -->
        </div>
    </div>
    <!-- model popup -->
    <!-- The Modal -->
    <div class="modal fade" id="adicionarUtilizadorModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar Administrador do Sistema</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">


                    <form id="formAdicionar" method="post" action="php/controller/adicionar/add_utilizador.php">

                        <div class="form-row">


                            <div class="form-group col-md-12">
                                <input type="text" name="u_nome" id="u_nome" class="form-control" placeholder="Nome do Utilizador">
                            </div> <!-- form-group end.// -->

                            <div class="form-group col-md-12">
                                <input type="text" name="u_email" id="u_email" class="form-control" placeholder="Email">
                            </div> <!-- form-group end.// -->

                            <div class="form-group col-md-12">
                                <input type="password" name="u_senha" id="u_senha" class="form-control" placeholder="Senha">
                            </div> <!-- form-group end.// -->

                            <div class="form-group col-md-12">
                                <input type="password" name="u_resenha" id="u_resenha" class="form-control" placeholder="Repetir Senha">
                            </div> <!-- form-group end.// -->

                            <div class="form-group col-md-12">
                                <input type="number" name="u_grupo" id="u_grupo" value="1" class="form-control" placeholder="Nome do Produto" readonly>
                            </div> <!-- form-group end.// -->

                            <div class="col-md-12 form-group">
                                <input type="number" name="u_contacto" id="u_contacto" class="form-control" placeholder="Contacto">
                            </div> <!-- form-group end.// -->

                            <div class="col-md-12 form-group">
                                <input type="text" name="u_endereco" id="u_endereco" class="form-control" placeholder="Endereço">
                            </div> <!-- form-group end.// -->


                        </div> <!-- form-row end.// -->



                        <div class="form-group  col-md-12 ">
                            <button type="submit" id="bt_gravar" class="btn btn-primary btn-block"> Adicionar Administrador <i class="fa fa-plus"></i> </button>
                        </div> <!-- form-group// -->

                    </form>




                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="actualizarPassword">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar Password</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">


                    <form id="formActualizarSenha" method="post" action="php/controller/actualizar/actualizar_password.php">

                        <div class="form-row">


                            <div class="form-group col-md-12">
                                <input type="password" name="u_senha" id="act_u_senha" class="form-control" placeholder="Senha">
                            </div> <!-- form-group end.// -->

                            <div class="form-group col-md-12">
                                <input type="password" name="u_resenha" id="act_u_resenha" class="form-control" placeholder="Repetir Senha">
                            </div> <!-- form-group end.// -->

                            <div class="form-group col-md-12 hidden">
                                <input type="number" name="u_id" id="u_id" class="form-control"  readonly>
                            </div> <!-- form-group end.// -->



                        </div> <!-- form-row end.// -->



                        <div class="form-group  col-md-12 ">
                            <button type="submit" id="bt_gravar" class="btn btn-primary btn-block"> Alterar Senha <i class="fa fa-edit"></i> </button>
                        </div> <!-- form-group// -->

                    </form>




                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="desactivarUtilizador">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Desactivar utilizador?</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">


                    <form id="formDesactivarUtilizador" method="post" action="php/controller/actualizar/desactivar_utilizador.php">

                        <div class="form-row">

                            <div class="form-group col-md-12 hidden">
                                <input type="number" name="u_id2" id="u_id2" class="form-control"  readonly>
                            </div> <!-- form-group end.// -->



                        </div> <!-- form-row end.// -->



                        <div class="form-group  col-md-12 ">
                            <button type="submit" id="bt_gravar" class="btn btn-danger btn-block"> Remover Utilizador <i class="fa fa-edit"></i> </button>
                        </div> <!-- form-group// -->

                    </form>




                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end model popup -->



</div>
<!-- jQuery -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- wow animation -->
<script src="js/animate.js"></script>
<!-- select country -->
<script src="js/bootstrap-select.js"></script>
<!-- owl carousel -->
<script src="js/owl.carousel.js"></script>
<!-- chart js -->
<script src="js/Chart.min.js"></script>
<script src="js/Chart.bundle.min.js"></script>
<script src="js/utils.js"></script>
<script src="js/analyser.js"></script>
<!-- nice scrollbar -->
<script src="js/perfect-scrollbar.min.js"></script>
<script>
    var ps = new PerfectScrollbar('#sidebar');
</script>
<!-- fancy box js -->

<script src="js/jquery.fancybox.min.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>
<!-- calendar file css -->
<script src="js/semantic.min.js"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="modules/jquery-datatable/jquery.dataTables.js"></script>
<script src="modules/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="modules/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="modules/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="modules/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="modules/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="modules/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="modules/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="modules/jquery-datatable/extensions/export/buttons.print.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>

    $('#actualizarPassword').on('show.bs.modal', function (e) {

        var data = $(e.relatedTarget).data('id');

        $('#u_id').val(data);

    });


    $('#desactivarUtilizador').on('show.bs.modal', function (e) {

        var data = $(e.relatedTarget).data('id');

        $('#u_id2').val(data);

    });


    $("#formAdicionar").on('submit',(function(e) {
        e.preventDefault();

        var action = $("#formAdicionar").attr('action');

        alert("Validate");

        var u_nome = $('#u_nome').val();
        var u_email = $('#u_email').val();
        var u_senha = $('#u_senha').val();
        var u_resenha = $('#u_resenha').val();
        var u_grupo = $('#u_grupo').val();
        var u_contacto = $('#u_contacto').val();
        var u_endereco = $('#u_endereco').text();

        alert(u_grupo);

        if(u_nome === "" || u_email === "" || u_senha === "" || u_resenha === ""){
            swal({
                title: "Aviso!",
                text: "Os campos devem ser preenchidos com dados válidos!",
                icon: "warning",
                button: "Ok!"
            });
        }else if(u_senha !== u_resenha){
            swal({
                title: "Aviso!",
                text: "As senhas não correspondem!",
                icon: "warning",
                button: "Ok!"
            });
        }else {

            $.ajax({
                url: action,
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function(){
                    $('#carregamento').css("display","block");
                },
                complete: function(){
                    $('#carregamento').css("display","none");
                },
                success: function (data) {


                    var result = JSON.parse(data);

                    if (result.estado === 'sucesso') {


                        $('#img1').attr('src', 'http://placehold.it/120x120');


                        swal({
                            title: "Óptimo, Utilizador registado!",
                            icon: "success",
                            button: "Ok!"
                        }).then(function () {

                           // $('#adicionarUtilizadorModal').modal('toggle');

                            window.location.reload(true);

                        });


                    }
                    else {
                        swal({
                            title: "Erro, o utilizador não foi criado!",
                            icon: "error",
                            button: "Ok!"
                        });
                    }
                },
                error: function (e) {
//                            $("#err").html(e).fadeIn();
                }
            });
        }
    }));

    $("#formActualizarSenha").on('submit',(function(e) {
        e.preventDefault();

        var action = $("#formActualizarSenha").attr('action');



        var u_senha = $('#act_u_senha').val();
        var u_resenha = $('#act_u_resenha').val();


        alert(u_grupo);

        if(u_senha === "" || u_resenha === ""){
            swal({
                title: "Aviso!",
                text: "Os campos devem ser preenchidos com dados válidos!",
                icon: "warning",
                button: "Ok!"
            });
        }else if(u_senha !== u_resenha){
            swal({
                title: "Aviso!",
                text: "As senhas não correspondem!",
                icon: "warning",
                button: "Ok!"
            });
        }else {

            $.ajax({
                url: action,
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function(){
                    $('#carregamento').css("display","block");
                },
                complete: function(){
                    $('#carregamento').css("display","none");
                },
                success: function (data) {


                    var result = JSON.parse(data);

                    if (result.estado === 'sucesso') {

                        swal({
                            title: "Óptimo, Utilizador actualizado!",
                            icon: "success",
                            button: "Ok!"
                        }).then(function () {

                           // $('#adicionarUtilizadorModal').modal('toggle');

                            window.location.reload(true);

                        });


                    }
                    else {
                        swal({
                            title: "Erro, o utilizador não foi actualizado!",
                            icon: "error",
                            button: "Ok!"
                        });
                    }
                },
                error: function (e) {
//                            $("#err").html(e).fadeIn();
                }
            });
        }
    }));

    $("#formDesactivarUtilizador").on('submit',(function(e) {
        e.preventDefault();

        var action = $("#formDesactivarUtilizador").attr('action');



            $.ajax({
                url: action,
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function(){
                    $('#carregamento').css("display","block");
                },
                complete: function(){
                    $('#carregamento').css("display","none");
                },
                success: function (data) {


                    var result = JSON.parse(data);

                    if (result.estado === 'sucesso') {


                        $('#img1').attr('src', 'http://placehold.it/120x120');


                        swal({
                            title: "Óptimo, Utilizador registado!",
                            icon: "success",
                            button: "Ok!"
                        }).then(function () {

                           // $('#adicionarUtilizadorModal').modal('toggle');

                            window.location.reload(true);

                        });


                    }
                    else {
                        swal({
                            title: "Erro, o utilizador não foi criado!",
                            icon: "error",
                            button: "Ok!"
                        });
                    }
                },
                error: function (e) {
//                            $("#err").html(e).fadeIn();
                }
            });

    }));


</script>


</body>
</html>