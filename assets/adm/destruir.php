<?php
    require_once '../config/db.php';
    session_start();
    if (isset($_GET['id'])){
        session_start();
        session_unset();
        session_destroy();
        $id = $_GET['id'];
        $sql = "DELETE FROM user WHERE id = $id";
        $result = mysqli_query($connect , $sql);
        header("location:../../login.php");
    }
?>