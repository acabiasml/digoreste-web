<!DOCTYPE html>
<head>
    <title>Treino | Digoreste</title>
    <link rel="icon" type="image/png" href="../images/favico.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/style-responsive.css" rel="stylesheet"/>
    <link href="css/bootstrap-table.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="css/font.css" type="text/css"/>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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

        <div style="visibility:hidden">
            <audio autoplay loop>
                <source src="audio.mp3">
            </audio>
        </div>
        
        <section id="main-content">
            <section class="wrapper">
                <div class="agile-grid" id="campo">
                    <form role="form" id="salvar">
                        <h1 style="font-family: exotc">Treino</h1></br>

                        <div class="panel-body">
                            <h1 id="pergunta">?</h1><br/>
                            <div class="row" id="clicaveis"></div>
                        </div>

                        <button class="btn btn-danger" id="pular" style="font-size:large;">Pular</button>
                    </form>
                    <script>
                        
                        function pergunta(){
                            $.ajax({
                                    dataType: "json",
                                    url: "consultas/pergunta.php",
                                    type: "POST",
                                    success: function(result){
                                        $("#perfil")
                                            .empty()
                                            .append('<option selected="selected" value="-1">Selecione</option>')
                                        ;
                                        $("#clicaveis").html("");
                                        $.each(result.mensagem, function (i, item) {
                                            $("#pergunta").html(item.descricao);
                                            
                                            $.each(item.opcoes, function (j, jitem) {
                                                $("#clicaveis").append("<div class='col-md-6' style='margin-bottom: 20px'><a href='#' id='"+jitem.correta+"' class='w3-button w3-block w3-teal resposta' style='white-space: normal;font-size:larger;'>"+jitem.descricao+"</a></div>");
                                            });
                                        });
                                    }
                                });
                        }
                        
                        $(document).ready(function () {
                            
                            pergunta();
                            
                            $("#salvar").submit(function(e) {
                                e.preventDefault();
                            });
                            
                            $("#pular").click(function(){
                                pergunta();
                            });
                            
                            $("body").on("click", "a.resposta", function(){                                
                                if($(this).attr("id") === "s"){
                                    swal(
                                        'Bom trabalho',
                                        'Você acertou! =D',
                                        'success'
                                    ).then(function(){
                                        var valor = $("#pontos").html();
                                        $("#pontos").html(parseInt(valor) + 1);
                                        pergunta();
                                    });    
                                }else{
                                    swal(
                                        'Eita',
                                        'Você errou :(',
                                        'error'
                                    ).then(pergunta()); 
                                }
                            });
                        });
                    </script>

                </div>
                <br/>
                <div class="row" style="margin-left: 14px">
                    <p style="font-weight: bolder; color: blue">Pontos: <span id="pontos" style="color:red">0</span></p>
                </div>
                
            </section>
            <?php include "footer.php"; ?>
        </section>
    </section>

    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap-table.js" type="text/javascript"></script>
    <script src="js/bootstrap-table-pt-BR.min.js" type="text/javascript"></script>
    <script src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/sweetalert2.all.min.js" type="text/javascript"></script>
    <!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="js/jquery.scrollTo.js"></script>
</body>
</html>
