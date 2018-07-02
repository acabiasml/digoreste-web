<!DOCTYPE html>
<head>
    <title>Usuário | Digoreste</title>
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

                    <h2 style="font-family: exotc">Usuário</h2></br>
                    
                    <div class="panel-body">
                        <div class="">
                            <form role="form" id="salvar">
                                <div id="divoid" class="form-group" style="text-align: right">
                                    <label>ID</label>
                                    <span id="oid">XXX</span>
                                </div>
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" class="form-control" id="nome">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" id="email">
                                </div>
                                <div class="form-group">
                                    <label>Senha</label>
                                    <input type="password" class="form-control" id="senha">
                                </div>
                                <div class="form-group">
                                    <label>Perfil</label>
                                    <select class="form-control m-bot15" id="perfil">
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
                            
                            $("#divoid").hide();
                            var aux = (window.location.href).split("id=");
                            var id = aux[1];
                            
                            if(id !== undefined){
                                $.ajax({
                                    dataType: "json",
                                    url: "consultas/user-list-um.php",
                                    type: "POST",
                                    data: {id: id},
                                    success: function(result){
                                        if(result.status === "erro"){
                                            alert("erro");
                                        }else{
                                            $("#nome").val(result.mensagem.nome);
                                            $("#email").val(result.mensagem.email);
                                            $("#senha").val(result.mensagem.senha);
                                        }
                                    }
                                });
                            }
                            
                            $.ajax({
                                dataType: "json",
                                url: "consultas/perfil-list.php",
                                type: "POST",
                                success: function(result){
                                    if(result.status === "erro"){
                                        alert("erro");
                                    }else{
                                        $.each(result.mensagem, function (i, item) {
                                            $("#perfil").append($("<option>", { 
                                                value: item.id,
                                                text : item.descricao 
                                            }));
                                        });
                                    }
                                }
                            });
                            
                            $("#salvar").submit(function(e) {
                                e.preventDefault();
                                
                                var nome = $("#nome").val();
                                var email = $("#email").val();
                                var senha = $("#senha").val();
                                var perfil = $("#perfil").val();
                                
                                if($.trim(nome) === "" || $.trim(email) === "" || $.trim(senha) === "" || perfil === "-1"){
                                    swal("Existem campos a serem preenchidos!");
                                }else{
                                    if(id !== undefined){
                                        
                                        $.ajax({
                                            dataType: "json",
                                            url: "consultas/user-upda.php",
                                            type: "POST",
                                            data: {id: id, nome: nome, email: email, senha: senha, perfil: perfil},
                                            success: function(result){
                                                swal("Dados atualizados com sucesso!").then(function(){
                                                    window.location.href = "index.php";
                                                });
                                            }
                                        });
                                    }else{
                                        $.ajax({
                                            dataType: "json",
                                            url: "consultas/user-inse.php",
                                            type: "POST",
                                            data: {nome: nome, email: email, senha: senha, perfil: perfil},
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
                            
                            if (id !== undefined) {
                                if(Cookies.get("usuarioperfil") !== "1"){
                                    if(Cookies.get("usuarioid") !== id){
                                        window.location.replace = "index.php";
                                    }
                                }
                                $("#oid").html(id);
                                $("#divoid").show();
                            }
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
