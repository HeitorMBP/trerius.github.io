<?php
    session_start();
     if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        header("location:index.php");
        exit;
    }

    $logado = $_SESSION['login'];
    $id = $_SESSION['id'];
    $isAdmin = $_SESSION['isAdmin'] ;
    if(!$isAdmin){
        header("location:index.php");
        exit;
    }
    include('process/conn.php');//conexão = $pdo




   


   

    foreach($_POST['remover'] as $row){
         $sql = "call prRemoverdaEquipe(".$row.")";
         $pdo -> exec($sql);
    }

    header("location:ADM-equipe.php");






    ?>