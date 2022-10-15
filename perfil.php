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
    if (isset($_POST['submit'])){
        $nome = mysqli_escape_string($connect , $_POST['name']);
        if (!empty($nome)){
            $sql = "UPDATE `user` SET `nome` = '$nome' WHERE `user`.`id` = '$id';";
            $result = mysqli_query($connect , $sql);
            header("location:perfil.php");
        }else{
            $erros[] = "Campos Vazios";
        }
       if(!empty($_FILES['file'])){
                $formatosPermitidos= array("png", "jpeg", "jpg", "gif");
                $extensao=pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                if(in_array($extensao, $formatosPermitidos)){
                    $varid = $dadosall['id'];
                    $pasta="assets/img/users/$varid/";
                    $pasta2="assets/img/users/$varid";
                    $move="assets/img/users/$varid/";
                    if (is_dir($pasta)){
                        $temporario= $_FILES['file']['tmp_name'];
                        $novoNome=uniqid().".$extensao";
                        if(move_uploaded_file($temporario, $move. $novoNome)){
                            $mensagem[]="Upload feito com sucesso!";
                            $salvarnobanco = $pasta. $novoNome;
                            $sql = "UPDATE `user` SET `img` = '$salvarnobanco' WHERE `user`.`id` = '$id';";
                            $result = mysqli_query($connect , $sql);
                            header("location:perfil.php");
                        }else{
                            echo 'erro';
                        }
                    }else{
                        mkdir($pasta2 , 0755, true);
                        $temporario= $_FILES['file']['tmp_name'];
                        $novoNome=uniqid().".$extensao";
                        if(move_uploaded_file($temporario, $move. $novoNome)){
                            $mensagem[]="Upload feito com sucesso!";
                            $salvarnobanco = $pasta. $novoNome;
                            $sql = "UPDATE `user` SET `img` = '$salvarnobanco' WHERE `user`.`id` = '$id';";
                            $result = mysqli_query($connect , $sql);
                            header("location:perfil.php");
                        }
                    }
                }else{
                    $erros[] = "Formato Invalido";
                }
            }else{
                $erros[] = "img Não Foi Alterada !<br>";
        }   
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
    <link rel="stylesheet" href="assets/css/init.css">
    <link rel="stylesheet" href="assets/css/adm.css">
    <link rel="stylesheet" href="assets/css/perfil.css">

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
                        <a href="painel.php">Painel</a>
                        <a href="#">Configurações De Perfil</a>
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
                <form method="POST" class="formchange" enctype="multipart/form-data">
                    <div class="show" id="show">
                        <div class="init">Você Quer Salvar ?</div>
                        <div class="action">
                            <input type="submit" name="submit" class="g" value="Salvar">
                            <input type="button" class="r" value="Cancelar" id="r">
                        </div>
                    </div>
                    <input type="file" id="file" name="file">
                    <label for="file" class="lol">
                        <span class="foto">
                            <img src="<?php echo $dadosall['img']?>"  id="icam">
                            <img src="" id="uimg">
                        </span>
                        <h2>Mude Sua Foto Aqui !</h2>
                    </label>
                    <input type="text" minlength="3" autocomplete="off" name="name" class="name" id="name" placeholder="Coloque Seu Apelido ! Com no minimo 3 letras" >
                </form>
            </div>
            <a href="assets/adm/destruir.php?id=<?php echo $dadosall['id']?>" style="text-decoration: none;">
                <div class="destruir">
                    <h2>Destruir Conta</h2>
                </div>
            </a>
        </div>
        </div>
    </section>
    <script src="assets/js/animes.js"></script>
    <script src="assets/js/change2.js"></script>
</body>
</html>