<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    ob_start();
    session_start();
    include('process/conn.php');//conexão = $pdo
    
     if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        header("location:index.php");
    }

    $id = $_SESSION['id'];

    if(!$_SESSION['isAdmin']){
        header("location:index.php");
    }

    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<style>
        body{
            background-color:black;
            color:rgba(255, 92, 241, 0.75);
        }
    </style>
</head>
<body>
    <div class="container">


        
        <div class="row">
            <div class="col"></div>

            <div class="col ">


            <?php

                if(isset($_POST['acao'])){


                            
                            
                            $sql = "DELETE FROM `tb_noticias` WHERE `tb_noticias`.`id_noticia` = ".$_POST['noticia'];
                            
                            $pdo -> exec($sql);

                            header("Location:index.php");
                        }
               
            ?>
                
                    <div class="card m-5 bg-dark" style="width: 20rem;">
                        <div class="card-body">
                            <h5 class="card-title">Apague uma notícia</h5>

                                <form action="" method="post" enctype="multipart/form-data">
                                    <select class="form-control" name="noticia" id="noticia">
                                        <option selected disabled>Selecione o que deseja apagar</option>
                                        <?php
                                            $search = "SELECT id_noticia, nm_titulo from tb_noticias ORDER BY id_noticia ASC";

                                            foreach($pdo -> query($search) as $row){

                                                echo "<option value = \"".$row['id_noticia']."\">".$row['nm_titulo']."</option>";

                                            }
                                        ?>
                                    </select><br>
                                    <input type="submit" name="acao" value="Apagar" class="btn btn-danger"/> <a href="index.php" class="btn btn-secondary" style="margin-left:45%;">Voltar</a>
                                </form>
                        </div>
                    </div>

            </div>

            <div class="col"></div>
        
        
        </div>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

</body>
</html>

