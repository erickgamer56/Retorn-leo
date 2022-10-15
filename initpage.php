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


if ($dadosall['nome'] != ''){
   header('location:painel.php');
}
if (isset($_POST['submit'])){
    $nome = mysqli_escape_string($connect , $_POST['name']);
    if (!empty($nome)){
        $sql = "UPDATE `user` SET `nome` = '$nome' WHERE `user`.`id` = '$id';";
        $result = mysqli_query($connect , $sql);
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
                        header("location:painel.php");
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
                        header("location:painel.php");
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
    <title>Loja - RECÓLEO</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/loja.css">
    <link rel="stylesheet" href="assets/css/media.css">
    <meta name="description" content="O Melhor Para Você">
    <meta property="og:image" content="https://cdn.discordapp.com/attachments/1008857228473802873/1013963872736133131/amostra.png">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/init.css">
</head>
<body>
    <header id="init">
        <form method="POST" class="init_box" enctype="multipart/form-data">
            <div class="init1">
                <h1>Bem-Vindo</h1>
                <p>Antes de começar precisamos saber mais sobre voce !</p>
                <div class="foot_initpage">
                    <span class="sty s1">
                        <a href="assets/config/sair.php"><input type="button" value="Deixa Para Depois"></a>
                    </span>
                    <span class="sty s2">
                        <input type="submit" value="Pronto" name="submit">
                    </span>
                </div>
            </div>
            <div class="obs">
                <input type="text" minlength="3" autocomplete="off" required name="name" class="name" placeholder="Coloque Seu Apelido ! Com no minimo 3 letras" >
                <input type="file" name="file" id="file" required>
                <label for="file" class="lol">
                    <span class="foto">
                        <i class='bx bx-camera' id="icam"></i>
                        <img src="" id="uimg">
                    </span>
                    <h2>Seu futuro depende apenas de você</h2>
                </label>
            </div>
        </form>
    </header>
    <script src="assets/js/change.js"></script>
</body>
</html>