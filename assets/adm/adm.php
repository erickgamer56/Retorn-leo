<?php
    require_once '../config/db.php';
    session_start();
    if (!isset($_SESSION['logado'])){
        header('location:login.php');
    };
    $id = $_SESSION['id_user'];
    $sql = "SELECT * FROM user WHERE id = '$id'";
    $result = mysqli_query($connect , $sql);
    $dadosall = mysqli_fetch_array($result);
    $dadosall['img'] = str_replace('assets', '..' , $dadosall['img']);
    $ecos = $dadosall['saldo'];
    $ecos = number_format($ecos , 2 , ',' , '.');
    if ($dadosall['nome'] == ''){
        header('location:initpage.php');
    }
    if ($dadosall['cargo'] != 'adm'){
        header('location:../../painel.php');
    }
    if (isset($_POST['submit'])){
        $tipo = $_POST['tipo'];
        $valor = $_POST['valor'];
        $nome = mysqli_escape_string($connect , $_POST['name']);
       if(!empty($_FILES['file'])){
                $formatosPermitidos= array("png", "jpeg", "jpg", "gif");
                $extensao=pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                if(in_array($extensao, $formatosPermitidos)){
                    $varid = $dadosall['id'];
                    $pasta="assets/img/produtos/";
                    $pasta2="../img/produtos";
                    $move="../img/produtos/";
                    if (is_dir($pasta2)){
                        $temporario= $_FILES['file']['tmp_name'];
                        $novoNome=uniqid().".$extensao";
                        if(move_uploaded_file($temporario, $move. $novoNome)){
                            $mensagem[]="Upload feito com sucesso!";
                            $salvarnobanco = $pasta. $novoNome;
                        }else{
                            echo 'erro';
                        }
                    }
                }else{
                    $erros[] = "Formato Invalido";
                }
            }else{
                $erros[] = "img Não Foi Alterada !<br>";
        }
        if (empty($nome && empty($_FILES['file']))){
            $sql = "INSERT INTO produtos (nome,tipo,img,valor) VALUES ('$nome','$tipo','$salvarnobanco','$valor')";
            $result = mysqli_query($connect, $sql);
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
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/loja.css">
    <link rel="stylesheet" href="../css/painel.css">
    <link rel="stylesheet" href="../css/media.css">
    <link rel="stylesheet" href="../css/init.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <meta name="description" content="O Melhor Para Você">
    <meta property="og:image" content="https://cdn.discordapp.com/attachments/1008857228473802873/1013963872736133131/amostra.png">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="shortcut icon" href="..//img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/adm.css">
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
                        <a href="../../index.php" class="link_a_navbar_side">
                            <i class='bx bxs-home-alt-2'></i>
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="../../index.php#Sobre" class="link_a_navbar_side">
                            <i class='bx bx-question-mark'></i></i>
                            Sobre
                        </a>
                    </li>
                    <li>
                        <a href="../../loja.php" class="link_a_navbar_side">
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
                    <a href="../../index.php" class="link_a_navbar">
                        <i class='bx bxs-home-alt-2'></i>
                        Inicio
                    </a>
                </li>
                <li>
                    <a href="../../index.php#Sobre" class="link_a_navbar">
                        <i class='bx bx-question-mark'></i></i>
                        Sobre
                    </a>
                </li>
                <li>
                    <a href="../../loja.php" class="link_a_navbar">
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
                        <a href="../../painel.php">Painel</a>
                        <a href="../../perfil.php">Configurações De Perfil</a>
                        <a href="../config/sair.php">Sair Da Conta</a>
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
    <div class="agru32">
        <div class="boh">
            <h1 class="h1">Nossos Usuarios:</h1>
            <div class="boxwhite">
                <table class="table">
                    <tr>
                        <td>id:</td>
                        <td>Nome:</td>
                        <td>Email:</td>
                        <td>Cargo:</td>
                        <td>Date:</td>
                        <td>Saldo:</td>
                    </tr>
                   <?php
                         $sql = "SELECT * FROM user";
                         $result = mysqli_query($connect , $sql);
                         $dados = mysqli_fetch_array($result);
                         foreach($result as $results => $indi){
                            $indi['saldo'] = $indi['saldo'];
                            $indi['saldo'] = number_format($indi['saldo'] , 2 , ',' , '.');
                            if ($indi['cargo'] == 'adm'){
                                $oqf = 'Demote';
                                $oqfl = 'demote=true&id='.$indi['id'];
                            }else{
                                $oqf = 'Promove';
                                $oqfl = 'promove=true&id='.$indi['id'];;
                            }
                             echo '
                             <tr>
                                <td>'.$indi['id'].'</td>
                                <td>'.$indi['nome'].'</td>
                                <td>'.$indi['email'].'</td>
                                <td>'.$indi['cargo'].'</td>
                                <td>'.$indi['date'].'</td>
                                <td>'.$indi['saldo'].'</td>
                                <td class="te"><a href="q.php?'.$oqfl.'" class="g">'.$oqf.'</a> <a href="q.php?remove=true&id='.$indi['id'].'" class="r">Remove</a></td>
                             </tr>
                             ' ;
                         }
                   ?>
                </table>
            </div>
        </div>
        <div class="boh">
            <h1 class="h1">Inserir Produto</h1>
            <div class="boxwhite">
                <form method="POST" class="form_box" enctype="multipart/form-data">
                    <label for="file" class="lol">
                            <span class="foto">
                                <i class='bx bx-camera' id="icam"></i>
                                <img src="" id="uimg">
                            </span>
                            <h2>Adicione a Foto do Seu Produto Aqui !</h2>
                    </label>
                    <div class="input">
                        <span class="titi_inp">
                            <i class='bx bxs-inbox'></i>
                            <h1>Adicione o Nome e Tipo Aqui !</h1>
                        </span>
                        <div class="flexc">
                            <input type="file" name="file" id="file" required>
                            <input type="text" class="ori_inp" placeholder="Nome Do Produto" name="name" required>
                            <input type="number" class="ori_inp" placeholder="Valor Do Produto" name="valor" required>
                            <select id="tipo" name="tipo" class="ori_inp">
                                <option value="sabao">Sabão</option>
                                <option value="produto">Produto Resgatável</option>
                            </select>
                        </div>
                    </div>
                    <input type="submit" value="Enviar" class="btn_form" name="submit">
                </form>            
            </div>
        </div>
        <div class="boh">
            <div class="boxwhite2">
                <div class="box32">
                <?php
                    $sql = "SELECT * FROM produtos";
                    $result = mysqli_query($connect , $sql);
                    $dados = mysqli_fetch_array($result);
                    foreach($result as $results => $indi){
                        $indi['img'] = str_replace('assets', '..' , $indi['img']);
                        echo '
                        <div class="gerir">
                            <div href="#" class="product" id="'.$indi['tipo'].'">
                                <img src="'.$indi['img'].'">
                                <span>'.$indi['nome'].'</span>
                            </div>
                            <a href="q.php?produto=true&id='.$indi['id'].'" class="apagar">Apagar Item</a>
                        </div>
                        ' ;
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/change.js"></script>
    <script src="assets/js/animes.js"></script>
</body>
</html>