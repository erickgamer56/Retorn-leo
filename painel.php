<?php
    require_once 'assets/config/db.php';
    session_start();
    if (!isset($_SESSION['logado'])){
        header('location:login.php');
    };
    $id = $_SESSION['id_user'];
    $sql = "SELECT * FROM user WHERE id = '$id'";
    $result = mysqli_query($connect , $sql);
    $dadosall = mysqli_fetch_array($result);
    $ecos = $dadosall['saldo'];
    $ecos = number_format($ecos , 2 , ',' , '.');
    if ($dadosall['nome'] == ''){
        header('location:initpage.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - RECÓLEO</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/loja.css">
    <link rel="stylesheet" href="assets/css/painel.css">
    <link rel="stylesheet" href="assets/css/media.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <meta name="description" content="O Melhor Para Você">
    <meta property="og:image" content="https://cdn.discordapp.com/attachments/1008857228473802873/1013963872736133131/amostra.png">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
</head>
<body>
    <section class="painel">
    <nav class="navbar">
        <input type="checkbox" id="menu_side">
        <div class="menu_side_box menu_side" >
            <div class="init_of_side">
                <div class="title">
                    <span>Recóleo</span>
                </div>
                <ul>
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
            <span>Recóleo</span>
        </div>
        <div>
            <ul>
                <li>
                    <a href="index.php" class="link_a_navbar">
                        <i class='bx bxs-home-alt-2'></i>
                        Inicio
                    </a>
                </li>
                <li>
                    <a href="index.php#Sobre" class="link_a_navbar">
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
                <label for="menuzin" class="laba"><img class="perfil" src="<?php echo $dadosall['img']?>"></label>
                <input type="checkbox" id="menuzin">
                <div class="menuzin">
                    <div class="init_menuzin">
                        <img src="<?php echo $dadosall['img']?>">
                        <span><?php echo $dadosall['email']?></span>
                    </div>
                    <div class="mid">
                        <?php 
                            if ($dadosall['cargo'] == 'adm'){
                                echo '<a href="assets/adm/adm.php" class="adm">Adm Space</a>';
                            }
                        ?>
                         <a href="perfil.php">Configurações De Perfil</a>
                        <a href="assets/config/sair.php">Sair Da Conta</a>
                    </div>
                </div>
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
        <div class="right">
            <div class="gap">
                <h1 class="text_saldo">Seu SAldo EM RECOPOINTS</h1>
                <span class="text_saldo_coin">
                    <?php echo $ecos ;?> RECOPOINT
                </span>
                <div>
                    <a href="ajudar.php">
                        <input type="button" value="Ajudar O Mundo" class="add">
                    </a>
                </div>
            </div>
        </div>
        </div>
    </section>
    <script src="assets/js/animes.js"></script>
</body>
</html>