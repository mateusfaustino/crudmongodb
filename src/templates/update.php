<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Editar Site</title>
   <link rel="stylesheet" href="./css/reset.css" />
   <link rel="stylesheet" href="./css/style.css" />
</head>
<body class="center-page">
<?php if (!empty($message)): ?>
  <div class='message'><?= $message ?></div>
<?php endif; ?>
<div class="form-container">
    <h1 class="form-title">Editar Site</h1>
    <form action="update.php" method="post">
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token, ENT_QUOTES, 'UTF-8'); ?>" />
      <input type="hidden" name="id" value="<?= htmlspecialchars((string) $site->_id, ENT_QUOTES, 'UTF-8') ?>" />

      <div class="form-group">
        <label for="nome">Nome do site:</label>
        <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($site->nome, ENT_QUOTES, 'UTF-8') ?>" required />
      </div>

      <div class="form-group">
        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" value="<?= htmlspecialchars($site->endereco, ENT_QUOTES, 'UTF-8') ?>" required />
      </div>

      <input type="submit" class="submit-btn" value="Atualizar Site" />
    </form>
  </div>
</body>
</html>
