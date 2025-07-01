<?php
session_start();
require 'connection.php'; // Conexão com o MongoDB
require 'csrf.php';
$token = generate_csrf_token();

if (isset($_POST['email'])) {


    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        die('CSRF validation failed');
    }
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);

    if (!$email || $senha === null) {
        $erro = "Email ou senha inválidos!";
    } else {
    
    // Criar uma consulta para buscar o usuário pelo email
    $filter = ['email' => $email];
    $query = new MongoDB\Driver\Query($filter);

    // Executar a consulta
    try {
        $cursor = $manager->executeQuery('catalogosites.usuarios', $query); // Usando "catalogosites"
        $usuario = current($cursor->toArray());
    } catch (\Throwable $e) {
        error_log('MongoDB query error: ' . $e->getMessage());
        die('Erro ao buscar usuário.');
    }

    // Verificar se o usuário foi encontrado e se a senha está correta utilizando hash
    if ($usuario && password_verify($senha, $usuario->senha)) {
        // Iniciar a sessão e redirecionar para a página index.php
        $_SESSION['email'] = $usuario->email;
        header("Location: index.php");
        exit();
    } else {
        $erro = "Email ou senha inválidos!";
    }
}
}?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - CRUD de Sites</title>
  <link rel="stylesheet" href="./css/reset.css" />
  <style>
    /* Estilos diretos na tag style conforme solicitado */
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f2f5f9;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    .login-container {
      background: #ffffff;
      padding: 2.5rem 2rem;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }

    .login-title {
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

    .error-message {
      color: #d00000;
      margin-top: 1rem;
      text-align: center;
      font-weight: 500;
    }

    .register-link {
      text-align: center;
      margin-top: 1rem;
    }

    .register-link a {
      color: #007bff;
      text-decoration: none;
    }
  </style>
</head>
<body>
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

    <?php if (isset($erro)) : ?>
      <p class="error-message"><?= $erro ?></p>
    <?php endif; ?>
  </div>
</body>
</html>

