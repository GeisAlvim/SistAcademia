

<?php 
require 'conexao.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $data_nascimento = $_POST['data_nascimento'];
    $plano_id = $_POST['plano_id'];

    $stmt = $pdo->prepare("INSERT INTO membros(nome, email, telefone, data_nascimento, plano_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nome, $email, $telefone, $data_nascimento, $plano_id]);

    echo "<div class='alert alert-success'>Membro cadastrado com sucesso!</div>"; 
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Membro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://png.pngtree.com/background/20230827/original/pngtree-3d-rendering-of-a-hospital-s-indoor-corridor-picture-image_4842146.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff; /* Texto branco para contraste */
        }
        .container {
            background-color: rgba(0, 0, 0, 0.8); /* Fundo preto com transparência */
            padding: 20px;
            border-radius: 10px;
        }
        .form-group img {
            max-width: 10%;
            height: auto;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1>Cadastrar Membro</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control">
        </div>
        <div class="mb-3">
            <label for="data_nascimento" class="form-label">Data de Nascimento</label>
            <input type="date" name="data_nascimento" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="plano_id" class="form-label">Plano</label>
            <select name="plano_id" class="form-control">
                <?php
                $planos = $pdo->query("SELECT * FROM planos")->fetchAll();
                foreach ($planos as $plano) {
                    echo "<option value='{$plano['id']}'>{$plano['nome']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




