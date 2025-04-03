<?php
include('db.php');
session_start();

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM corretores WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
  $_SESSION['mensagem'] = "Registro excluído com sucesso!";
} else {
  $_SESSION['mensagem'] = "Erro ao excluir!";
}

header("Location: index.php");
exit;
