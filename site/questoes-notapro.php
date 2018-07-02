<!DOCTYPE html>
<head>
    <title>Em Análise | Digoreste</title>
    <link rel="icon" type="image/png" href="../images/favico.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/style-responsive.css" rel="stylesheet"/>
    <link href="css/bootstrap-table.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="css/font.css" type="text/css"/>
    <link href="css/font-awesome.css" rel="stylesheet"> 
    <link rel="stylesheet" href="css/morris.css" type="text/css"/>
    <link rel="stylesheet" href="css/monthly.css">
    <script src="js/jquery2.0.3.min.js"></script>
    <script src="js/raphael-min.js"></script>
    <script src="js/morris.js"></script>
    <script src="../js/js.cookie.js" type="text/javascript"></script>
    <link href="css/sweetalert2.min.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <section id="container">
        <?php include "header.php"; ?>
        <?php include "sidebar.php"; ?>

        <section id="main-content">
            <section class="wrapper">
                <div class="agile-grid">
                
                    <h2 style="font-family: exotc">Questões em Análise (não aprovadas)</h2></br>
                    
                    <table id="table" 
                            data-toolbar="#toolbar"
                            data-search="true"
                            data-pagination="true"
                            data-id-field="id"
                            data-detail-view="true"
                            data-detail-formatter="detailFormatter"
                            data-page-list="[10, 25, 50, 100, ALL]"
                            data-side-pagination="client"
                            data-sort-name="nome"
                            data-sort-order="asc"
                            style="background-color: white">
                    </table>
                    
                    <script>
                        
                        function detailFormatter(index, row) {
                            var html = [];
                            $.each(row["opcoes"], function (key, value) {
                                var certa = "";
                                if(value["correta"] === "s"){
                                    certa = "<b> - opção correta</b>";
                                }
                                html.push("<b>Opção " + (key+1) + ":</b> " + value["descricao"] + certa + "<br/>");
                            });
                            return html.join('');
                        }

                        function operateFormatter(value, row, index) {
                            return [
                                '<a class="edit" href="javascript:void(0)" title="Aprovar">',
                                '<i class="glyphicon glyphicon-ok"></i>',
                                '</a>  ',
                                '<a class="remove" href="javascript:void(0)" title="Excluir">',
                                '<i class="glyphicon glyphicon-remove"></i>',
                                '</a>'
                            ].join('');
                        }

                        window.operateEvents = {
                            "click .edit": function (e, value, row, index) {
                                swal({
                                    title: "Aprovar questão?",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Sim",
                                    cancelButtonText: "Cancelar"
                                }).then(function () {
                                    $.ajax({
                                        dataType: "json",
                                        url: "consultas/quest-apro.php",
                                        type: "POST",
                                        data: {id: row["0"]},
                                        success: function(){
                                            swal(
                                                'Aprovada!',
                                                'A questão agora está disponível no jogo.',
                                                'success'
                                              ).then(function(){
                                                  location.reload();
                                              });
                                        }
                                    });
                                });
                            },
                            "click .remove": function (e, value, row, index) {
                                swal({
                                    title: "Tem certeza?",
                                    text: "Essa ação não pode ser revertida.",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Sim, apagar.",
                                    cancelButtonText: "Cancelar"
                                }).then(function () {
                                    $.ajax({
                                        dataType: "json",
                                        url: "consultas/quest-excl.php",
                                        type: "POST",
                                        data: {id: row["0"]},
                                        success: function(){
                                            swal(
                                                'Apagado!',
                                                'A questão foi removida.',
                                                'success'
                                              ).then(function(){
                                                  location.reload();
                                              });
                                        }
                                    });
                                });
                            }
                        };
                        
                        $(document).ready(function(){
                            $.ajax({
                                dataType: "json",
                                url: "consultas/ques-list-notapro.php",
                                type: "POST",
                                success: function(result){
                                    if(result.status === "erro"){
                                        swal("Não há questões para análise de aprovação.");
                                    }else{
                                        
                                        $('#table').bootstrapTable({
                                            columns: [{
                                                field: '0',
                                                title: 'ID',
                                                sortable: true
                                            }, {
                                                field: 'pergunta',
                                                title: 'Pergunta',
                                                sortable: true
                                            },{
                                                field: "dica",
                                                title: "Dica",
                                                sortable: true
                                            }, {
                                                field: "otema",
                                                title: "Tema",
                                                sortable: true
                                            }, {
                                                field: "ouser",
                                                title: "Sugerido por",
                                                sortable: true
                                            },{
                                                field: 'operate',
                                                title: 'Operações',
                                                align: 'center',
                                                events: operateEvents,
                                                formatter: operateFormatter
                                            }],
                                            data: result.mensagem
                                        });
                                        
                                    }
                                }
                            });
                            
                            
                        });
                    </script>
                    
                </div>
            </section>
            <?php include "footer.php"; ?>
        </section>
    </section>

    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap-table.js" type="text/javascript"></script>
    <script src="js/bootstrap-table-pt-BR.min.js" type="text/javascript"></script>
    <script src="js/sweetalert2.all.min.js" type="text/javascript"></script>
    <!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>    
    <script src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="js/jquery.scrollTo.js"></script>
</body>
</html>
