
<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $membro_id = $_POST['membro_id'];
    $valor = $_POST['valor'];
    $data_pagamento = date('Y-m-d');

    $stmt = $pdo->prepare("INSERT INTO pagamentos (membro_id, valor, data_pagamento) VALUES (?, ?, ?)");
    $stmt->execute([$membro_id, $valor, $data_pagamento]);

    echo "Pagamento registrado com sucesso!";
}
?>

<form method="POST">
    <label>Membro: 
        <select name="membro_id">
            <?php
            $membros = $pdo->query("SELECT * FROM membros")->fetchAll();
            foreach ($membros as $membro) {
                echo "<option value='{$membro['id']}'>{$membro['nome']}</option>";
            }
            ?>
        </select>
    </label><br>
    <label>Valor: <input type="number" step="0.01" name="valor" required></label><br>
    <button type="submit">Registrar Pagamento</button>
</form>
