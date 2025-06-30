<?php
session_start();
require 'connection.php';
require 'csrf.php';
$token = generate_csrf_token();

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        die('CSRF validation failed');
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);

    if (!$email || $senha === null) {
        $mensagem = 'Dados de cadastro inválidos!';
    } else {
        $hash = password_hash($senha, PASSWORD_DEFAULT);

        $document = [
            'email' => $email,
            'senha' => $hash
        ];

        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->insert($document);
        try {
            $manager->executeBulkWrite('catalogosites.usuarios', $bulk);
        } catch (\Throwable $e) {
            error_log('MongoDB insert error: ' . $e->getMessage());
            die('Erro ao cadastrar usuário.');
        }

        $mensagem = 'Usuário cadastrado com sucesso!';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastro de Usuário</title>
  <link rel="stylesheet" href="./css/reset.css" />
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f2f5f9;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    .register-container {
      background: #ffffff;
      padding: 2.5rem 2rem;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }

    .register-title {
      text-align: center;
      margin-bottom: 1.5rem;
      font-size: 1.8rem;
      color: #333;
    }

    .form-group {
      margin-bottom: 1rem;
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 600;
      color: #333;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 0.75rem;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 1rem;
      transition: border 0.3s ease;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
      border-color: #007bff;
      outline: none;
    }

    .submit-btn {
      width: 100%;
      padding: 0.75rem;
      background-color: #007bff;
      border: none;
      color: white;
      font-weight: bold;
      border-radius: 8px;
      cursor: pointer;
      font-size: 1rem;
      transition: background 0.3s ease;
    }

    .submit-btn:hover {
      background-color: #0056b3;
    }

    .message {
      color: #155724;
      background-color: #d4edda;
      padding: 1rem;
      border-radius: 8px;
      text-align: center;
      margin-bottom: 1rem;
    }
  </style>
</head>
<body>
  <div class="register-container">
    <h1 class="register-title">Cadastro</h1>
    <?php if (isset($mensagem)) : ?>
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
