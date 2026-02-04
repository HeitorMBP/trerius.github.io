<?php
session_start();
include('process/conn.php');

     if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        $_SESSION['error'] = "Faça login para continuar";
        header("location:index.php");
        
    }else{
        $logado = $_SESSION['login'];
        $id = $_SESSION['id'];
        $isAdmin = $_SESSION['isAdmin'] ;
    }

    $sql = "SELECT nm_imagem, ds_about FROM tb_user WHERE id_user = ".$id;
    $user = $pdo -> query($sql) -> fetch(PDO::FETCH_ASSOC) ;

    if($user){

        $imagem = $user['nm_imagem'];
        $about = $user['ds_about'];

        $_SESSION['imagem'] = $imagem;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="Trerius.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conta de <?php echo $logado; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<style>
    body{
        overflow-x: hidden;
        box-sizing: border-box;
         background-color: black;
         color: rgb(161, 113, 206);
    }

    .upload-area {
    position: relative;
    width: 200px;
    height: 200px;
    cursor: pointer;
}

.upload-area img#preview {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 100%;
}

/* Container do ícone */
.upload-icon {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity .3s;
    border-radius: 100%;
}

/* A imagem do ícone */
.upload-icon img {
    width: 60px;   /* ajuste como quiser */
    opacity: 0.9;
}

/* Hover mostra o ícone */
.upload-area:hover .upload-icon {
    opacity: 1;
}

/* Input invisível */
#fileInput {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    top: 0;
    left: 0;
}
</style> 
</head>
<body >
    


<div class="container">
















<div class="row" >
<div class="col "></div>
<div class="um bg-dark text-center pb-4">
    <div class="dois bg-dark d-flex" >
    <div class="col">

 <?php

                
                   if(isset($_POST['salvar'])){

                     if(isset($_FILES['file'])){
                        $arquivo = $_FILES['file'];

                        $arquivoNovo = explode('.',$arquivo['name']);

                        if($arquivoNovo[sizeof($arquivoNovo)-1] != 'jpg'){
                            die('Você não pode fazer upload desse tipo de arquivoNovo, faça de JPG');
                            
                        }else{
                                         
                            move_uploaded_file($arquivo['tmp_name'],'profilePics/'.$arquivo['name']);

                           
                            $sql = "UPDATE `tb_user` SET `nm_imagem` = 'profilePics/".$arquivo['name']."' WHERE `tb_user`.`id_user` =".$id;
                            
                            $pdo -> exec($sql);
                            header('refresh:1');
                            
                        }
                    }
                   
                   }
                
            ?>
         







<form action="" method="post" enctype="multipart/form-data">
    <div class="upload-area">
    <img id="preview" src="<?php echo $imagem; ?> " alt="">
    <div class="upload-icon"><img src="img/upload-pic.png" height="50px" width="50px" alt=""></div>
    <input type="file" id="fileInput" name="file" accept="image/*" onchange="document.getElementById('inv').setAttribute('class','visible')">
</div>
    
    <div class="invisible" id="inv">
        <input type="submit" class="btn btn-success" name="salvar" value="Salvar">
    </div>
</form>





<?php
    if(isset($_POST['salvar-texto'])){
        $sql = "UPDATE `tb_user` SET `ds_about` = '".$_POST['about']."' WHERE `tb_user`.`id_user` =".$id;
                            
                            $pdo -> exec($sql);
                            header('refresh:1');
    }


?>








</div>
<div class="col" >
    <div class="col text-start"><h1><?php echo $logado; ?></h1></div>


    <form action="" method="post">
    <textarea class="form-control" name="about" id="about" onchange="document.getElementById('inv2').setAttribute('class','visible')"><?php  echo $about;?></textarea><br>
    <div class="invisible" id="inv2">
        <input type="submit" class="btn btn-success" name="salvar-texto" value="Salvar">
    </div>
</form>




</div>
</div>
<a href="index.php" class="btn btn-secondary">Página inicial</a><br>
</div>



<div class="col "></div>



</div>



</div>







<script>
document.getElementById('fileInput').addEventListener('change', function(event) {
    const reader = new FileReader();

    reader.onload = function(){
        document.getElementById('preview').src = reader.result;
    }

    reader.readAsDataURL(event.target.files[0]);
});
</script>






<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

</body>
</html>