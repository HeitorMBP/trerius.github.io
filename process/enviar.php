<?php
include('conn.php');
include('funcoes.php');
session_start();

$conversationId = $_POST['conversation_id'];
$conteudo = $_POST['conteudo'];
$usuarioId = $_SESSION['id'];

$idMsg = enviarMensagem($pdo, $conversationId, $usuarioId, $conteudo);

header("Location: ../chat.php?id=$conversationId");
?>