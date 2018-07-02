<!DOCTYPE html>
<head>
    <title>Desafios da Turma | Digoreste</title>
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
                
                    <h2 style="font-family: exotc">Desafios da turma</h2></br>
                                        
                    <table id="table" 
                            data-search="true"
                            data-pagination="true"
                            data-id-field="id"
                            data-page-list="[10, 25, 50, 100, ALL]"
                            data-side-pagination="client"
                            data-sort-name="nome"
                            data-sort-order="asc"
                            style="background-color: white">
                    </table>
                    
                    <script>
                        $(document).ready(function(){
                            
                            $("#divoid").hide();
                            var aux = (window.location.href).split("id=");
                            var id = aux[1];
                            
                            function operateFormatter(value, row, index) {
                                return [
                                    '<a class="edit" href="javascript:void(0)" title="Jogar">',
                                    '<i class="glyphicon glyphicon-ok-circle"></i>',
                                    '</a>  '
                                ].join('');
                            }
                            
                            function formatarData(value) {
                                var datadehora = value.split(" ");
                                var dia = datadehora[0];
                                
                                ano = dia.split("-")[0];
                                mes = dia.split("-")[1];
                                odia = dia.split("-")[2];
                                
                                return odia + "-" + mes + "-" + ano + " " + datadehora[1];
                            }
                            
                            window.operateEvents = {
                                "click .edit": function (e, value, row, index) {
                                    var inicio = new Date(row["inicio"]);
                                    var fim = new Date(row["fim"]);
                                    var agora = new Date($.now());
                                    
                                    //convertendo para timestamp
                                    inicio = inicio.getTime();
                                    fim = fim.getTime();
                                    agora = agora.getTime();
                                    
                                    if(agora >= inicio && agora <= fim){
                                        window.location.href = "jogar-desafio.php?id="+row["id"];  
                                    }else{
                                        swal("Verifique o horário do desafio.");
                                    }
                                }
                            };
                            
                            $.ajax({
                                dataType: "json",
                                url: "consultas/desa-list-um.php",
                                data: {turma: id},
                                type: "POST",
                                success: function(result){
                                    if(result.status === "erro"){
                                        swal("Ainda não há desafios para turma.");
                                    }else{
                                        $('#table').bootstrapTable({
                                            columns: [{
                                                field: '0',
                                                title: 'ID',
                                                visible: false
                                            },{
                                                field: "inicio",
                                                title: "Início",
                                                formatter: formatarData,
                                                sortable: true
                                            },{
                                                field: "fim",
                                                title: "Fim",
                                                formatter: formatarData,
                                                sortable: true
                                            },{
                                                field: 'operate',
                                                title: 'Jogar',
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
