<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Adicionar Site</title>
  <link rel="stylesheet" href="./css/reset.css" />
  <link rel="stylesheet" href="./css/style.css" />
</head>
<body class="center-page" style="flex-direction:column;">
  <?php if (!empty($message)): ?>
    <div class='message'><?= $message ?></div>
  <?php endif; ?>
  <div class="form-container">

    <h1 class="form-title">Adicionar Novo Site</h1>
    <form action="create.php" method="post">
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token, ENT_QUOTES, 'UTF-8'); ?>" />
      <div class="form-group">
        <label for="nome">Nome do site:</label>
        <input type="text" id="nome" name="nome" required />
      </div>
      <div class="form-group">
        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required />
      </div>
      <input type="submit" class="submit-btn" value="Adicionar Site" />
    </form>
  </div>
</body>
</html>
