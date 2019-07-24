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
        <!-- Sidebar  -->

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
                                <h2>Produtos</h2>
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
                                        <h2>Tabela de Produtos</h2>

                                    </div>

                                    <div class="button_block"><a href="novo_produto.php" class="pull-right btn cur-p btn-primary">Adicionar Produto</a></div>

                                </div>


                                <div class="table_section padding_infor_info">

                                    <div class="table-responsive-sm">
                                        <table class="table">
                                            <thead>

                                            <tr>
                                                <th>#</th>
                                                <th>Nome</th>
                                                <th>Descrição</th>
                                                <th>Preço</th>
                                                <th>Último Preço</th>
                                                <th>Desconto</th>
                                                <th>SubCategoria</th>
                                                <th>Imagem</th>
                                                <th>Data de Criação</th>
                                                <th>Opções</th>

                                            </tr>

                                            </thead>

                                            <tbody>

                                            <?php


                                            include_once ("php/controller/pesquisar/pesquisar_produto.php");

                                            listarProdutos();


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
    <div class="modal fade" id="imagemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Imagem do Produto</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">


                    <div class="row">

                        <div class="col-md-8">

                            <img src="" class="img-box" id="imagem" style="width: 400px; height: 350px">

                        </div>

                        <div class="col-md-4">

                            <form id="formAlterarFoto" action="php/controller/actualizar/editar_foto_produto.php">

                                <div class="col-md-12 form-group">
                                    <span>Editar foto do Produto</span>
                                    <label class=newbtn>
                                        <img id="img1" src="http://placehold.it/120x120" height="120px" width="120px">
                                        <input id="p_imagem" name="p_imagem" class='pis form-control' onchange="readURL(this);" type="file" accept="image/*">
                                    </label>
                                </div>

                                <div class="col-md-12 form-group hidden">
                                    <input name="p_id" id="p_id" class="form-control">
                                </div> <!-- form-group end.// -->


                                <div class="form-group  col-md-12 ">
                                    <button type="submit" id="bt_editar_foto" class="btn btn-primary btn-block"> Editar Foto <i class="fa fa-edit"></i> </button>
                                </div> <!-- form-group// -->

                            </form>

                        </div>


                    </div>


                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end model popup -->
</div>
<!-- jQuery -->
<script src="js/jquery/jquery.min.js"></script>
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
<!--<script src="js/jquery-3.3.1.min.js"></script>-->
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

    $('#imagemModal').on('show.bs.modal', function (e) {

        var data = $(e.relatedTarget).data('id');
        var produto = $(e.relatedTarget).data('produto');


       $('#imagem').attr('src','images/produtos/'+data);
       $('#p_id').val(produto);

    });


    function goToEditar(p_id){

        sessionStorage.setItem("p_id",p_id);

        window.location.href = 'editar_produto.php'

    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            var id = $(input).attr("id");
            var img = '';


            if(id === 'p_imagem'){

                //alert('In');

                reader.onload = function (e) {
                    $('#img1')
                        .attr('src', e.target.result);
                };

            }


            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#formAlterarFoto").on('submit',(function(e) {
        e.preventDefault();

        var action = $("#formAlterarFoto").attr('action');

        var pic = $('#p_imagem').val();


        if(pic === ""){
            swal({
                title: "Aviso!",
                text: "Os campos devem ser preenchidos com dados válidos!",
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

                    //alert(data);

                    var result = JSON.parse(data);

                    if (result.estado === 'sucesso') {

                        swal({
                            title: "Óptimo, Produto actualizado!",
                            icon: "success",
                            button: "Ok!"
                        }).then(function () {

                            history.back();

                        });


                    }
                    else {
                        swal({
                            title: "Erro, o produto não foi actualizado!",
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



</script>


</body>
</html>