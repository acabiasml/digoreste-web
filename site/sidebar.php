<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a href="index.php">
                        <i class="fa fa-home"></i>
                        <span>Home</span>
                    </a>
                </li>
                <span id="menuadmin">
                    <li>
                        <a href="gerenciar-usuarios.php">
                            <i class="fa fa-address-card-o"></i>
                            <span>Gerenciar usuários</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-database"></i>
                            <span>Banco de Questões</span>
                        </a>
                        <ul class="sub">
                            <li><a href="questoes-notapro.php">Sugestões não aprovadas</a></li>
                            <li><a href="questoes-yesapro.php">Ver aprovadas</a></li>
                        </ul>
                    </li>
                </span>
                <span id="menucolab">
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-hand-peace-o"></i>
                            <span>Colaborador</span>
                        </a>
                        <ul class="sub">
                            <li><a href="questao.php">Sugerir questão</a></li>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-group"></i>
                                    <span>Administrar turmas</span>
                                </a>
                                <ul class="sub">
                                    <li><a href="turma.php">Criar nova</a></li>
                                    <li><a href="gerenciar-turmas.php">Gerenciar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </span>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-gamepad"></i>
                        <span>Jogar</span>
                    </a>
                    <ul class="sub">
                        <li><a href="treino.php">Modo Treino</a></li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-signing"></i>
                                <span>Jogar em turma</span>
                            </a>
                            <ul class="sub">
                                <li><a href="minhasturmas.php">Ver minhas turmas</a></li>
                                <li><a href="inscrever.php">Inscrever-se em nova turma</a></li>                                
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->

<script type="text/javascript">
        $(document).ready(function(){
            if(Cookies.get("usuarioperfil") === "2"){
                $("#menuadmin").hide();
            }
            if(Cookies.get("usuarioperfil") === "3"){
                $("#menuadmin").hide();
                $("#menucolab").hide();
            }
        });
</script>