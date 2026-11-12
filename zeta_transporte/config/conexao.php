<?php
$host = "localhost";
$banco = "zeta_transporte";
$usuario = "root";
$senha = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$banco;charset=utf8mb4",
        $usuario,
        $senha
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $erro) {
    die("Não foi possível conectar ao banco de dados. Confira o XAMPP e o arquivo config/conexao.php.");
}
?>