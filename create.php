<?php
// create.php
session_start();
require 'connection.php';
require 'csrf.php';
$token = generate_csrf_token();

?>

<!-- Formulário para adicionar um site -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Adicionar Site</title>
  <link rel="stylesheet" href="./css/reset.css" />
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f2f5f9;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      color: #333;
    }

    .form-container {
      background: #ffffff;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      width: 100%;
      max-width: 500px;
    }

    .form-title {
      text-align: center;
      font-size: 1.8rem;
      margin-bottom: 1.5rem;
    }

    .form-group {
      margin-bottom: 1.2rem;
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 600;
    }

    input[type="text"] {
      width: 100%;
      padding: 0.75rem;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 1rem;
      transition: border-color 0.3s ease;
    }

    input[type="text"]:focus {
      border-color: #007bff;
      outline: none;
    }

    .submit-btn {
      width: 100%;
      padding: 0.75rem;
      background-color: #007bff;
      color: white;
      border: none;
      font-weight: bold;
      font-size: 1rem;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .submit-btn:hover {
      background-color: #0056b3;
    }

    .message {
      background-color: #d4edda;
      color: #155724;
      padding: 1rem 1.5rem;
      border-radius: 8px;
      border: 1px solid #c3e6cb;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
      font-size: 1rem;
      font-weight: 500;
      max-width: 400px;
      text-align: center;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
                die('CSRF validation failed');
            }
            // Capturar dados do formulário
            $nome = $_POST['nome'];
            $endereco = $_POST['endereco'];

            $document = [
                'nome' => $nome,
                'endereco'=>$endereco
            ];
            // Preparar o documento para inserção
            $bulk = new MongoDB\Driver\BulkWrite;
                
            $bulk->insert($document);

            // Inserir no MongoDB
            $manager->executeBulkWrite('catalogosites.sites', $bulk);

            echo "<div class='message'>Site cadastrado com sucesso!</div>";
        }
    ?>
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
