
<?php 
require 'conexao.php';
if ($_SERVER['REQUEST_METHOD']==='POST'){
    $membro_id =$POST['membro_id'];
    $data_presenca = date('Y-m-d');

    $stmt = $pdo->prepare("INSERT INTO presenca(membro_id, data_presenca) VALUES (?,?)");

    echo "Presença registrada com sucesso!";
}
?>

<form method="POST">
    <label>Membro:
        <select name="membro_id">
            
    <?php
    $membros = $pdo->query("SELECT * FROM membros")->fetchALL();
    foreach ($membros as $membro) {
        echo "<option value ='{$membro['id']}'>{$membro['nome']}</option>";
    }
    ?>
    ?> </select> </label><br> <button type="submit">Registrar Presença</button> </form>

    