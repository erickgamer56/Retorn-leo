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
     if (!isset($_GET['p_id'])){
        header("location:loja.php");
     }
     if(isset($_GET['p_id']) && $_GET['p_id'] == ''){
        header("location:loja.php");
     }
     $p_id = $_GET['p_id'];
     $sql = "SELECT * FROM produtos WHERE id = '$p_id'";
     $result = mysqli_query($connect , $sql);
     $dp = mysqli_fetch_array($result);
     if ($dp['tipo'] == 'sabao'){
        $dp['tipo'] = 'sabão';
        $moeda = 'Reais';
        if ($dp['valor'] > 1){
            $moeda = 'Reais';
        }else{
            $moeda = 'Real';
        }
     }
     if ($dp['tipo'] == 'produto'){
        $dp['tipo'] = 'Resgatável';
        $moeda = 'RECOPOINT';
        if ($dp['valor'] > 1){
            $moeda = 'RECOPOINTS';
        }else{
            $moeda = 'RECOPOINT';
        }
     }
     if (!$dp['id']){
        header("location:loja.php");
     }
     $dp['valor'] = $dp['valor'];
     $dp['valor']= number_format($dp['valor'] , 2 , ',' , '.');
     
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
    <link rel="stylesheet" href="assets/css/produtos.css">
</head>
<body>
    <section class="painel">
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
                        <a href="index.php" class="link_a_navbar_side">
                            <i class='bx bxs-home-alt-2'></i>
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="index.php#Sobre" class="link_a_navbar_side">
                            <i class='bx bx-question-mark'></i></i>
                            Sobre
                        </a>
                    </li>
                    <li>
                        <a href="#" class="link_a_navbar_side">
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
                    <a href="#" class="link_a_navbar">
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
        <div class="right">
            <div class="flex">
                <img src="<?php echo $dp['img']?>" class="img_produto">
                <div class="texts">
                    <h1 class="nome"><?php echo $dp['nome'].' - '. $dp['tipo'] ?></h1>
                    <span class="valor">
                        <?php echo $dp['valor']?>
                        <span class="oter">
                            <?php echo $moeda?>
                        </span>
                    </span>
                    <p class="msg">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Minus assumenda eos culpa provident numquam quae veniam rem accusantium at non. Quod, inventore nulla suscipit culpa asperiores eum. Dolorem, libero aliquam?
                    </p>
                    <a href="#"><input type="button" class="btn" value="Falar com vendedores"></a>
                </div>
            </div>
        </div>
    </section>
    <section class="product_section">
        <div class="init_product">
            <span class="categ_product"><input id="product_sabao" class="input_categ active_boder_categ" type="button" value="sabões"></span>
            <span class="categ_product"><input id="product_pontos" class="input_categ"type="button" value="Resgatar Produtos"></span>
        </div>
        <div class="product_div">
            <div class="grid">
                <?php
                    $sql = "SELECT * FROM produtos";
                    $result = mysqli_query($connect , $sql);
                    $dados = mysqli_fetch_array($result);
                    foreach($result as $results => $indi){
                        echo '
                        <a href="produto.php?p_id='.$indi['id'].'" class="product" id="'.$indi['tipo'].'">
                            <img src="'.$indi['img'].'">
                            <span>'.$indi['nome'].'</span>
                        </a>
                        ' ;
                    }
                
                ?>
            </div> 
        </div>
    </section>
    <script src="assets/js/loja.js"></script>
    <script src="assets/js/animes.js"></script>
</body>
</html>