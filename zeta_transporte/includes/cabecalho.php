<?php
require_once __DIR__ . "/funcoes.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Ana Clara Lopes">
    <title><?= isset($titulo) ? limpar($titulo) . " | " : "" ?>Zeta Transporte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark topo">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">ZETA <span>TRANSPORTE</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <div class="navbar-nav ms-auto align-items-lg-center">
                <a class="nav-link" href="index.php">Início</a>
                <a class="nav-link" href="produtos.php">Produtos</a>
                <a class="nav-link" href="curriculos.php">Trabalhe conosco</a>
                <?php if (isset($_SESSION["usuario_id"])): ?>
                    <a class="nav-link" href="dashboard.php">Minha conta</a>
                    <a class="btn btn-light btn-sm ms-lg-2" href="logout.php">Sair</a>
                <?php else: ?>
                    <a class="nav-link" href="cadastro.php">Cadastro</a>
                    <a class="btn btn-danger btn-sm ms-lg-2" href="login.php">Entrar</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
<main>
