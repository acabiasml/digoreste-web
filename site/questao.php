<!DOCTYPE html>
<head>
    <title>Questão | Digoreste</title>
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

                    <h2 style="font-family: exotc">Questão</h2></br>

                    <div class="panel-body">
                        <div class="">
                            <form role="form" id="salvar">
                                <div class="form-group">
                                    <label>Descrição</label>
                                    <input type="text" class="form-control" id="descricao">
                                </div>
                                <div class="form-group">
                                    <label>Dica</label>
                                    <input type="text" class="form-control" id="dica">
                                </div>
                                <div class="row" style="background-color: white">
                                    <p style="font-size: medium; margin: 15px 15px 15px 15px;"><b>Alternativas</b></p>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="margin-right: 10px;">1</label>
                                            <input type="checkbox" class="check" id="ch1" value="alt1"> correta
                                            <input type="text" class="form-control" id="alt1">
                                        </div>
                                        <div class="form-group">
                                            <label style="margin-right: 10px;">2</label>
                                            <input type="checkbox" class="check" id="ch2" value="alt2"> correta
                                            <input type="text" class="form-control" id="alt2">
                                        </div>
                                        <div class="form-group">
                                            <label style="margin-right: 10px;">3</label>
                                            <input type="checkbox" class="check" id="ch3" value="alt3"> correta
                                            <input type="text" class="form-control" id="alt3">
                                        </div>
                                    </div>
                                    <aside class="col-md-6">
                                        <div class="form-group">
                                            <label style="margin-right: 10px;">4</label>
                                            <input type="checkbox" class="check" id="ch4" value="alt4"> correta
                                            <input type="text" class="form-control" id="alt4">
                                        </div>
                                        <div class="form-group">
                                            <label style="margin-right: 10px;">5</label>
                                            <input type="checkbox" class="check" id="ch5" value="alt5"> correta
                                            <input type="text" class="form-control" id="alt5">
                                        </div>
                                    </aside>
                                </div><br/>
                                <div class="form-group">
                                    <label>Tema</label>
                                    <select class="form-control m-bot15" id="tema">
                                        <option value="-1">Selecione</option>
                                    </select>
                                </div>
                                <button id="cancelar" class="btn btn-danger">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </form>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function () {
                            
                            $("input.check").on("change", function() {
                                $("input.check").not(this).prop("checked", false);  
                            });
                            
                            $.ajax({
                                dataType: "json",
                                url: "consultas/tema-list.php",
                                type: "POST",
                                success: function(result){
                                    if(result.status === "erro"){
                                        swal("Não há temas cadastrados. É necessário fazê-lo primeiro.");
                                    }else{
                                        $.each(result.mensagem, function (i, item) {
                                            $("#tema").append($("<option>", { 
                                                value: item.id,
                                                text : item.descricao 
                                            }));
                                        });
                                    }
                                }
                            });
                            
                            
                            $("#salvar").submit(function(e) {
                                e.preventDefault();
                                
                                var descricao = $.trim($("#descricao").val());
                                var dica = $.trim($("#dica").val());
                                var tema = $.trim($("#tema").val());
                                
                                var correto = $("input.check:checked").val();
                                                                
                                if($.trim($("#" + correto).val()) === ""){
                                    swal("A resposta correta deve ser preenchida.");
                                }else{
                                    if(descricao === "" || tema === "-1"){
                                        swal("Existem campos a serem preenchidos!");
                                    }else{
                                        $.ajax({
                                            dataType: "json",
                                            url: "consultas/ques-inse.php",
                                            type: "POST",
                                            data: {descricao: descricao, 
                                                    dica: dica, tema: tema, correto: correto,
                                                    usuario: Cookies.get("usuarioid"), desc1: $("#alt1").val(),  
                                                    desc2: $("#alt2").val(), desc3: $("#alt3").val(), 
                                                    desc4: $("#alt4").val(), desc5: $("#alt5").val()},
                                            success: function(result){
                                                swal("Dados inseridos com sucesso!").then(function(){
                                                    window.location.href = "index.php";
                                                });
                                            }
                                        });
                                        
                                    }
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
