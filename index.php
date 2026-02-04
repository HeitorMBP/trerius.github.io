<?php
session_start();
include('process/conn.php'); //conexão = $pdo

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php
    
     if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        header("location:userlogin.php");
        $logado = "USER";
        $isAdmin = 0;
    }else{
        $logado = $_SESSION['login'];
        $id = $_SESSION['id'];
        $isAdmin = $_SESSION['isAdmin'] ;
        
    }
    if(isset($_SESSION['error'])){
         echo "<script type='text/javascript'>alert('" . $_SESSION['error'] . "');</script>";
        unset($_SESSION['error']); 
    }
    
    ?>





    <meta author="M4St3r_Fr0m_Th3_d4Rk">
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="Trerius.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="120">
    <link rel="stylesheet" href="style/div.css">
    
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <title>
        Trerius
    </title>
</head>
<body class="overflow-x-hidden">
    <style>
        *{
    font-family:monospace;
    margin: 0%;
    font-size: 10pt;
    transition: all .24s ease-in-out;
    color: rgb(161, 113, 206);
}

body{
    background-color: black;
    box-sizing: border-box;
}

button{
    cursor: pointer;
}

#loading {
    position: fixed;
    z-index: 999;
    height: 2em;
    width: 2em;
    overflow: show;
    margin: auto;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    display: none;
}

/* Transparent Overlay */
#loading:before {
    content: '';
    display: block;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
}

/* :not(:required) hides these rules from IE9 and below */
#loading:not(:required) {
    /* hide "loading..." text */
    font: 0/0 a;
    color: transparent;
    text-shadow: none;
    background-color: transparent;
    border: 0;
}

#loading:not(:required):after {
    content: '';
    display: block;
    font-size: 10px;
    width: 1em;
    height: 1em;
    margin-top: -0.5em;
    animation: spinner 2s infinite linear;
    border-radius: 0.5em;
    box-shadow: rgba(255, 92, 241, 0.75) 1.5em 0 0 0, rgba(255, 92, 241, 0.75) 1.1em 1.1em 0 0, rgba(255, 92, 241, 0.75) 0 1.5em 0 0, rgba(255, 92, 241, 0.75) -1.1em 1.1em 0 0, rgba(255, 92, 241, 0.75) -1.5em 0 0 0,rgba(255, 92, 241, 0.75) -1.1em -1.1em 0 0, rgba(255, 92, 241, 0.75) 0 -1.5em 0 0,rgba(255, 92, 241, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */
@keyframes spinner {
    0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
a{
    color: rgb(161, 113, 206);
}




    </style>



    <div class="container-fluid">
        <div class="row ">
        <div class="col">
            <h1 style="font-size: 24pt;">Trerius</h1>
        </div>
        <div class="col">
            <h2 style="font-size: 50pt;" class="text-center">NEWS</h2>
 
            






<?php
    if($isAdmin){
        echo "
            <div class=\"modal  \" tabindex=\"-1\" id=\"exampleModal\">
                <div class=\"modal-dialog\">
                    <div class=\"modal-content\">
                    <div class=\"modal-header\">
                        <h5 class=\"modal-title\">Ferramentas de Admin</h5>
                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                    </div>
                    <div class=\"modal-body text-center\">
                        <a href=\"uploadft.php\" style=\"background-color:rgb(161, 113, 206);color:white;\" class=\"btn\">Adicionar notícia com imagem JPG</a><br><br>
                        <a href=\"uploadlk.php\" style=\"background-color:rgb(161, 113, 206);color:white;\" class=\"btn\">Adicionar notícia com link</a><br><br>
                        <a href=\"delete-new.php\" style=\"background-color:rgb(161, 113, 206);color:white;\" class=\"btn\">Deletar notícia</a><br><br>
                        <a href=\"ADM-equipe.php\" style=\"background-color:rgb(161, 113, 206);color:white;\" class=\"btn\">Gerenciar equipes</a><br><br>
                    </div>
                    <div class=\"modal-footer\">
                        <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">Close</button>
                    </div>
                    </div>
                </div>
            </div>
        ";
    }
?>











        </div>
        <div class="col" style="text-align: end;">
            <a style="font-size: 24pt;"  href="#"><?php echo $logado;?></a>
        </div>
        
    </div>
    
    <div class="row" style="height:650px;">
        <div class="col">
            



                <!-- <button  onclick="window.location.href='chat.php'" type="button" style="font-size: 15pt;color: rgb(161, 113, 206);" class="btn btn-link position-relative">
  POSTS/CHAT
  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    99+
    <span class="visually-hidden">unread messages</span>
  </span>
</button> -->
        </div>






        <div class="col text-center " style="text-align: center; display:flex; flex-flow:column wrap; justify-content:center;">
            
      <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" style="align-self:center;">
                <div class="carousel-inner ">

                    <div class="carousel-item active ">
                            <!-- <div class="card bg-dark" style="width: 38rem; heigth: 38rem;">
                                <img src="img/NEWS.PNG" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">NEWS</h5>
                                    <p class="card-text"></p>
                                    
                                </div>
                            </div> -->
                            <div style="background-color:black; ">
                                <img src="img/Trerius_logo_completa.png"  height="560px" alt="">
                            </div>
                    </div> 

                    <?php
                        $sql = "SELECT nm_imagem, nm_titulo, ds_noticia FROM tb_noticias ORDER BY id_noticia ASC;";

                        foreach ($pdo -> query($sql) as $row){
                            echo "<div class='carousel-item '>";
                            echo "<div class='card bg-dark' style='width: 48rem;'>";
                            echo "<img src=\"".$row['nm_imagem']."\" class=\"card-img-top\">";
                            echo "<div class='card-body'>";
                            echo "<h5 class=\"card-title\">".$row['nm_titulo']."</h5>
                                    <p class=\"card-text\">".$row['ds_noticia']."</p>
                                     </div>
                                    </div>
                                    </div>";
                        }
                    ?>
                    
                </div>
       </div>
                    </div>
        <div class="col" style="display:flex; flex-flow:column wrap; text-align: end; justify-content:center;">
            <ul style="list-style: none;" >
                <li style="font-size: 15pt;"><a href="useraccount.php" style="font-size: 15pt;">USER ACCOUNT</a></li>
                <li style="font-size: 15pt;"><a href="#" style="font-size: 15pt;">CONFIG</a></li>
                <li style="font-size: 15pt;"><a href="equipe.php" style="font-size: 15pt;">YOUR TEAM</a></li>
            </ul>
        </div>


    <footer class="row fixed-bottom">
        <div class="col">
            <?php
                if($isAdmin){
                    echo "
                    <button type=\"button\" style=\"background-color:rgb(161, 113, 206);color:white;\" class=\"btn m-3\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">
                        Ferramentas <br>
                        de
                        <br> Admin
                    </button>
                    ";
                }
            ?>



















          

















        </div>
        <div class="col" style="text-align: end;">
            <ul style="list-style: none;">
                <li style="font-size: 14pt;"><a href="#" style="font-size: 14pt;">ABOUT US</a></li>
                <li style="font-size: 14pt;"><a href="#" style="font-size: 14pt;">SUPPORT</a></li>
                <li style="font-size: 14pt;"><a href="userlogin.php" style="font-size: 14pt;">LOG-IN </a>| <a href="logout.php" style="font-size: 14pt;">LOG-OUT</a></li>
            </ul>
        </div>
    </div>
    </div>





<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>


<script>
   const myCarouselElement = document.querySelector('#carouselExampleSlidesOnly')

const carousel = new bootstrap.Carousel(myCarouselElement, {
  interval: 5000,
  touch: false
})
</script>


</body>
</html>