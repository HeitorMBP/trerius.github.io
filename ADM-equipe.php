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
    include('process/conn.php');//conexão = $pdo
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="Trerius.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizar equipes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        body{
            background-color:black;
            color:rgba(255, 92, 241, 0.75);
            overflow-x: hidden;
        }
    </style>
</head>
<body>
    
    <div class="row mt-5">
        <div class="col"><a href="index.php" class="btn btn-info">Voltar</a></div>
        <div class="col">
<div class="card" style="width: 18rem;">

  <div class="card-body">
    <h5 class="card-title">Adicionar membro na equipe</h5>
    <form action="addMembro.php" method="post">
        <select  class="form-control" name="equipe" id="equipe" required>
            
            
            <?php
                $equipes = "SELECT nm_equipe, id_conversa, id_equipe from tb_equipe";
                foreach($pdo -> query($equipes) as $row){
                    echo "<option value=\"'{\"id_equipe\":".$row['id_equipe'].",\"id_conversa\":".$row['id_conversa']."}'\">".$row['nm_equipe']."</option>";
                }
            
            ?>
        </select><br>
        <select  class="form-control" name="id_user" id="id_user" required>
            <option value="" selected disabled>Escolha o usuário</option>
            
            <?php
                $users = "SELECT nm_user, id_user from tb_user WHERE isAdmin = 0 AND id_equipe = 1";
                foreach($pdo -> query($users) as $row){
                    echo "<option value=\"".$row['id_user']."\">".$row['nm_user']."</option>";
                }
            
            ?>
        </select>
        <br>
        <input type="submit" value="Adicionar" class="btn btn-success">
    </form>
    
  </div>
</div>
        </div>









        <div class="col">




<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Ver equipes</h5>
     <form action="" method="post">
        <select  class="form-control" name="equipe" id="id_equipe" required>
            <option value="" selected disabled>Escolha a equipe</option>
            
            <?php
                $equipes = "SELECT nm_equipe, id_equipe from tb_equipe";
                foreach($pdo -> query($equipes) as $row){
                    echo "<option value=\"".$row['id_equipe']."\">".$row['nm_equipe']."</option>";
                }
            
            ?>
        </select><br>
        <input type="submit" name="visualizar" value="Visualizar" class="btn btn-success">
            </form>
            <br>
            <div class="overflow-y-scroll " style="height:150px; overflow-y: auto; border-radius:10px; background-color: #ccc; color:black;">

                <?php
            if(isset($_POST['visualizar'])){
                $sql = "SELECT nm_user, id_user FROM tb_user WHERE isAdmin = 0 AND id_equipe = ".$_POST['equipe'];
                echo "
                <form action=\"removerdaequipe.php\" method=\"post\">";
                if($_POST['equipe'] == 1 ){

                        }else{
                            echo"<input type=\"submit\" value=\"Excluir\" class=\"btn btn-danger\">";
                        }
                        echo"
                
                <table class=\"table\">
                    <tr>
                        <th scope=\"col\">#</th>
                        <th scope=\"col\">Agente</th>";
                        if($_POST['equipe'] == 1 ){

                        }else{
                            echo"<th scope=\"col\">Retirar?</th>";
                        }
                        
                echo"
                    </tr>
                </thead>
                
                ";
                echo "<tbody>";
                if($_POST['equipe'] == 1){
                    foreach($pdo -> query($sql) as $row){
                    echo "<tr>
                    <th scope=\"col\"> -> </th>
                    <td>".$row['nm_user']."</td>                  
                    </tr>";
                    }
                }else{
                    foreach($pdo -> query($sql) as $row){
                    echo "<tr>
                    <th scope=\"col\"> -> </th>
                    <td>".$row['nm_user']."</td>
                    <td><input type=\"checkbox\" name=\"remover[]\" id=\"remover\" value=\"".$row['id_user']."\"></td>                   
                    </tr>";
                }
                }
                echo "</tbody></table></form>";
            }
            ?>


            </div>
            
  </div>
</div>





        </div>







        <div class="col">
            <div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Criar Equipe</h5>
    <form action="addEquipe.php" method="post">
        <label class="form-label" for="nome">Nome da equipe: </label>
        <input class="form-control" type="text" name="nome" id="nome" required>
        <br>
        <input class="btn btn-primary" type="submit" value="Criar">
    </form>

  </div>
</div>
        </div>
        <div class="col"></div> 
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

</body>
</html>