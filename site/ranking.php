<!DOCTYPE html>
<head>
    <title>Ranking | Digoreste</title>
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
</head>
<body>
    <section id="container">
        <?php include "header.php"; ?>
        <?php include "sidebar.php"; ?>

        <section id="main-content">
            <section class="wrapper">
                <div class="agile-grid">
                
                    <h1 style="font-family: exotc">Ranking</h1></br>
                    
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
                    
                </div>
            </section>
            <?php include "footer.php"; ?>
        </section>
    </section>

    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap-table.js" type="text/javascript"></script>
    <script src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="js/jquery.scrollTo.js"></script>
    <script>
        $(document).ready(function () {
            var aux = (window.location.href).split("id=");
            var id = aux[1];
            
            setInterval(function() {
                //recarrega a página depois de cinco segundos
                location.reload();
            }, 5000);
            
            
            function indice(value, row, index) {
                return index + 1;
            }
            
            $.ajax({
                dataType: "json",
                url: "consultas/gerar-ranking.php",
                data: {id: id},
                type: "POST",
                success: function(result){
                    if(result.status === "erro"){
                        swal("Ocorreu um erro na geração do ranking.");
                    }else{
                        $('#table').bootstrapTable({
                            columns: [{
                                title: "Lugar",
                                formatter: indice
                            },{
                                field: "nome",
                                title: "Nome",
                                sortable: true
                            },{
                                field: "pontos",
                                title: "Pontos",
                                sortable: true
                            }],
                            data: result.mensagem,
                            sortName: "pontos",
                            sortOrder: "desc"
                        });
                    }
                }
            });
        });
    </script>
</body>
</html>
