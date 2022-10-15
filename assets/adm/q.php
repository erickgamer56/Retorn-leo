<?php
require_once '../config/db.php';
session_start();
$id = $_SESSION['id_user'];
$sql = "SELECT * FROM user WHERE id = '$id'";
$result = mysqli_query($connect , $sql);
$dadosall = mysqli_fetch_array($result);
if (!isset($_SESSION['logado'])){
    header('location:login.php');
};
if ($dadosall['cargo'] != 'adm'){
    header('location:../../painel.php');
}
if (isset($_GET['remove']) && isset($_GET['id'])){
    $true = $_GET['remove'];
    $id = $_GET['id'];
    if ($true = 'true'){
        $sql = "DELETE FROM user WHERE id = $id";
        $result = mysqli_query($connect , $sql);
        header('location:adm.php');
    }
}
if (isset($_GET['demote']) && isset($_GET['id'])){
    $true = $_GET['demote'];
    $id = $_GET['id'];
    if ($true = 'true'){
        $sql = "UPDATE user SET cargo = 'ajudante' WHERE id = $id";
        $result = mysqli_query($connect , $sql);
        header('location:adm.php');
    }
}
if (isset($_GET['promove']) && isset($_GET['id'])){
    $true = $_GET['promove'];
    $id = $_GET['id'];
    if ($true = 'true'){
        $sql = "UPDATE user SET cargo = 'adm' WHERE id = $id";
        $result = mysqli_query($connect , $sql);
        header('location:adm.php');
    }
}
if (isset($_GET['produto']) && isset($_GET['id'])){
    $true = $_GET['produto'];
    $id = $_GET['id'];
    if ($true = 'true'){
        $sql = "DELETE FROM produtos WHERE id = $id";
        $result = mysqli_query($connect , $sql);
        header('location:adm.php');
    }
}



?>