<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastro de Usuário</title>
  <link rel="stylesheet" href="./css/reset.css" />
  <link rel="stylesheet" href="./css/style.css" />
</head>
<body class="center-page">
  <div class="register-container">
    <h1 class="register-title">Cadastro</h1>
    <?php if (!empty($mensagem)) : ?>
      <div class="message"><?= $mensagem ?></div>
    <?php endif; ?>
    <form action="register.php" method="post">
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token, ENT_QUOTES, 'UTF-8'); ?>" />
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" required />
      </div>
      <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" name="senha" required />
      </div>
      <input class="submit-btn" type="submit" value="Cadastrar" />
    </form>
  </div>
</body>
</html>
