<?php
require 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM membros WHERE id = ?");
    $stmt->execute([$id]);
    $membro = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$membro) {
        die("Membro não encontrado.");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $data_nascimento = $_POST['data_nascimento'];
    $plano_id = $_POST['plano_id'];

    $stmt = $pdo->prepare("UPDATE membros SET nome = ?, email = ?, telefone = ?, data_nascimento = ?, plano_id = ? WHERE id = ?");
    $stmt->execute([$nome, $email, $telefone, $data_nascimento, $plano_id, $id]);

    echo "<div class='alert alert-success'>Cadastro atualizado com sucesso!</div>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Membro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Editar Membro</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="<?= $membro['nome'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" value="<?= $membro['email'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control" value="<?= $membro['telefone'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="data_nascimento" class="form-label">Data de Nascimento</label>
            <input type="date" name="data_nascimento" class="form-control" value="<?= $membro['data_nascimento'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="plano_id" class="form-label">Plano</label>
            <select name="plano_id" class="form-control" required>
                <?php
                $planos = $pdo->query("SELECT * FROM planos")->fetchAll();
                foreach ($planos as $plano) {
                    $selected = $plano['id'] == $membro['plano_id'] ? 'selected' : '';
                    echo "<option value='{$plano['id']}' $selected>{$plano['nome']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>