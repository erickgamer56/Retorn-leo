<?php
 require_once 'assets/config/db.php';
 session_start();
 if (isset($_SESSION['logado'])){
     $login = true;
 };
 if (isset($login)){
    if ($login == true){
        $id = $_SESSION['id_user'];
        $sql = "SELECT * FROM user WHERE id = '$id'";
        $result = mysqli_query($connect , $sql);
        $dadosall = mysqli_fetch_array($result);
        if ($dadosall['nome'] == ''){
            header('location:initpage.php');
        }
         
    }
 }else{
    $login=false;
 }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RECÓLEO</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/media.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <meta name="description" content="O Melhor Para Você">
    <meta property="og:image" content="https://cdn.discordapp.com/attachments/1008857228473802873/1013963872736133131/amostra.png">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
</head>
<body>
    <nav class="navbar">
        <input type="checkbox" id="menu_side">
        <div class="menu_side_box menu_side" >
            <div class="init_of_side">
                <div class="title">
                    <span>RECÓLEO</span>
                </div>
                <ul>
                    <?php
                        if ($login == true){
                            echo ' ';
                        }else{
                            echo '<li><a href="login.php"><input class="btn_login" type="button" value="Fazer Login"> </a></li>';
                        }
                    ?>
                    <li>
                        <label for="menu_side">
                            <span class="menu_side">
                                <i class='bx bx-menu'></i>
                            </span>
                        </label>
                    </li>
                </ul>
            </div>
            <div class="opt_menu_side">
                <ul>
                    <li>
                        <a href="#" class="link_a_navbar_side">
                            <i class='bx bxs-home-alt-2'></i>
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="#Sobre" class="link_a_navbar_side">
                            <i class='bx bx-question-mark'></i></i>
                            Sobre
                        </a>
                    </li>
                    <li>
                        <a href="loja.php" class="link_a_navbar_side">
                            <i class='bx bxs-shopping-bag-alt'></i>
                            Loja
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="title">
            <span>RECÓLEO</span>
        </div>
        <div>
            <ul>
                <li>
                    <a href="#" class="link_a_navbar">
                        <i class='bx bxs-home-alt-2'></i>
                        Inicio
                    </a>
                </li>
                <li>
                    <a href="#Sobre" class="link_a_navbar">
                        <i class='bx bx-question-mark'></i></i>
                        Sobre
                    </a>
                </li>
                <li>
                    <a href="loja.php" class="link_a_navbar">
                        <i class='bx bxs-shopping-bag-alt'></i>
                        Loja
                    </a>
                </li>
                <input type="checkbox" id="menuzin">
                <div class="menuzin">
                    <div class="init_menuzin">
                        <img src="<?php echo $dadosall['img']?>">
                        <span><?php echo $dadosall['email']?></span>
                    </div>
                    <div class="mid">
                        <a href="painel.php">Painel</a>
                        <a href="perfil.php">Configurações De Perfil</a>
                        <a href="assets/config/sair.php">Sair Da Conta</a>
                    </div>
                </div>
                <?php
                    if ($login == true){
                        echo '<label for="menuzin"><img class="perfil" src="'.$dadosall['img'].'"></label>';
                    }else{
                        echo '<li><a href="login.php"><input class="btn_login" type="button" value="Fazer Login"> </a></li>';
                    }
                ?>
                <li>
                    <label for="menu_side">
                        <span class="menu_side">
                            <i class='bx bx-menu'></i>
                        </span>
                    </label>
                </li>
            </ul>
        </div>
    </nav>
    <header id="Menu">
        <div class="text_header">
            <h1>
                Olá Pessoa !
            </h1>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam recusandae omnis iusto consectetur voluptate in vel, magni laboriosam quibusdam adipisci qui nisi inventore! Magnam, accusamus cum quae laboriosam consequuntur aut.
            </p>
        </div>
    </header>
    <main>
        <div class="contei_main">
            <h1 class="title_main">O Melhor Da Equipe RECÓLEO</h1>
            <div class="container_main">
                <div class="imgs_main">
                    <img src="assets/img/produtos/1.jpg">
                </div>
                <div class="imgs_main">
                    <img src="assets/img/produtos/2.jpg">
                </div>
                <div class="imgs_main">
                    <img src="assets/img/produtos/3.png">
                </div>
            </div>
            <a href="loja.php" class="more_main">
                <i class='bx bxs-shopping-bag-alt'></i>
                Conheça Mais Produtos ECO <i class='bx bxs-right-arrow-alt'></i>
            </a>
        </div>
    </main>
    <section class="about_product" id="Sobre">
        <div class="black">
            <img src="assets/img/logo.png" class="img_about">
        </div>
        <div class="text_about">
            <h1>Conheça a RECÓLEO</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui excepturi non libero saepe voluptatum tenetur deserunt laudantium error quos possimus ipsam temporibus atque, maxime, vero voluptate repellendus ipsa enim. Autem!</p>
        </div>
    </section>
    <footer>
        <div class="init_footer">
            <h2>ETE - RECÓLEO</h2>
            <h2>© 2021 - 2022 RECÓLEO</h2>
        </div>
        <div class="links_footer">
            <ul class="text_footer">
                <div>
                    <h1 class="title_footer">Sobre</h1>
                    <p>Evento dedicado a intentar interação dos estudantes à instituição de ensino ETE Clóvis Nogueira Alves, afim de propor diversão e, consequentemente, atrair novos estudantes a mesma, pelo 3° ano integrado logística.</p>
                </div>
            </ul>
            <ul class="coluna_footer">
                <h1 class="title_footer">Redes</h1>
                <li><a href="#" class="links_of_footer"><i class='bx bxl-instagram-alt' ></i>Instagram</a></li>
                <li><a href="#" class="links_of_footer"><i class='bx bxl-facebook-square'></i>Facebook</a></li>
                <li><a href="#" class="links_of_footer"><i class='bx bxl-tiktok' ></i>TikTok</a></li>
            </ul>
            <ul class="coluna_footer">
                <h1 class="title_footer">Paginas</h1>
                <li><a href="#" class="links_of_footer"><i class='bx bxs-home-alt-2'></i>Inicio</a></li>
                <li><a href="#" class="links_of_footer"><i class='bx bxs-shopping-bag-alt'></i>Loja</a></li>
                <li><a href="#" class="links_of_footer"><i class='bx bxs-user'></i>Login</a></li>
            </ul>
            <ul class="coluna_footer">
                <h1 class="title_footer">Contatos</h1>
                <li><a href="#" class="links_of_footer"><i class='bx bxl-whatsapp' ></i>Whatsapp</a></li>
            </ul>
        </div>
    </footer>
    <script src="assets/js/index.js"></script>
</body>
</html>