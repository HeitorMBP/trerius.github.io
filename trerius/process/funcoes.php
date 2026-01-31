<?php
include('process/conn.php');

function criarConversa($pdo, $tipo, $criadorId) {
    $sql = "INSERT INTO tb_conversa (nm_tipo, id_user_criador, dt_criado)
            VALUES (?, ?, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$tipo, $criadorId]);
    return $pdo->lastInsertId();
}


function adicionarMembro($pdo, $conversationId, $userId) {
    $sql = "INSERT INTO conversation_members (conversation_id, user_id, entrou_em)
            VALUES (?, ?, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$conversationId, $userId]);
}

function trocarMembro($pdo, $conversationId, $userId){
    $sql = "UPDATE conversation_members SET conversation_id = ?, entrou_em = NOW() WHERE user_id = ?";
    $pdo ->prepare($sql)->execute([$conversationId, $userId]);
}


function enviarMensagem($pdo, $conversationId, $senderId, $conteudo) {
    $sql = "INSERT INTO tb_mensagem (id_conversa, id_user_sender, ds_conteudo, dt_enviado)
            VALUES (?, ?, ?, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$conversationId, $senderId, $conteudo]);
    return $pdo->lastInsertId();
}

function listarMensagens($pdo, $conversationId) {
    $sql = "SELECT u.id_user as id, m.id_mensagem, m.ds_conteudo, m.dt_enviado, u.nm_user AS autor, u.nm_imagem AS imagem
            FROM tb_mensagem m
            JOIN tb_user u ON u.id_user = m.id_user_sender
            WHERE m.id_conversa = ?
            ORDER BY m.dt_enviado ASC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$conversationId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function marcarComoLida($pdo, $messageId, $userId) {
    $sql = "INSERT INTO message_reads (message_id, user_id, lido_em)
            VALUES (?, ?, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$messageId, $userId]);
}

function enviarAnexo($pdo, $messageId, $arquivo) {
    $nome = $arquivo['name'];
    $tmp = $arquivo['tmp_name'];

    $destino = "upload/" . uniqid() . "_" . $nome;
    move_uploaded_file($tmp, $destino);

    $sql = "INSERT INTO message_attachments (message_id, url_arquivo, tipo, tamanho_bytes)
            VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$messageId, $destino, $arquivo['type'], $arquivo['size']]);
}

?>