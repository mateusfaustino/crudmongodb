<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Página Inicial - CRUD de Sites</title>
  <link rel="stylesheet" href="./css/reset.css" />
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f2f5f9;
      padding: 2rem;
      color: #333;
    }

    .container {
      max-width: 900px;
      margin: 0 auto;
      background-color: #fff;
      border-radius: 12px;
      padding: 2rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .page-title {
      font-size: 2rem;
      margin-bottom: 1rem;
      text-align: center;
    }

    .welcome-message {
      font-size: 1rem;
      margin-bottom: 1.5rem;
      text-align: center;
      color: #666;
    }

    .actions {
      text-align: center;
      margin-bottom: 2rem;
    }

    .actions a {
      margin: 0 0.5rem;
      text-decoration: none;
      background-color: #007bff;
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 8px;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .actions a:hover {
      background-color: #0056b3;
    }

    h2 {
      font-size: 1.5rem;
      margin-bottom: 1rem;
      color: #222;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    th, td {
      padding: 0.75rem 1rem;
      text-align: left;
      border-bottom: 1px solid #e0e0e0;
    }

    th {
      background-color: #f4f6fa;
      font-weight: 600;
      color: #333;
    }

    td a {
      color: #007bff;
      text-decoration: none;
      font-weight: 500;
    }

    td a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
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
