<!DOCTYPE html>
<head>
    <title>Turma | Digoreste</title>
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

                    <h2 style="font-family: exotc">Turma</h2></br>

                    <div class="panel-body">
                        <div class="">
                            <form role="form" id="salvar">
                                <div class="form-group">
                                    <label>Descrição</label>
                                    <input type="text" class="form-control" id="descricao">
                                </div>
                                <div class="form-group">
                                    <label>Senha</label>
                                    <input type="password" class="form-control" id="senha">
                                </div>
                                <button id="cancelar" class="btn btn-danger">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </form>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function () {
                            
                            $("#salvar").submit(function(e) {
                                e.preventDefault();
                                
                                var descricao = $.trim($("#descricao").val());
                                var senha = $.trim($("#senha").val());
                                
                                if(descricao === "" || senha === ""){
                                    swal("Existem campos a serem preenchidos!");
                                }else{
                                    $.ajax({
                                        dataType: "json",
                                        url: "consultas/turm-inse.php",
                                        type: "POST",
                                        data: {descricao: descricao, 
                                                senha: senha, usuario: Cookies.get("usuarioid")},
                                        success: function(result){
                                            swal("Nova turma criada com sucesso!").then(function(){
                                                window.location.href = "index.php";
                                            });
                                        }
                                    });

                                }
                                
                            });
                            
                            $("#cancelar").click(function(){
                                parent.history.back();
                                return false;
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
