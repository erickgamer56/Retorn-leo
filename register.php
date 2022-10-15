<?php
    require_once 'assets/config/db.php';
    session_start();
    if (isset($_SESSION['logado'])){
        header('location:painel.php');
    };
    if(isset($_POST['submit'])){
        $erros = array();
        $email = mysqli_escape_string($connect , $_POST['email']);
        $senha = mysqli_escape_string($connect , $_POST['password']);
        $senha = password_hash($senha,  PASSWORD_BCRYPT);
        if (empty($email) or empty($senha)){
            $erros[] = "Campos Vazios";
        }else{
            $sql = "SELECT email FROM user WHERE email = '$email'";
            $result = mysqli_query($connect, $sql);
            if (mysqli_num_rows($result) > 0) {
                $erros[] = "Email Já existe .<a href='login.php'> Quer Fazer Login ?</a>";
            }else{
                $sql = "INSERT INTO user (email,senha) VALUES ('$email','$senha')";
                $result = mysqli_query($connect, $sql);
                header("location:login.php");
            }
        };
    };

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - RECÓLEO</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/media.css">
    <link rel="stylesheet" href="assets/css/sign.css">
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
                    <li><a href="login.php"><input class="btn_login" type="button" value="Fazer Login"> </a></li>
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
                <li><a href="login.php"><input class="btn_login" type="button" value="Fazer Login"> </a></li>
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
    <header>
        <form method="POST" class="form_login">
            <h1 class="title_form_login">Bem-Vindo(a) Novatos(a)</h1>
            <div class="inp_text_form">
                <span>
                    <h3>Email: </h3>
                    <input type="email" class="inp" name="email" placeholder="email" required>
                </span>
                <span>
                    <h3>Senha: </h3>
                    <input type="password" class="inp" name="password" placeholder="Senha" required>
                </span>
            </div>
            <div class="foo">
                <span class="sp">
                <?php
                    if (!empty($erros)){
                        foreach ($erros as $erro) {
                            echo $erro;
                        }
                    }
                ?>
                </span>
                <input type="submit" value="Criar Conta" class="submit" name="submit">
                <span>Já Tem Uma Conta ? <a href="login.php">Entrar !</a></span>
            </div>
        </form>
    </header>
    <script src="assets/js/animes.js"></script>
</body>
</html>