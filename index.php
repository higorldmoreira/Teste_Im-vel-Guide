<?php include('db.php'); session_start(); ?>

<?php
  $editar = false;
  $id = $name = $cpf = $creci = '';

  if (isset($_GET['edit'])) {
    $editar = true;
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM corretores WHERE id = $id");
    $dados = $result->fetch_assoc();

    $name = $dados['name'];
    $cpf = $dados['cpf'];
    $creci = $dados['creci'];
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Corretor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

  <h2 class="mb-4">Cadastro de Corretor</h2>

  <?php if (isset($_SESSION['mensagem'])): ?>
    <div class="alert alert-info"><?= $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?></div>
  <?php endif; ?>

  <form action="salvar.php" method="POST" class="mb-4">
    <?php if ($editar): ?>
      <input type="hidden" name="id" value="<?= $id ?>">
    <?php endif; ?>

    <div class="mb-3">
      <label>CPF</label>
      <input type="text" name="cpf" class="form-control" required minlength="11" maxlength="11" value="<?= $cpf ?>">
    </div>

    <div class="mb-3">
      <label>CRECI</label>
      <input type="text" name="creci" class="form-control" required minlength="2" value="<?= $creci ?>">
    </div>

    <div class="mb-3">
      <label>Nome</label>
      <input type="text" name="name" class="form-control" required minlength="2" value="<?= $name ?>">
    </div>

    <button type="submit" class="btn btn-<?= $editar ? 'warning' : 'primary' ?>">
      <?= $editar ? 'Salvar' : 'Enviar' ?>
    </button>
    <?php if ($editar): ?>
      <a href="index.php" class="btn btn-secondary ms-2">Cancelar</a>
    <?php endif; ?>
  </form>

  <h4>Corretores Cadastrados</h4>
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>ID</th><th>Nome</th><th>CPF</th><th>CRECI</th><th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql = "SELECT * FROM corretores";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()):
      ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= $row['name'] ?></td>
          <td><?= $row['cpf'] ?></td>
          <td><?= $row['creci'] ?></td>
          <td>
            <a href="?edit=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
            <a href="deletar.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger">Excluir</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

</body>
</html>
