<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - CRUD de Sites</title>
  <link rel="stylesheet" href="./css/reset.css" />
  <link rel="stylesheet" href="./css/style.css" />
</head>
<body class="center-page">
  <div class="login-container">
    <h1 class="login-title">Login</h1>
    <form action="login.php" method="post">
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token, ENT_QUOTES, 'UTF-8'); ?>" />
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" required />
      </div>
      <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" name="senha" required />
      </div>
      <input class="submit-btn" type="submit" value="Entrar" />
    </form>

    <p class="register-link">Ainda não possui conta? <a href="register.php">Cadastre-se</a></p>

    <?php if (!empty($erro)) : ?>
      <p class="error-message"><?= $erro ?></p>
    <?php endif; ?>
  </div>
</body>
</html>
