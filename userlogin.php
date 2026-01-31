<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
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
    <?php
        session_start();
        include('process/conn.php');//conexão = $pdo

        if(isset($_POST['acao'])){
            $user = $_POST['user'];
            $senha = $_POST['senha'];

            $sql = "SELECT nm_senha FROM tb_user WHERE nm_user like '".$user."' limit 1;";
            $resultado = $pdo -> query($sql);
            $bdsenha = $resultado-> fetchColumn();
            if(password_verify($senha, $bdsenha)){
                $_SESSION['login'] = $user;
                $_SESSION['senha'] = $senha;
                $qualid = "SELECT id_user FROM tb_user WHERE nm_user like '".$user."' limit 1;";
                $id = $pdo -> query($qualid) ->fetchColumn();
                $_SESSION['id']=$id;
                $secreto = "SELECT isAdmin from tb_user WHERE id_user = '".$id."';";
                $isAdmin = $pdo -> query($secreto) ->fetchColumn();
                $_SESSION['isAdmin'] = $isAdmin;

                $login = "UPDATE tb_user SET dt_ultimologin = NOW() WHERE id_user = ?";
                $stmt = $pdo->prepare($login);
                $stmt->execute([$id]);

                $sql = "SELECT nm_imagem FROM tb_user WHERE id_user = ".$id;
                 $user = $pdo -> query($sql) -> fetch(PDO::FETCH_ASSOC) ;
                $_SESSION['imagem'] = $user['nm_imagem'];
                header("Location: index.php");
            }else{
                unset ($_SESSION['login']);
                unset ($_SESSION['senha']);
                unset ($_SESSION['isAdmin']);
                unset($_SESSION['imagem']);
            }

        }

    ?>

 <div class="container">


        
        <div class="row">
            <div class="col"></div>

            <div class="col ">


                
                    <div class="card m-5 bg-dark" style="width: 20rem;">
                        <div class="card-body">
                            <h5 class="card-title">Faça Login</h5>

                                <form action="" method="post">
                                    <label class="form-label" for="user" ><img src="img/user.png" alt="">Usuário: </label>
                                    <input class="form-control" required type="text" name="user">
                                    <br><br>
                                    <label class="form-label" for="senha"><img src="img/password.png" alt="">Senha: </label>
                                    <input class="form-control" required type="password" name="senha">
                                    <br><br>
                                    <div class="text-center">
                                        <input type="submit" value="Entrar" class="btn btn-primary" name="acao">
                                    <br><br>
                                    <a href="usersingup.php" class="btn btn-secondary">Não possui conta?</a>
                                    </div>
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