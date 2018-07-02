<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="index.php" class="logo">
        <img src="../images/logo.svg" alt="" height="40" />
        digoreste
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">
        <!-- sugesst start-->
        <li id="header_notification_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="fa fa-edit"></i>
            </a>
        </li>
        <!-- suggest end -->
        <!-- download start-->
        <li id="header_notification_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#" id="botaodownload" target="_blank">
                <i class="fa fa-download"></i>
            </a>
        </li>
        <!-- download end -->
    </ul>
    <!--  notification end -->
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="images/user.svg">
                <span class="username" id="usuarionome"></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#" id="editarusuario"><i class="fa fa-cog"></i>Minha conta</a></li>
                <li><a href="#" id="botaosair"><i class="fa fa-key"></i>Sair</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->

<script type="text/javascript">
    $(document).ready(function () {
        if(Cookies.get("usuariologado") !== "sim"){
            window.location.replace("../index.html");
        }

        $("#usuarionome").html(Cookies.get("usuarionome"));
        
        $("#botaosair").click(function(){
            Cookies.remove("usuariologado");
            window.location.replace("../index.html");
        });
        
        $("#editarusuario").click(function(){
            window.location.replace("usuario.php?id=" + Cookies.get("usuarioid"));
        });
        
        $("#botaodownload").click(function(){
            url = "https://play.google.com/store/apps/details?id=com.acabias.digoreste&hl=pt-BR";
            window.open(url);
        });
    });
</script>