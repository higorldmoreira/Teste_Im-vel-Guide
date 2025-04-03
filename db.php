<?php
$host = 'localhost';
$usuario = 'root';
$senha = '2203';
$banco = 'imovel_guide';

$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica conexão
if ($conn->connect_error) {
    die('Erro na conexão: ' . $conn->connect_error);
}
?>
