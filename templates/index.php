<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Página Inicial - CRUD de Sites</title>
  <link rel="stylesheet" href="./css/reset.css" />
  <link rel="stylesheet" href="./css/style.css" />
</head>
<body class="index-page">
  <div class="container">
    <h1 class="page-title">Gerenciamento de Sites</h1>
    <p class="welcome-message">Bem-vindo, <?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>!</p>

    <div class="actions">
      <a href="create.php">Adicionar Novo Site</a>
      <a href="logout.php">Logout</a>
    </div>

    <h2>Lista de Sites</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Endereço</th>
          <th>Ações</th>
        </tr>
      </thead>
        <tbody>
          <?php foreach ($sites as $document): ?>
              <tr>
              <td><?= htmlspecialchars((string) $document->_id, ENT_QUOTES, 'UTF-8'); ?></td>
              <td><?= htmlspecialchars($document->nome, ENT_QUOTES, 'UTF-8'); ?></td>
              <td><a href="<?= htmlspecialchars($document->endereco, ENT_QUOTES, 'UTF-8'); ?>" target="_blank">
                  <?= htmlspecialchars($document->endereco, ENT_QUOTES, 'UTF-8'); ?></a></td>
              <td>
              <a href='update.php?id=<?= htmlspecialchars((string) $document->_id, ENT_QUOTES, 'UTF-8'); ?>'>Editar</a> |
              <a href='delete.php?id=<?= htmlspecialchars((string) $document->_id, ENT_QUOTES, 'UTF-8'); ?>'>Deletar</a>
              </td>
              </tr>
          <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
