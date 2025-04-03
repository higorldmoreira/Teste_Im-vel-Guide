<?php
include('db.php');
session_start();

$name = trim($_POST['name']);
$cpf = trim($_POST['cpf']);
$creci = trim($_POST['creci']);

if (strlen($cpf) != 11 || strlen($creci) < 2 || strlen($name) < 2) {
  $_SESSION['mensagem'] = "Preencha os campos corretamente!";
  header("Location: index.php");
  exit;
}

if (isset($_POST['id'])) {
  // Edição
  $id = $_POST['id'];
  $stmt = $conn->prepare("UPDATE corretores SET name = ?, cpf = ?, creci = ? WHERE id = ?");
  $stmt->bind_param("sssi", $name, $cpf, $creci, $id);
  $executado = $stmt->execute();

  $_SESSION['mensagem'] = $executado ? "Dados atualizados com sucesso!" : "Erro ao atualizar!";
} else {
  // Inserção
  $stmt = $conn->prepare("INSERT INTO corretores (name, cpf, creci) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $name, $cpf, $creci);
  $executado = $stmt->execute();

  $_SESSION['mensagem'] = $executado ? "Corretor cadastrado com sucesso!" : "Erro ao cadastrar!";
}

header("Location: index.php");
exit;
