<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="Trerius.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sing Up</title>
</head>
<body>
    <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="Trerius.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>
  
<style>
        body{
            background-color:black;
            color:rgba(255, 92, 241, 0.75);
        }
    </style>
<div class="container">


        
        <div class="row">
            <div class="col"></div>

            <div class="col ">


                
                    <div class="card m-5 bg-dark" style="width: 20rem;">
                        <div class="card-body">
                            <h5 class="card-title">Faça Login</h5>

                                  <form action="" method="post">
                                    <label class="form-label" for="user"><img src="img/user.png" alt=""> Usuário: </label>
                                    <input class="form-control" type="text" name="user">
                                    <br><br>
                                    <label class="form-label" for="email"><img src="img/email.png" alt="">E-mail: </label>
                                    <input type="email" name="email" class="form-control">
                                    <br><br>
                                    <label class="form-label" for="senha"><img src="img/password.png" alt="">Senha: </label>
                                    <input class="form-control" type="password" name="senha">
                                    <br><br>
                                    <label class="form-label" for="Csenha"><img src="img/password.png" alt="">Confirmar senha: </label>
                                    <input class="form-control" type="password" name="Csenha">
                                    <br><br>
                                    <div class="text-center">
                                        <input type="submit" class="btn btn-primary" value="Entrar" name="acao">
                                    <br><br>
                                    <a href="userlogin.php" class="btn btn-secondary">Já possui conta?</a>
                                    </div>
                                </form>
                        </div>
                    </div>

            </div>

            <div class="col"></div>
        
        
        </div>

        </div>
    <?php
    
        include('process/conn.php');//conexão = $pdo
        if(isset($_POST['acao'])){
            $user = $_POST['user'];
            if($_POST['Csenha']==$_POST['senha']){
                $senha = $_POST['senha'];
                
                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
                $sql = "INSERT INTO tb_user(nm_user, nm_email, nm_senha) VALUES ('".$_POST['user']."', '".$_POST['email']."', '".$senha_hash."')";

                $pdo -> exec($sql);
                echo $senha . "<br>";
                echo $senha_hash . "<br>";
                header("Location: userlogin.php");
            }

            
            

        }

    ?>









    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

</body>
</html>
