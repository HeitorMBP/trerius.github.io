<?php
session_start();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="Trerius.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>
<body class="bg-dark">
    <div class="container">
       <div class="offcanvas offcanvas-start show bg-black" style="color: rgb(161, 113, 206);" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Menu <a href="index.php" class="btn">Retornar🏠</a></h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <form action="" method="get" style="height:550px" class="bg-white overflow-y-auto">
        <div class="list-group">
            
           <?php
           
           
            echo "
            <button type=\"submit\" class=\"list-group-item bg-secondary list-group-item-action \" name=\"id\" value=\"1\" aria-current=\"true\">
                The current button is 1
            </button>
            
            ";
           
           
           ?>
        </div>
    </form>
  </div>
</div>
        <div class="row">
            <div class="col "></div>
            






           <div class="col ">
            <div class="bg-white" style="border-radius: 0px 0px 10px 10px">
                 <div class="mensagens overflow-x-hidden overflow-y-auto" style="height:650px;overflow-x:none; width:800px; background-color: #ccc; color:black;">
                <?php
            include('process/conn.php');
            include('process/funcoes.php');
            
            if(isset($_GET['id'])){
                $conversationId = $_GET['id'];
            $mensagens = listarMensagens($pdo, $conversationId);
                
            foreach ($mensagens as $m) {
               if($m['id'] == $_SESSION['id']){
                    echo "<div class=\"row\">
                    
                    <div class=\"col\"></div>
                    <div class=\"col mb-5\">
                <div class=\"toast show \" role=\"alert\" aria-live=\"assertive\" aria-atomic=\"true\">
                <div class=\"toast-header bg-primary\">
                    <img src=\"{$m['imagem']}\" height=\"50px\" class=\"rounded me-2\" alt=\"...\">
                    <strong class=\"me-auto\">{$m['autor']}</strong>
                    <small>{$m['dt_enviado']}</small>
                    
                </div>
                <div class=\"toast-body\">
            {$m['ds_conteudo']}
                </div>
                </div>
                </div>
                </div>
                ";
               }else{
                echo "
                <div class=\"row\">
                <div class=\"col mb-5\">
                <div class=\"toast show\" role=\"alert\" aria-live=\"assertive\" aria-atomic=\"true\">
                <div class=\"toast-header bg-secondary\">
                    <img src=\"{$m['imagem']}\" height=\"50px\" class=\"rounded me-2\" alt=\"...\">
                    <strong class=\"me-auto\">{$m['autor']}</strong>
                    <small>{$m['dt_enviado']}</small>
                    
                </div>
                <div class=\"toast-body\">
            {$m['ds_conteudo']}
                </div>
                </div>
                </div>
                <div class=\"col\">
                </div>
                </div>
                ";
                }
            }
            }
            ?>
             </div>

<?php 

            if(isset($_GET))


?>

        <form method="POST" action="process/enviar.php">
            <input type="hidden" name="conversation_id" value="<?php if(isset($_GET['id'])){
                echo $_GET['id'];
                    } ?>">
            <div class="input-group">
            
            <textarea class="form-control" aria-label="With textarea" name="conteudo"></textarea>
            <span class="input-group-text"><button type="submit" class="btn "><img src="img/send.png" height="40px"></button></span>
            </div>
            </div>
            
        </form>
           </div>










          
            <div class="col"></div>
        </div>
    </div>





        
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>