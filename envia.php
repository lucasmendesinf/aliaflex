<?php
$nome = trim($_POST['nomeremetente'] ?? '');
$email = trim($_POST['emailremetente'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$assunto = trim($_POST['assunto'] ?? '');
$mensagem = trim($_POST['mensagem'] ?? '');

$destino = 'contato@aliaflex.com.br';
$titulo = $assunto !== '' ? 'Contato pelo site: ' . $assunto : 'Contato pelo site Aliaflex';
$corpo = "Nome: {$nome}\nE-mail: {$email}\nTelefone: {$telefone}\n\nMensagem:\n{$mensagem}\n";
$headers = "From: {$destino}\r\nReply-To: {$email}\r\nContent-Type: text/plain; charset=UTF-8\r\n";
$enviado = false;

if ($nome !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) && $mensagem !== '') {
    $enviado = @mail($destino, $titulo, $corpo, $headers);
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contato recebido | Aliaflex</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body class="d-flex min-vh-100 align-items-center bg-light">
  <main class="container">
    <div class="contact-form mx-auto" style="max-width: 680px;">
      <img src="assets/img/impressoras_r1_c4.png" alt="Aliaflex Etiquetas Adesivas" class="img-fluid mb-4" style="max-width: 360px;">
      <?php if ($enviado): ?>
        <h1 class="h3 text-primary fw-bold">Mensagem enviada com sucesso.</h1>
        <p class="mb-4">Obrigado pelo contato. A Aliaflex retornará o mais breve possível.</p>
      <?php else: ?>
        <h1 class="h3 text-primary fw-bold">Recebemos seus dados.</h1>
        <p class="mb-4">O servidor local pode não estar configurado para envio de e-mail. Confira os dados informados ou entre em contato diretamente com a Aliaflex.</p>
      <?php endif; ?>
      <a class="btn btn-primary" href="index.html#contato">Voltar ao site</a>
    </div>
  </main>
</body>
</html>
