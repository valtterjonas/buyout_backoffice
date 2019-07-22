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
    <!-- site icon -->
    <link rel="icon" href="images/logo/buyout_icon.png" type="image/png" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- site css -->
    <link rel="stylesheet" href="style.css" />
    <!-- responsive css -->
    <link rel="stylesheet" href="css/responsive.css" />
    <!-- color css -->

    <!-- select bootstrap -->
    <link rel="stylesheet" href="css/bootstrap-select.css" />
    <!-- scrollbar css -->
    <link rel="stylesheet" href="css/perfect-scrollbar.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="css/custom.css" />

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
                                <h2>Produtos da Compra</h2>
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
                                        <h2>Tabela de Produtos da Compra</h2>

                                    </div>

                                </div>


                                <div class="table_section padding_infor_info">

                                    <div class="table-responsive-sm">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nome do Produto</th>
                                                <th>Quantidade</th>
                                                <th>Preço Unitário</th>
                                                <th>Preço</th>


                                            </tr>
                                            </thead>
                                            <tbody id="t_tabela">



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
    <div class="modal fade" id="produtosCompra">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Produtos da Compra</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">

                    <div class="table_section padding_infor_info">

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


<script>


    var token = getUrlParameter("token");

    //alert(token);

    $.ajax({
        url: "php/controller/pesquisar/pesquisar_produtos_compra.php",
        type: "POST",
        data: {
            compra_id:token
        },
        beforeSend: function(){
            $('#carregamento').css("display","block");
        },
        complete: function(){
            $('#carregamento').css("display","none");
        },
        success: function (data) {

            //alert(data);

            var result = JSON.parse(data);

            var html = "";

            for(var i in result){

                html += "<tr>" +
                    "<td>"+result[i].produto_id+"</td>" +
                    "<td>"+result[i].produto_nome+"</td>" +
                    "<td>"+result[i].quantidade+"</td>" +
                    "<td>"+result[i].preco_unit+"</td>" +
                    "<td>"+result[i].preco_total+"</td>" +
                    "</tr>";

            }

            $('#t_tabela').html(html)


        },
        error: function (e) {
//                            $("#err").html(e).fadeIn();
        }
    });


    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    };

</script>


</body>
</html>