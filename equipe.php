<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
    <?php
    include('process/conn.php');//conexão = $pdo
    session_start();
     if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {   
        $_SESSION['error'] = "Faça o Login!";
        header("location:index.php");
        exit;
    }

    $id = $_SESSION['id'];

    $sql = "SELECT nm_user, nm_imagem, isAdmin, ds_about from tb_user WHERE id_equipe = (select id_equipe from tb_user WHERE id_user =".$id.");";
    ?>
    <link rel="shortcut icon" href="img/Trerius.png" type="image/x-icon">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body >
    
<style>

   
    body{
            background-color:black;
            color:rgba(255, 92, 241, 0.75);
            overflow-x: hidden;
            
        }
   </style> 

<!-- <nav class="navbar navbar-expand-lg bg-secondary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img src="img/Trerius.png" height="100px" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        
        
      </ul>
      
    </div>
  </div>
</nav> -->
    <div class="container">


     












    <?php
        $equipenm = "select nm_equipe from tb_equipe e WHERE e.id_equipe = (select id_equipe from tb_user WHERE id_user = ".$id.");";
         $linha = $pdo -> query($equipenm)->fetch(PDO::FETCH_ASSOC);
        echo "<div class=\"alert alert-dark text-center\" role=\"alert\" > <h1>";
        echo $linha['nm_equipe'];
        echo "</h1></div>";
        echo "<br>Membros da equipe: ";
        echo"<div class=\"row\">";
        foreach($pdo -> query($sql) as $row){
           //echo $row['nm_user'] . "<img src=\"".$row['nm_imagem']."\"><br>";
        if(!$row['isAdmin']){
            echo "
        <div class=\"col-sm-6 col-md-4 mb-4\">
            <div  style=\"width: 10rem; display: inline-block;background-color:#CCC;\" class=\"card m-5 \">
            <img src=\"".$row['nm_imagem']."\" class=\"card-img-top\" alt=\"".$row['nm_user']."\">
                <div class=\"card-body\" style=\"color:black;\">
                    <h5 class=\"card-title\">".$row['nm_user']."</h5>
                    <p class=\"card-text\">".$row['ds_about']."</p>
                </div>
            </div>
        </div>
            
        ";
        }else{

        }
        
        }
        echo "</div>";
    ?>
   


   
<div class="row">
    <div class="col"></div>
    <div class="col text-center">


    <div class="text-center">
        <a href="index.php" class="btn btn-dark">Voltar</a>
    </div>





    </div>
    <div class="col"></div>
</div>


    </div>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>


</body>
</html>