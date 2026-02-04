<?php
session_start();
include('process/conn.php');//conexão = $pdo

     if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        header("location:index.php");
    }

    $id = $_SESSION['id'];

    if(!$_SESSION['isAdmin']){
        header("location:index.php");
        exit;
    }

// handle POST before any output so header() works
if(isset($_POST['acao'])){
    if(isset($_FILES['file'])){
        $arquivo = $_FILES['file'];
        $arquivoNovo = explode('.',$arquivo['name']);
        if($arquivoNovo[sizeof($arquivoNovo)-1] != 'jpg'){
            die('Você não pode fazer upload desse tipo de arquivoNovo, faça de JPG');
        }
        move_uploaded_file($arquivo['tmp_name'],'NEWS/'.$arquivo['name']);
        $sql = "INSERT INTO `tb_noticias` (`id_noticia`, `nm_imagem`, `nm_titulo`, `ds_noticia`) VALUES (NULL, 'NEWS/".$arquivo['name']."', '".$_POST['title']."', '".$_POST['text']."');";
        $pdo->exec($sql);
        header("Location: index.php");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="img/Trerius.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de arquivos</title>
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

        </div>
        <div class="row">
            <div class="col"></div>
            <div class="col">



                
                <!-- <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="file" /><br><br>
                    <label for="title">Título: </label>
                    <input type="text" name="title" maxlength="50"><br><br>
                    <label for="text">Texto: </label>
                    <textarea name="text" id="text"></textarea><br><br>
                    <input type="submit" name="acao" value="Enviar"/>
                </form> -->

                <div class="card m-5 bg-dark" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">Monte sua notícia</h5>

                    <form action="" method="post" enctype="multipart/form-data">
                        <input class="form-control" type="file" name="file" /><br>
                        <label class="form-label" for="title">Título: </label>
                        <input class="form-control" type="text" name="title" id="title" maxlength="50"><br>
                        <label class="form-label" for="text">Texto: </label>
                        <textarea class="form-control" name="text" id="text"></textarea><br><br>
                        <input type="submit" name="acao" value="Enviar" class="btn btn-primary"/> <a href="index.php" class="btn btn-secondary" style="margin-left:50%;">Voltar</a>
                    </form>
                </div>
                </div>

            </div>
            <div class="col"></div>
        </div>

        <div class="row"></div>


        </div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

</body>
</html>