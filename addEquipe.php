<?php
    session_start();
     if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        header("location:index.php");
    }

    $logado = $_SESSION['login'];
    $id = $_SESSION['id'];
    $isAdmin = $_SESSION['isAdmin'] ;
    if(!$isAdmin){
        header("location:index.php");
    }


    $nome = $_POST['nome'];

    include('process/conn.php');//conexão = $pdo
    include('process/funcoes.php');
    $sql = "INSERT INTO tb_equipe(nm_equipe,id_conversa) VALUES ('".$nome."',".criarConversa($pdo,"grupo",0).");";
    $pdo -> exec($sql);
    

    header('location:ADM-equipe.php')
    ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="img/Trerius.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionando...</title>
    <style>
         body{
            background-color:black;
            color:rgba(255, 92, 241, 0.75);
            overflow-x: hidden;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="spinner-grow" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        


    </div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

</body>
</html>